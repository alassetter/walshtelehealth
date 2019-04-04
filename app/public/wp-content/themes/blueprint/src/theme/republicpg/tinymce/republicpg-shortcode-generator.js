jQuery(document).ready(function($){
	
	$('body').on('click','.republicpg-shortcode-generator',function(){
       
 					
				//The chosen one
				if($('#republicpg_shortcodes_chosen').length == 0) {
					$("select#republicpg-shortcodes").chosen();
				}
				//handle icon selection
				$('select[name="icon-set-select"]').trigger('change');
				$('#options-icon #color').trigger('change');
				$('#options-button #color').trigger('change');
				
				//color pickers
				$('#republicpg-sc-generator input.popup-colorpicker.sc-gen').wpColorPicker({
					palettes: ['#27CCC0', '#f6653c', '#2ac4ea', '#ae81f9', '#FF4629', '#78cd6e']
				});
				
            $.magnificPopup.open({
                mainClass: 'mfp-zoom-in',
 	 		 	items: {
 	  	     		src: '#republicpg-sc-generator'
  	        	},
  	         	type: 'inline',
                removalDelay: 500
	    }, 0);    


        //slim editor shortcodes
	    if($(this).parents('.wp-editor-wrap').find('.wp-editor-area.slim').length > 0 || $(this).hasClass('slim') ) {
	    	$('#republicpg-shortcodes optgroup[label="Columns"] option, #republicpg-shortcodes optgroup[label="Portfolio/Blog"] option, #republicpg-shortcodes option[value="full_width_section"], #republicpg-shortcodes option[value="republicpg_slider"], #republicpg-shortcodes option[value="image_with_animation"], #republicpg-shortcodes option[value="tabbed_section"], #republicpg-shortcodes option[value="carousel"], #republicpg-shortcodes option[value="video"], #republicpg-shortcodes option[value="audio"]').hide();
	    	$('#republicpg-shortcodes').trigger("chosen:updated");
	    }  else {
	    	$('#republicpg-shortcodes optgroup, #republicpg-shortcodes optgroup option').show();
	    	$('#republicpg-shortcodes').trigger("chosen:updated");
	    }  
 
	}); 


});
