<?php


#-----------------------------------------------------------------#
# Create the Portfolio meta boxes
#-----------------------------------------------------------------# 

add_action('add_meta_boxes_portfolio', 'republicpg_metabox_portfolio');
function republicpg_metabox_portfolio(){
	
	
	$options = get_republicpg_theme_options(); 
	if(!empty($options['transparent-header']) && $options['transparent-header'] == '1') {
		$disable_transparent_header = array( 
					'name' =>  esc_html__('Disable Transparency From Navigation', 'blueprint'),
					'desc' => esc_html__('You can use this option to force your navigation header to stay a solid color even if it qualifies to trigger the','blueprint') . '<a target="_blank" href="'. esc_url(admin_url('?page=Blueprint#16_section_group_li_a')) .'"> transparent effect</a> ' . esc_html__('you have activated in the Blueprint options panel.', 'blueprint'),
					'id' => '_disable_transparent_header',
					'type' => 'checkbox',
	                'std' => ''
				);
		$force_transparent_header_color = array( 
      'name' => esc_html__('Transparent Header Navigation Color', 'blueprint'),
      'desc' => esc_html__('Choose your header navigation logo & color scheme that will be used at the top of the page when the transparent effect is active. This option pulls from the settings "Header Starting Dark Logo" & "Header Dark Text Color" in the','blueprint') . ' <a target="_blank" href="'. esc_url(admin_url('?page=Blueprint#16_section_group_li_a')) .'">transparency tab</a>.',
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
		$force_transparent_header_color = null;
	}
	
	function republicpg_metabox_portfolio_callback($post,$meta_box) {
		republicpg_create_meta_box( $post, $meta_box["args"] );
	}
	
	#-----------------------------------------------------------------#
	# Extra Content
	#-----------------------------------------------------------------# 
	$meta_box = array(
		'id' => 'republicpg-metabox-portfolio-extra',
		'title' =>  esc_html__('Extra Content', 'blueprint'),
		'description' => esc_html__('Please use this section to place any extra content you would like to appear in the main content area under your portfolio item. (The above default editor is only used to populate your items sidebar content)', 'blueprint'),
		'post_type' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
    		array( 
				'name' => '',
				'desc' => '',
				'id' => '_republicpg_portfolio_extra_content',
				'type' => 'editor',
				'std' => ''
			),
		)
	);
	
  //$callback = create_function( '$post,$meta_box', 'republicpg_create_meta_box( $post, $meta_box["args"] );' );

	
	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_portfolio_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
		
    
	
	
	$portfolio_pages = array('default'=>'Default');
			
	//grab all pages that are using the portfolio layout
	$portfolio_pages_ft = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-portfolio.php'
	));
	
	if(!empty($portfolio_pages_ft)) {
		foreach($portfolio_pages_ft as $page){
			$portfolio_pages[$page->ID] = $page->post_title;
		}
	}
	
	$portfolio_pages_ft_new = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'template-portfolio.php'
	));
	
	if(!empty($portfolio_pages_ft_new)) {
		foreach($portfolio_pages_ft_new as $page){
			$portfolio_pages[$page->ID] = $page->post_title;
		}
	}
	
	
	//grab all pages that contain the portfolio shortcode
	global $wpdb;
	
	$results = $wpdb->get_results("SELECT * FROM $wpdb->posts
	WHERE post_content LIKE '%[republicpg_portfolio%' AND post_type='page'");
	 
	if(!empty($results)) {
	    foreach ($results as $result) {
	       $portfolio_pages[$result->ID] = $result->post_title;
	    }
	}
	
	
	#-----------------------------------------------------------------#
	# Project Configuration
	#-----------------------------------------------------------------# 
	if ( floatval(get_bloginfo('version')) < "3.6" ) {
		$meta_box = array(
			'id' => 'republicpg-metabox-custom-thummbnail',
			'title' =>  esc_html__('Project Configuration', 'blueprint'),
			'description' => '',
			'post_type' => 'portfolio',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array( 
						'name' => esc_html__('Full Width Portfolio Item Layout', 'blueprint'),
						'desc' => esc_html__('This will remove the sidebar and allow you to use fullwidth sections and sliders', 'blueprint'),
						'id' => '_republicpg_portfolio_item_layout',
						'type' => 'choice_below',
						'options' => array(
							'disabled' => 'Disabled',
							'enabled' => 'Enabled'
						),
						'std' => 'disabled'
				),
	    		array( 
					'name' => esc_html__('Custom Thumbnail Image', 'blueprint'),
					'desc' => esc_html__('If you would like to have a separate thumbnail for your portfolio item, upload it here. If left blank, a cropped version of your featured image will be automatically used instead. The recommended dimensions are 600px by 403px.', 'blueprint'),
					'id' => '_republicpg_portfolio_custom_thumbnail',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' =>  esc_html__('Hide Featured Image/Video on Single Project Page?', 'blueprint'),
					'desc' => esc_html__('You can choose to hide your featured image/video from automatically displaying on the top of the main project page.', 'blueprint'),
					'id' => '_republicpg_hide_featured',
					'type' => 'checkbox',
	                'std' => 1
				),
				array( 
					'name' => esc_html__('Masonry Item Sizing', 'blueprint'),
					'desc' => esc_html__('This will only be used if you choose to display your portfolio in the masonry format', 'blueprint'),
					'id' => '_portfolio_item_masonry_sizing',
					'type' => 'select',
					'std' => 'tall_regular',
					'options' => array(
						"regular" => "Regular",
				  		"wide" => "Wide",
				  		"tall" => "Tall",
				  		"wide_tall" => "Wide & Tall"
					)
				),
				array( 
					'name' => esc_html__('Masonry Content Position', 'blueprint'),
					'desc' => esc_html__('This will only be used on project styles which show the content overlaid before hover', 'blueprint'),
					'id' => '_portfolio_item_masonry_content_pos',
					'type' => 'select',
					'std' => 'middle',
					'options' => array(
						"middle" => "Middle",
				  		"left" => "Left",
				  		"right" => "Right",
				  		"top" => "Top",
				  		"bottom" => "Bottom"
					)
				),
				array( 
					'name' => esc_html__('External Project URL', 'blueprint'),
					'desc' => esc_html__('If you would like your project to link to a custom location, enter it here (remember to include "http://")', 'blueprint'),
					'id' => '_republicpg_external_project_url',
					'type' => 'text',
					'std' => ''
				),
				array( 
					'name' => esc_html__('Parent Portfolio Override', 'blueprint'),
					'desc' => esc_html__('This allows you to manually assign where your "Back to all" button will take the user on your single portfolio item pages.', 'blueprint'),
					'id' => 'republicpg-metabox-portfolio-parent-override',
					'type' => 'select',
					'options' => $portfolio_pages,
					'std' => 'default'
				),
				array( 
					'name' => esc_html__('Project Excerpt', 'blueprint'),
					'desc' => esc_html__('If you would like your project to display a small excerpt of text under the title in portfolio element, enter it here.', 'blueprint'),
					'id' => '_republicpg_project_excerpt',
					'type' => 'text',
					'std' => ''
				)
				
				
			)
		);
	} 
	
	//wp 3.6+
	else {
		
		
		//show gallery slider option for legacy users only if they're using it
		global $post;
		if($post) {
			$using_gallery_slider = get_post_meta($post->ID, '_republicpg_gallery_slider', true);
			if(!empty($using_gallery_slider) && $using_gallery_slider == 'on'){
				$gallery_slider = array(
						'name' =>  esc_html__('Gallery Slider', 'blueprint'),
						'desc' => esc_html__('This will turn all default WordPress galleries attached to this post into a simple slider.', 'blueprint'),
						'id' => '_republicpg_gallery_slider',
						'type' => 'checkbox',
		                'std' => 1
					);
			} else {
				$gallery_slider = null;
			}
		} else {
			$gallery_slider = null;
		}

		$meta_box = array(
			'id' => 'republicpg-metabox-project-configuration',
			'title' =>  esc_html__('Project Configuration', 'blueprint'),
			'description' => '',
			'post_type' => 'portfolio',
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array( 
						'name' => esc_html__('Full Width Portfolio Item Layout', 'blueprint'),
						'desc' => esc_html__('This will remove the sidebar and allow you to use fullwidth sections and sliders', 'blueprint'),
						'id' => '_republicpg_portfolio_item_layout',
						'type' => 'choice_below',
						'options' => array(
							'disabled' => 'Disabled',
							'enabled' => 'Enabled'
						),
						'std' => 'disabled'
				),
				array( 
						'name' => esc_html__('Custom Content Grid Item', 'blueprint'),
						'desc' => esc_html__('This will all you to place custom content using the above editor that will appear in your portfolio grid. By using this option the single project page will be disabled, however you can still link the item to a custom URL if desired.', 'blueprint'),
						'id' => '_republicpg_portfolio_custom_grid_item',
						'type' => 'choice_below',
						'options' => array(
							'off' => 'Disabled',
							'on' => 'Enabled'
						),
						'std' => 'off'
				),
				array( 
					'name' => esc_html__('Custom Content Grid Item Content', 'blueprint'),
					'desc' => esc_html__('Use this to populate what will display as your project content in place of the default meta info', 'blueprint'),
					'id' => '_republicpg_portfolio_custom_grid_item_content',
					'type' => 'slim_editor',
					'std' => ''
				),
	    		array( 
					'name' => esc_html__('Custom Thumbnail Image', 'blueprint'),
					'desc' => esc_html__('If you would like to have a separate thumbnail for your portfolio item, upload it here. If left blank, a cropped version of your featured image will be automatically used instead. The recommended dimensions are 600px by 403px.', 'blueprint'),
					'id' => '_republicpg_portfolio_custom_thumbnail',
					'type' => 'file',
					'std' => ''
				),
				array(
					'name' =>  esc_html__('Hide Featured Image/Video on Single Project Page?', 'blueprint'),
					'desc' => esc_html__('You can choose to hide your featured image/video from automatically displaying on the top of the main project page.', 'blueprint'),
					'id' => '_republicpg_hide_featured',
					'type' => 'checkbox',
	                'std' => 1
				),
				array( 
					'name' => esc_html__('Masonry Item Sizing', 'blueprint'),
					'desc' => esc_html__('This will only be used if you choose to display your portfolio in the masonry format', 'blueprint'),
					'id' => '_portfolio_item_masonry_sizing',
					'type' => 'select',
					'std' => 'tall_regular',
					'options' => array(
						"regular" => "Regular",
				  		"wide" => "Wide",
				  		"tall" => "Tall",
				  		"wide_tall" => "Wide & Tall",
					)
				),
				array( 
					'name' => esc_html__('Masonry Content Position', 'blueprint'),
					'desc' => esc_html__('This will only be used on project styles which show the content overlaid before hover', 'blueprint'),
					'id' => '_portfolio_item_masonry_content_pos',
					'type' => 'select',
					'std' => 'middle',
					'options' => array(
						"middle" => "Middle",
				  		"left" => "Left",
				  		"right" => "Right",
				  		"top" => "Top",
				  		"bottom" => "Bottom"
					)
				),
				$gallery_slider,
				array( 
					'name' => esc_html__('External Project URL', 'blueprint'),
					'desc' => esc_html__('If you would like your project to link to a custom location, enter it here (remember to include "http://")', 'blueprint'),
					'id' => '_republicpg_external_project_url',
					'type' => 'text',
					'std' => ''
				),
				array( 
					'name' => esc_html__('Parent Portfolio Override', 'blueprint'),
					'desc' => esc_html__('This allows you to manually assign where your "Back to all" button will take the user on your single portfolio item pages.', 'blueprint'),
					'id' => 'republicpg-metabox-portfolio-parent-override',
					'type' => 'select',
					'options' => $portfolio_pages,
					'std' => 'default'
				),
				array( 
					'name' => esc_html__('Project Excerpt', 'blueprint'),
					'desc' => esc_html__('If you would like your project to display a small excerpt of text under the title in portfolio element, enter it here.', 'blueprint'),
					'id' => '_republicpg_project_excerpt',
					'type' => 'text',
					'std' => ''
				),
				array( 
					'name' => esc_html__('Project Accent Color', 'blueprint'),
					'desc' => esc_html__('This will be used in applicable project styles in the portfolio thumbnail view.', 'blueprint'),
					'id' => '_republicpg_project_accent_color',
					'type' => 'color',
					'std' => ''
				),
				array( 
					'name' => esc_html__('Project Title Color', 'blueprint'),
					'desc' => esc_html__('This will be used in applicable project styles in the portfolio thumbnail view.', 'blueprint'),
					'id' => '_republicpg_project_title_color',
					'type' => 'color',
					'std' => ''
				),
				array( 
					'name' => esc_html__('Project Date/Custom excerpt Color', 'blueprint'),
					'desc' => esc_html__('This will be used in applicable project styles in the portfolio thumbnail view.', 'blueprint'),
					'id' => '_republicpg_project_subtitle_color',
					'type' => 'color',
					'std' => ''
				),
				array( 
					'name' => esc_html__('Custom CSS Class Name', 'blueprint'),
					'desc' => esc_html__('For advanced users with css knowledge - use this to add an a specific class onto your project that can be used to target it in any portfolio element to add custom styling.', 'blueprint'),
					'id' => '_republicpg_project_css_class',
					'type' => 'text',
					'std' => ''
				),
				/*array( 
					'name' => esc_html__('3D Parallax Images', 'blueprint'),
					'desc' => 'Add images here that will be used to create the 3d parallax effect when using the relevant project style.',
					'id' => '_republicpg_3d_parallax_images',
					'type' => 'canvas_shape_group',
					'class' => '_republicpg_3d_parallax_images',
					'std' => ''
				)*/
			)
		);

	}//endif

	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_portfolio_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
		
	
	
	
	#-----------------------------------------------------------------#
	# Header Settings
	#-----------------------------------------------------------------#
    $meta_box = array(
		'id' => 'republicpg-metabox-page-header',
		'title' => esc_html__('Project Header Settings', 'blueprint'),
		'description' => esc_html__('Here you can configure how your page header will appear. ', 'blueprint'),
		'post_type' => 'portfolio',
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
					'desc' => esc_html__('The image should be between 1600px - 2000px wide and have a minimum height of 475px for best results.', 'blueprint'),
					'id' => '_republicpg_header_bg',
					'type' => 'file',
					'std' => ''
				),
			array(
					'name' =>  esc_html__('Parallax Header?', 'blueprint'),
					'desc' => esc_html__('If you would like your header to have a parallax scroll effect check this box.', 'blueprint'),
					'id' => '_republicpg_header_parallax',
					'type' => 'checkbox',
	                'std' => 1
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
					'name' => esc_html__('Background Alignment', 'blueprint'),
					'desc' => esc_html__('Please choose how you would like your image background to be aligned', 'blueprint'),
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
					'name' => esc_html__('Page Header Overlay Color', 'blueprint'),
					'desc' => esc_html__('This will be applied ontop on your page header BG image (if supplied).', 'blueprint'),
					'id' => '_republicpg_header_bg_overlay_color',
					'type' => 'color',
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
					'name' => esc_html__('Page Header Font Color', 'blueprint'),
					'desc' => esc_html__('Set your desired page header font color - will only be used if using a header bg image/color', 'blueprint'),
					'id' => '_republicpg_header_font_color',
					'type' => 'color',
					'std' => ''
				),
			$disable_transparent_header,
			$force_transparent_header_color
		)
	);
	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_portfolio_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );
	
	
	
	
    #-----------------------------------------------------------------#
	# Video 
	#-----------------------------------------------------------------#
		
	
    $meta_box = array( 
		'id' => 'republicpg-metabox-portfolio-video',
		'title' => esc_html__('Video Settings', 'blueprint'),
		'description' => esc_html__('If you have a video, please fill out the fields below.', 'blueprint'),
		'post_type' => 'portfolio',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array( 
					'name' => esc_html__('MP4 File URL', 'blueprint'),
					'desc' => esc_html__('Please upload the .mp4 video file.', 'blueprint'),
					'id' => '_republicpg_video_m4v',
					'type' => 'media',
					'std' => ''
				),
			array( 
					'name' => esc_html__('OGV File URL', 'blueprint'),
					'desc' => esc_html__('Please upload the .ogv video file.', 'blueprint'),
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
					'desc' => esc_html__('If the video is an embed rather than self hosted, enter in a Youtube or Vimeo embed code here. The width should be a minimum of 670px with any height.', 'blueprint'),
					'id' => '_republicpg_video_embed',
					'type' => 'textarea',
					'std' => ''
				)
		)
	);


	add_meta_box( $meta_box['id'], $meta_box['title'], 'republicpg_metabox_portfolio_callback', $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );


}