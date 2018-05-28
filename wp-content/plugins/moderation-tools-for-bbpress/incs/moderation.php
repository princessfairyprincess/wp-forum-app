<?php
class bbPressModToolsPlugin_Moderation extends bbPressModToolsPlugin {

	public static function init() {

		$self = new self();

		// Moderate the post and mark as awaiting approval
		add_filter( 'bbp_new_topic_pre_insert', array( $self, 'moderate_post' ) );
		add_filter( 'bbp_edit_topic_pre_insert', array( $self, 'moderate_post' ) );
		add_filter( 'bbp_new_reply_pre_insert', array( $self, 'moderate_post' ) );
		add_filter( 'bbp_edit_reply_pre_insert', array( $self, 'moderate_post' ) );

		// Trigger action processing
		add_action( 'init', array( $self, 'handle_actions' ) );

		// Report Post
		add_action( 'wp_ajax_bbp_report_post', array( $self, 'handle_report_post' ) );
		add_action( 'wp_ajax_nopriv_bbp_report_post', array( $self, 'handle_report_post' ) );

	}

	/**
	 * Mark topics and replies as awaiting moderation
	 *
	 *	@since  0.1.0
	 *	@since  1.0.0 Added english detection and expanded logic to allow multiple rules
	 *
	 * @param  INT $post_id
	 */
	public function moderate_post( $post ) {

		global $wpdb;

		// Check if the topic is a reply or topic
		if ( 'reply' != $post['post_type'] && 'topic' != $post['post_type'] ) {

			return $post;

		}

		// Skip moderation if the post is marked as spam
		if ( 'spam' == $post['post_status'] ) {

			return $post;

		}

		// Skip moderation if the user has moderation power
		if ( $this->user_can_moderate() ) {

			return $post;

		}

		$moderation_type = get_option( '_bbp_moderation_type' );

		// Check if any moderation type is set, if not or is off return the post as is.
		if ( empty( $moderation_type ) || 'off' == $moderation_type ) {

			return $post;

		}

		// If the moderation type is set to 'all', set post status to pending and return $post
		if ( ! empty( $moderation_type ) && 'all' == $moderation_type ) {

			$post['post_status'] = 'pending';
			return $post;

		}

		// If moderation type is custom, run valid checks
		if ( ! empty( $moderation_type ) && 'custom' == $moderation_type ) {

			$test_content = htmlspecialchars_decode( stripslashes( $post['post_content'] ) );
			$test_title = htmlspecialchars_decode( stripslashes( $post['post_title'] ) );

			$custom_moderation_options = get_option( '_bbp_moderation_custom' );

			// Run the ascii english detection check
			if ( ! empty( $custom_moderation_options ) && ( in_array( 'ascii', $custom_moderation_options ) || in_array( 'ascii_unnaproved', $custom_moderation_options ) ) ) {

				$ascii_approved = get_user_meta( $post['post_author'], '_ascii_moderation_approved', TRUE );

				if ( ! $ascii_approved ) {

					$len = strlen( $test_content );
					for ($i = 0; $i < $len; $i++) {
						$ord = ord( $test_content[$i] );
						if ( $ord == 10 || $ord == 32 || $ord == 194 || $ord == 163 ) {

						} else if ( $ord > 127 ) {
							$non_english_arr[] = $ord;
						} else {
							$english_arr[] =  $ord;
						}
					}

					$len = strlen( $test_title );
					for ($i = 0; $i < $len; $i++) {
						$ord = ord( $test_title[$i] );
						if ( $ord == 10 || $ord == 32 || $ord == 194 || $ord == 163 ) {

						} else if ( $ord > 127 ) {
							$non_english_arr[] = $ord;
						} else {
							$english_arr[] =  $ord;
						}
					}

					$english_percent = ( count( $english_arr ) / ( count( $non_english_arr ) + count( $english_arr ) ) ) * 100 ;
					$bbp_moderation_english_threshold = get_option( '_bbp_moderation_english_threshold');
					$english_threshold = ! empty( $bbp_moderation_english_threshold ) ? $bbp_moderation_english_threshold : 70;

					if ( (int) $english_percent < (int) $english_threshold ) {

						$post['post_status'] = 'pending';
						$post['meta_input'] = array( '_bbp_moderation_ascii_found' => true );

					}

				}

			}

			// Moderate posts with links
			if ( ! empty( $custom_moderation_options ) && in_array( 'links', $custom_moderation_options ) ) {

				// Check if user has not had a previous post with a link approved
				if ( ! get_user_meta( $post['post_author'], '_link_moderation_approved', TRUE ) ) {

					// Check for a link in the post content
					$pattern = '#(https?\://)?(www\.)?[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(/\S*)?#';

					if ( preg_match( $pattern, $post['post_content'] ) or preg_match( $pattern, $post['post_title'] ) ) {

						$post['post_status'] = 'pending';
						$post['meta_input'] = array( '_bbp_moderation_link_found' => true );

					}

				}

			}

			// Moderate first post
			if ( ! empty( $custom_moderation_options ) && in_array( 'users', $custom_moderation_options ) ) {

				// Check if user has any published posts
				$sql = $wpdb->prepare( "SELECT COUNT( ID ) FROM {$wpdb->posts} WHERE post_author = %d AND post_type IN ('topic','reply') AND post_status = 'publish'", $post['post_author'] );
				$count = $wpdb->get_var($sql);

				if ( $count < 1 ) {

					$post['post_status'] = 'pending';

				}

			}

		}

		return $post;

	}

	/**
	 * Handle actions
	 *
	 *	@since  1.1.0
	 *
	 */
	public function handle_actions() {

		if ( ! isset( $_GET[$this->plugin_slug . '-wp_nonce'] ) or ! wp_verify_nonce( $_GET[$this->plugin_slug . '-wp_nonce'], 'moderator_action' ) )
			return;

		if ( ! isset( $_GET['action'] ) )
			return;

		switch ( $_GET['action'] ) {

			case $this->plugin_slug . '-approve':
			case $this->plugin_slug . '-remove':
				$this->handle_moderation_action( $_GET['action'] );
				break;

			case $this->plugin_slug . '-block_user':
			case $this->plugin_slug . '-unblock_user':
				$this->handle_block_action( $_GET['action'] );
				break;

		}

	}
	
	/**
	 * Handle moderator actions
	 *
	 *	@since  0.1.0
	 *	@since  1.0.0 moved flag setting and added actions to handle flag in preperation for bbPress 2.6
	 *
	 */
	public function handle_moderation_action( $action ) {

		if ( ! $this->user_can_moderate() )
			return;

		if ( isset( $_GET['topic_id'] ) ) {
			
			$post_id = $_GET['topic_id'];

		} else if ( isset( $_GET['reply_id'] ) ) {

			$post_id = $_GET['reply_id'];

		}

		$post = get_post( $post_id );
		
		if ( empty( $post ) )
			return;

		if ( $action == $this->plugin_slug . '-approve' ) {

			// Execute pre pending code
			if ( 'topic' == $post->post_type ) {
				do_action( 'bbp_approve_topic', $post->ID );
			} else if ( 'reply' == $post->post_type ) {
				do_action( 'bbp_approve_reply', $post->ID );
			}

			wp_update_post( array(
				'ID' => $post->ID,
				'post_status' => 'publish',
			) );

			// Execute post pending code
			if ( 'topic' == $post->post_type ) {
				do_action( 'bbp_approved_topic', $post->ID );
			} else if ( 'reply' == $post->post_type ) {
				do_action( 'bbp_approved_reply', $post->ID );
			}

		} elseif ( $action == $this->plugin_slug . '-remove' ) {

			wp_update_post( array(
				'ID' => $post->ID,
				'post_status' => 'pending',
			));

		}

		if ( $post->post_type == 'reply' ) {
			
			wp_redirect( remove_query_arg( array( 'reply_id', 'topic_id', 'action', $this->plugin_slug . '-wp_nonce' ), $_SERVER['REQUEST_URI'] ) );

		} else {

			wp_redirect( site_url( '?post_type=' . $post->post_type . '&p=' . $post->ID ) );

		}

		exit;

	}

	/**
	 * Handle block actions
	 *
	 *	@since  1.1.0
	 *
	 */
	public function handle_block_action( $action ) {

		if ( ! isset( $_GET['author_id'] ) )
			return;

		$author_id = (int)$_GET['author_id'];

		if ( $action == $this->plugin_slug . '-block_user' ) {
			
			bbp_set_user_role( $author_id, 'bbp_blocked' );

		}

		if ( $action == $this->plugin_slug . '-unblock_user' ) {
			
			bbp_set_user_role( $author_id, 'bbp_participant' );

		}

	}


	/**
	* Handle report post
	*
	*	@since  1.1.0
	*/
	public function handle_report_post() {

		check_ajax_referer( 'report-post-nonce', 'nonce' );

		$post_id = (int)$_POST['post_id'];
		$type = sanitize_text_field( $_POST['type'] );

		$this->report_post( $post_id, $type );

		echo __( 'Your report will be reviewed by our moderation team.' );

		die();

	}

	/**
	* Report post
	*
	*	@since  1.1.0
	*/
	private function report_post( $post_id, $type ) {

		$report = array(
			'date' => date( 'Y-m-d H:i:s' ),
			'user_id' => get_current_user_id(),
			'type' => $type,
		);

		$meta_id = add_post_meta( $post_id, '_bbp_modtools_post_report', $report );

		$this->increase_post_reported_count( $post_id );

		do_action( 'bbp_mod_tools_report_post', $meta_id, $post_id, $report );

	}

	/**
	* Increase post reported count
	*
	*	@since  1.1.0
	*/
	private function increase_post_reported_count( $post_id ) {

		$current = (int)get_post_meta( $post_id, '_bbp_modtools_post_report_count', TRUE ) + 1;
		update_post_meta( $post_id, '_bbp_modtools_post_report_count', $current );

	}

}

bbPressModToolsPlugin_Moderation::init();
