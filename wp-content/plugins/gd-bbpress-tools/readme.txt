=== GD bbPress Tools ===
Contributors: GDragoN
Donate link: https://plugins.dev4press.com/gd-bbpress-toolbox/
Version: 1.9.3
Tags: bbpress, tools, gdragon, dev4press, forums, forum, topic, reply, signature, quote, search, toolbar, signature, views, admin, bbcode, bbcodes, shortcode, shortcodes
Requires at least: 4.2
Requires PHP: 5.3
Tested up to: 4.9
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds different expansions and tools to the bbPress plugin powered forums: BBCode support, signatures, custom views, quote...

== Description ==
Adds various expansions and tools to the bbPress plugin implemented forums. Currently included features:

* BBCode shortcodes support
* Quote Reply or Topic
* User signature with BBCode and HTML support
* Additional custom views
* Basic topics search results view
* Toolbar menu integration
* Limit bbPress admin side access

The plugin supports BBCodes based on the phpBB implementation. Right now, the plugin has 30 BBCodes.

Included translations: English, Serbian, German.

= bbPress Plugin Versions =
GD bbPress Tools 1.9.2 supports bbPress 2.5 or newer. Older bbPress are no longer supported!

= BuddyPress Support =
GD bbPress Tools 1.9.2 is tested with BuddyPress 2.6 and newer and it works fine if you enable BuddyPress support in bbPress plugin for Group Forums. Make sure you enable JavaScript and CSS Settings Always Include option in the Attachments plugin settings.

= Upgrade to GD bbPress Toolbox Pro =
Pro version contains many more useful features 10 more BBCodes (including Hide and Spoiler), BBCodes editor toolbar, report topics and replies, SEO features, many more views, notification email control, BBCodes toolbar, great new responsive admin UI, enhanced attachments features and additional widgets. For more information: [GD bbPress Toolbox Pro](https://plugins.dev4press.com/gd-bbpress-toolbox/)

= Premium dev4Press.com plugins for bbPress =
* [GD bbPress Toolbox Pro](https://plugins.dev4press.com/gd-bbpress-toolbox/) - collection of features for bbPress
* [GD Topic Polls Pro](https://plugins.dev4press.com/gd-topic-polls/) - add polls to the bbPress topics
* [GD Topic Prefix Pro](https://plugins.dev4press.com/gd-topic-prefix/) - add customizable bbPress topic prefixes
* [GD Content Tools Pro](https://plugins.dev4press.com/gd-content-tools/) - meta box for the topic and reply form

= More free dev4Press.com plugins for bbPress =
* [GD bbPress Attachments](https://wordpress.org/plugins/gd-bbpress-attachments/) - attachments for topics and replies
* [GD Topic Polls](https://wordpress.org/plugins/gd-topic-polls/) - add polls to the bbPress topics

== Installation ==
= General Requirements =
* PHP: 5.3 or newer

= WordPress Requirements =
* WordPress: 4.2 or newer

= bbPress Requirements =
* bbPress Plugin: 2.5 or newer

= Basic Installation =
* Plugin folder in the WordPress plugins folder must be `gd-bbpress-tools`
* Upload folder `gd-bbpress-tools` to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==
* Where can I configure the plugin?
Open the Forums menu, and you will see Tools item there. This will open a panel with global plugin settings.

* Will this plugin work with standalone bbPress installation?
No. This plugin requires the plugin versions of bbPress 2.3 or higher.

* Does this plugin work with bbPress that is part of BuddyPress plugin?
No. Plugin requires bbPress 2.3 or higher plugin.

* Does this plugin work with bbPress plugin used as site wide forums for BuddyPress plugin?
Yes. But, make sure to enable 'Always Include' option for JavaScript and CSS.

== Translations ==
* English
* Serbian
* German: David Decker - https://deckerweb.de/

== Upgrade Notice ==
= 1.9.3 =
Updated function for universal rendering of BBCodes.

== Changelog ==
= 1.9.3 - 2018.02.16 =
* Updated function for universal rendering of BBCodes
* Updated various URL's included in plugin and readme file

= 1.9.2 - 2017.10.26 =
* Added function to access BBCodes handler functions
* Updated trim quote content before adding to editor
* Updated several BBCodes handler functions
* Fixed topic related issue with the quote BBCode
* Fixed minor issue with the loading of Views module

= 1.9.1 - 2017.09.20 =
* Updated WordPress minimal requirement to 4.2
* Updated several broken URL's
* Updated and improved readme file

= 1.9 - 2016.09.24 =
* Updated sanitation of the plugin settings on save
* Updated PHP minimal requirement to 5.3
* Updated WordPress minimal requirement to 4.0
* Updated several broken URL's
* Updated several missing translation strings
* Updated signature editors display filters

= 1.8 - 2015.12.10 =
* Auto update signature for shorthand BBCodes
* Added update tool for WordPress 4.4 shortcodes changes
* Added few missing translation strings
* Updated list of BBCodes to remove shorthand notation
* Updated loading of text domain for centralized translations loading
* Fixed adding quote BBCode using shorthand notation
* Fixed list of BBCodes in some cases missing quotes

= 1.7.1 =
* Updated several Dev4Press links
* Fixed XSS security vulnerability with unsanitized input

= 1.7 =
* Added option to enable DIV tag in the content
* Added check if user can set unfiltered HTML for signatures
* Added option to allow mixing HTML and BBCode in signatures
* Improved signature editing process loading and display
* Fixed display of HTML signatures to non logged users
* Fixed editing signatures on admin profile page breaks HTML
* Fixed warning when saving signature in some cases
* Fixed BuddyPress profile edit shows wrong signature
* Fixed quote problem caused by filtered DIV tags
* Fixed order of the quote content wrapper filters

= 1.6 =
* Added smilies parsing for user signature
* Removed support for bbPress 2.2.x
* Fixed some quote issues with BR tags
* Fixed quote not working with WordPress 3.9

= 1.5.1 =
* Fixed signatures not working with bbPress 2.4
* Fixed quote not working with bbPress 2.4

= 1.5 =
* Added options to disable any of the plugins bbcodes
* Improved bbcodes: youtube code supports full url
* Improved bbcodes: vimeo code supports full url
* Removed support for bbPress 2.1.x
* Fixed option for showing and hiding bbCode notice
* Fixed bbCode youtube and vimeo don't work with SSL active

= 1.4 =
* Select profile group in BuddyPress for signature editor
* Changed loading order for bbPress 2.3 compatibility
* Admin side uses proper enqueue method to load style
* Dropped support for bbPress 2.0
* Dropped support for WordPress 3.2
* Fixed quote not setting proper ID for lead topic display
* Fixed testing for roles allowed for all available tools
* Fixed missing enhanced info when editing signatures
* Fixed missing table cell ending for admin side signature editor

= 1.3.1 =
* Fixed signature visible to logged in users only
* Fixed detection of bbPress 2.2

= 1.3 =
* Added support for dynamic roles from bbPress 2.2
* Added signature edit to BuddyPress profile editor
* Using enqueue scripts and styles to load files on frontend
* Various styling improvements to embedded forms and elements
* Admin menu now uses 'activate_plugins' capability by default
* Screenshots removed from plugin and added into assets directory
* Fixed duplicated signature form on profile edit page
* Fixed signature fails to find topic/reply author
* Fixed signature not displayed when using lead topic
* Fixed quote not working when using lead topic
* Fixed quote in some cases quote link is missing
* Fixed bbcodes not applied when displaying lead topic

= 1.2.9 =
* Fixed another important quote problem with JavaScript

= 1.2.8 =
* Fixed quote not working with HTML editor with fancy editor
* Fixed scroll in JavaScript for quote with IE7 and IE8
* Fixed JavaScript use of trim function with IE7 and IE8
* Fixed problem with quote that breaks the oEmbed

= 1.2.7 =
* BuddyPress with site wide bbPress supported
* Support for signature editing with admin side profile editor
* Expanded list of FAQ entries
* Panel for upgrade to GD bbPress Toolbox
* Added few missing translation strings
* Added German Translation
* Change to generating some links in toolbar menu
* Fixed quote element that can include attachments also
* Fixed quote option displayed when not allowed

= 1.2.6 =
* Fixed toolbar menu when there are no forums to show

= 1.2.5 =
* Added Serbian translation
* Check if bbPress is activated before loading code

= 1.2.4 =
* Fixed toolbar integration bug causing posts edit problems

= 1.2.3 =
* Improvements to shared functions loading
* Improvements to loading of plugin modules

= 1.2.2 =
* Fixed search topics view for bbPress 2.0.2

= 1.2.1 =
* Updated readme.txt with more information
* Fixed broken links in the context help
* Fixed invalid display of user signatures

= 1.2.0 =
* Added user signature with BBCode and HTML support
* Added use of capabilities for all plugin features
* Added support for setting up additional custom views
* Added BBCodes: Vimeo, Image, Font Size, Font Color
* Added basic support for topics search results view
* Allows use of the WordPress rich editor for quoting
* Allows to quote only selected portion of the text
* When you click quote button, page will scroll to the form
* Improvements for the bbPress 2.1 compatibility

= 1.1.0 =
* Added BBCodes shortcodes support
* Added quote reply or topic support
* Added file with shared functions
* Plugin features organized into mods

= 1.0.0 =
* First official release

== Screenshots ==
1. Main plugins settings panel
2. BBCode settings panel
3. Views settings panel
4. Toolbar bbPress forums menu
5. Setting up signature
