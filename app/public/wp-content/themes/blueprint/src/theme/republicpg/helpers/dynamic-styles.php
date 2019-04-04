<?php
/**
 * Dynamic CSS related helper functions
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Check if the first element on the page is a full width row to handle the top padding
 *
 * @since 9.0
 */
if (!function_exists('republicpg_top_padding_calc')) {
	
	function republicpg_top_padding_calc() {
		
			global $post;
			
			$pattern = get_shortcode_regex();
			
			if($post && isset($post->post_content) && (!is_single() && !is_archive()) ) {

						if ( preg_match( '/'. $pattern .'/s', $post->post_content, $matches ) && array_key_exists( 0, $matches ))  {

								if($matches[0]){
									
										if( strpos($matches[0],'vc_row type="full_width_background"') !== false || strpos($matches[0],'vc_row type="full_width_content"') !== false ) {
							 				$custom_css = 'html body[data-header-resize="1"] .container-wrap, html body[data-header-resize="0"] .container-wrap, body[data-header-format="left-header"][data-header-resize="0"] .container-wrap { padding-top: 0; }';
							 				wp_add_inline_style( 'main-styles', $custom_css );
										} //first shortcode is fullwidth
									
								}
							
						}

			} // verify not on single or archive
			
	} // end function
	
}

add_action( 'wp_enqueue_scripts', 'republicpg_top_padding_calc' );




/**
 * Generates the dynamic CSS that will be added into the head of pages when using the option "Move Dynamic/Custom CSS Into External Stylesheet"
 *
 * @since 6.0
 */
if (!function_exists('republicpg_page_specific_dynamic')) {
	function republicpg_page_specific_dynamic() {

		 ob_start(); 

		 ////page header
		 global $post;
		 global $republicpg_options;

		 $font_color = get_post_meta($post->ID, '_republicpg_header_font_color', true);
		 
		 $header_auto_title = (!empty($republicpg_options['header-auto-title']) && $republicpg_options['header-auto-title'] == '1') ? true : false;
		 $title = get_post_meta($post->ID, '_republicpg_header_title', true);
		 
		 if($header_auto_title && is_page() && empty($title)) {
			 if(empty($font_color)) { $font_color = (!empty($republicpg_options['overall-font-color'])) ? $republicpg_options['overall-font-color'] : '#333333'; }
		 }
		 
		 if(!empty($font_color) && !is_search()) {
			 echo '#page-header-bg h1, #page-header-bg .subheader,  .republicpg-box-roll .overlaid-content h1, .republicpg-box-roll .overlaid-content .subheader, .page-header-no-bg h1, body .section-title #portfolio-nav a:hover i, .page-header-no-bg span, #page-header-bg #portfolio-nav a i, #page-header-bg span { color: '. $font_color .'!important; } ';
			 echo 'body #page-header-bg a.pinterest-share i, body #page-header-bg a.facebook-share i, body #page-header-bg .twitter-share i, body #page-header-bg .google-plus-share i, 
		 	 body #page-header-bg .icon-blueprint-heart, body #page-header-bg .icon-blueprint-heart-2 { color: '. $font_color .'; }';
		 }   
		
		$theme_skin = ( !empty($republicpg_options['theme-skin']) ) ? $republicpg_options['theme-skin'] : 'original'; 
		$header_format = (!empty($republicpg_options['header_format'])) ? $republicpg_options['header_format'] : 'default';
		if($header_format == 'centered-menu-bottom-bar') { $theme_skin = 'material'; }
		
		$logo_height = (!empty($republicpg_options['use-logo']) && !empty($republicpg_options['logo-height'])) ? intval($republicpg_options['logo-height']) : 30;
		$header_padding = (!empty($republicpg_options['header-padding'])) ? intval($republicpg_options['header-padding']) : 28;
		$nav_font_size = (!empty($republicpg_options['use-custom-fonts']) && $republicpg_options['use-custom-fonts'] == 1 && !empty($republicpg_options['navigation_font_size']) && $republicpg_options['navigation_font_size'] != '-') ? intval(substr($republicpg_options['navigation_font_size'],0,-2) *1.4 ) : 20;
		$dd_indicator_height = (!empty($republicpg_options['use-custom-fonts']) && $republicpg_options['use-custom-fonts'] == 1 && !empty($republicpg_options['navigation_font_size']) && $republicpg_options['navigation_font_size'] != '-') ? intval(substr($republicpg_options['navigation_font_size'],0,-2)) -1 : 20;
		
		$padding_top = ceil(($logo_height/2)) - ceil(($nav_font_size/2));
		$padding_bottom = (ceil(($logo_height/2)) - ceil(($nav_font_size/2))) + $header_padding;
		
		$search_padding_top = ceil(($logo_height/2)) - ceil(21/2) +1;
		$search_padding_bottom =  (ceil(($logo_height/2)) - ceil(21/2));
		
		$using_secondary = (!empty($republicpg_options['header_layout'])) ? $republicpg_options['header_layout'] : ' ';
		
		
		if($theme_skin == 'material') {
			$extra_secondary_height = ($using_secondary == 'header_with_secondary') ? 40 : 0;
		} else {
			$extra_secondary_height = ($using_secondary == 'header_with_secondary') ? 32 : 0;
		}
		
		if($header_format == 'centered-menu-bottom-bar') {
		 	$header_space = $logo_height + ($header_padding*3) + $nav_font_size + $extra_secondary_height;
		}	
		else if($header_format == 'centered-menu-under-logo') {
		 	$header_space = $logo_height + ($header_padding*2) + 20 + $nav_font_size + $extra_secondary_height;
		}	
		else {
			 	$header_space = $logo_height + ($header_padding*2) + $extra_secondary_height;
		}
		
		
		
		//woo product title
		$wooSocial = ( !empty($republicpg_options['woo_social']) && $republicpg_options['woo_social'] == 1 ) ? '1' : '0';
		$wooSocialCount = 0;
		$wooProductTitlePadding = 0;
		
		if($wooSocial == '1') {
			if(!empty($republicpg_options['woo-facebook-sharing']) && $republicpg_options['woo-facebook-sharing'] == 1) $wooSocialCount++;
			if(!empty($republicpg_options['woo-twitter-sharing']) && $republicpg_options['woo-twitter-sharing'] == 1) $wooSocialCount++;
			if(!empty($republicpg_options['woo-pinterest-sharing']) && $republicpg_options['woo-pinterest-sharing'] == 1) $wooSocialCount++;
			if(!empty($republicpg_options['woo-google-plus-sharing']) && $republicpg_options['woo-google-plus-sharing'] == 1) $wooSocialCount++;
			if(!empty($republicpg_options['woo-linkedin-sharing']) && $republicpg_options['woo-linkedin-sharing'] == 1) $wooSocialCount++;

			$wooProductTitlePadding = ($wooSocialCount*52) + 50;
		}
	


		//hide scrollbar during loading if using fullpage option
		$page_full_screen_rows = (isset($post->ID)) ? get_post_meta($post->ID, '_republicpg_full_screen_rows', true) : '';
		if($page_full_screen_rows == 'on') {

			echo 'body,html  { overflow: hidden; height: 100%;}';
		}
		//body border
		$body_border = (!empty($republicpg_options['body-border'])) ? $republicpg_options['body-border'] : 'off';
		$body_border_size = (!empty($republicpg_options['body-border-size'])) ? $republicpg_options['body-border-size'] : '20';
		$body_border_color = (!empty($republicpg_options['body-border-color'])) ? $republicpg_options['body-border-color'] : '#ffffff';
		if($body_border == '1') {
			
			$headerColorScheme = (!empty($republicpg_options['header-color'])) ? $republicpg_options['header-color'] : 'light';
			$userSetBG = (!empty($republicpg_options['header-background-color']) && $headerColorScheme == 'custom') ? $republicpg_options['header-background-color'] : '#ffffff';
			$activate_transparency = using_page_header($post->ID);

			if(empty($republicpg_options['transparent-header'])) {
				$activate_transparency = 'false';
			}

			echo '@media only screen and (min-width: 1001px) { 

				.page-submenu > .full-width-section,
				.page-submenu .full-width-content,
				.full-width-content.blog-fullwidth-wrap,
				.wpb_row.full-width-content, 
				body .full-width-section .row-bg-wrap,
				body .full-width-section > .republicpg-shape-divider-wrap,
				body .full-width-section > .video-color-overlay,
				body[data-aie="zoom-out"] .first-section .row-bg-wrap, 
				body[data-aie="long-zoom-out"] .first-section .row-bg-wrap,
				body[data-aie="zoom-out"] .top-level.full-width-section .row-bg-wrap, 
				body[data-aie="long-zoom-out"] .top-level.full-width-section .row-bg-wrap,
				body .full-width-section.parallax_section .row-bg-wrap {
					margin-left: calc(-50vw + '. intval($body_border_size*2) .'px);
					left: calc(50% - '.$body_border_size.'px);
					width: calc(100vw - '. intval($body_border_size)*2 .'px);
				}';
				
				if($header_format == 'left-header') {
					echo '[data-header-format="left-header"] .full-width-content.blog-fullwidth-wrap,
					[data-header-format="left-header"] .wpb_row.full-width-content, 
					[data-header-format="left-header"] .page-submenu > .full-width-section,
					[data-header-format="left-header"] .page-submenu .full-width-content,
					[data-header-format="left-header"] .full-width-section .row-bg-wrap,
					[data-header-format="left-header"] .full-width-section > .republicpg-shape-divider-wrap,
					[data-header-format="left-header"] .full-width-section > .video-color-overlay,
					[data-header-format="left-header"][data-aie="zoom-out"] .first-section .row-bg-wrap, 
					[data-header-format="left-header"][data-aie="long-zoom-out"] .first-section .row-bg-wrap,
					[data-header-format="left-header"][data-aie="zoom-out"] .top-level.full-width-section .row-bg-wrap, 
					[data-header-format="left-header"][data-aie="long-zoom-out"] .top-level.full-width-section .row-bg-wrap,
					[data-header-format="left-header"] .full-width-section.parallax_section .row-bg-wrap,
					[data-header-format="left-header"] .republicpg-slider-wrap[data-full-width="true"] {
						margin-left: -'. (61 + intval($body_border_size)) .'px;
						width: calc(100% + '. (122 + intval($body_border_size)) .'px);
						left: 0;
					}
					[data-header-format="left-header"] .full-width-section > .republicpg-video-wrap {
						margin-left: -'. (61 + intval($body_border_size)) .'px;
						width: calc(100% + '. (122 + intval($body_border_size)) .'px)!important;
						left: 0;
					}';
			}
				
			echo 'body {padding-bottom: '.$body_border_size.'px; }
			.container-wrap { padding-right: '.$body_border_size.'px; padding-left: '.$body_border_size.'px; padding-bottom: '.$body_border_size.'px;} 
			 .midnightInner, #footer-outer[data-full-width="1"] { padding-right: '.$body_border_size.'px; padding-left: '.$body_border_size.'px; }
			 #slide-out-widget-area.fullscreen .bottom-text[data-has-desktop-social="false"], #slide-out-widget-area.fullscreen-alt .bottom-text[data-has-desktop-social="false"] {bottom: '. intval($body_border_size + 28) .'px;}
			#header-outer, body #header-outer-bg-only  {box-shadow: none; -webkit-box-shadow: none;} 
			 .slide-out-hover-icon-effect.small, .slide-out-hover-icon-effect:not(.small) {margin-top: '.$body_border_size.'px; margin-right: '.$body_border_size.'px;}
			 #slide-out-widget-area-bg.fullscreen-alt { padding: '.$body_border_size.'px;  }
			 #slide-out-widget-area.slide-out-from-right-hover {margin-right: '.$body_border_size.'px;}
			 .orbit-wrapper div.slider-nav span.left, .swiper-container .slider-prev { margin-left: '.$body_border_size.'px;} .orbit-wrapper div.slider-nav span.right, .swiper-container .slider-next { margin-right: '.$body_border_size.'px;}
			 .admin-bar #slide-out-widget-area-bg.fullscreen-alt { padding-top: '. intval($body_border_size+32) .'px;  }
			 #header-outer, body.ascend #search-outer, #header-secondary-outer, #slide-out-widget-area.slide-out-from-right, #slide-out-widget-area.fullscreen .bottom-text { margin-top: '.$body_border_size.'px; padding-right: '.$body_border_size.'px; padding-left: '.$body_border_size.'px; }
			 #republicpg_fullscreen_rows, body #slide-out-widget-area-bg:not(.fullscreen-alt) { margin-top: '.$body_border_size.'px; }
			body:not(.ascend):not(.material) .cart-menu-wrap .cart-menu , #slide-out-widget-area.fullscreen .off-canvas-social-links { padding-right: '.$body_border_size.'px!important; }
			.section-down-arrow, #slide-out-widget-area.fullscreen .off-canvas-social-links, #slide-out-widget-area.fullscreen .bottom-text { padding-bottom: '.$body_border_size.'px; } 
			.ascend #search-outer #search #close, body[data-smooth-scrolling="0"]:not(.material) #header-outer .widget_shopping_cart, #page-header-bg  .pagination-navigation { margin-right:  '.$body_border_size.'px; }
			#to-top { right: '. intval($body_border_size+17) .'px; margin-bottom: '.$body_border_size.'px; }
			body[data-dropdown-style="minimal"][data-header-color="light"] #header-outer:not(.transparent) .sf-menu > li > ul { border-top: none; }
			body:not(.ascend) #header-outer .cart-menu { background-color: '.$body_border_color.'; border-left: 1px solid rgba(0,0,0,0.1); }
			#fp-nav { padding-right: '.$body_border_size.'px; } .body-border-left {background-color: '.$body_border_color.'; width: '.$body_border_size.'px;} .body-border-right {background-color: '.$body_border_color.'; width: '.$body_border_size.'px;} .body-border-bottom { background-color: '.$body_border_color.'; height: '.$body_border_size.'px;} 
			.body-border-top {background-color: '.$body_border_color.'; height: '.$body_border_size.'px;} 
		} 
			@media only screen and (max-width: 1000px) { 
				.body-border-right, .body-border-left, .body-border-top, .body-border-bottom { display: none; } 
			}';
			
			if(($body_border_color == '#ffffff' && $headerColorScheme == 'light' || $headerColorScheme == 'custom' && $body_border_color == $userSetBG ) && $activate_transparency != 'true' ) {
				echo '#header-outer:not([data-using-secondary="1"]):not(.transparent),  body.ascend #search-outer, body[data-slide-out-widget-area-style="fullscreen-alt"] #header-outer:not([data-using-secondary="1"]) { margin-top: 0!important; } .body-border-top { z-index: 9997; } #slide-out-widget-area.slide-out-from-right { z-index: 9997;} 
				#republicpg_fullscreen_rows, body #slide-out-widget-area-bg { margin-top: 0px!important; }
				body #header-outer, body[data-slide-out-widget-area-style="slide-out-from-right-hover"] #header-outer { z-index: 9998; }
				
				@media only screen and (min-width: 1001px) {
					body[data-user-set-ocm="off"].material #header-outer[data-full-width="true"], body[data-user-set-ocm="off"].ascend #header-outer { z-index: 10010; }
				}
				
				#header-outer[data-full-width="true"]:not([data-transparent-header="true"]) header > .container, #header-outer[data-full-width="true"][data-transparent-header="true"].pseudo-data-transparent header > .container { padding-left: 0; padding-right: 0; }
				@media only screen and (max-width: 1080px) and (min-width: 1000px) {
					.ascend[data-slide-out-widget-area="true"] #header-outer[data-full-width="true"]:not([data-transparent-header="true"]) header > .container { padding-left: 0!important; padding-right: 0!important; }
				}
				body[data-header-search="false"][data-slide-out-widget-area="false"].ascend #header-outer[data-full-width="true"][data-cart="true"]:not([data-transparent-header="true"]) header > .container { padding-right: 28px; }

				body:not(.ascend):not(.material) #header-outer[data-full-width="true"] header#top nav > ul.product_added.buttons { padding-right: '.intval($body_border_size+80) .'px!important; }

				body.ascend[data-slide-out-widget-area="true"] #header-outer[data-full-width="true"] .cart-menu-wrap { right: '.intval($body_border_size+51) .'px!important; }

				body[data-slide-out-widget-area-style="slide-out-from-right"] #header-outer[data-header-resize="0"] {
					-ms-transition: transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1), background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), box-shadow 0.40s ease, margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important;
					-webkit-transition: -webkit-transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1), background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), box-shadow 0.40s ease, margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important;
					transition: transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1), background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), box-shadow 0.40s ease, margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important;
				}

				@media only screen and (min-width: 690px) { 
					body div.portfolio-items[data-gutter*="px"][data-col-num="elastic"] { padding: 0!important; }
				}

				body #header-outer[data-transparent-header="true"].transparent {  transition: none; -webkit-transition: none; }
				body[data-slide-out-widget-area-style="fullscreen-alt"] #header-outer { transition:  background-color 0.3s cubic-bezier(0.215,0.61,0.355,1); -webkit-transition:  background-color 0.3s cubic-bezier(0.215,0.61,0.355,1); }
				body.ascend[data-slide-out-widget-area="false"] #header-outer[data-header-resize="0"][data-cart="true"]:not(.transparent) { z-index: 100000; }
				';

			} else if($body_border_color == '#ffffff' && $headerColorScheme == 'light' || $headerColorScheme == 'custom' && $body_border_color == $userSetBG) {
			
				echo '#header-outer.small-nav:not(.transparent), #header-outer[data-header-resize="0"]:not([data-using-secondary="1"]).scrolled-down:not(.transparent), #header-outer.detached,  body.ascend #search-outer.small-nav, body[data-slide-out-widget-area-style="slide-out-from-right-hover"] #header-outer:not([data-using-secondary="1"]):not(.transparent), body[data-slide-out-widget-area-style="fullscreen-alt"] #header-outer:not([data-using-secondary="1"]).scrolled-down, body[data-slide-out-widget-area-style="fullscreen-alt"] #header-outer:not([data-using-secondary="1"]).transparent.side-widget-open { margin-top: 0px; z-index: 100000; }
				body.ascend[data-slide-out-widget-area="true"] #header-outer[data-full-width="true"].transparent:not(.small-nav) .cart-menu-wrap,
				body.ascend[data-slide-out-widget-area="true"] #header-outer[data-full-width="true"].scrolled-down .cart-menu-wrap { right: '.intval($body_border_size+80) .'px!important; }
				body.ascend[data-slide-out-widget-area="true"] #header-outer[data-full-width="true"] .cart-menu-wrap,
				body.ascend[data-slide-out-widget-area="false"] #header-outer[data-full-width="true"][data-cart="true"] .cart-menu-wrap { transition: right 0.3s cubic-bezier(0.215, 0.61, 0.355, 1); -webkit-transition: all 0.3s cubic-bezier(0.215, 0.61, 0.355, 1); }
				.ascend #header-outer.transparent .cart-menu-wrap {width: 130px;}
				body:not(.ascend):not(.material) #header-outer[data-full-width="true"] header#top nav > ul.product_added.buttons { padding-right: '.intval($body_border_size+80) .'px!important; }
				#header-outer[data-full-width="true"][data-transparent-header="true"][data-header-resize="0"].scrolled-down:not(.transparent) .container,
				body[data-slide-out-widget-area-style="fullscreen-alt"] #header-outer[data-full-width="true"].scrolled-down .container,
				body[data-slide-out-widget-area-style="fullscreen-alt"] #header-outer[data-full-width="true"].transparent.side-widget-open .container { padding-left: 0!important; padding-right: 0!important; }
				
				@media only screen and (min-width: 1001px) { 
					.material #header-outer[data-full-width="true"][data-transparent-header="true"][data-header-resize="0"].scrolled-down:not(.transparent) #search-outer .container {
						padding: 0 90px!important;
					}
				}
				
				body[data-header-search="false"][data-slide-out-widget-area="false"].ascend #header-outer[data-full-width="true"][data-cart="true"]:not(.transparent) header > .container { padding-right: 28px!important; }
				body.ascend[data-slide-out-widget-area="false"] #header-outer[data-full-width="true"][data-cart="true"].transparent .cart-menu-wrap { right: '.intval($body_border_size) .'px!important; }

				body.ascend[data-slide-out-widget-area="true"]:not([data-slide-out-widget-area-style="fullscreen"]):not([data-slide-out-widget-area-style="slide-out-from-right"]) #header-outer[data-full-width="true"][data-header-resize="0"].scrolled-down .cart-menu-wrap,
				body.ascend[data-slide-out-widget-area="true"][data-slide-out-widget-area-style="fullscreen"] #header-outer[data-full-width="true"][data-header-resize="0"].scrolled-down:not(.transparent) .cart-menu-wrap,
				body.ascend[data-slide-out-widget-area="true"][data-slide-out-widget-area-style="slide-out-from-right"] #header-outer[data-full-width="true"][data-header-resize="0"].scrolled-down:not(.transparent) .cart-menu-wrap,
				body[data-slide-out-widget-area-style="fullscreen-alt"].ascend #header-outer[data-full-width="true"].transparent.side-widget-open .cart-menu-wrap { right: '.intval($body_border_size+50) .'px!important; }
				
				@media only screen and (min-width: 690px) { 
					body div.portfolio-items[data-gutter*="px"][data-col-num="elastic"] { padding: 0!important; }
				}
				#header-outer[data-full-width="true"][data-header-resize="0"].transparent { -ms-transition: transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1),  background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important; transition: transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1),  background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important; -webkit-transition: -webkit-transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1),  background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important; }
				body #header-outer[data-transparent-header="true"][data-header-resize="0"] { -ms-transition: transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1), background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), box-shadow 0.40s ease, margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important; -webkit-transition: -webkit-transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1), background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), box-shadow 0.40s ease, margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important; transition: transform 0.7s cubic-bezier(0.645, 0.045, 0.355, 1), background-color 0.3s cubic-bezier(0.215,0.61,0.355,1), box-shadow 0.40s ease, margin 0.3s cubic-bezier(0.215,0.61,0.355,1)!important; }
				#header-outer[data-full-width="true"][data-header-resize="0"] header > .container { -ms-transition: padding 0.35s cubic-bezier(0.215,0.61,0.355,1); transition: padding 0.35s cubic-bezier(0.215,0.61,0.355,1); -webkit-transition: padding 0.35s cubic-bezier(0.215,0.61,0.355,1); }
				';

				$trans_header = (!empty($republicpg_options['transparent-header']) && $republicpg_options['transparent-header'] == '1') ? $republicpg_options['transparent-header'] : 'false';
				$bg_header = (!empty($post->ID) && $post->ID != 0) ? using_page_header($post->ID) : 0;
				$perm_trans = (!empty($republicpg_options['header-permanent-transparent']) && $trans_header != 'false' && $bg_header == 'true') ? $republicpg_options['header-permanent-transparent'] : 'false'; 
				
				if($perm_trans != '1') {
					echo '@media only screen and (max-width: 1000px) and (min-width: 690px) { 
					#header-outer,#republicpg_fullscreen_rows, body #slide-out-widget-area-bg { margin-top: 0!important; } 
					}';
				}

			} else if ($body_border_color != '#ffffff' && $headerColorScheme == 'light' ||  $headerColorScheme == 'custom' && $body_border_color != $userSetBG ) {
				echo '@media only screen and (min-width: 1001px) { #header-space { margin-top: '.$body_border_size.'px; } }';
				echo 'html body.ascend[data-user-set-ocm="off"] #header-outer[data-full-width="true"] .cart-outer[data-user-set-ocm="off"] .cart-menu-wrap { right: '.intval($body_border_size) .'px!important; }
				html body.ascend[data-user-set-ocm="1"] #header-outer[data-full-width="true"] .cart-outer[data-user-set-ocm="1"] .cart-menu-wrap { right: '.intval($body_border_size+77) .'px!important; }';
			}

		}


		 //// header transparent option
		if(!empty($republicpg_options['transparent-header']) && $republicpg_options['transparent-header'] == '1') {
			
			$activate_transparency = using_page_header($post->ID);

			if($activate_transparency) {
				
				//old IE versions
				echo '.no-rgba #header-space { display: none;  } ';
				
				echo '@media only screen and (min-width: 1000px) {
					
					 #header-space {
					 	 display: none; 
					 } 
					 .republicpg-slider-wrap.first-section, .parallax_slider_outer.first-section, .full-width-content.first-section, 
					 .parallax_slider_outer.first-section .swiper-slide .content, .republicpg-slider-wrap.first-section .swiper-slide .content, #page-header-bg, .nder-page-header, #page-header-wrap,
					 .full-width-section.first-section {
					 	 margin-top: 0!important;
					 }
					 
					 body #page-header-bg, body #page-header-wrap {
					 	height: '.$header_space.'px;
					 }
					 
					 body #search-outer { z-index: 100000; }

				 }';
				 
			} 
			
			else if(!empty($republicpg_options['header-bg-opacity'])) {
				$header_space_bg_color = (!empty($republicpg_options['overall-bg-color'])) ? $republicpg_options['overall-bg-color'] : '#ffffff';
				echo '#header-space { background-color: '.$header_space_bg_color.'}';
			}

		} //using transparent theme option
		
		
		$activate_transparency = using_page_header($post->ID);
		
		$header_extra_space_to_remove = $extra_secondary_height;
 	 
 	  if($header_format == 'centered-menu-under-logo' || $header_format == 'centered-menu-bottom-bar') {
 		  $header_extra_space_to_remove += 20;
 	  } else {
 		  $header_extra_space_to_remove += intval($header_padding);
 	  }
	 	
		/* desktop calcs for fullscreen headers/elements */
		if( (!empty($republicpg_options['transparent-header']) && $republicpg_options['transparent-header'] == '1' && $activate_transparency) || $header_format == 'left-header'){
				echo '@media only screen and (min-width: 1000px) {
				#page-header-wrap.fullscreen-header,
				#page-header-wrap.fullscreen-header #page-header-bg,
				html:not(.republicpg-box-roll-loaded) .republicpg-box-roll > #page-header-bg.fullscreen-header,
				.republicpg_fullscreen_zoom_recent_projects,
				#republicpg_fullscreen_rows:not(.afterLoaded) > div {
					height: 100vh;
				}
				
				.wpb_row.vc_row-o-full-height.top-level, .wpb_row.vc_row-o-full-height.top-level > .col.span_12 { min-height: 100vh; }';
				
				if(is_admin_bar_showing()) {
					echo '.admin-bar #page-header-wrap.fullscreen-header,
					.admin-bar #page-header-wrap.fullscreen-header #page-header-bg,
					.admin-bar .republicpg_fullscreen_zoom_recent_projects,
					.admin-bar #republicpg_fullscreen_rows:not(.afterLoaded) > div {
						height: calc(100vh - 32px);
					}
					.admin-bar .wpb_row.vc_row-o-full-height.top-level, .admin-bar .wpb_row.vc_row-o-full-height.top-level > .col.span_12 { min-height: calc(100vh - 32px); }';
				}
				
				if($header_format != 'left-header') {
					echo '#page-header-bg[data-alignment-v="middle"] .span_6 .inner-wrap,
					#page-header-bg[data-alignment-v="top"] .span_6 .inner-wrap {
						padding-top: '. (intval($header_space) - $header_extra_space_to_remove) .'px;
					}';
				}
					
				echo '.republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded), .republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded) .swiper-container {
					height: calc(100vh + 2px)!important;
				}
				.admin-bar .republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded), .admin-bar .republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded) .swiper-container {
					height: calc(100vh - 30px)!important;
				}

				
			}';
			
		} else {
			
			echo '@media only screen and (min-width: 1000px) {  
				body #ajax-content-wrap.no-scroll { min-height:  calc(100vh - '. ($header_space) .'px);	height: calc(100vh - '. ($header_space) .'px)!important; } 
			}';
			

			echo '@media only screen and (min-width: 1000px) { 
				#page-header-wrap.fullscreen-header,
				#page-header-wrap.fullscreen-header #page-header-bg,
				html:not(.republicpg-box-roll-loaded) .republicpg-box-roll > #page-header-bg.fullscreen-header,
				.republicpg_fullscreen_zoom_recent_projects,
				#republicpg_fullscreen_rows:not(.afterLoaded) > div {
					height: calc(100vh - '. ($header_space - 1) .'px);
				} 
				
				.wpb_row.vc_row-o-full-height.top-level, .wpb_row.vc_row-o-full-height.top-level > .col.span_12 { min-height: calc(100vh - '. ($header_space - 1) .'px); }
				
				html:not(.republicpg-box-roll-loaded) .republicpg-box-roll > #page-header-bg.fullscreen-header { top: '.$header_space.'px; }';
				
				if(is_admin_bar_showing()) {
					echo '.admin-bar #page-header-wrap.fullscreen-header,
					.admin-bar #page-header-wrap.fullscreen-header #page-header-bg,
					.admin-bar .republicpg_fullscreen_zoom_recent_projects,
					.admin-bar #republicpg_fullscreen_rows:not(.afterLoaded) > div {
						height: calc(100vh - '. ($header_space - 1) .'px - 32px);
					}
					.admin-bar .wpb_row.vc_row-o-full-height.top-level, .admin-bar .wpb_row.vc_row-o-full-height.top-level > .col.span_12 { min-height: calc(100vh - '. ($header_space - 1) .'px - 32px); }';
					
				}
				
				echo '.republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded), .republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded) .swiper-container {
					height: calc(100vh - '. ($header_space - 2) .'px)!important;
				} 
				
				.admin-bar .republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded), .admin-bar .republicpg-slider-wrap[data-fullscreen="true"]:not(.loaded) .swiper-container  {
					height: calc(100vh - '. ($header_space - 2) .'px - 32px)!important;
				}
		}';

   }
		
		
		
		

		global $woocommerce;

		if($woocommerce && $woocommerce->cart->cart_contents_count > 0 && !empty($republicpg_options['enable-cart']) && $republicpg_options['enable-cart'] == '1' && !empty($republicpg_options['header-fullwidth']) && $republicpg_options['header-fullwidth'] == '1') {
			echo '@media only screen and (min-width: 1080px) {
				body:not(.material) #header-outer[data-full-width="true"] header#top nav > ul.product_added.buttons {
			 	 padding-right: 80px!important; 
		        }
		        body:not(.ascend):not(.material) #header-outer[data-full-width="true"][data-remove-border="true"].transparent header#top nav > ul.product_added .slide-out-widget-area-toggle,
		        body:not(.ascend):not(.material) #header-outer[data-full-width="true"][data-remove-border="true"].side-widget-open header#top nav > ul.product_added .slide-out-widget-area-toggle {
		          margin-right: -20px!important; 
		    	}
		    }';
		} elseif($woocommerce && !empty($republicpg_options['enable-cart']) && $republicpg_options['enable-cart'] == '1' && !empty($republicpg_options['header-fullwidth']) && $republicpg_options['header-fullwidth'] == '1') {
			echo '@media only screen and (min-width: 1080px) {
				body:not(.material) #header-outer[data-full-width="true"] header#top nav > ul.product_added.buttons {
			 	 padding-right: 80px!important; 
		        }
		        body:not(.ascend):not(.material) #header-outer[data-full-width="true"][data-remove-border="true"].transparent header#top nav > ul.product_added .slide-out-widget-area-toggle,
		        body:not(.ascend):not(.material) #header-outer[data-full-width="true"][data-remove-border="true"].side-widget-open header#top nav > ul.product_added .slide-out-widget-area-toggle {
		          margin-right: -20px!important; 
		    	}
		    }';
		}

		if($woocommerce && !empty($republicpg_options['product_archive_bg_color'])) {
			echo '.post-type-archive-product.woocommerce .container-wrap, .tax-product_cat.woocommerce .container-wrap { background-color: '.$republicpg_options['product_archive_bg_color'].'; } ';
		}

		if($woocommerce && !empty($republicpg_options['product_bg_color'])) {
		 	echo '.woocommerce ul.products li.product.material, .woocommerce-page ul.products li.product.material { background-color: '.$republicpg_options['product_bg_color'].'; }';
		}
		
		if($woocommerce && !empty($republicpg_options['product_minimal_bg_color'])) {
		 echo '.woocommerce ul.products li.product.minimal .product-wrap, .woocommerce ul.products li.product.minimal .background-color-expand,
		 .woocommerce-page ul.products li.product.minimal .product-wrap, .woocommerce-page ul.products li.product.minimal .background-color-expand  { background-color: '.$republicpg_options['product_minimal_bg_color'].'; }';
		}

		if($woocommerce && !empty($republicpg_options['product_tab_position']) && $republicpg_options['product_tab_position'] == 'fullwidth') echo '
		 .woocommerce.single-product #single-meta { position: relative!important; top: 0!important; margin: 0; left: 8px; height: auto; } 
		 .woocommerce.single-product #single-meta:after { display: block; content: " "; clear: both; height: 1px;  } 
		 .woocommerce-tabs { margin-top: 40px; clear: both; }
		 @media only screen and (min-width: 1000px) {
			 .woocommerce #reviews #comments, .woocommerce #reviews #review_form_wrapper {  float: left; width: 47%; }
			 .woocommerce #reviews #comments { margin-right: 3%; width: 50%; } 
			 .ascend.woocommerce #respond { margin-top: 0px!important; }
			 .rtl.woocommerce #reviews #comments, .woocommerce #reviews #review_form_wrapper {  float: right;}
			 .rtl.woocommerce #reviews #comments { margin-left: 3%; margin-right: 0;}
			 .woocommerce .woocommerce-tabs > div { margin-top: 15px!important; }
			 .woocommerce #reviews #reply-title { margin-top: 5px!important; }
		 }';

		if($woocommerce && $woocommerce->cart->cart_contents_count > 0 && !empty($republicpg_options['enable-cart']) && $republicpg_options['enable-cart'] == '1') {
			echo '@media only screen and (min-width: 1080px) and (max-width: 1475px) {
			    header#top nav > ul.buttons {
				  padding-right: 20px!important; 
			    } 
				#boxed header#top nav > ul.product_added.buttons {
					padding-right: 0px!important; 
				}
				#search-outer #search #close a {
					right: 110px;
				}
			 }';
		}
		elseif($woocommerce && !empty($republicpg_options['enable-cart']) && $republicpg_options['enable-cart'] == '1') {
			echo '@media only screen and (min-width: 1080px) and (max-width: 1475px) {
			    header#top nav > ul.product_added {
				  padding-right: 20px!important; 
			    } 
				#boxed header#top nav > ul.product_added.buttons {
					padding-right: 0px!important; 
				}
				#search-outer #search #close a.product_added {
					right: 110px;
				}
			 }';
		 }

		 //boxed css
		if(!empty($republicpg_options['boxed_layout']) && $republicpg_options['boxed_layout'] == '1')  {
			
			$attachment = $republicpg_options["background-attachment"];
			$position = $republicpg_options["background-position"];
			$repeat = $republicpg_options["background-repeat"];
			$background_color = $republicpg_options["background-color"];
			
			echo 'body {
			 	background-image: url("'.republicpg_options_img($republicpg_options["background_image"]).'");
				background-position: '.$position.';
				background-repeat: '.$repeat.';
				background-color: '.$background_color.'!important;
				background-attachment: '.$attachment.';';
				if(!empty($republicpg_options["background-cover"]) && $republicpg_options["background-cover"] == '1') {
					echo 'background-size: cover;
					-moz-background-size: cover;
					-webkit-background-size: cover;
					-o-background-size: cover;';
				}
				
			 echo '}';
		}

		//blog next post coloring
		if(is_singular('post')){

			$next_post = get_previous_post();
			if (!empty( $next_post )) {
				$blog_next_bg_color = get_post_meta($next_post->ID, '_republicpg_header_bg_color', true);
				$blog_next_font_color = get_post_meta($next_post->ID, '_republicpg_header_font_color', true);
				if(!empty($blog_next_font_color)){
					echo '.blog_next_prev_buttons .col h3, .blog_next_prev_buttons span {  
						color: '.$blog_next_font_color.';
					}';
				}
				if(!empty($blog_next_bg_color)){
					echo '.blog_next_prev_buttons {  
						background-color: '.$blog_next_bg_color.';
					}';
				}
			}
		}


		$dynamic_css = ob_get_contents();
		ob_end_clean();

		return republicpg_quick_minify($dynamic_css);	

	}
}



/**
 * Quick minification function
 *
 * @since 6.0
 */
 
function republicpg_quick_minify( $css ) {

	$css = preg_replace( '/\s+/', ' ', $css );
	
	$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
	
	$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
	
	$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
	
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
	
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
	
	return trim( $css );

}


/**
 * Gets the color related dynamic css
 *
 * @since 9.0.2
 */
if (!function_exists('republicpg_colors_css_output')) {
	function republicpg_colors_css_output(){
		get_template_part('css/colors');
	}
}

/**
 * Gets the theme option related dynamic css
 *
 * @since 9.0.2
 */
if (!function_exists('republicpg_custom_css_output')) {
	function republicpg_custom_css_output(){
		get_template_part('css/custom');
	}
}

/**
 * Gets the font related dynamic css
 *
 * @since 9.0.2
 */
if (!function_exists('republicpg_fonts_output')) {
	function republicpg_fonts_output(){
		get_template_part('css/fonts');
	}
}




/**
 * Writes the dynamic CSS into a file
 * @since 6.0
 * @hooked redux/options/blueprint_redux/saved
 */
function republicpg_generate_options_css() {

	$republicpg_options = get_republicpg_theme_options(); 

	if(!empty($republicpg_options['external-dynamic-css']) && $republicpg_options['external-dynamic-css'] == 1){

		$css_dir = get_stylesheet_directory() . '/css/'; 
		ob_start(); // Capture all output (output buffering)

		//include css
		republicpg_colors_css_output();
		republicpg_custom_css_output();
		republicpg_fonts_output();

		$css = ob_get_clean(); // Get generated CSS (output buffering)
		
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		global $wp_filesystem;
		WP_Filesystem();
		
		$wp_filesystem->put_contents($css_dir . 'dynamic-combined.css', $css, FS_CHMOD_FILE);
		
		//file_put_contents($css_dir . 'dynamic-combined.css', $css, LOCK_EX); // Save it
		
	}
}



/**
 * Enqueue the dynamic CSS
 * @since 6.0
 */
function republicpg_enqueue_dynamic_css() {
	
	$republicpg_theme_version = republicpg_get_theme_version();
	
	wp_register_style('dynamic-css', get_stylesheet_directory_uri() . '/css/dynamic-combined.css', '', $republicpg_theme_version);
	wp_enqueue_style( 'dynamic-css');
	
	//handle page specific dynamic - as of v8.5.6
	$republicpg_page_specific_dynamic_css = republicpg_page_specific_dynamic();
	wp_add_inline_style( 'dynamic-css', $republicpg_page_specific_dynamic_css );
}


//loaded in head
$external_dynamic = (!empty($republicpg_options['external-dynamic-css']) && $republicpg_options['external-dynamic-css'] == 1) ? 'on' : 'off';
if($external_dynamic != 'on') {

	add_action('wp_head', 'republicpg_colors_css_output');
	add_action('wp_head', 'republicpg_custom_css_output');
	add_action('wp_head', 'republicpg_fonts_output'); 

} 
//written to static css file
else {
	add_action('wp_enqueue_scripts', 'republicpg_enqueue_dynamic_css');
}




/**
 * Adds Lovelo to font list
 * @since 4.0
 */
if( !function_exists('republicpg_lovelo_font')) {
	function republicpg_lovelo_font(){
		echo "
		<!-- A font fabric font - http://fontfabric.com/lovelo-font/ -->
		<style> @font-face { font-family: 'Lovelo'; src: url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.eot'); src: url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.eot?#iefix') format('embedded-opentype'), url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.woff') format('woff'),  url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.ttf') format('truetype'), url('".get_template_directory_uri()."/css/fonts/Lovelo_Black.svg#loveloblack') format('svg'); font-weight: normal; font-style: normal; } </style>";
	}
}

$font_fields = array('navigation_font_family','navigation_dropdown_font_family','page_heading_font_family','page_heading_subtitle_font_family','off_canvas_nav_font_family','off_canvas_nav_subtext_font_family','body_font_family','h1_font_family','h2_font_family','h3_font_family','h4_font_family','h5_font_family','h6_font_family','i_font_family','label_font_family','republicpg_slider_heading_font_family','home_slider_caption_font_family','testimonial_font_family','sidebar_footer_h_font_family','team_member_h_font_family','republicpg_dropcap_font_family');

foreach($font_fields as $k => $v){
	if(isset($republicpg_options[$v]['font-family']) && $republicpg_options[$v]['font-family'] == 'Lovelo, sans-serif') { 
		add_action('wp_head', 'republicpg_lovelo_font');
		break;
	}
}