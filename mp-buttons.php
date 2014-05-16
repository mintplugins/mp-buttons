<?php
/*
Plugin Name: MP Buttons
Plugin URI: http://mintplugins.com
Description: Insert buttons into TinyMCE
Version: 1.0.0.6
Author: Mint Plugins
Author URI: http://mintplugins.com
Text Domain: mp_buttons
Domain Path: languages
License: GPL2
*/

/*  Copyright 2014  Phil Johnston  (email : phil@mintplugins.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Mint Plugins Core.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/
// Plugin version
if( !defined( 'MP_BUTTONS_VERSION' ) )
	define( 'MP_BUTTONS_VERSION', '1.0.0.4' );

// Plugin Folder URL
if( !defined( 'MP_BUTTONS_PLUGIN_URL' ) )
	define( 'MP_BUTTONS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Plugin Folder Path
if( !defined( 'MP_BUTTONS_PLUGIN_DIR' ) )
	define( 'MP_BUTTONS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Plugin Root File
if( !defined( 'MP_BUTTONS_PLUGIN_FILE' ) )
	define( 'MP_BUTTONS_PLUGIN_FILE', __FILE__ );

/*
|--------------------------------------------------------------------------
| GLOBALS
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| INTERNATIONALIZATION
|--------------------------------------------------------------------------
*/

function mp_buttons_textdomain() {

	// Set filter for plugin's languages directory
	$mp_buttons_lang_dir = dirname( plugin_basename( MP_BUTTONS_PLUGIN_FILE ) ) . '/languages/';
	$mp_buttons_lang_dir = apply_filters( 'mp_buttons_languages_directory', $mp_buttons_lang_dir );


	// Traditional WordPress plugin locale filter
	$locale        = apply_filters( 'plugin_locale',  get_locale(), 'mp-buttons' );
	$mofile        = sprintf( '%1$s-%2$s.mo', 'mp-buttons', $locale );

	// Setup paths to current locale file
	$mofile_local  = $mp_buttons_lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/mp-buttons/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/mp-buttons folder
		load_textdomain( 'mp_buttons', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/mp-buttons/languages/ folder
		load_textdomain( 'mp_buttons', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'mp_buttons', false, $mp_buttons_lang_dir );
	}

}
add_action( 'init', 'mp_buttons_textdomain', 1 );

/*
|--------------------------------------------------------------------------
| INCLUDES
|--------------------------------------------------------------------------
*/
function mp_buttons_include_files(){
	/**
	 * If mp_core isn't active, stop and install it now
	 */
	if (!function_exists('mp_core_textdomain') || !function_exists('mp_stacks_textdomain')){
		
		/**
		 * Include Plugin Checker
		 */
		require( MP_BUTTONS_PLUGIN_DIR . '/includes/plugin-checker/class-plugin-checker.php' );
		
		/**
		 * Include Plugin Installer
		 */
		require( MP_BUTTONS_PLUGIN_DIR . '/includes/plugin-checker/class-plugin-installer.php' );
		
		/**
		 * Check if mp_core in installed
		 */
		require( MP_BUTTONS_PLUGIN_DIR . 'includes/plugin-checker/included-plugins/mp-core-check.php' );
				
	}
	/**
	 * Otherwise, if mp_core is active, carry out the plugin's functions
	 */
	else{
				
		/**
		 * keep mp_buttons up to date
		 */
		require( MP_BUTTONS_PLUGIN_DIR . 'includes/updater/mp-buttons-update.php' );
		
		/**
		 * enqueue scripts
		 */
		require( MP_BUTTONS_PLUGIN_DIR . 'includes/misc-functions/enqueue-scripts.php' );
		
		/**
		 * button creator
		 */
		require( MP_BUTTONS_PLUGIN_DIR . 'includes/misc-functions/button-creator.php' );
		
		/**
		 * button creator
		 */
		require( MP_BUTTONS_PLUGIN_DIR . 'includes/misc-functions/misc-functions.php' );
				
	}
}
add_action('plugins_loaded', 'mp_buttons_include_files', 9);