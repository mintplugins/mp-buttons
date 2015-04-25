<?php
/**
 * This file contains the button creation scripts function for the buttons plugin
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
* Shortcode which is used to display the button
*/
function mp_buttons_shortcode( $atts ) {
	global $mp_buttons_meta_box;
	$vars =  shortcode_atts( array(
		'icon' => NULL,
		'icon_position' => 'left',
		'icon_size' => NULL,
		'icon_spacing' => NULL,
		'text' => NULL,
		'link' => NULL,
		'btn_bg' => 'show',
		'color' => NULL,
		'text_color' => NULL,
		'hover_color' => NULL,
		'hover_text_color' => NULL,
		'open_type' => NULL,
		'lightbox_width' => 500,
		'lightbox_height' => 500,
	), $atts );
	
	//Default for the button style attribute string
	$button_style = NULL;
			
	//Set up the target based on what the user chose for an Open Type
	if ( $vars['open_type'] == 'lightbox' ){
		
		$lightbox_class = ' mp-stacks-iframe-custom-width-height ';
		$mfp_width_height_attr = ' mfp-width="' . $vars['lightbox_width'] . '" mfp-height="' . $vars['lightbox_height'] . '" ';
		$target = NULL;	
		
	}
	else{
		
		$lightbox_class = NULL;
		$mfp_width_height_attr = NULL;
		$target = ' target="' . $vars['open_type'] . '" ';
		
	}
	
	//Set up the default button classes
	$button_class = 'button mp-button mp-button-' . sanitize_title( $vars['text'] ) . ' ' . $vars['icon'] . $lightbox_class . '';
	
	//If the icon should be after the text or below it
	if ( !empty( $vars['icon_position'] ) ){ 
		
		//Add the "after" class
		if ( $vars['icon_position'] == 'right' || $vars['icon_position'] == 'below' ){ 
			$button_class .= ' mp-button-icon-after ';
		}
		//Add the "before" class
		else{
			$button_class .= ' mp-button-icon-before ';
		}
		
		//Add the "above" class
		if ( $vars['icon_position'] == 'above' ){ 
			$button_class .= ' mp-button-icon-above ';
		}
		//Add the "before" class
		else if ( $vars['icon_position'] == 'below' ){ 
			$button_class .= ' mp-button-icon-below ';
		}
	}
	
	//Set up the button html
	$button_html = '<a style="' . $button_style . '" ' . $mfp_width_height_attr . $target . ' class="' . $button_class . '" href="' . $vars['link'] . '" target="' . $vars['open_type'] . '">' . $vars['text']. '</a>';
	
	global $mp_buttons_footer_css;
	$mp_buttons_footer_css .= '
		<style type="text/css">
		
			.mp-button-' . sanitize_title( $vars['text'] ) .'{
				' . ( $vars['btn_bg'] == 'hide' ? 'background:transparent!important;' : 'background-color: ' . $vars['color'] . '!important;' ) . '	
				color: ' . $vars['text_color'] . '!important;
			}
			.mp-button-' . sanitize_title( $vars['text'] ) .':hover{
				' . ( $vars['btn_bg'] == 'hide' ? 'background:transparent!important;' : 'background-color: ' . $vars['hover_color'] . '!important;' ) . '	
				color: ' . $vars['hover_text_color'] . '!important;
			}
			.mp-button-' . sanitize_title( $vars['text'] ) .':before{
				font-size: ' . ( !empty( $vars['icon_size'] ) ? $vars['icon_size'] . 'px!important;' : NULL ) . '
				' . ( !empty( $vars['icon_spacing'] ) ? 'margin-bottom:' . $vars['icon_spacing'] . 'px;' : NULL ) . '	
			}
			.mp-button-' . sanitize_title( $vars['text'] ) .':after{
				font-size: ' . ( !empty( $vars['icon_size'] ) ? $vars['icon_size'] . 'px!important;' : NULL ) . '
				' . ( !empty( $vars['icon_spacing'] ) ? 'margin-top:' . $vars['icon_spacing'] . 'px;' : NULL ) . '	
			}
		</style>';
		
	//Return the stack HTML output - pass the function the stack id
	return $button_html;
}
add_shortcode( 'mp_button', 'mp_buttons_shortcode' );

//Create the custom CSS for this button for colors
function mp_button_footer_css(){
	
	global $mp_buttons_footer_css;
	
	echo $mp_buttons_footer_css;
}
add_action( 'wp_footer', 'mp_button_footer_css' );

/**
 * Show "Insert Shortcode" above posts
 */
function mp_buttons_show_insert_shortcode(){
	
	//Get current page
	$current_page = get_current_screen();
	
	//Only load if we are on an mp_brick page
	if ( $current_page->base != 'post' ){
		return;	
	}
	
	//If MP Stacks is installed, give them the option to have a lightbox popup
	$open_options = function_exists( 'mp_stacks_textdomain' ) ? array( 
		'_self' => __( 'Open in this window', 'mp_buttons' ), 
		'_blank' => __( 'Open in a new Window/Tab', 'mp_buttons' ), 
		'_parent' => __( 'Open in the parent window (If in an iFrame)', 'mp_buttons' ),
		'lightbox' => __( 'Open in Lightbox Popup', 'mp_buttons' ) 
	) : array( 
		'_self' => __( 'Open in this window', 'mp_buttons' ), 
		'_blank' => __( 'Open in a new Window/Tab', 'mp_buttons' ), 
		'_parent' => __( 'Open in the parent window (If in an iFrame)', 'mp_buttons' ),
	);
	
	$args = array(
		'shortcode_id' => 'mp_button',
		'shortcode_title' => __('Button', 'mp_buttons'),
		'shortcode_description' => __( 'Use the form below to insert the shortcode for your Button:', 'mp_buttons' ),
		'shortcode_icon_spot' => true,
		'shortcode_icon_dashicon_class' => 'dashicons-plus-alt',
		'shortcode_options' => array(
			array(
				'option_id' => 'icon',
				'option_title' => __('Button Icon', 'mp_buttons'),
				'option_description' => __( 'If you want to have an icon on this button, pick one here.', 'mp_buttons' ),
				'option_type' => 'iconfontpicker',
				'option_value' => mp_buttons_get_font_awesome_icons(),
			),
			array(
				'option_id' => 'icon_position',
				'option_title' => __( 'Icon Position', 'mp_buttons' ),
				'option_description' => __( 'Where should the Icon sit in the button?', 'mp_buttons' ),
				'option_type' => 'select',
				'option_value' => array( 
					'left' => __( 'On the Left', 'mp_buttons' ),
					'right' => __( 'On the Right', 'mp_buttons' ),
					'above' => __( 'Above the text', 'mp_buttons' ),
					'below' => __( 'Below the text', 'mp_buttons' ),
				)
			),
			array(
				'option_id' => 'icon_size',
				'option_title' => __( 'Icon Size', 'mp_buttons' ),
				'option_description' => __( 'Enter the size the icon should be in pixels. Leave blank to have it match the font size of this text area.', 'mp_buttons' ),
				'option_type' => 'number',
				'option_value' => '',
				'option_conditional_id' => 'icon_position',
				'option_conditional_values' => array( 'above', 'below' ),
			),
			array(
				'option_id' => 'icon_spacing',
				'option_title' => __( 'Icon Spacing', 'mp_buttons' ),
				'option_description' => __( 'How much space should there be between the icon and the text?', 'mp_buttons' ),
				'option_type' => 'number',
				'option_value' => '',
				'option_conditional_id' => 'icon_position',
				'option_conditional_values' => array( 'above', 'below' ),
			),
			array(
				'option_id' => 'text',
				'option_title' => __( 'Button Text', 'mp_buttons' ),
				'option_description' => __( 'What should the button say?', 'mp_buttons' ),
				'option_type' => 'textbox',
				'option_value' => '',
			),
			array(
				'option_id' => 'link',
				'option_title' => __( 'Button Link', 'mp_buttons' ),
				'option_description' => __( 'Where should this button go when clicked?', 'mp_buttons' ),
				'option_type' => 'textbox',
				'option_value' => '',
			),
			array(
				'option_id' => 'btn_bg',
				'option_title' => __( 'Button Background', 'mp_buttons' ),
				'option_description' => __( 'Should there be a background for this button?', 'mp_buttons' ),
				'option_type' => 'select',
				'option_value' => array( 
					'show' => __( 'Show', 'mp_buttons' ),
					'hide' => __( 'Hide', 'mp_buttons' ),
				)
			),
			array(
				'option_id' => 'color',
				'option_title' => __( 'Button Background Color', 'mp_buttons' ),
				'option_description' => __( 'Pick a color for this button', 'mp_buttons' ),
				'option_type' => 'colorpicker',
				'option_value' => '',
				'option_conditional_id' => 'btn_bg',
				'option_conditional_values' => array( 'show' ),
			),
			array(
				'option_id' => 'hover_color',
				'option_title' => __( 'Mouse-Over Button Background Color', 'mp_buttons' ),
				'option_description' => __( 'Pick a color for this button when the mouse is over it', 'mp_buttons' ),
				'option_type' => 'colorpicker',
				'option_value' => '',
				'option_conditional_id' => 'btn_bg',
				'option_conditional_values' => array( 'show' ),
			),
			array(
				'option_id' => 'text_color',
				'option_title' => __( 'Button Text/Icon Color', 'mp_buttons' ),
				'option_description' => __( 'Pick a color for the text on this button', 'mp_buttons' ),
				'option_type' => 'colorpicker',
				'option_value' => '',
			),
			array(
				'option_id' => 'hover_text_color',
				'option_title' => __( 'Mouse-Over Button Text/Icon Color', 'mp_buttons' ),
				'option_description' => __( 'Pick a color for text on this button when the mouse is over it', 'mp_buttons' ),
				'option_type' => 'colorpicker',
				'option_value' => '',
			),
			array(
				'option_id' => 'open_type',
				'option_title' => __( 'Open Type', 'mp_buttons' ),
				'option_description' => 'Where/How should this link open?', 'mp_buttons',
				'option_type' => 'select',
				'option_value' => $open_options
			),
			array(
				'option_id' => 'lightbox_width',
				'option_title' => __( 'Lightbox Width', 'mp_buttons' ),
				'option_description' => 'What width should the lightbox popup be? (Default 500)', 'mp_buttons',
				'option_type' => 'number',
				'option_value' => '500',
				'option_conditional_id' => 'open_type',
				'option_conditional_values' => array( 'lightbox' ),
			),
			array(
				'option_id' => 'lightbox_height',
				'option_title' => __( 'Lightbox Height', 'mp_buttons' ),
				'option_description' => 'What height should the lightbox popup be? (Default 500)', 'mp_buttons',
				'option_type' => 'number',
				'option_value' => '500',
				'option_conditional_id' => 'open_type',
				'option_conditional_values' => array( 'lightbox' ),
			)
		)
	); 
		
	//Shortcode args filter
	$args = has_filter('mp_buttons_insert_shortcode_args') ? apply_filters('mp_buttons_insert_shortcode_args', $args) : $args;
	
	new MP_CORE_Shortcode_Insert($args);	
}
add_action('current_screen', 'mp_buttons_show_insert_shortcode');