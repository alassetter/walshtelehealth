<?php 
add_action('add_meta_boxes_page', 'republicpg_metabox_page');
function republicpg_metabox_page(){
    
	$options = get_republicpg_theme_options(); 
	if(!empty($options['transparent-header']) && $options['transparent-header'] == '1') {
		$disable_transparent_header = array( 
					'name' =>  esc_html__('Disable Transparency From Navigation', 'blueprint'),
					'desc' => esc_html__('You can use this option to force your navigation header to stay a solid color even if it qualifies to trigger the','blueprint') . '<a target="_blank" href="'. esc_url(admin_url('?page=Blueprint#16_section_group_li_a')) .'"> transparent effect</a> ' . esc_html__('you have activated in the Blueprint options panel.', 'blueprint'),
					'id' => '_disable_transparent_header',
					'type' => 'checkbox',
	                'std' => ''
				);
		$force_transparent_header = array( 
					'name' =>  esc_html__('Force Transparency On Navigation', 'blueprint'),
					'desc' => esc_html__('You can use this option to force your navigation header to start transparent even if it does not qualify to trigger the','blueprint') . '<a target="_blank" href="'. esc_url(admin_url('?page=Blueprint#16_section_group_li_a')) .'"> transparent effect</a> ' . esc_html__('you have activated in the Blueprint options panel.', 'blueprint'),
					'id' => '_force_transparent_header',
					'type' => 'checkbox',
	                'std' => ''
				);
    $force_transparent_header_color = array( 
      'name' => esc_html__('Transparent Header Navigation Color', 'blueprint'),
      'desc' => esc_html__('Choose your header navigation logo & color scheme that will be used at the top of the page when the transparent effect is active. This option pulls from the settings "Header Starting Dark Logo" & "Header Dark Text Color" in the','blueprint') . ' <a target="_blank" href="'. admin_url('?page=Blueprint#16_section_group_li_a') .'">transparency tab</a>.',
      'id' => '_force_transparent_header_color',
      'type' => 'select',
      'std' => 'light',
      'options' => array(
        "light" => "Light (default)",
        "dark" => "Dark",
      )
    );
    
	} else {
		$disable_transparent_header = null;
		$force_transparent_header = null;
    $force_transparent_header_color = null;
	}
	
	#-----------------------------------------------------------------#
	# Fullscreen rows
	#-----------------------------------------------------------------#
    $meta_box = array(
		'id' => 'republicpg-metabox-fullscreen-rows',
		'title' => esc_html__('Page Full Screen Rows', 'blueprint'),
		'description' => esc_html__('Here you can configure your page fullscreen rows', 'blueprint'),
		'post_type' => 'page',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(

				array( 
					'name' => esc_html__('Activate Fullscreen Rows', 'blueprint'),
					'desc' => esc_html__('This will cause all WPBakery Page Builder rows to be fullscreen. Some functionality and options within the WPBakery Page Builder will be changed when this is active.', 'blueprint'),
					'id' => '_republicpg_full_screen_rows',
					'type' => 'choice_below',
					'options' => array(
						'off' => 'Off',
						'on' => 'On'
					),
					'std' => 'off'
				),
				array( 
					'name' => esc_html__('Animation Bewteen Rows', 'blueprint'),
					'desc' => esc_html__('Select your desired animation between rows', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_animation',
					'type' => 'select',
					'std' => 'none',
					'options' => array(
						"none" => "Default Scroll",
				  		 "zoom-out-parallax" => "Zoom Out + Parallax",
				  		 "parallax" => "Parallax"
					)
				),
				array( 
					'name' => esc_html__('Animation Speed', 'blueprint'),
					'desc' => esc_html__('Selection your desired animation speed', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_animation_speed',
					'type' => 'select',
					'std' => 'medium',
					'options' => array(
						"slow" => "Slow",
				  		 "medium" => "Medium",
				  		 "fast" => "Fast"
					)
				),
				array( 
					'name' => esc_html__('Overall BG Color', 'blueprint'),
					'desc' => esc_html__('Set your desired background color which will be seen when transitioning through rows. Defaults to #333333', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_overall_bg_color',
					'type' => 'color',
					'std' => ''
				),
				array(
					'name' =>  esc_html__('Add Row Anchors to URL', 'blueprint'),
					'desc' => esc_html__('Enable this to add anchors into your URL for each row.', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_anchors',
					'type' => 'checkbox',
	                'std' => '0'
				),
				array(
					'name' =>  esc_html__('Disable On Mobile', 'blueprint'),
					'desc' => esc_html__('Check this to disable the page full screen rows when viewing on a mobile device.', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_mobile_disable',
					'type' => 'checkbox',
	                'std' => '0'
				),
				array( 
					'name' => esc_html__('Row BG Image Animation', 'blueprint'),
					'desc' => esc_html__('Select your desired row BG image animation', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_row_bg_animation',
					'type' => 'select',
					'std' => 'none',
					'options' => array(
						"none" => "None",
				  		 "ken_burns" => "Ken Burns Zoom"
					)
				),
				array( 
					'name' => esc_html__('Dot Navigation', 'blueprint'),
					'desc' => esc_html__('Select your desired dot navigation style', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_dot_navigation',
					'type' => 'select',
					'std' => 'tooltip',
					'options' => array(
						"transparent" => "Transparent",
				  		 "tooltip" => "Tooltip",
				  		 "tooltip_alt" => "Tooltip Alt",
				  		 "hidden" => "None (Hidden)"
					)
				),
				array( 
					'name' => esc_html__('Row Overflow', 'blueprint'),
					'desc' => esc_html__('Select how you would like rows to be handled that have content taller than the users window height. This only applies to desktop (mobile will automatically get scrollbars)', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_content_overflow',
					'type' => 'select',
					'std' => 'tooltip',
					'options' => array(
						"scrollbar" => "Provide Scrollbar",
				  		"hidden" => "Hide Extra Content",
					)
				),
				array( 
					'name' => esc_html__('Page Footer', 'blueprint'),
					'desc' => esc_html__('This option allows you to define what will be used for the footer after your fullscreen rows', 'blueprint'),
					'id' => '_republicpg_full_screen_rows_footer',
					'type' => 'select',
					'std' => 'none',
					'options' => array(
						"default" => "Default Footer",
						"last_row" => "Last Row",
						"none" => "None"
					)
				),
		)
	);
	//$callback = create_function( '$post,$meta_box', 'republicpg_create_meta_box( $post, $meta_box["args"] );' );
  
  function republicpg_metabox_page_meta_callback($post,$meta_box) {
    republicpg_create_meta_box( $post, $meta_box["args"] );
  }
  
  //do not add page full screen row metabox when gutenberg is active editor
  global $current_screen;
  $current_screen = get_current_screen();
  if( method_exists($current_screen, 'is_block_editor') && $current_screen->is_block_editor() ) {
    
  } else {
	   add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_page_meta_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
  }

	#-----------------------------------------------------------------#
	# Header Settings
	#-----------------------------------------------------------------#
    $meta_box = array(
		'id' => 'republicpg-metabox-page-header',
		'title' => esc_html__('Page Header Settings', 'blueprint'),
		'description' => esc_html__('Here you can configure how your page header will appear. For a full width background image behind your header text, simply upload the image below. To have a standard header just fill out the fields below and don\'t upload an image.', 'blueprint'),
		'post_type' => 'page',
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
						'video_bg' => 'Video Background',
						'particle_bg' => 'HTML5 Canvas Background'
					),
					'std' => 'image_bg'
				),
			
			array( 
					'name' => esc_html__('Particle Images', 'blueprint'),
					'desc' => 'Add images here that will be used to create the particle shapes.',
					'id' => '_republicpg_canvas_shapes',
					'type' => 'canvas_shape_group',
					'class' => 'republicpg_slider_canvas_shape',
					'std' => ''
				),


			array( 
					'name' => esc_html__('Video WebM Upload', 'blueprint'),
					'desc' => esc_html__('Browse for your WebM video file here. This will be automatically played on load so make sure to use this responsibly for enhancing your design. You must include this format & the mp4 format to render your video with cross browser compatibility. OGV is optional. Video must be in a 16:9 aspect ratio.', 'blueprint'),
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
					'name' => esc_html__('Video OGV Upload', 'blueprint'),
					'desc' => esc_html__('Browse for your OGV video file here. See the note above for recommendations on how to properly use your video background.', 'blueprint'),
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
					'name' => esc_html__('Page Header Image', 'blueprint'),
					'desc' => esc_html__('The image should be between 1600px - 2000px wide and have a minimum height of 475px for best results. Click "Browse" to upload and then "Insert into Post".', 'blueprint'),
					'id' => '_republicpg_header_bg',
					'type' => 'file',
					'std' => ''
				),
			array(
					'name' =>  esc_html__('Parallax Header', 'blueprint'),
					'desc' => esc_html__('This will cause your header to have a parallax scroll effect.', 'blueprint'),
					'id' => '_republicpg_header_parallax',
					'type' => 'checkbox',
					'extra' => 'first2',
	                'std' => 1
				),	
			array(
					'name' =>  esc_html__('Box Roll Header', 'blueprint'),
					'desc' => esc_html__('This will cause your header to have a 3d box roll on scroll. (deactivated for boxed layouts)', 'blueprint'),
					'id' => '_republicpg_header_box_roll',
					'type' => 'checkbox',
					'extra' => 'last',
	                'std' => ''
				),
			array( 
					'name' => esc_html__('Page Header Height', 'blueprint'),
					'desc' => esc_html__('How tall do you want your header? Don\'t include "px" in the string. e.g. 350 This only applies when you are using an image/bg color.', 'blueprint'),
					'id' => '_republicpg_header_bg_height',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Fullscreen Height', 'blueprint'),
					'desc' => esc_html__('Chooseing this option will allow your header to always remain fullscreen on all devices/screen sizes.', 'blueprint'),
					'id' => '_republicpg_header_fullscreen',
					'type' => 'checkbox',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Page Header Title', 'blueprint'),
					'desc' => esc_html__('Enter in the page header title', 'blueprint'),
					'id' => '_republicpg_header_title',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Page Header Subtitle', 'blueprint'),
					'desc' => esc_html__('Enter in the page header subtitle', 'blueprint'),
					'id' => '_republicpg_header_subtitle',
					'type' => 'text',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Text Effect', 'blueprint'),
					'desc' => esc_html__('Please select your desired text effect', 'blueprint'),
					'id' => '_republicpg_page_header_text-effect',
					'type' => 'select',
					'std' => 'none',
					'options' => array(
						"none" => "None",
				  		 "rotate_in" => "Rotate In"
					)
				),
			array( 
					'name' => esc_html__('Shape Autorotate Timing', 'blueprint'),
					'desc' => esc_html__('Enter your desired autorotation time in milliseconds e.g. "5000". Leaving this blank will disable the functionality.', 'blueprint'),
					'id' => '_republicpg_particle_rotation_timing',
					'type' => 'text',
					'std' => ''
				),
			array(
					'name' =>  esc_html__('Disable Chance For Particle Explosion', 'blueprint'),
					'desc' => esc_html__('By default there\'s a 50% chance on autorotation that your particles will explode. Checking this box disables that.', 'blueprint'),
					'id' => '_republicpg_particle_disable_explosion',
					'type' => 'checkbox',
	                'std' => ''
				),
			array( 
					'name' => esc_html__('Content Alignment', 'blueprint'),
					'desc' => esc_html__('Horizontal Alignment', 'blueprint'),
					'id' => '_republicpg_page_header_alignment',
					'type' => 'caption_pos',
					'options' => array(
						'left' => 'Left',
						'center' => 'Centered',
						'right' => 'Right',
					),
					'std' => 'left',
					'extra' => 'first2'
				),
				
			array( 
					'name' => esc_html__('Content Alignment', 'blueprint'),
					'desc' => esc_html__('Vertical Alignment', 'blueprint'),
					'id' => '_republicpg_page_header_alignment_v',
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
					'name' => esc_html__('Background Alignment', 'blueprint'),
					'desc' => esc_html__('Please choose how you would like your header background to be aligned', 'blueprint'),
					'id' => '_republicpg_page_header_bg_alignment',
					'type' => 'select',
					'std' => 'center',
					'options' => array(
						"top" => "Top",
				  		 "center" => "Center",
				  		 "bottom" => "Bottom"
					)
				),
			array( 
					'name' => esc_html__('Page Header Background Color', 'blueprint'),
					'desc' => esc_html__('Set your desired page header background color if not using an image', 'blueprint'),
					'id' => '_republicpg_header_bg_color',
					'type' => 'color',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Page Header Font Color', 'blueprint'),
					'desc' => esc_html__('Set your desired page header font color', 'blueprint'),
					'id' => '_republicpg_header_font_color',
					'type' => 'color',
					'std' => ''
				),
			array( 
					'name' => esc_html__('Page Header Overlay Color', 'blueprint'),
					'desc' => esc_html__('This will be applied ontop on your page header BG image (if supplied).', 'blueprint'),
					'id' => '_republicpg_header_bg_overlay_color',
					'type' => 'color',
					'std' => ''
				),
		    $disable_transparent_header,
		    $force_transparent_header,
        $force_transparent_header_color
		)
	);
	//$callback = create_function( '$post,$meta_box', 'republicpg_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_page_meta_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	#-----------------------------------------------------------------#
	# Portfolio Display Settings
	#-----------------------------------------------------------------#
	$portfolio_types = get_terms('project-type');

	$types_options = array("all" => "All");
	
	foreach ($portfolio_types as $type) {
		$types_options[$type->slug] = $type->name;
	}
			
    $meta_box = array(
		'id' => 'republicpg-metabox-portfolio-display',
		'title' => esc_html__('Portfolio Display Settings', 'blueprint'),
		'description' => esc_html__('Here you can configure which categories will display in your portfolio.', 'blueprint'),
		'post_type' => 'page',
		'context' => 'side',
		'priority' => 'core',
		'fields' => array(
			array( 
					'name' => 'Portfolio Categories',
					'desc' => '',
					'id' => 'republicpg-metabox-portfolio-display',
					'type' => 'multi-select',
					'options' => $types_options,
					'std' => 'all'
				),
			array( 
					'name' => 'Display Sortable',
					'desc' => 'Should these portfolio items be sortable?',
					'id' => 'republicpg-metabox-portfolio-display-sortable',
					'type' => 'checkbox',
					'std' => '1'
				)
		)
	);
	//$callback = create_function( '$post,$meta_box', 'republicpg_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_page_meta_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
}


?>