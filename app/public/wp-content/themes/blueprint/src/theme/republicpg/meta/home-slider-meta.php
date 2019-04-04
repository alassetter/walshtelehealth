<?php 
add_action('add_meta_boxes', 'republicpg_metabox_home_slider');
function republicpg_metabox_home_slider(){
    
    $meta_box = array(
		'id' => 'republicpg-metabox-home-slider',
		'title' => esc_html__('Slide Settings', 'blueprint'),
		'description' => esc_html__('If you want a full width header with background image, please fill out the fields below.', 'blueprint'),
		'post_type' => 'home_slider',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => esc_html__('Slide Image', 'blueprint'),
					'desc' => esc_html__('The image should be between 1600px - 2000px in width and have a minimum height of 700px for best results. Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection.', 'blueprint'),
					'id' => '_republicpg_slider_image',
					'type' => 'file',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Caption', 'blueprint'),
					'desc' => esc_html__('Enter in the slide caption. (should be fairly short)', 'blueprint'),
					'id' => '_republicpg_slider_caption',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Button Text', 'blueprint'),
					'desc' => esc_html__('If you would like a button to appear below your caption, please enter the text for it here.', 'blueprint'),
					'id' => '_republicpg_slider_button',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Button Link', 'blueprint'),
					'desc' => esc_html__('Please enter the URL for the button here.', 'blueprint'),
					'id' => '_republicpg_slider_button_url',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Slide Alignment', 'blueprint'),
					'desc' => esc_html__('Select the alignment for your caption and button.', 'blueprint'),
					'id' => '_republicpg_slide_alignment',
					'type' => 'slide_alignment',
					'options' => array(
						'left' => 'Left',
						'centered' => 'Centered',
						'right' => 'Right',
					),
					'std' => 'left'
				)
		)
	);
	//$callback = create_function( '$post,$meta_box', 'republicpg_create_meta_box( $post, $meta_box["args"] );' );
  
  function republicpg_metabox_home_slider_callback($post,$meta_box) {
    republicpg_create_meta_box( $post, $meta_box["args"] );
  }
  
	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_home_slider_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
	
	
	
	
	#-----------------------------------------------------------------#
	# Video 
	#-----------------------------------------------------------------#

    $meta_box = array(
		'id' => 'republicpg-metabox-slider-video',
		'title' => esc_html__('Slide Video Settings', 'blueprint'),
		'description' => esc_html__('If you want to feature a video in this slide, please fill out the fields below. Your video & image should be in a 16:9 aspect ratio.', 'blueprint'),
		'post_type' => 'home_slider',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => esc_html__('M4V File URL', 'blueprint'),
					'desc' => esc_html__('Please upload the .m4v video file. You must include both formats.', 'blueprint'),
					'id' => '_republicpg_video_m4v',
					'type' => 'media', 
					'std' => ''
				),
			array( 
					'name' => esc_html__('OGV File URL', 'blueprint'),
					'desc' => esc_html__('Please upload the .ogv video file. You must include both formats.', 'blueprint'),
					'id' => '_republicpg_video_ogv',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Preview Image', 'blueprint'),
					'desc' => esc_html__('Image should be at least 680px wide. Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection. Only applies to self hosted videos.', 'blueprint'),
					'id' => '_republicpg_video_poster',
					'type' => 'file',
					'std' => ''
				),
			array(
					'name' => esc_html__('Embedded Code', 'blueprint'),
					'desc' => esc_html__('If the video is an embed rather than self hosted, enter in a Vimeo or Youtube embed code here. Embeds work worse with the parallax effect, but if you must use this, Vimeo is recommended. ', 'blueprint'),
					'id' => '_republicpg_video_embed',
					'type' => 'textarea',
					'std' => ''
				)
		
		)
	);

	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_home_slider_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
}


?>