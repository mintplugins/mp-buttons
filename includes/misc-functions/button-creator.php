<?php
/**
 * This file contains the button creation scripts function for the buttons plugin
 *
 * @since 1.0.0
 *
 * @package    MP Buttons
 * @subpackage Functions
 *
 * @copyright  Copyright (c) 2013, Move Plugins
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
 */
function mp_buttons_thickboxes(){
	
	//Create Thickbox
	echo '<div id="mp-buttons-thickbox" style="display: none;">';
	?>
		<div class="wrap" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
            
            <p><?php echo __( 'Use the form below to insert a button', 'mp_buttons' ); ?> </p>
            
            <div class="mp_field">
            
                <div class="mp_title"><label for="mp_button_icon"><strong><?php echo __( 'Button Icon:', 'mp_buttons' ); ?></strong> <em><?php echo __( 'If you want to have an icon on this button, pick one here.', 'mp_buttons' ); ?></em></label></div>     
                <input type="hidden" class="mp-buttons-icon-field" />
                 
                <?php
                //Font thumbnail
                echo '<div class="mp_button_font_icon_thumbnail">';
                    echo '<div class="">';
                        echo '<div class="mp-iconfontpicker-title" ></div>';
                    echo '</div>';
                echo '</div>';
                ?>
                
                <a class="mp-button-icon-select button"><?php _e('Select Icon', 'mp-buttons'); ?></a>
            	
                <?php		
		
				//Get all font styles in the css document and put them in an array
				$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
				//$subject = file_get_contents( plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ) );
				
				// Initializing curl
				$ch = curl_init();
				 
				//Return Transfer
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				
				//File to fetch
				curl_setopt($ch, CURLOPT_URL, plugins_url( '/fonts/font-awesome-4.0.3/css/font-awesome.css', dirname( __FILE__ ) ) );
														 
				// Getting results
				$subject =  curl_exec($ch); // Getting jSON result string
				
				curl_close($ch);
				
			
				
				preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
				
				$icons = array();
			
				foreach($matches as $match){
					$icons[$match[1]] = $match[1];
				}	
				
				?>
				
				<div class="mp-buttons-icon-picker-area" style="display: none;">
				
					<?php
					foreach( $icons as $icon ){
						
						echo '<a href="#" class="mp-button-icon-picker-item">';
													
							echo '<div class="' . $icon . ' mp-button-icon">';
								
								echo '<div class="mp-iconfontpicker-title" >' . $icon . '</div>';
							
							echo '</div>';
						
						echo '</a>';
							 
					} 
					?>
					
				</div>
		
            </div>
            
            <div class="mp_field">
            	
                <div class="mp_title"><label for="mp_button_text"><strong><?php echo __( 'Button Text:', 'mp_buttons' ); ?></strong> <em><?php echo __( 'What should the button say?', 'mp_buttons' ); ?></em></label></div>   
            	<input type="text" class="mp-buttons-text-field" />
                
            </div>
            
            <div class="mp_field">
            	
                <div class="mp_title"><label for="mp_button_link"><strong><?php echo __( 'Button Link:', 'mp_core' ); ?></strong> <em><?php echo __( 'Where should this button go when clicked?', 'mp_buttons' ); ?></em></label></div>   
            	<input type="url" class="mp-buttons-link-field" />
                
            </div>
            
            <div class="mp_field">
            	
                <div class="mp_title"><label for="mp_button_color"><strong><?php echo __( 'Button Color:', 'mp_buttons' ); ?></strong> <em><?php echo __( 'Pick a color for this button', 'mp_buttons' ); ?></em></label></div>   
            	<input type="text" class="mp-buttons-color-field of-color" />
                
            </div>
            
             <div class="mp_field">
            	
                <div class="mp_title"><label for="mp_button_text_color"><strong><?php echo __( 'Button Text Color:', 'mp_buttons' ); ?></strong> <em><?php echo __( 'Pick a color for text on this button', 'mp_core' ); ?></em></label></div>   
            	<input type="text" class="mp-buttons-text-color-field of-color" />
                
            </div>
            
             <div class="mp_field">
            	
                <div class="mp_title"><label for="mp_button_color_hover"><strong><?php echo __( 'Mouse-Over Button Color:', 'mp_buttons' ); ?></strong> <em><?php echo __( 'Pick a color for this button when the mouse is over it:', 'mp_buttons' ); ?></em></label></div>   
            	<input type="text" class="mp-buttons-color-field-hover of-color" />
                
            </div>
            
            <div class="mp_field">
            	
                <div class="mp_title"><label for="mp_button_text_color_hover"><strong><?php echo __( 'Mouse-Over Button Text Color:', 'mp_buttons' ); ?></strong> <em><?php echo __( 'Pick a color for text on this button when the mouse is over it', 'mp_buttons' ); ?></em></label></div>   
            	<input type="text" class="mp-buttons-text-color-field-hover of-color" />
                
            </div>
            
            <div class="mp_field">
            	
                <div class="mp_title"><label for="mp_button_window"><strong><?php echo __( 'Button Open Type:', 'mp_buttons' ); ?></strong> <em><?php echo __( 'Where/How should this link open?', 'mp_buttons' ); ?></em></label></div>   
            	
                
                <select class="mp-buttons-open-type-field" />
                  <option value="_self"><?php echo __( 'Open in this window', 'mp_buttons' ); ?></option>
                  <option value="_blank"><?php echo __( 'Open in a new Window/Tab', 'mp_buttons' ); ?></option>
                </select>
                
            </div>
            
            <p class="submit">
            
                <input type="button" class="button-primary" value="<?php echo __('Insert Button', 'mp_buttons') ?>" onclick="mp_buttons_insert();" />
                <a id="cancel-mp-buttons-insert" class="button-secondary" onclick="tb_remove();" title="<?php _e( 'Cancel', 'mp_buttons' ); ?>"><?php _e( 'Cancel', 'mp_buttons' ); ?></a>
            
            </p>
                
		</div>
        
	<?php
	//End Thickbox
	echo '</div>';
		
}
add_action( 'admin_footer', 'mp_buttons_thickboxes' );

/**
 * Media Button
 *
 * Returns the "Insert Button" TinyMCE button.
 *
 * @access     public
 * @since      1.0.0
 * @global     $pagenow
 * @global     $typenow
 * @global     $wp_version
 * @param      string $context The string of buttons that already exist
 * @return     string The HTML output for the media buttons
*/
function mp_buttons_media_button( $context ) {
	
	global $pagenow, $typenow, $wp_version;
	
	$output = '';

	/** Only run in post/page creation and edit screens */
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {
		
		//Check current WP version - If we are on an older version than 3.5
		if ( version_compare( $wp_version, '3.5', '<' ) ) {
			
			//Output old style button
			$output = '<a href="#TB_inline?width=640&inlineId=mp-buttons-thickbox" class="thickbox" title="' . __('Add Button', 'mp_core') . '">' . $img . '</a>';
			
		//If we are on a newer than 3.5 WordPress	
		} else {
			
			//Output new style button
			$output = '<a href="#TB_inline?width=640&inlineId=mp-buttons-thickbox" class="thickbox button" title="' . __('Add Button', 'mp_core') . '">';
			
			//Media Button Image
			$output .= '<span class="wp-media-buttons-icon" id="mp-buttons-media-icon"></span>';
			
			//Finish the output
			$output.= __('Add Button', 'mp_core') . '</a>';
		}
	}
	
	//Add new button to list of buttons to output
	return $context . $output;
}
add_filter( 'media_buttons_context', 'mp_buttons_media_button' );