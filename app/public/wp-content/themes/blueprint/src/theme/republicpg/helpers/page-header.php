<?php
/**
 * Blueprint page header helpers
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( !function_exists( 'republicpg_page_header' ) ) {
    function republicpg_page_header($postid) {
		
		global $republicpg_options;
		global $post;
		global $republicpg_theme_skin;
		global $woocommerce;
		
		
		$header_auto_title = (!empty($republicpg_options['header-auto-title']) && $republicpg_options['header-auto-title'] == '1') ? true : false;
		$bg = get_post_meta($postid, '_republicpg_header_bg', true);
		$bg_color = get_post_meta($postid, '_republicpg_header_bg_color', true);
		$bg_type = get_post_meta($postid, '_republicpg_slider_bg_type', true);
		$height = get_post_meta($postid, '_republicpg_header_bg_height', true); 
		$font_color = get_post_meta($postid, '_republicpg_header_font_color', true);
		$title = get_post_meta($postid, '_republicpg_header_title', true);
		$subtitle = get_post_meta($postid, '_republicpg_header_subtitle', true);
		$bg_overlay_color = get_post_meta($postid, '_republicpg_header_bg_overlay_color', true);
		
		if($header_auto_title && is_page() && empty($title)) {
			$title = esc_html( get_the_title() );
			if(empty($bg_color)) { $bg_color = (!empty($republicpg_options['overall-bg-color'])) ? $republicpg_options['overall-bg-color'] : '#ffffff'; }
			if(empty($bg_overlay_color)) { $bg_overlay_color = 'rgba(0,0,0,0.07)'; }
			if(empty($height)) { $height = '225'; }
			
		} else {
			$title = get_post_meta($postid, '_republicpg_header_title', true);
		}
		
		//single post inherits featured img
		$single_post_header_inherit_fi = (!empty($republicpg_options['blog_post_header_inherit_featured_image'])) ? $republicpg_options['blog_post_header_inherit_featured_image'] : '0'; 
		if(empty($bg) && empty($bg_color) && $single_post_header_inherit_fi == '1' && isset($post->post_type) && $post->post_type == 'post' && $post->ID != 0 && is_single() ) {
			$bg_color = '#333333';
		}
		if(empty($bg) && $single_post_header_inherit_fi == '1' && isset($post->post_type) && $post->post_type == 'post' && $post->ID != 0 && is_single() ) {
			if(has_post_thumbnail($post->ID)) {
				$bg = wp_get_attachment_url( get_post_thumbnail_id() );
			}
		}
		
    	

		if(empty($bg_type)) { $bg_type = 'image_bg'; }

		$early_exit = ( isset($post->post_type) && $post->post_type == 'page' && $bg_type == 'image_bg' && empty($bg_color) && empty($bg) && empty($height) && empty($title)) ? true : false;
		
		$headerRemoveStickiness = (!empty($republicpg_options['header-remove-fixed'])) ? $republicpg_options['header-remove-fixed'] : '0'; 
		$header_format = (!empty($republicpg_options['header_format'])) ? $republicpg_options['header_format'] : 'default';
		$condense_header_on_scroll = (!empty($republicpg_options['condense-header-on-scroll']) && $header_format == 'centered-menu-bottom-bar' && $headerRemoveStickiness != '1' && $republicpg_options['condense-header-on-scroll'] == '1') ? 'true' : 'false'; 
		
		$fullscreen_rows = get_post_meta($postid, '_republicpg_full_screen_rows', true);
		if($fullscreen_rows == 'on' || $early_exit) {
			return;
		}

		$parallax_bg = get_post_meta($postid, '_republicpg_header_parallax', true);
    	
    	//woocommerce archives
    	if(function_exists('woocommerce_page_title')) {
	    	if($woocommerce && is_product_category() || $woocommerce && is_product_tag() || $woocommerce && is_product_taxonomy() ) {
	    		$subtitle = '';
	    		$title = woocommerce_page_title(false);

	    		$cate = get_queried_object();
	    		$t_id = (property_exists($cate, 'term_id')) ? $cate->term_id : '';
	    		$product_terms =  get_option( "taxonomy_$t_id" );

	    		$bg = (!empty($product_terms['product_category_image'])) ? $product_terms['product_category_image'] : $bg;
	    	}
	    }
		
		$page_template = get_post_meta($postid, '_wp_page_template', true); 
		$display_sortable = get_post_meta($postid, 'republicpg-metabox-portfolio-display-sortable', true);
		$inline_filters = (!empty($republicpg_options['portfolio_inline_filters']) && $republicpg_options['portfolio_inline_filters'] == '1') ? '1' : '0';
		$filters_id = (!empty($republicpg_options['portfolio_inline_filters']) && $republicpg_options['portfolio_inline_filters'] == '1') ? 'portfolio-filters-inline' : 'portfolio-filters';
		$text_align = get_post_meta($postid, '_republicpg_page_header_alignment', true); 
		$text_align_v = get_post_meta($postid, '_republicpg_page_header_alignment_v', true); 
		$fullscreen_header = (!empty($republicpg_options['blog_header_type']) && $republicpg_options['blog_header_type'] == 'fullscreen' && is_singular('post')) ? true : false;
		$post_header_style = (!empty($republicpg_options['blog_header_type'])) ? $republicpg_options['blog_header_type'] : 'default'; 
		$bottom_shadow = get_post_meta($postid, '_republicpg_header_bottom_shadow', true); 
		$bg_overlay = get_post_meta($postid, '_republicpg_header_overlay', true); 
		$text_effect = get_post_meta($postid, '_republicpg_page_header_text-effect', true); 
		$animate_in_effect = (!empty($republicpg_options['header-animate-in-effect'])) ? $republicpg_options['header-animate-in-effect'] : 'none';
		(!empty($display_sortable) && $display_sortable == 'on') ? $display_sortable = '1' : $display_sortable = '0';
		
		//incase no title is entered for portfolio, still show the filters
		if( $page_template == 'template-portfolio.php' && empty($title)) $title = get_the_title($post->ID);
		

		if( (!empty($bg) || !empty($bg_color) || $bg_type == 'video_bg' || $bg_type == 'particle_bg') && !is_post_type_archive( 'post' ) ) {  
    	
    $social_img_src = (empty($bg)) ? 'none' : $bg;
		$bg = (empty($bg)) ? 'none' : $bg;

		if($bg_type == 'image_bg' || $bg_type == 'particle_bg') {
    		(empty($bg_color)) ? $bg_color = '#000' : $bg_color = $bg_color;
    	} else {
    		$bg = 'none'; //remove stnd bg image for video BG type
    	}
    	$bg_color_string = (!empty($bg_color)) ? 'background-color: '.$bg_color.'; ' : null;

    	if($bg_type == 'particle_bg') {
	    	$rotate_timing = get_post_meta($postid, '_republicpg_particle_rotation_timing', true); 
	    	$disable_explosion = get_post_meta($postid, '_republicpg_particle_disable_explosion', true);
	    	$shapes = get_post_meta($postid, '_republicpg_canvas_shapes', true); 
	    	if(empty($shapes)) $bg_type = 'image_bg';
	    }
	    if($bg_type == 'video_bg') {
			$video_webm = get_post_meta($postid, '_republicpg_media_upload_webm', true); 
			$video_mp4 = get_post_meta($postid, '_republicpg_media_upload_mp4', true); 
			$video_ogv = get_post_meta($postid, '_republicpg_media_upload_ogv', true); 
			$video_image = get_post_meta($postid, '_republicpg_slider_preview_image', true); 
		}
		$box_roll = get_post_meta($postid, '_republicpg_header_box_roll', true); 
		if(!empty($republicpg_options['boxed_layout']) && $republicpg_options['boxed_layout'] == '1' || $condense_header_on_scroll == 'true') $box_roll = 'off';
		$bg_position = get_post_meta($postid, '_republicpg_page_header_bg_alignment', true); 
		if(empty($bg_position)) $bg_position = 'top'; 

		if( $post_header_style == 'default_minimal' && (isset($post->post_type) && $post->post_type == 'post' && is_single())) {
			$height = (!empty($height)) ? preg_replace('/\s+/', '', $height) : 550;
		} else {
			$height = (!empty($height)) ? preg_replace('/\s+/', '', $height) : 350;
		}
		
		//mobile padding calc
		if(intval($height) < 350) {
			$mobile_padding_influence = 'low';
		} else if(intval($height) < 600) {
			$mobile_padding_influence = 'normal';
		} else {
			$mobile_padding_influence = 'high';
		}

		$not_loaded_class = ($republicpg_theme_skin != 'ascend') ? "not-loaded" : null;		
		$page_fullscreen_header = get_post_meta($postid, '_republicpg_header_fullscreen', true); 
		$fullscreen_class = ($fullscreen_header == true || $page_fullscreen_header == 'on') ? "fullscreen-header" : null;
		$bottom_shadow_class = ($bottom_shadow == 'on') ? " bottom-shadow": null;
		$bg_overlay_class = ($bg_overlay == 'on') ? " bg-overlay": null;
		$ajax_page_loading = (!empty($republicpg_options['ajax-page-loading']) && $republicpg_options['ajax-page-loading'] == '1') ? true : false;
		
		$hentry_post_class = ( isset($post->post_type) && $post->post_type == 'post' && is_single() ) ? ' hentry' : '';
		
		if($animate_in_effect == 'slide-down') {
			$wrapper_height_style = null;
		} else {
			$wrapper_height_style = 'style="height: '.$height.'px;"';
		}
		if($fullscreen_header == true && ($post->post_type == 'post' && is_single()) || $page_fullscreen_header == 'on') $wrapper_height_style = null; //diable slide down for fullscreen headers
	  
		$force_transparent_header_color = (isset($post->ID)) ? get_post_meta($post->ID, '_force_transparent_header_color', true) : '';
		if(empty($force_transparent_header_color)) { $force_transparent_header_color = 'light'; }
		
		$midnight_non_parallax = (!empty($parallax_bg) && $parallax_bg == 'on') ? null : 'data-midnight="light"';
		$regular_page_header_midnight_override = 'data-midnight="'.$force_transparent_header_color.'"';
		
  	if($box_roll != 'on') { echo '<div id="page-header-wrap" data-animate-in-effect="'. $animate_in_effect .'" data-midnight="'.$force_transparent_header_color.'" class="'.$fullscreen_class.'" '.$wrapper_height_style.'>'; } 
  	if(!empty($box_roll) && $box_roll == 'on') { 
  		wp_enqueue_style('box-roll'); 
  		echo '<div class="republicpg-box-roll">'; 
  	}
		
		//starting fullscreen height
		////conditional checking pages and posts
		if($page_fullscreen_header == 'on' || $fullscreen_header == true ) {
			$starting_height = ' ';
		} else {
			$starting_height = 'height:' . $height . 'px;';
		}

		
    	?>
	    <div class="<?php echo esc_attr( $not_loaded_class ) . ' ' . esc_attr( $fullscreen_class ) . esc_attr( $bottom_shadow_class ) . esc_attr( $hentry_post_class ) . esc_attr( $bg_overlay_class ); ?>" <?php if(isset($post->post_type) && $post->post_type == 'post' && is_single()) echo 'data-post-hs="'. esc_attr( $post_header_style ) .'"'; ?> data-padding-amt="<?php echo esc_attr( $mobile_padding_influence ); ?>" data-animate-in-effect="<?php echo esc_attr( $animate_in_effect ); ?>" id="page-header-bg" <?php echo $regular_page_header_midnight_override; ?> data-text-effect="<?php echo esc_attr( $text_effect ); ?>" data-bg-pos="<?php echo esc_attr( $bg_position ); ?>" data-alignment="<?php echo (!empty($text_align)) ? esc_attr($text_align) : 'left' ; ?>" data-alignment-v="<?php echo (!empty($text_align_v)) ? esc_attr($text_align_v) : 'middle' ; ?>" data-parallax="<?php echo (!empty($parallax_bg) && $parallax_bg == 'on') ? '1' : '0'; ?>" data-height="<?php echo (!empty($height)) ? esc_attr($height) : '350'; ?>" style="<?php echo $bg_color_string; ?> <?php echo $starting_height; ?>">
			
			<?php 

			if(!empty($bg) && $bg != 'none') { ?><div class="page-header-bg-image-wrap" id="republicpg-page-header-p-wrap" data-parallax-speed="medium"><div class="page-header-bg-image" style="background-image: url(<?php echo $bg; ?>);"></div></div> <?php  } 

			if(!empty($bg_overlay_color)) { ?><div class="page-header-overlay-color" style="background-color: <?php echo $bg_overlay_color; ?>;"></div> <?php }  ?>

			<?php if($bg_type != 'particle_bg') { echo '<div class="container">'; }
			
					
					if($post->ID != 0 && $post->post_type && $post->post_type == 'portfolio') { ?>
					
					<div class="row project-title">
					<div class="container">
					<div class="col span_6 section-title <?php if(empty($republicpg_options['portfolio_social']) || $republicpg_options['portfolio_social'] == 0 || empty($republicpg_options['portfolio_date']) || $republicpg_options['portfolio_date'] == 0 ) echo 'no-date'?>">
						<div class="inner-wrap">
						<h1><?php the_title(); ?></h1>
						<?php if(!empty($subtitle)) { ?> <span class="subheader"><?php echo wp_kses_post( $subtitle ); ?></span> <?php } ?>
						
						<?php 

						global $republicpg_options;
						$single_nav_pos = (!empty($republicpg_options['portfolio_single_nav'])) ? $republicpg_options['portfolio_single_nav'] : 'in_header';

						if($single_nav_pos == 'in_header') project_single_controls(); ?>
						</div>
					</div>
				</div> 
			
			</div><!--/row-->
						
						
						
						
						
						
						
					<?php } elseif($post->ID != 0 && $post->post_type == 'post' && is_single() ) { 
						
						// also set as an img for social sharing/
						if($social_img_src != 'none') echo '<img class="hidden-social-img" src="'.$social_img_src.'" alt="'.get_the_title().'" />';
						
						$remove_single_post_date = (!empty($republicpg_options['blog_remove_single_date'])) ? $republicpg_options['blog_remove_single_date'] : '0'; 
						$remove_single_post_author = (!empty($republicpg_options['blog_remove_single_author'])) ? $republicpg_options['blog_remove_single_author'] : '0'; 
						$remove_single_post_comment_number = (!empty($republicpg_options['blog_remove_single_comment_number'])) ? $republicpg_options['blog_remove_single_comment_number'] : '0'; 
						$remove_single_post_republicpg_love = (!empty($republicpg_options['blog_remove_single_republicpg_love'])) ? $republicpg_options['blog_remove_single_republicpg_love'] : '0'; 

						?>
						
						<div class="row">

							<div class="col span_6 section-title blog-title" data-remove-post-date="<?php echo esc_attr( $remove_single_post_date ); ?>" data-remove-post-author="<?php echo esc_attr( $remove_single_post_author ); ?>" data-remove-post-comment-number="<?php echo esc_attr( $remove_single_post_comment_number ); ?>">
								<div class="inner-wrap">

									<?php 
									global $republicpg_options;
									$theme_skin = (!empty($republicpg_options['theme-skin'])) ? $republicpg_options['theme-skin'] : 'default';
									
									if( ($post->post_type == 'post' && is_single()) && $post_header_style == 'default_minimal' ||
								      ($post->post_type == 'post' && is_single()) && $fullscreen_header == true && $theme_skin == 'material') {

										  $categories = get_the_category();
											if ( ! empty( $categories ) ) {
												$output = null;
											    foreach( $categories as $category ) {
											        $output .= '<a class="'.$category->slug.'" href="' . esc_url( get_category_link( $category->term_id ) ) . '" >' . esc_html( $category->name ) . '</a>';
											    }
											    echo trim( $output);
											}
									} ?>
									
									<h1 class="entry-title"><?php the_title(); ?></h1>

									 <?php if(($post->post_type == 'post' && is_single()) && $fullscreen_header == true ) { ?>
									 	<div class="author-section">
										 	<span class="meta-author">  
										 		<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 100 ); }?>
										 	</span> 
										 	<div class="avatar-post-info vcard author">
											 	<span class="fn"><?php the_author_posts_link(); ?></span>
											 
												<?php 
												$republicpg_u_time = get_the_time('U'); 
												$republicpg_u_modified_time = get_the_modified_time('U'); 
												if ($republicpg_u_modified_time >= $republicpg_u_time + 86400) { ?>
														<span class="meta-date date published"><i><?php echo get_the_date(); ?></i></span>
														<span class="meta-date date updated rich-snippet-hidden"><i><?php echo get_the_modified_time('F jS, Y'); ?></i></span>
												<?php } else { ?>
												    <span class="meta-date date updated"><i><?php echo get_the_date(); ?></i></span>
												<?php }	?>
												
											 </div>
										</div>
								<?php } ?>
							
							
								<?php if($fullscreen_header != true) { ?>	
									<div id="single-below-header">
										<span class="meta-author vcard author"><span class="fn"><?php echo esc_html__('By', 'blueprint'); ?> <?php the_author_posts_link(); ?></span></span><!--
										--><?php 
										$republicpg_u_time = get_the_time('U'); 
										$republicpg_u_modified_time = get_the_modified_time('U'); 
										if ($republicpg_u_modified_time >= $republicpg_u_time + 86400) { ?>
												<span class="meta-date date published"><?php echo get_the_date(); ?></span>
												<span class="meta-date date updated rich-snippet-hidden"><?php echo get_the_modified_time('F jS, Y'); ?></span>
										<?php } else { ?>
												<span class="meta-date date updated"><?php echo get_the_date(); ?></span>
										<?php }	?><!--
										--><?php if($post_header_style != 'default_minimal') { ?> <span class="meta-category"><?php the_category(', '); ?></span> <?php } else { ?><!--
										--><span class="meta-comment-count"><a href="<?php comments_link(); ?>"> <?php comments_number( esc_html__('No Comments', 'blueprint'), esc_html__('One Comment ', 'blueprint'), esc_html__('% Comments', 'blueprint') ); ?></a></span>
									<?php } ?>
									</div><!--/single-below-header-->
								<?php } ?>
								
								<?php if($fullscreen_header != true && $post_header_style != 'default_minimal') { ?>

								<div id="single-meta" data-sharing="<?php echo ( !empty($republicpg_options['blog_social']) && $republicpg_options['blog_social'] == 1 ) ? '1' : '0'; ?>">
									<ul>
		
	  	
									   
										<li class="meta-comment-count">
											<a href="<?php comments_link(); ?>"><i class="icon-default-style steadysets-icon-chat"></i> <?php comments_number( esc_html__('No Comments', 'blueprint'), esc_html__('One Comment ', 'blueprint'), esc_html__('% Comments', 'blueprint') ); ?></a>
										</li>
										  <?php if($remove_single_post_republicpg_love != '1') { ?>
												<li>
										   		<?php echo '<span class="n-shortcode">'.republicpg_love('return').'</span>'; ?>
										   	</li>
										  <?php } 
										
										$blog_social_style = (!empty($republicpg_options['blog_social_style'])) ? $republicpg_options['blog_social_style'] : 'default';
										
										if( !empty($republicpg_options['blog_social']) && $republicpg_options['blog_social'] == 1 &&  $blog_social_style != 'fixed_bottom_right') { 
										   
										   echo '<li class="meta-share-count"><a href="#"><i class="icon-default-style steadysets-icon-share"></i><span class="share-count-total">0</span></a> <div class="republicpg-social">';
										   
										
											//facebook
											if(!empty($republicpg_options['blog-facebook-sharing']) && $republicpg_options['blog-facebook-sharing'] == 1) { 
												echo "<a class='facebook-share republicpg-sharing' href='#' title='".esc_attr__('Share this', 'blueprint')."'> <i class='fa fa-facebook'></i> <span class='count'></span></a>";
											}
											//twitter
											if(!empty($republicpg_options['blog-twitter-sharing']) && $republicpg_options['blog-twitter-sharing'] == 1) {
												echo "<a class='twitter-share republicpg-sharing' href='#' title='".esc_attr__('Tweet this', 'blueprint')."'> <i class='fa fa-twitter'></i> <span class='count'></span></a>";
											}
											//google plus
											if(!empty($republicpg_options['blog-google-plus-sharing']) && $republicpg_options['blog-google-plus-sharing'] == 1) {
												echo "<a class='google-plus-share republicpg-sharing-alt' href='#' title='".esc_attr__('Share this', 'blueprint')."'> <i class='fa fa-google-plus'></i> <span class='count'>0</span></a>";
											}
											
											//linkedIn
											if(!empty($republicpg_options['blog-linkedin-sharing']) && $republicpg_options['blog-linkedin-sharing'] == 1) {
												echo "<a class='linkedin-share republicpg-sharing' href='#' title='".esc_attr__('Share this', 'blueprint')."'> <i class='fa fa-linkedin'></i> <span class='count'> </span></a>";
											}
											//pinterest
											if(!empty($republicpg_options['blog-pinterest-sharing']) && $republicpg_options['blog-pinterest-sharing'] == 1) {
												echo "<a class='pinterest-share republicpg-sharing' href='#' title='".esc_attr__('Pin this', 'blueprint')."'> <i class='fa fa-pinterest'></i> <span class='count'></span></a>";
											}
											
										  echo '</div></li>';
		
								 		}
									?>
									
									

									</ul>
									
								</div><!--/single-meta-->

							<?php } //end if theme skin default ?>
						    </div>
						</div><!--/section-title-->
					</div><!--/row-->
						
							
						
						
					
					<?php //default	
					} else if($bg_type != 'particle_bg') {

						if(!empty($box_roll) && $box_roll == 'on') { 
							$alignment = (!empty($text_align)) ? $text_align : 'left';
							$v_alignment = (!empty($text_align_v)) ? $text_align_v : 'middle';
							echo '<div class="overlaid-content" data-text-effect="'.$text_effect.'" data-alignment="'.$alignment.'" data-alignment-v="'.$v_alignment.'"><div class="container">';
						}  
						
						$empty_title_class = (empty($title) && empty($subtitle)) ? 'empty-title' : '';
						?>

						 <div class="row">
							<div class="col span_6 <?php echo esc_attr( $empty_title_class ); ?>">
								<div class="inner-wrap">
									<?php if(!empty($title)) { ?><h1><?php echo $title; ?></h1> <?php } ?>
									<span class="subheader"><?php echo wp_kses_post( $subtitle ); ?></span>
								</div>
								 
								<?php // portfolio filters
									if( $page_template == 'template-portfolio.php' && $display_sortable == '1' && $inline_filters == '0') { ?>
									<div class="<?php echo esc_attr( $filters_id );?>" instance="0">
											<a href="#" data-sortable-label="<?php echo (!empty($republicpg_options['portfolio-sortable-text'])) ? wp_kses_post( $republicpg_options['portfolio-sortable-text'] ) :'Sort Portfolio'; ?>" id="sort-portfolio"><span><?php echo (!empty($republicpg_options['portfolio-sortable-text'])) ? wp_kses_post( $republicpg_options['portfolio-sortable-text'] ) : esc_html__('Sort Portfolio','blueprint'); ?></span> <i class="icon-angle-down"></i></a> 
										<ul>
										   <li><a href="#" data-filter="*"><?php echo esc_html__('All', 'blueprint'); ?></a></li>
						               	   <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'project-type', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
										</ul>
									</div>
								<?php } ?>
								</div>
						  </div>
					  
					  <?php if(!empty($box_roll) && $box_roll == 'on') echo '</div></div><!--/overlaid-content-->';

				 } ?>
					
					
				
			<?php if($bg_type != 'particle_bg') { echo '</div>'; } //closing container 


			 if(($post->ID != 0 && $post->post_type == 'post' && is_single()) && $fullscreen_header == true || $page_fullscreen_header == 'on') { 
			 	 $rotate_in_class = ( $text_effect == 'rotate_in') ? 'hidden' : null;
			 	 $button_styling = (!empty($republicpg_options['button-styling'])) ? $republicpg_options['button-styling'] : 'default'; 

			 	 $header_down_arrow_style = (!empty($republicpg_options['header-down-arrow-style'])) ? $republicpg_options['header-down-arrow-style'] : 'default'; 
			 	 
			 	 if($header_down_arrow_style == 'scroll-animation' || $button_styling == 'slightly_rounded' || $button_styling == 'slightly_rounded_shadow') {
			 	 	echo '<div class="scroll-down-wrap no-border"><a href="#" class="section-down-arrow '.$rotate_in_class.'"><svg class="republicpg-scroll-icon" viewBox="0 0 30 45" enable-background="new 0 0 30 45">
                			<path class="republicpg-scroll-icon-path" fill="none" stroke="#ffffff" stroke-width="2" stroke-miterlimit="10" d="M15,1.118c12.352,0,13.967,12.88,13.967,12.88v18.76  c0,0-1.514,11.204-13.967,11.204S0.931,32.966,0.931,32.966V14.05C0.931,14.05,2.648,1.118,15,1.118z"></path>
            			  </svg></a></div>';
			 	 } else {
				 	 if($button_styling == 'default'){
				 	 	echo '<div class="scroll-down-wrap"><a href="#" class="section-down-arrow '.$rotate_in_class.'"><i class="icon-blueprint-down-arrow icon-default-style"> </i></a></div>';
				 	 } else {
				 	 	echo '<div class="scroll-down-wrap '.$rotate_in_class.'"><a href="#" class="section-down-arrow"><i class="fa fa-angle-down top"></i><i class="fa fa-angle-down"></i></a></div>';
				 	 }
				 }

			  } 

		
		//video bg
		if($bg_type == 'video_bg') {
			
			if ( floatval(get_bloginfo('version')) >= "3.6" ) {
				//wp_enqueue_script('wp-mediaelement');
				//wp_enqueue_style('wp-mediaelement');
			} else {
				//register media element for WordPress 3.5
				wp_register_script('wp-mediaelement', get_template_directory_uri() . '/js/mediaelement-and-player.min.js', array('jquery'), '1.0', TRUE);
				wp_register_style('wp-mediaelement', get_template_directory_uri() . '/css/mediaelementplayer.min.css');
				
				wp_enqueue_script('wp-mediaelement');
				wp_enqueue_style('wp-mediaelement');
			}
			
			//parse video image
			if(strpos($video_image, "http://") !== false || strpos($video_image, "https://") !== false){
				$video_image_src = $video_image;
			} else {
				$video_image_src = wp_get_attachment_image_src($video_image, 'full');
				$video_image_src = $video_image_src[0];
			}
			
			$poster_markup = null;
			$video_markup = null;
			
			$video_markup .=  '<div class="video-color-overlay" data-color="'. esc_attr($bg_color) .'"></div>';
			
				 
			$video_markup .= '
			
			<div class="mobile-video-image" style="background-image: url('. esc_url($video_image_src) .')"></div>
			<div class="republicpg-video-wrap" data-bg-alignment="'. esc_attr( $bg_position ).'">
				
				
				<video class="republicpg-video-bg" width="1800" height="700" '.$poster_markup.'  preload="auto" loop autoplay muted playsinline>';
				    if(!empty($video_webm)) { $video_markup .= '<source type="video/webm" src="'. esc_url( $video_webm ).'">'; }
				    if(!empty($video_mp4)) { $video_markup .= '<source type="video/mp4" src="'. esc_url( $video_mp4 ).'">'; }
				    if(!empty($video_ogv)) { $video_markup .= '<source type="video/ogg" src="'. esc_url( $video_ogv ).'">'; }
				  
			   $video_markup .='</video>
		
			</div>';
			
			echo $video_markup; // WPCS: XSS ok.
		}

		//particle bg
		if($bg_type == 'particle_bg') {

			wp_enqueue_script('republicpgParticles');

			echo '<div class=" republicpg-particles" data-disable-explosion="'.$disable_explosion.'" data-rotation-timing="'.$rotate_timing.'"><div class="canvas-bg"><canvas id="canvas" data-active-index="0"></canvas></div>';

			$images = explode( ',', $shapes);
			$i = 0;

			if(!empty($shapes)) {

				if(!empty($box_roll) && $box_roll == 'on') { 
					$alignment = (!empty($text_align)) ? $text_align : 'left';
					$v_alignment = (!empty($text_align_v)) ? $text_align_v : 'middle';
					echo '<div class="overlaid-content" data-text-effect="'.$text_effect.'" data-alignment="'.$alignment.'" data-alignment-v="'.$v_alignment.'">';
				}

				echo '<div class="container"><div class="row"><div class="col span_6" >';

				foreach ( $images as $attach_id ) {
					$i++;

	    			$img = wp_get_attachment_image_src(  $attach_id, 'full' );

	    			$attachment = get_post( $attach_id );
					  $shape_meta = array(
							'caption' => $attachment->post_excerpt,
							'title' => $attachment->post_title,
							'bg_color' => get_post_meta( $attachment->ID, 'republicpg_particle_shape_bg_color', true ),
							'color' => get_post_meta( $attachment->ID, 'republicpg_particle_shape_color', true ),
							'color_mapping' => get_post_meta( $attachment->ID, 'republicpg_particle_shape_color_mapping', true ),
							'alpha' => get_post_meta( $attachment->ID, 'republicpg_particle_shape_color_alpha', true ),
							'density' => get_post_meta( $attachment->ID, 'republicpg_particle_shape_density', true ),
							'max_particle_size' => get_post_meta( $attachment->ID, 'republicpg_particle_max_particle_size', true )
					);
					if(!empty($shape_meta['density'])) {
						switch($shape_meta['density']) {
							case 'very_low':
								$shape_meta['density'] = '19';
							break;
							case 'low':
								$shape_meta['density'] = '16';
							break;
							case 'medium':
								$shape_meta['density'] = '13';
							break;
							case 'high':
								$shape_meta['density'] = '10';
							break;
							case 'very_high':
								$shape_meta['density'] = '8';
							break;
						}
					}

					if(!empty($shape_meta['color']) && $shape_meta['color'] == '#fff' || !empty($shape_meta['color']) && $shape_meta['color'] == '#ffffff') $shape_meta['color'] = '#fefefe';

	    			//data for particle shape
	    			echo '<div class="shape" data-src="'. republicpg_ssl_check($img[0]) .'" data-max-size="'.$shape_meta['max_particle_size'].'" data-alpha="'.$shape_meta['alpha'].'" data-density="'.$shape_meta['density'].'" data-color-mapping="'.$shape_meta['color_mapping'].'" data-color="'.$shape_meta['color'].'" data-bg-color="'.$shape_meta['bg_color'].'"></div>';

	    			//overlaid content
	    			echo '<div class="inner-wrap shape-'.$i.'">';
	    			echo '<h1>'.$shape_meta["title"].'</h1> <span class="subheader">'.$shape_meta["caption"].'</span>';
	    			echo '</div>';

	    		} ?>

	    		</div></div></div>

	    		<div class="pagination-navigation">
					<div class="pagination-current"></div>
					<div class="pagination-dots">
						<?php foreach ( $images as $attach_id ) {
							echo '<button class="pagination-dot"></button>';
						} ?>
					</div>
				</div>
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="690">
				  <defs>
				    <filter id="goo">
				      <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"></feGaussianBlur>
				      <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 69 -16" result="goo"></feColorMatrix>
				      <feComposite in="SourceGraphic" in2="goo" operator="atop"></feComposite>
				    </filter>
				  </defs>
				</svg>

				<?php if(!empty($box_roll) && $box_roll == 'on') echo '</div><!--/overlaid-content-->'; ?>

			</div> <!--/republicpg particles-->

			<?php }
		} //particle bg ?>

		</div>

	   <?php 

	    echo '</div>';  

	    } else if( !empty($title) && !is_archive()) { ?>
	    	
		    <div class="row page-header-no-bg" data-alignment="<?php echo (!empty($text_align)) ? $text_align : 'left' ; ?>">
		    	<div class="container">	
					<div class="col span_12 section-title">
						<h1><?php echo $title; ?><?php if(!empty($subtitle)) echo '<span>' . $subtitle . '</span>'; ?></h1>
						
						<?php // portfolio filters
						if( $page_template == 'template-portfolio.php' && $display_sortable == '1' && $inline_filters == '0') { ?>
						<div class="<?php echo esc_attr( $filters_id ) ;?>" instance="0">
							
							<a href="#" data-sortable-label="<?php echo (!empty($republicpg_options['portfolio-sortable-text'])) ? wp_kses_post( $republicpg_options['portfolio-sortable-text'] ) :'Sort Portfolio'; ?>" id="sort-portfolio"><span><?php echo (!empty($republicpg_options['portfolio-sortable-text'])) ? wp_kses_post( $republicpg_options['portfolio-sortable-text'] ) : esc_html__('Sort Portfolio','blueprint'); ?></span> <i class="icon-angle-down"></i></a> 
							
							<ul>
							   <li><a href="#" data-filter="*"><?php echo esc_html__('All', 'blueprint'); ?></a></li>
			               	   <?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'project-type', 'show_option_none'   => '', 'walker' => new Walker_Portfolio_Filter())); ?>
							</ul>
						</div>
					<?php } ?>
						
					</div>
				</div>

			</div> 
	 	   	
	    <?php } else if(is_category() || is_tag() || is_date() || is_author() ) {

	    	/*blog archives*/
	    	$archive_bg_img = (isset($republicpg_options['blog_archive_bg_image'])) ? republicpg_options_img($republicpg_options['blog_archive_bg_image']) : null;
	    	$t_id =  get_cat_ID( single_cat_title( '', false ) ) ;
	    	$terms =  get_option( "taxonomy_$t_id" );

	    	$heading = null;
			$subtitle = null;

			if(is_author()){

				$heading =  get_the_author();
				$subtitle = esc_html__('All Posts By', 'blueprint' );

			} else if(is_category()) {

				$heading =  single_cat_title( '', false );
				$subtitle = esc_html__('Category', 'blueprint' );

			} else if(is_tag()) {

				$heading =  wp_title("",false);
				$subtitle = esc_html__('Tag', 'blueprint' );

			} else if(is_date()){

				if ( is_day() ) :

					$heading = get_the_date();
					$subtitle = esc_html__('Daily Archives', 'blueprint' );
				
				elseif ( is_month() ) :

					$heading = get_the_date( _x( 'F Y', 'monthly archives date format', 'blueprint' ) );
					$subtitle = esc_html__('Monthly Archives', 'blueprint' );

				elseif ( is_year() ) :

					$heading =  get_the_date( _x( 'Y', 'yearly archives date format', 'blueprint' ) );
					$subtitle = esc_html__('Yearly Archives', 'blueprint' );

				else :
					$heading = __( 'Archives', 'blueprint' );

				endif;
			} else {
					$heading = wp_title("",false);
			} ?>


			<?php 
			//category archive text align
			$blog_type = $republicpg_options['blog_type'];
			if($blog_type == null) $blog_type = 'std-blog-sidebar';

			$blog_standard_type = (!empty($republicpg_options['blog_standard_type'])) ? $republicpg_options['blog_standard_type'] : 'classic';
			$archive_header_text_align = ($blog_type != 'masonry-blog-sidebar' && $blog_type != 'masonry-blog-fullwidth' && $blog_type != 'masonry-blog-full-screen-width' && $blog_standard_type == 'minimal') ? 'center' : 'left';

			if(!empty($terms['category_image']) || !empty($archive_bg_img)) { 

				$bg_img = $archive_bg_img;
				if(!empty($terms['category_image'])) $bg_img = $terms['category_image'];

				if($animate_in_effect == 'slide-down') {
					$wrapper_height_style = null;
				} else {
					$wrapper_height_style = 'style="height: 350px;"';
				}
			?>

			<div id="page-header-wrap" data-midnight="light" <?php echo $wrapper_height_style; ?>>	 
				<div id="page-header-bg" data-animate-in-effect="<?php echo esc_attr( $animate_in_effect ); ?>" id="page-header-bg" data-text-effect="" data-bg-pos="center" data-alignment="<?php echo esc_attr( $archive_header_text_align ); ?>" data-alignment-v="middle" data-parallax="0" data-height="350" style="height: 350px;">
			
					<div class="page-header-bg-image" style="background-image: url(<?php echo esc_url( $bg_img ); ?>);"></div> 

					<div class="container">
					    <div class="row">
						    <div class="col span_6">
							     <div class="inner-wrap">
							     	<span class="subheader"><?php echo wp_kses_post( $subtitle ); ?></span>
									  <h1><?php echo wp_kses_post( $heading ); ?></h1>
							    </div>
							 
					   	    </div>
				        </div>
							  
				   </div>
		        </div>

   			</div>
   			<?php } else { ?>


	   			 <div class="row page-header-no-bg" data-alignment="<?php echo (!empty($text_align)) ? $text_align : 'left' ; ?>">
			    	<div class="container">	
						<div class="col span_12 section-title">
							<span class="subheader"><?php echo wp_kses_post( $subtitle ); ?></span>
							<h1><?php echo wp_kses_post( $heading ); ?></h1>
						</div>
					</div>

				</div> 


   			<?php }
	    }
 
    }
}






if ( !function_exists( 'using_page_header' ) ) {
	function using_page_header($post_id){

		 global $post; 
		 global $woocommerce; 
		 global $republicpg_options;

		 $force_effect = null;

		 if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag()) {

		 	if( version_compare( $woocommerce->version, "3.0", ">=" ) ) {
				$header_title = get_post_meta(wc_get_page_id('shop'), '_republicpg_header_title', true);
				$header_bg = get_post_meta(wc_get_page_id('shop'), '_republicpg_header_bg', true);
				$header_bg_color = get_post_meta(wc_get_page_id('shop'), '_republicpg_header_bg_color', true);
				$bg_type = get_post_meta(wc_get_page_id('shop'), '_republicpg_slider_bg_type', true); 
				if(empty($bg_type)) $bg_type = 'image_bg'; 
				$disable_effect = get_post_meta(wc_get_page_id('shop'), '_disable_transparent_header', true);
				$force_effect = null;
			} else {
				$header_title = get_post_meta(woocommerce_get_page_id('shop'), '_republicpg_header_title', true);
				$header_bg = get_post_meta(woocommerce_get_page_id('shop'), '_republicpg_header_bg', true);
				$header_bg_color = get_post_meta(woocommerce_get_page_id('shop'), '_republicpg_header_bg_color', true);
				$bg_type = get_post_meta(woocommerce_get_page_id('shop'), '_republicpg_slider_bg_type', true); 
				if(empty($bg_type)) $bg_type = 'image_bg'; 
				$disable_effect = get_post_meta(woocommerce_get_page_id('shop'), '_disable_transparent_header', true);
				$force_effect = null;
			}

		 } 
		 else if(is_home()){
		 	$header_title = get_post_meta(get_option('page_for_posts'), '_republicpg_header_title', true);
			$header_bg = get_post_meta(get_option('page_for_posts'), '_republicpg_header_bg', true); 
			$header_bg_color = get_post_meta(get_option('page_for_posts'), '_republicpg_header_bg_color', true); 
			$bg_type = get_post_meta(get_option('page_for_posts'), '_republicpg_slider_bg_type', true); 
			if(empty($bg_type)) $bg_type = 'image_bg'; 
			$disable_effect = get_post_meta(get_option('page_for_posts'), '_disable_transparent_header', true);
			$force_effect = null;
		 }  

		 else if(!is_category() && !is_tag() && !is_date() & !is_author()) {
			$header_title = get_post_meta($post->ID, '_republicpg_header_title', true);
			$header_bg = get_post_meta($post->ID, '_republicpg_header_bg', true); 
			$header_bg_color = get_post_meta($post->ID, '_republicpg_header_bg_color', true); 
			$bg_type = get_post_meta($post->ID, '_republicpg_slider_bg_type', true); 
			if(empty($bg_type)) $bg_type = 'image_bg'; 
			$disable_effect = get_post_meta($post->ID, '_disable_transparent_header', true);
			$force_effect = get_post_meta($post->ID, '_force_transparent_header', true);
		 }

		//blog archives
		if(is_category() || is_tag() || is_date() || is_author()){
			$bg_type = null;
			$disable_effect = null;
			$archive_bg_img = ( isset($republicpg_options['blog_archive_bg_image']['id']) && !empty($republicpg_options['blog_archive_bg_image']['id']) ) ? republicpg_options_img($republicpg_options['blog_archive_bg_image']) : null;
			$t_id =  get_cat_ID( single_cat_title( '', false ) ) ;
			$terms =  get_option( "taxonomy_$t_id" );
			if(!empty($archive_bg_img) || !empty($terms['category_image'])) {
			     $force_effect = 'on';
			     $bg_type = 'image_bg';
			 }
		}

		$pattern = get_shortcode_regex();
		
		$using_applicable_shortcode = 0;
		
	    if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )  && array_key_exists( 0, $matches ))  {
	    	
			if($matches[0][0]){
				if( strpos($matches[0][0],'republicpg_slider') !== false && strpos($matches[0][0],'full_width="true"') !== false) {
					
					if(empty($header_title)) $using_applicable_shortcode = 1;
					
				} else {
					$using_applicable_shortcode = 0;
				}
			}
	    	
	    }
		
		//stop effect from WooCommerce single pages
		global $woocommerce; 
		if($woocommerce && is_product()) { $using_applicable_shortcode = 0; $header_bg = 0; $header_bg_color = 0; }

		//alternate header style
		global $republicpg_options;
		if(!empty($republicpg_options['blog_header_type']) && $republicpg_options['blog_header_type'] == 'fullscreen' && is_singular('post')) { $using_applicable_shortcode = 1; }

		//incase of search / tax / removing effect
		if(is_search() || $disable_effect == 'on') { $using_applicable_shortcode = 0; $header_bg = 0; $header_bg_color = 0; $bg_type = 'image_bg'; }

		$page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_republicpg_full_screen_rows', true) : '';
		//if forcing effect
		if($force_effect == 'on' && (!is_search() && !is_tax()) || $page_full_screen_rows == 'on' && (!is_search() && !is_tax()) ) { $using_applicable_shortcode = 1; }

		$the_verdict = (!empty($header_bg_color) || !empty($header_bg) || $bg_type == 'video_bg' || $bg_type == 'particle_bg' || $using_applicable_shortcode) ? true : false;
		
		//verify its not a portfolio archive
		if( is_tax('project-type') || is_tax('project-attributes') || is_404() ) { $the_verdict = false; } 
		
		//frontend editor when using fullscreen page rows
		$republicpg_using_VC_front_end_editor = (isset($_GET['vc_editable'])) ? sanitize_text_field($_GET['vc_editable']) : '';
		$republicpg_using_VC_front_end_editor = ($republicpg_using_VC_front_end_editor == 'true') ? true : false;

		if($republicpg_using_VC_front_end_editor && is_page() && (!is_search() && !is_tax()) ) {
			$the_verdict = false;
		}
		
		return $the_verdict;

	}
}






if ( !function_exists( 'using_republicpg_slider' ) ) {
	function using_republicpg_slider(){
		
		global $post; 
		global $woocommerce;
		
		if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag()) {
			if( version_compare( $woocommerce->version, "3.0", ">=" ) ) {
				$header_title = get_post_meta(wc_get_page_id('shop'), '_republicpg_header_title', true);
				$header_bg = get_post_meta(wc_get_page_id('shop'), '_republicpg_header_bg', true);
				$header_bg_color = get_post_meta(wc_get_page_id('shop'), '_republicpg_header_bg_color', true);
			} else {
				$header_title = get_post_meta(woocommerce_get_page_id('shop'), '_republicpg_header_title', true);
				$header_bg = get_post_meta(woocommerce_get_page_id('shop'), '_republicpg_header_bg', true);
				$header_bg_color = get_post_meta(woocommerce_get_page_id('shop'), '_republicpg_header_bg_color', true);
			}
		 } 
		 else if(is_home() || is_archive()){
		 	$header_title = get_post_meta(get_option('page_for_posts'), '_republicpg_header_title', true);
			$header_bg = get_post_meta(get_option('page_for_posts'), '_republicpg_header_bg', true); 
			$header_bg_color = get_post_meta(get_option('page_for_posts'), '_republicpg_header_bg_color', true); 
		 }  else {
			$header_title = get_post_meta($post->ID, '_republicpg_header_title', true);
			$header_bg = get_post_meta($post->ID, '_republicpg_header_bg', true); 
			$header_bg_color = get_post_meta($post->ID, '_republicpg_header_bg_color', true); 
		 }
		
		$pattern = get_shortcode_regex();
		$using_fullwidth_slider = 0;
		
		if ( preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )  && array_key_exists( 0, $matches ))  {
	    	
			if($matches[0][0]){
				
				if( strpos($matches[0][0],'republicpg_slider') !== false && strpos($matches[0][0],'full_width="true"') !== false 
				|| strpos($matches[0][0],' type="full_width_content"') !== false && strpos($matches[0][0],'republicpg_slider') !== false && strpos($matches[0][0],'[vc_column width="1/1"') !== false ) {
					
					$using_fullwidth_slider = 1;
					
				} else {
					
					$using_fullwidth_slider = 0;
					
				}
			}
	    	
	    }
		
		//incase of search
		if(is_search() || is_tax()) $using_fullwidth_slider = 0;

		//stop effect from WooCommerce single pages
		global $woocommerce; 
		if($woocommerce && is_product()) $using_fullwidth_slider = 0; 

		$the_verdict = (empty($header_title) && empty($header_bg) && empty($header_bg_color) && $using_fullwidth_slider) ? true : false;

		return $the_verdict;
	}
}





function republicpg_header_section_check($post_id){

	 global $post; 
	 global $woocommerce; 
	 global $republicpg_options;

	 if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag()) {
	 	return false;
	 }  

	 $header_bg = '';
	 $header_bg_color = '';
	 $bg_type = '';
	 $page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_republicpg_full_screen_rows', true) : '';
	 
	 
	 if(!is_category() && !is_tag() && !is_date() & !is_author()) {
		$header_bg = get_post_meta($post->ID, '_republicpg_header_bg', true); 
		$header_bg_color = get_post_meta($post->ID, '_republicpg_header_bg_color', true); 
		$bg_type = get_post_meta($post->ID, '_republicpg_slider_bg_type', true); 
		if(empty($bg_type)) $bg_type = 'image_bg'; 
	 }
	
	$header_auto_title = (!empty($republicpg_options['header-auto-title']) && $republicpg_options['header-auto-title'] == '1') ? true : false;
	
	$the_verdict = (!empty($header_bg_color) || !empty($header_bg) || $bg_type == 'video_bg' || $bg_type == 'particle_bg' || $page_full_screen_rows == 'on' || ($header_auto_title && is_page()) ) ? true : false;
	
	//verify its not a portfolio or other non applicable archive
	if( is_tax('project-type') || is_tax('project-attributes') || is_404() || is_search()) { $the_verdict = false; } 

	return $the_verdict;

}


