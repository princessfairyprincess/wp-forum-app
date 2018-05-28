<?php
function my_theme_enqueue_styles() {
    $parent_style = 'SiteOrigin-Corp-Style'; // This is 'twentysixteen-style' for the Twenty Sixteen theme.
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/*// Source: https://wpcolt.com/fix-hentry-errors-wordpress/
add_filter( 'post_class', 'remove_hentry' );
function remove_hentry( $class ) {
	$class = array_diff( $class, array( 'hentry' ) );	
	return $class;
}*/

/*function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'job_listing';
     
    return $post_types;
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );*/

function custom_excerpt_length( $length ) {
        return 20;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
