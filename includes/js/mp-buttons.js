jQuery(document).ready(function($){
	
	//When Icon Font Picker item is clicked, put it's value in the field and close the thickbox
	$( 'body' ).on( 'click', '.mp-button-icon-picker-item', function(event){
		
		event.preventDefault();
			
		//Put the icon code selected into the field ID input field
		$( '.mp-buttons-icon-field' ).val($(this).find(' > div > div').html());
		
		//Show the icon in the thumbnail area preview
		$( '.mp_button_font_icon_thumbnail > div' ).attr( 'class', $(this).find(' > div > div').html() + " mp-button-icon-thumb" );
		$( '.mp_button_font_icon_thumbnail' ).css( 'display', 'inline-block' );
		
		//Hide the Icon Picker div
		$( '.mp-buttons-icon-picker-area' ).css('display', 'none');
	
	});
	
	//When Icon Font Picker item is clicked, put it's value in the field and close the thickbox
	$( 'body' ).on( 'click', '.mp-button-icon-select', function(event){
		
		event.preventDefault();
					
		//Put the icon code selected into the field ID input field
		$( '.mp-buttons-icon-picker-area' ).css('display', 'inline-block');
			
	});
		
});

function mp_buttons_insert() {
	
	//Get icon class
	var icon_class = jQuery('.mp-buttons-icon-field').val();
	
	//Get button link url
	var button_link = jQuery('.mp-buttons-link-field').val();
	
	//Get button text
	var button_text = jQuery('.mp-buttons-text-field').val();
	
	//Get open type
	var open_type = jQuery('.mp-buttons-open-type-field').val();

	//If there is an icon, put a space before the text so they aren't squished
	if ( icon_class ){
		button_text = " " + button_text;
	}
	
	//Reset Form
	jQuery('.mp_button_font_icon_thumbnail' ).css('display', 'none');
	jQuery('.mp-buttons-icon-field').val('');
	jQuery('.mp-buttons-link-field').val('');
	jQuery('.mp-buttons-text-field').val('');
	
	//Send the button to the editor
	tinyMCE.activeEditor.selection.setContent(
		tinyMCE.activeEditor.dom.createHTML(
			'a', 
			{href : button_link, class : 'button ' + icon_class, target : open_type}, 
			button_text
		)
	);
	
	//Close the thickbox
	tb_remove();
}