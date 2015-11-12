=== MP Buttons ===
Contributors: johnstonphilip, mintplugins
Donate link: http://mintplugins.com/
Tags: buttons, tinyMCE
Requires at least: 3.5
Tested up to: 4.3
Stable tag: 1.0.1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Insert buttons into TinyMCE with class ‘button’ and custom colours and options.

== Description ==

Insert buttons into TinyMCE with class ‘button’ and custom colours and options.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the ‘mp-buttons’ folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the “Add Button” link on any post or page

== Frequently Asked Questions ==

= What do I do with this?  =

Make buttons!

== Screenshots ==


== Changelog ==

= 1.0.1.3 = October 26, 2015
* Changed vertical align for button icons from 'middle' to 'baseline'

= 1.0.1.2 = October 26, 2015
* Upgrade Font Awesome to version 4.4.0

= 1.0.1.1 = September 14, 2015
* Shortcode Hook now uses 'mp_core_shortcode_setup' to work with mp_core 1.0.2.1

= 1.0.1.0 = April 25, 2015
* Button icons can now be above/below/after
* Buttons can have transparent backgrounds
* Button Icons can be custom sized
* Button icons now verticaly aligned
* Changed CSS output for custom buttons from being inside the <p> tag to being in the footer at the bottom instead (mp_buttons_footer_css).

= 1.0.0.9 = March 18, 2015
* Switch from curl to wp_remote_get when getting the font icon array for the short code creator.
* Changed up the short code icon from an image to a dashicon

= 1.0.0.8 = January 22, 2014
* Buttons have their own stylesheet
* Buttons can open lightboxes if MP Stacks is active


= 1.0.0.7 = May 17, 2014
* Major update which uses a button shortcode now instead of inserting HTML and CSS directly into TinyMCE because TinyMCE wasn’t playing nice.

= 1.0.0.6 = May 16, 2014
* Wrap CSS tag in Span tag before inserting into tinyMCE. Additional fix from 1.0.0.5

= 1.0.0.5 = May 15, 2014
* Added support or <style> tags in tinyMCE 4.0 and wp 3.9
* Move to Mint

= 1.0.0.4 = March 4, 2014
* Location of update fix

= 1.0.0.3 = March 4, 2014
* Added MP repo updater back

= 1.0.0.2 = March 3, 2014
* Localized all strings
* Improved JS insert to work with either TinyMCE of Raw Text area.

= 1.0.0.1 = March 3, 2014
* Removed custom update script in favour of the WP repo.

= 1.0.0.0 = March 2, 2014
* Original release
