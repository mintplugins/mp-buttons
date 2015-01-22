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
		'text' => NULL,
		'link' => NULL,
		'color' => NULL,
		'text_color' => NULL,
		'hover_color' => NULL,
		'hover_text_color' => NULL,
		'open_type' => NULL,
		'lightbox_width' => 500,
		'lightbox_height' => 500,
	), $atts );
	
	//add space to text if icon is present
	$button_text = !empty( $vars['icon'] ) ? ' ' . $vars['text'] : $vars['text'];
	
	//Set up the target
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
	
	$button_html = '<a class="button mp-button-' . sanitize_title( $vars['text'] ) . ' ' . $vars['icon'] . $lightbox_class . '" ' . $mfp_width_height_attr . $target . ' href="' . $vars['link'] . '"	target="' . $vars['open_type'] . '">' . $button_text. '</a>';
	$button_html .= '<style scoped>
	
	.mp-button-' . sanitize_title( $vars['text'] ) .'{
		background-color: ' . $vars['color'] . '!important;
		color: ' . $vars['text_color'] . '!important;
	}
	.mp-button-' . sanitize_title( $vars['text'] ) .':hover{
		background-color: ' . $vars['hover_color'] . '!important;
		color: ' . $vars['hover_text_color'] . '!important;
	}
	</style>';
		
	//Return the stack HTML output - pass the function the stack id
	return $button_html;
}
add_shortcode( 'mp_button', 'mp_buttons_shortcode' );

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
		'shortcode_options' => array(
			array(
				'option_id' => 'icon',
				'option_title' => __('Button Icon', 'mp_buttons'),
				'option_description' => __( 'If you want to have an icon on this button, pick one here.', 'mp_buttons' ),
				'option_type' => 'iconfontpicker',
				'option_value' => mp_stacks_buttons_get_font_awesome_icons(),
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
				'option_id' => 'color',
				'option_title' => __( 'Button Color', 'mp_buttons' ),
				'option_description' => __( 'Pick a color for this button', 'mp_buttons' ),
				'option_type' => 'colorpicker',
				'option_value' => '',
			),
			array(
				'option_id' => 'text_color',
				'option_title' => __( 'Button Text Color', 'mp_buttons' ),
				'option_description' => __( 'Pick a color for the text on this button', 'mp_buttons' ),
				'option_type' => 'colorpicker',
				'option_value' => '',
			),
			array(
				'option_id' => 'hover_color',
				'option_title' => __( 'Mouse-Over Button Color', 'mp_buttons' ),
				'option_description' => __( 'Pick a color for this button when the mouse is over it', 'mp_buttons' ),
				'option_type' => 'colorpicker',
				'option_value' => '',
			),
			array(
				'option_id' => 'hover_text_color',
				'option_title' => __( 'Mouse-Over Button Text Color', 'mp_buttons' ),
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