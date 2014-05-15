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
 * Allow style tags in TINY MCE editors
 *
 * @access   public
 * @since    1.0.0
 * @return   void
 */
function mp_buttoms_allow_style_tags_in_tinyMCE( $options ) {

    if ( ! isset( $options['extended_valid_elements'] ) ) {
        $options['extended_valid_elements'] = 'style';
    } else {
        $options['extended_valid_elements'] .= ',style';
    }

    if ( ! isset( $options['valid_children'] ) ) {
        $options['valid_children'] = '+body[style]';
    } else {
        $options['valid_children'] .= ',+body[style]';
    }

    if ( ! isset( $options['custom_elements'] ) ) {
        $options['custom_elements'] = 'style';
    } else {
        $options['custom_elements'] .= ',style';
    }

    return $options;
}
add_filter('tiny_mce_before_init', 'mp_buttoms_allow_style_tags_in_tinyMCE');