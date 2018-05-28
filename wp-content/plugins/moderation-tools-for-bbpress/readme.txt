=== bbPress - Moderation Tools ===
Contributors: digital-arm
Tags: bbpress, moderation tools, mod tools, mod, moderation
Requires at least: 4.0
Tested up to: 4.9.1
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Moderation Tools extends bbPress to give you more control over your forums by adding rules that can automatically detect spam from users and bots. Topics and replies held for moderation are marked as pending, ready for your Moderators and Administrators to approve or unapprove. Once a user has at least one approved post a flag is set to trust their future posts, depending on the settings you choose.

All settings can be found in the bbPress settings page (Settings > Forums).

**Features**

**Spam Detection Rules**
Use one or more rules to automatically hold posts for moderation, including:

* Unapproved users posting
* Unapproved users posting links
* Unapproved users posting below the English character threshold (this is a percentage that can be tweaked)
* All posts below the English character threshold
* All posts (lockdown)

**Email notifications**

* When posts are held for moderation
* When a user reports a post

Send email notifications to any combination of the following:

* Keymasters
* Moderators
* Specified emails

**Front end controls**
Approval and unapproval of posts and blocking users is handled on the front end by showing pending posts to the post author, moderators and administrators.

**More Features**

* Redirect blocked users to a custom page instead of the default 404
* Adds a Senior Moderator role
* Support for single forum moderators (bbPress 2.6 feature)

We're always happy to hear from our users via the support forum if you have ideas or requests for new features.

Props to [Ian Stanley](https://profiles.wordpress.org/iandstanley/) for the inspiration for this plugin with his work on the plugin [bbPress Moderation](https://wordpress.org/plugins/bbpressmoderation/).

== Changelog ==

= 1.1.1 =
* Fixed css rule that set forum board background to yellow

= 1.1.0 =
* Added filter to change notification recipient and message. Props to @boonebgorges
* Added filter to extend who can moderate a board. Props to @boonebgorges
* Added report topic/reply option for logged in users with notification
* Added setting to toggle user reporting
* Added settings to toggle moderation notifications
* Added Senior Moderator bbPress role
* Added unblock front end option (restricted to keymasters and senior moderators)

= 1.0.7 =
* Fixed extra / when enqueuing CSS
* Added version number to CSS
* Updated CSS handles to remove additional -css

= 1.0.6 =
* Fixed function array dereferencing error caused by version check

= 1.0.5 =
* Topic title is now included in moderation checks

= 1.0.4 =
* Fixed issue with sanitize callback which meant custom moderation settings weren't saved

= 1.0.3 =
* Moderation checks are now performed on topic/reply edits

= 1.0.2 =
* Added missing sanitize callback on forum settings

= 1.0.1 =
* Fixed fatal error for pre PHP 5.5 servers

= 1.0.0 =
* Added English character threshold moderation rule
* Added support for bbPress 2.6 single forum moderators
* Added redirection to parent for guests posting pending topics or replies
* Added option to redirect blocked users to a custom page
* Added "replies awaiting moderation" notice to topics if it has pending replies
* Updated block user action to author details and profile
* Updated pending to unapprove in the topic/reply action bar
* Updated moderation rules so that multiple custom rules can be selected
* Removed pending and approve links in the topic/reply action bar for bbPress 2.6+

= 0.1.3 =
* Fixed PHP warning caused by empty variable
