<?php
/**
 * Enqueue scripts
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


function republicpg_register_js() {

	global $republicpg_options;
	global $post;
	global $republicpg_get_template_directory_uri;

	$republicpg_using_VC_front_end_editor = (isset($_GET['vc_editable'])) ? sanitize_text_field($_GET['vc_editable']) : '';
	$republicpg_using_VC_front_end_editor = ($republicpg_using_VC_front_end_editor == 'true') ? true : false;

	$republicpg_theme_version = republicpg_get_theme_version();

	if ( ! is_admin() ) {

		// Register
		wp_register_script( 'republicpg_priority', $republicpg_get_template_directory_uri . '/js/vendors/priority.js', 'jquery', $republicpg_theme_version, true );
		wp_register_script( 'modernizer', $republicpg_get_template_directory_uri . '/js/vendors/modernizr.js', 'jquery', '2.6.2', true );
		wp_register_script( 'imagesLoaded', $republicpg_get_template_directory_uri . '/js/vendors/imagesLoaded.min.js', 'jquery', '4.1.4', true );
		wp_register_script( 'respond', $republicpg_get_template_directory_uri . '/js/vendors/respond.js', 'jquery', '1.1', true );
		wp_register_script( 'superfish', $republicpg_get_template_directory_uri . '/js/vendors/superfish.js', 'jquery', '1.4.8', true );
		wp_register_script( 'respond', $republicpg_get_template_directory_uri . '/js/vendors/respond.js', 'jquery', '1.1', true );
		wp_register_script( 'touchswipe', $republicpg_get_template_directory_uri . '/js/vendors/touchswipe.min.js', 'jquery', '1.0', true );
		wp_register_script( 'flexslider', $republicpg_get_template_directory_uri . '/js/vendors/flexslider.min.js', array( 'jquery', 'touchswipe' ), '2.1', true );
		wp_register_script( 'orbit', $republicpg_get_template_directory_uri . '/js/vendors/orbit.js', 'jquery', '1.4', true );
		wp_register_script( 'flickity', $republicpg_get_template_directory_uri . '/js/vendors/flickity.min.js', 'jquery', '1.1.1', true );
		wp_register_script( 'nicescroll', $republicpg_get_template_directory_uri . '/js/vendors/nicescroll.js', 'jquery', '3.5.4', true );
		wp_register_script( 'magnific', $republicpg_get_template_directory_uri . '/js/vendors/magnific.js', 'jquery', '7.0.1', true );
		wp_register_script( 'fancyBox', $republicpg_get_template_directory_uri . '/js/vendors/jquery.fancybox.min.js', 'jquery', '7.0.1', true );
		wp_register_script( 'republicpg_parallax', $republicpg_get_template_directory_uri . '/js/vendors/parallax.js', 'jquery', '1.0', true );
		wp_register_script( 'isotope', $republicpg_get_template_directory_uri . '/js/vendors/isotope.min.js', 'jquery', '7.6', true );
		wp_register_script( 'select2', $republicpg_get_template_directory_uri . '/js/vendors/select2.min.js', 'jquery', '3.5.2', true );
		wp_register_script( 'republicpgSlider', $republicpg_get_template_directory_uri . '/js/vendors/republicpg-slider.js', 'jquery', $republicpg_theme_version, true );
		wp_register_script( 'republicpg_single_product', $republicpg_get_template_directory_uri . '/js/vendors/republicpg-single-product.js', 'jquery', $republicpg_theme_version, true );
		wp_register_script( 'fullPage', $republicpg_get_template_directory_uri . '/js/vendors/jquery.fullPage.min.js', 'jquery', $republicpg_theme_version, true );
		wp_register_script( 'vivus', $republicpg_get_template_directory_uri . '/js/vendors/vivus.min.js', 'jquery', '6.0.1', true );
		wp_register_script( 'republicpgParticles', $republicpg_get_template_directory_uri . '/js/vendors/republicpg-particles.js', 'jquery', $republicpg_theme_version, true );
		wp_register_script( 'ajaxify', $republicpg_get_template_directory_uri . '/js/vendors/ajaxify.js', 'jquery', $republicpg_theme_version, true );
		wp_register_script( 'caroufredsel', $republicpg_get_template_directory_uri . '/js/vendors/caroufredsel.min.js', array( 'jquery', 'touchswipe' ), '7.0.1', true );
		wp_register_script( 'owl_carousel', $republicpg_get_template_directory_uri . '/js/vendors/owl.carousel.min.js', 'jquery', '2.3.4', true );
		wp_register_script( 'leaflet', $republicpg_get_template_directory_uri . '/js/vendors/leaflet.js', 'jquery', '1.3.1', true );
		wp_register_script( 'republicpg_leaflet_map', $republicpg_get_template_directory_uri . '/js/vendors/republicpg-leaflet-map.js', 'jquery', $republicpg_theme_version, true );
		wp_register_script( 'twentytwenty', $republicpg_get_template_directory_uri . '/js/vendors/jquery.twentytwenty.js', 'jquery', '1.0', true );
		wp_register_script( 'infinite_scroll', $republicpg_get_template_directory_uri . '/js/vendors/infinitescroll.js', array( 'jquery' ), '1.1', true );
		wp_register_script( 'stickykit', $republicpg_get_template_directory_uri . '/js/vendors/stickkit.js', 'jquery', '1.0', true );
		wp_register_script( 'pixi', $republicpg_get_template_directory_uri . '/js/vendors/pixi.min.js', 'jquery', '4.5.1', true );

		if ( floatval( get_bloginfo( 'version' ) ) < '3.6' ) {
			wp_register_script( 'jplayer', $republicpg_get_template_directory_uri . '/js/vendors/jplayer.min.js', 'jquery', '2.1', true );
		}
		wp_register_script( 'republicpgFrontend', $republicpg_get_template_directory_uri . '/js/vendors/init.js', array( 'jquery', 'superfish' ), $republicpg_theme_version, true );

		// Dequeue
		$lightbox_script = ( ! empty( $republicpg_options['lightbox_script'] ) ) ? $republicpg_options['lightbox_script'] : 'magnific';
		if ( $lightbox_script == 'pretty_photo' ) {
			$lightbox_script = 'magnific'; }

		// Enqueue
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'republicpg_priority' );
		wp_enqueue_script( 'modernizer' );
		wp_enqueue_script( 'imagesLoaded' );

		// only load for IE8
		if ( preg_match( '/(?i)msie [2-8]/', $_SERVER['HTTP_USER_AGENT'] ) ) {
			wp_enqueue_script( 'respond' );
		}

		$portfolio_extra_content = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_portfolio_extra_content', true ) : '';
		$post_content            = ( isset( $post->post_content ) ) ? $post->post_content : '';

		if ( ! empty( $republicpg_options['portfolio_sidebar_follow'] ) && $republicpg_options['portfolio_sidebar_follow'] == '1' && is_singular( 'portfolio' ) ) {
			wp_enqueue_script( 'stickykit' ); }

		if ( $lightbox_script == 'magnific' ) {
			wp_enqueue_script( 'magnific' );
		} elseif ( $lightbox_script == 'fancybox' ) {
			wp_enqueue_script( 'fancyBox' );
		}

		if ( stripos( $post_content, 'republicpg_portfolio' ) !== false || stripos( $portfolio_extra_content, 'republicpg_portfolio' ) !== false ||
		   stripos( $post_content, 'vc_gallery type="image_grid"' ) !== false || stripos( $portfolio_extra_content, 'vc_gallery type="image_grid"' ) !== false ||
		   stripos( $post_content, "vc_gallery type='image_grid'" ) !== false || stripos( $portfolio_extra_content, "vc_gallery type='image_grid'" ) !== false ||
		   stripos( $post_content, 'type="image_grid"' ) !== false || stripos( $portfolio_extra_content, 'type="image_grid"' ) !== false ||
		   stripos( $post_content, "type='image_grid'" ) !== false || stripos( $portfolio_extra_content, "type='image_grid'" ) !== false ||
		   is_page_template( 'template-portfolio.php' ) || is_search() ) {

			 wp_enqueue_script( 'isotope' );
		}

		$page_full_screen_rows = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows', true ) : '';
		if ( $page_full_screen_rows == 'on' ) {
			wp_enqueue_script( 'fullPage' );
		}

		if ( stripos( $post_content, '[recent_projects' ) !== false || stripos( $portfolio_extra_content, '[recent_projects' ) !== false
		|| stripos( $post_content, '[carousel' ) !== false || stripos( $portfolio_extra_content, '[carousel' ) !== false
		|| stripos( $post_content, 'carousel="true"' ) !== false || stripos( $portfolio_extra_content, 'carousel="true"' ) !== false
		|| stripos( $post_content, 'carousel="1"' ) !== false || stripos( $portfolio_extra_content, 'carousel="1"' ) !== false
		|| is_page_template( 'template-home-1.php' ) ) {
			wp_enqueue_script( 'caroufredsel' );
		}

		if ( stripos( $post_content, 'script="owl_carousel"' ) !== false || stripos( $portfolio_extra_content, 'script="owl_carousel"' ) !== false ) {
			wp_enqueue_script( 'owl_carousel' );
		}

		$republicpg_theme_skin = ( ! empty( $republicpg_options['theme-skin'] ) ) ? $republicpg_options['theme-skin'] : 'original';
		$header_format     = ( ! empty( $republicpg_options['header_format'] ) ) ? $republicpg_options['header_format'] : 'default';
		if ( $header_format == 'centered-menu-bottom-bar' ) {
			$republicpg_theme_skin = 'material'; }

		if ( stripos( $post_content, 'bg_image_animation="displace-filter' ) !== false || stripos( $portfolio_extra_content, 'bg_image_animation="displace-filter' ) !== false ) {
			wp_enqueue_script( 'pixi' );
		}

		wp_enqueue_script( 'republicpgFrontend' );

		$bg_type = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_slider_bg_type', true ) : '';

		$transition_method = ( ! empty( $republicpg_options['transition-method'] ) ) ? $republicpg_options['transition-method'] : 'ajax';
		if ( ! empty( $republicpg_options['ajax-page-loading'] ) && $republicpg_options['ajax-page-loading'] == '1' && $transition_method == 'ajax' ) {
			wp_enqueue_script( 'republicpgSlider' );
			wp_enqueue_script( 'fullPage' );
			wp_enqueue_script( 'pixi' );
			wp_enqueue_script( 'ajaxify' );
		}

		if($republicpg_using_VC_front_end_editor) {
			//scripts that are possibly called through elements
			wp_enqueue_script('republicpgSlider');
			wp_enqueue_script('isotope');
			wp_enqueue_script('caroufredsel');
			wp_enqueue_script('vivus');
			wp_enqueue_script('touchswipe');
			wp_enqueue_script('flickity');
			wp_enqueue_script('flexslider');
			wp_enqueue_script('stickykit');
			wp_enqueue_script('vivus');
			wp_enqueue_script('twentytwenty');
			wp_enqueue_script('owl_carousel');
			wp_enqueue_script('leaflet');
	    wp_enqueue_script('republicpg_leaflet_map');
		}


	}
}

add_action( 'wp_enqueue_scripts', 'republicpg_register_js' );



function republicpg_page_specific_js() {

	global $post;
	global $republicpg_options;
	global $republicpg_get_template_directory_uri;

	if ( ! is_object( $post ) ) {
		$post = (object) array(
			'post_content' => ' ',
			'ID'           => ' ',
		);
	}
	$template_name = get_post_meta( $post->ID, '_wp_page_template', true );

	// home
	if ( is_page_template( 'template-home-1.php' ) || $template_name == 'blueprint/template-home-1.php' ||
		 is_page_template( 'template-home-2.php' ) || $template_name == 'blueprint/template-home-2.php' ||
		 is_page_template( 'template-home-3.php' ) || $template_name == 'blueprint/template-home-3.php' ||
		 is_page_template( 'template-home-4.php' ) || $template_name == 'blueprint/template-home-4.php' ) {
		wp_enqueue_script( 'orbit' );
		wp_enqueue_script( 'touchswipe' );
	}

	$portfolio_extra_content = get_post_meta( $post->ID, '_republicpg_portfolio_extra_content', true );
	$post_content            = $post->post_content;
	$posttype                = get_post_type( $post );

	/*********for page builder elements*/

	// infinite scroll
	if ( stripos( $post->post_content, 'pagination_type="infinite_scroll"' ) !== false || stripos( $portfolio_extra_content, 'pagination_type="infinite_scroll"' ) !== false ) {
		wp_enqueue_script( 'infinite_scroll' );
	}

	// gallery slider scripts
	if ( stripos( $post->post_content, '[republicpg_blog' ) !== false ||
	  stripos( $portfolio_extra_content, '[republicpg_blog' ) !== false ) {
			wp_enqueue_script( 'flickity' );
			wp_enqueue_script( 'flexslider' );
	}

	// stickkit
	if ( stripos( $post->post_content, '[republicpg_blog' ) !== false && stripos( $post->post_content, 'enable_ss="true"' ) !== false ||
	  stripos( $portfolio_extra_content, '[republicpg_blog' ) !== false && stripos( $portfolio_extra_content, 'enable_ss="true"' ) !== false ) {
		wp_enqueue_script( 'stickykit' );
	}

	// isotope
	if ( stripos( $post->post_content, '[republicpg_blog' ) !== false && stripos( $post->post_content, 'layout="masonry' ) !== false ||
		stripos( $post->post_content, '[republicpg_blog' ) !== false && stripos( $post->post_content, 'layout="std-blog-' ) !== false && stripos( $post->post_content, 'blog_standard_style="classic' ) !== false ||
		stripos( $post->post_content, '[republicpg_blog' ) !== false && stripos( $post->post_content, 'layout="std-blog-' ) !== false && stripos( $post->post_content, 'blog_standard_style="minimal' ) !== false ||
	  stripos( $portfolio_extra_content, '[republicpg_blog' ) !== false && stripos( $portfolio_extra_content, 'layout="masonry' ) !== false ) {
		wp_enqueue_script( 'isotope' );
	}

	/*********for archive pages based on theme options*/
	$republicpg_on_blog_archive_check      = ( is_archive() || is_author() || is_category() || is_home() || is_tag() ) && ( 'post' == $posttype && ! is_singular() );
	$republicpg_on_portfolio_archive_check = ( is_archive() || is_category() || is_home() || is_tag() ) && ( 'portfolio' == $posttype && ! is_singular() );

	// infinite scroll
	if ( ( ! empty( $republicpg_options['portfolio_pagination_type'] ) && $republicpg_options['portfolio_pagination_type'] == 'infinite_scroll' ) && $republicpg_on_portfolio_archive_check ||
			( ! empty( $republicpg_options['portfolio_pagination_type'] ) && $republicpg_options['portfolio_pagination_type'] == 'infinite_scroll' ) && is_page_template( 'template-portfolio.php' ) ||
			( ! empty( $republicpg_options['blog_pagination_type'] ) && $republicpg_options['blog_pagination_type'] == 'infinite_scroll' ) && $republicpg_on_blog_archive_check ) {
			wp_enqueue_script( 'infinite_scroll' );

		if ( class_exists( 'WPBakeryVisualComposerAbstract' ) && defined( 'BLUEPRINT_VC_ACTIVE' ) ) {
			wp_register_script( 'progressCircle', vc_asset_url( 'lib/bower/progress-circle/ProgressCircle.min.js' ) );
			wp_register_script( 'vc_pie', vc_asset_url( 'lib/vc_chart/jquery.vc_chart.min.js' ), array( 'jquery', 'progressCircle' ) );
		}
	}

	// sticky sidebar
	if ( ! empty( $republicpg_options['blog_enable_ss'] ) && $republicpg_options['blog_enable_ss'] == '1' && $republicpg_on_blog_archive_check ) {
		wp_enqueue_script( 'stickykit' );
	}

	// isotope
	$republicpg_blog_type          = ( ! empty( $republicpg_options['blog_type'] ) ) ? $republicpg_options['blog_type'] : 'masonry-blog-fullwidth';
	$republicpg_blog_std_style     = ( ! empty( $republicpg_options['blog_standard_type'] ) ) ? $republicpg_options['blog_standard_type'] : 'featured_img_left';
	$republicpg_blog_masonry_style = ( ! empty( $republicpg_options['blog_masonry_type'] ) ) ? $republicpg_options['blog_masonry_type'] : 'auto_meta_overlaid_spaced';

	if ( $republicpg_blog_type != 'std-blog-sidebar' && $republicpg_blog_type != 'std-blog-fullwidth' ) {
		if ( $republicpg_blog_masonry_style != 'auto_meta_overlaid_spaced' && $republicpg_on_blog_archive_check ) {
			wp_enqueue_script( 'isotope' );
		}
	}

	if ( $republicpg_on_portfolio_archive_check ) {
		wp_enqueue_script( 'isotope' ); }

	// gallery slider scripts
	if ( $republicpg_on_blog_archive_check ) {

		if ( $republicpg_blog_type == 'std-blog-sidebar' || $republicpg_blog_type == 'std-blog-fullwidth' ) {
			// std styles that could contain gallery sliders
			if ( $republicpg_blog_std_style == 'classic' || $republicpg_blog_std_style == 'minimal' ) {
				wp_enqueue_script( 'flickity' );
				wp_enqueue_script( 'flexslider' );
				wp_enqueue_script( 'isotope' );
			}
		} else {
			// masonry styles that could contain gallery sliders
			if ( $republicpg_blog_masonry_style != 'auto_meta_overlaid_spaced' ) {
				wp_enqueue_script( 'flickity' );
				wp_enqueue_script( 'flexslider' );
			}
		}
	}

	// single post sticky sidebar
	$enable_ss = ( ! empty( $republicpg_options['blog_enable_ss'] ) ) ? $republicpg_options['blog_enable_ss'] : 'false';

	if ( ( $enable_ss == '1' && is_single() && $posttype == 'post' ) ||
	  stripos( $post->post_content, '[vc_widget_sidebar' ) !== false || stripos( $portfolio_extra_content, '[vc_widget_sidebar' ) !== false ) {
		  wp_enqueue_script( 'stickykit' );
	}

	// republicpgSlider
	if ( stripos( $post_content, '[republicpg_slider' ) !== false || stripos( $portfolio_extra_content, '[republicpg_slider' ) !== false
	|| stripos( $post_content, 'type="republicpgslider_style"' ) !== false || stripos( $portfolio_extra_content, 'type="republicpgslider_style"' ) !== false ) {

		wp_enqueue_script( 'republicpgSlider' );
	}

	// touch swipe
	$box_roll = get_post_meta( $post->ID, '_republicpg_header_box_roll', true );
	wp_enqueue_script( 'touchswipe' );

	// flickity
	if ( stripos( $post_content, '[vc_gallery type="flickity"' ) !== false || stripos( $portfolio_extra_content, '[vc_gallery type="flickity"' ) !== false
	|| stripos( $post_content, 'style="multiple_visible"' ) !== false || stripos( $portfolio_extra_content, 'style="multiple_visible"' ) !== false
	|| stripos( $post_content, 'style="slider_multiple_visible"' ) !== false || stripos( $portfolio_extra_content, 'style="slider_multiple_visible"' ) !== false
	|| stripos( $post_content, 'script="flickity"' ) !== false || stripos( $portfolio_extra_content, 'script="flickity"' ) !== false
	|| stripos( $post_content, 'style="multiple_visible_minimal"' ) !== false || stripos( $portfolio_extra_content, 'style="multiple_visible_minimal"' ) !== false
	|| stripos( $post_content, 'style="slider"' ) !== false || stripos( $portfolio_extra_content, 'style="slider"' ) !== false ) {

		wp_enqueue_script( 'flickity' );
	}

	// fancy select
	$fancy_rcs = ( ! empty( $republicpg_options['form-fancy-select'] ) ) ? $republicpg_options['form-fancy-select'] : 'default';
	if ( $fancy_rcs == '1' ) {
		wp_enqueue_script( 'select2' );
	}

	// svg icon animation
	if ( strpos( $post_content, '.svg' ) !== false || strpos( $portfolio_extra_content, '.svg' ) !== false ) {
		wp_enqueue_script( 'vivus' );
	}

	// comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'republicpg_page_specific_js' );
