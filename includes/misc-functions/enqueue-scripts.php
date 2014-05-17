<?php
/**
 * This file contains the enqueue scripts function for the buttons plugin
 *
 * @since 1.0.0
 *
 * @package    MP Buttons
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2014, Mint Plugins
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @author     Philip Johnston
 */
 
/**
 * Enqueue JS and CSS for buttons 
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */

/**
 * Enqueue css and js
 *
 * Filter: mp_buttons_css_location
 */
function mp_buttons_enqueue_scripts(){
	
	//Enqueue Font Awesome CSS
	wp_enqueue_style( 'fontawesome', plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ) );
		
	//Enqueue buttons CSS
	wp_enqueue_style( 'mp_buttons_css', plugins_url( 'css/buttons.css', dirname( __FILE__ ) ) );

}
add_action( 'wp_enqueue_scripts', 'mp_buttons_enqueue_scripts' );

/**
 * Enqueue css for Tiny MCE
 *
 */
function mp_buttons_add_tiny_mce(){
	//Default styles for tinymce
	add_editor_style( plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ) );
}
add_action( 'mp_core_editor_styles', 'mp_buttons_add_tiny_mce' );

/**
 * Enqueue css and js
 *
 * Filter: mp_buttons_css_location
 */
function mp_buttons_admin_enqueue_scripts(){
	
	//Enqueue Font Awesome CSS
	wp_enqueue_style( 'fontawesome', plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ) );
	
	//Enqueue Admin Features CSS
	wp_enqueue_style( 'mp_buttons_css', plugins_url( 'css/admin-buttons.css', dirname( __FILE__ ) ) );
	
}
add_action( 'admin_enqueue_scripts', 'mp_buttons_admin_enqueue_scripts' );