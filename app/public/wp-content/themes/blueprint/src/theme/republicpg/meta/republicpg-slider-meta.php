<?php 
add_action('add_meta_boxes', 'republicpg_metabox_republicpg_slider');
function republicpg_metabox_republicpg_slider(){
    
    $meta_box = array(
		'id' => 'republicpg-metabox-republicpg-slider',
		'title' => esc_html__('Slide Settings', 'blueprint'),
		'description' => esc_html__('Please fill out & configure the fileds below to create your slide. The only mandatory field is the "Slide Image".', 'blueprint'),
		'post_type' => 'republicpg_slider',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
		
			array( 
					'name' => esc_html__('Background Type', 'blueprint'),
					'desc' => esc_html__('Please select the background type you would like to use for your slide.', 'blueprint'),
					'id' => '_republicpg_slider_bg_type',
					'type' => 'choice_below',
					'options' => array(
						'image_bg' => 'Image Background',
						'video_bg' => 'Video Background'
					),
					'std' => 'image_bg'
				),
			array( 
					'name' => esc_html__('Slide Image', 'blueprint'),
					'desc' => esc_html__('Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection.', 'blueprint'),
					'id' => '_republicpg_slider_image',
					'type' => 'file',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Video WebM Upload', 'blueprint'),
					'desc' => esc_html__('Browse for your WebM video file here. This will be automatically played on load so make sure to use this responsibly for enhancing your design, rather than annoy your user. e.g. A video loop with no sound. You must include this format & the mp4 format to render your video with cross browser compatibility. OGV is optional. Video must be in a 16:9 aspect ratio.', 'blueprint'),
					'id' => '_republicpg_media_upload_webm',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Video MP4 Upload', 'blueprint'),
					'desc' => esc_html__('Browse for your mp4 video file here. See the note above for recommendations on how to properly use your video background.', 'blueprint'),
					'id' => '_republicpg_media_upload_mp4',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => __('Video OGV Upload', 'blueprint'),
					'desc' => __('Browse for your OGV video file here.<br/>  See the note above for recommendations on how to properly use your video background.', 'blueprint'),
					'id' => '_republicpg_media_upload_ogv',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Preview Image', 'blueprint'),
					'desc' => esc_html__('This is the image that will be seen in place of your video on mobile devices & older browsers before your video is played.', 'blueprint'),
					'id' => '_republicpg_slider_preview_image',
					'type' => 'file',
					'std' => ''
				),
			array(
					'name' =>  esc_html__('Add texture overlay to background', 'blueprint'),
					'desc' => esc_html__('If you would like a slight texture overlay on your background, activate this option.', 'blueprint'),
					'id' => '_republicpg_slider_video_texture',
					'type' => 'checkbox',
	                'std' => 1
				),
      	
			
			array( 
					'name' => esc_html__('Background Alignment', 'blueprint'),
					'desc' => esc_html__('Please choose how you would like your slides background to be aligned', 'blueprint'),
					'id' => '_republicpg_slider_slide_bg_alignment',
					'type' => 'select',
					'std' => 'center',
					'options' => array(
						"top" => "Top",
				  		 "center" => "Center",
				  		 "bottom" => "Bottom"
					)
				),
				
			array( 
					'name' => esc_html__('Slide Font Color', 'blueprint'),
					'desc' => esc_html__('This gives you an easy way to make sure your text is visible regardless of the background.', 'blueprint'),
					'id' => '_republicpg_slider_slide_font_color',
					'type' => 'select',
					'std' => '',
					'options' => array(
						'light' => 'Light',
						'dark' => 'Dark'
					)
				),
				
			array( 
					'name' => esc_html__('Heading', 'blueprint'),
					'desc' => esc_html__('Please enter in the heading for your slide.', 'blueprint'),
					'id' => '_republicpg_slider_heading',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Caption', 'blueprint'),
					'desc' => esc_html__('If you have a caption for your slide, enter it here', 'blueprint'),
					'id' => '_republicpg_slider_caption',
					'type' => 'textarea',
					'std' => ''
				),
			array(
					'name' =>  esc_html__('Caption Background', 'blueprint'),
					'desc' => esc_html__('If you would like to add a semi transparent background to your caption, activate this option.', 'blueprint'),
					'id' => '_republicpg_slider_caption_background',
					'type' => 'checkbox',
	                'std' => ''
				),	
        
        array( 
  					'name' => esc_html__('Slide Content Desktop Width', 'blueprint'),
  					'desc' => esc_html__('Releative to the site content container', 'blueprint'),
  					'id' => '_republicpg_slider_slide_content_width_desktop',
  					'type' => 'select',
  					'std' => '',
  					'options' => array(
  						'auto' => 'Auto',
  						'90%' => '90%',
              '80%' => '80%',
              '70%' => '70%',
              '60%' => '60%',
              '50%' => '50%'
  					)
  				),
        
          array( 
    					'name' => esc_html__('Slide Content Tablet Width', 'blueprint'),
    					'desc' => esc_html__('Releative to the site content container', 'blueprint'),
    					'id' => '_republicpg_slider_slide_content_width_tablet',
    					'type' => 'select',
    					'std' => '',
    					'options' => array(
    						'auto' => 'Auto',
    						'90%' => '90%',
                '80%' => '80%',
                '70%' => '70%',
                '60%' => '60%',
                '50%' => '50%'
    					)
    				),
          
        array( 
  					'name' => esc_html__('Background Overlay Color', 'blueprint'),
  					'desc' => esc_html__('This will be applied ontop on your BG image (if supplied).', 'blueprint'),
  					'id' => '_republicpg_slider_bg_overlay_color',
  					'type' => 'color',
  					'std' => ''
  				),
			array( 
					'name' => esc_html__('Insert Down Arrow That Leads to Content Below?', 'blueprint'),
					'desc' => esc_html__('This is particularly useful when using tall sliders to let the user know there\'s content underneath.', 'blueprint'),
					'id' => '_republicpg_slider_down_arrow',
					'type' => 'checkbox',
					'std' => ''
				),	
			array( 
					'name' => esc_html__('Link Type', 'blueprint'),
					'desc' => esc_html__('Please select how you would like to link your slide.', 'blueprint'),
					'id' => '_republicpg_slider_link_type',
					'type' => 'choice_below',
					'options' => array(
						'button_links' => 'Button Links',
						'full_slide_link' => 'Full Slide Link'
					),
					'std' => 'button_links'
				),	
			array( 
					'name' => esc_html__('Button Text', 'blueprint'),
					'desc' => esc_html__('Enter the text for your button here.', 'blueprint'),
					'id' => '_republicpg_slider_button',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'first'
				),
			array( 
					'name' => esc_html__('Button Link', 'blueprint'),
					'desc' => esc_html__('Enter a URL here.', 'blueprint'),
					'id' => '_republicpg_slider_button_url',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'inline'
				),
			array( 
					'name' => esc_html__('Button Style', 'blueprint'),
					'desc' => esc_html__('Desired button style', 'blueprint'),
					'id' => '_republicpg_slider_button_style',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'solid_color' => esc_html__('Solid Color BG', 'blueprint'),
						'solid_color_2' => esc_html__('Solid Color BG W/ Tilt Hover', 'blueprint'),
						'transparent' => esc_html__('Transparent With Border', 'blueprint'),
						'transparent_2' => esc_html__('Transparent W/ Solid BG Hover', 'blueprint')
					),
					'extra' => 'inline'
				),
			array( 
					'name' => esc_html__('Button Color', 'blueprint'),
					'desc' => esc_html__('Desired color', 'blueprint'),
					'id' => '_republicpg_slider_button_color',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'primary-color' => esc_html__('Primary Color', 'blueprint'),
						'extra-color-1' => esc_html__('Extra Color #1', 'blueprint'),
						'extra-color-2' => esc_html__('Extra Color #2', 'blueprint'),
						'extra-color-3' => esc_html__('Extra Color #3', 'blueprint'),
            "extra-color-gradient-1" => __("Color Gradient 1", 'blueprint'),
    		 		"extra-color-gradient-2" => __("Color Gradient 2", 'blueprint'),
            "white" => "White & Black Text"
					),
					'extra' => 'last'
				),
				
			
			array( 
					'name' => esc_html__('Button Text', 'blueprint'),
					'desc' => esc_html__('Enter the text for your button here.', 'blueprint'),
					'id' => '_republicpg_slider_button_2',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'first'
				),
			array( 
					'name' => esc_html__('Button Link', 'blueprint'),
					'desc' => esc_html__('Enter a URL here.', 'blueprint'),
					'id' => '_republicpg_slider_button_url_2',
					'type' => 'slider_button_textarea',
					'std' => '',
					'extra' => 'inline'
				),
			array( 
					'name' => esc_html__('Button Style', 'blueprint'),
					'desc' => esc_html__('Desired button style', 'blueprint'),
					'id' => '_republicpg_slider_button_style_2',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'solid_color' => esc_html__('Solid Color Background', 'blueprint'),
						'solid_color_2' => esc_html__('Solid Color BG W/ Tilt Hover', 'blueprint'),
						'transparent' => esc_html__('Transparent With Border', 'blueprint'),
						'transparent_2' => esc_html__('Transparent W/ Solid BG Hover', 'blueprint')
					),
					'extra' => 'inline'
				),
			array( 
					'name' => esc_html__('Button Color', 'blueprint'),
					'desc' => esc_html__('Desired color', 'blueprint'),
					'id' => '_republicpg_slider_button_color_2',
					'type' => 'slider_button_select',
					'std' => '',
					'options' => array(
						'primary-color' => esc_html__('Primary Color', 'blueprint'),
						'extra-color-1' => esc_html__('Extra Color #1', 'blueprint'),
						'extra-color-2' => esc_html__('Extra Color #2', 'blueprint'),
						'extra-color-3' => esc_html__('Extra Color #3', 'blueprint'),
            "extra-color-gradient-1" => __("Color Gradient 1", 'blueprint'),
    		 		"extra-color-gradient-2" => __("Color Gradient 2", 'blueprint'),
            "white" => "White & Black Text"
					),
					'extra' => 'last'
				),
				
			array( 
					'name' => esc_html__('Slide Link', 'blueprint'),
					'desc' => esc_html__('Please enter your URL that will be used to link the slide.', 'blueprint'),
					'id' => '_republicpg_slider_entire_link',
					'type' => 'text',
					'std' => ''
				),
				
			array( 
					'name' => esc_html__('Slide Video Popup', 'blueprint'),
					'desc' => esc_html__('Enter in an embed code from Youtube or Vimeo that will be used to display your video in a popup. (You can also use the WordPress video shortcode)', 'blueprint'),
					'id' => '_republicpg_slider_video_popup',
					'type' => 'textarea',
					'std' => ''
				),
				
			array( 
					'name' => esc_html__('Slide Content Alignment', 'blueprint'),
					'desc' => esc_html__('Horizontal Alignment', 'blueprint'),
					'id' => '_republicpg_slide_xpos_alignment',
					'type' => 'caption_pos',
					'options' => array(
						'left' => 'Left',
						'centered' => 'Centered',
						'right' => 'Right',
					),
					'std' => 'left',
					'extra' => 'first'
				),
				
			array( 
					'name' => esc_html__('Slide Content Alignment', 'blueprint'),
					'desc' => esc_html__('Vertical Alignment', 'blueprint'),
					'id' => '_republicpg_slide_ypos_alignment',
					'type' => 'caption_pos',
					'options' => array(
						'top' => 'Top',
						'middle' => 'Middle',
						'bottom' => 'Bottom',
					),
					'std' => 'middle',
					'extra' => 'last'
				),
			array( 
				'name' => esc_html__('Extra Class Name', 'blueprint'),
				'desc' => esc_html__('If you would like to enter a custom class name to this slide for css purposes, enter it here.', 'blueprint'),
				'id' => '_republicpg_slider_slide_custom_class',
				'type' => 'text',
				'std' => ''
			)
		)
	);
	//$callback = create_function( '$post,$meta_box', 'republicpg_create_meta_box( $post, $meta_box["args"] );' );
  
  function republicpg_metabox_republicpg_slider_callback($post,$meta_box) {
    republicpg_create_meta_box( $post, $meta_box["args"] );
  }
  
	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_republicpg_slider_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
	
	
}


?>