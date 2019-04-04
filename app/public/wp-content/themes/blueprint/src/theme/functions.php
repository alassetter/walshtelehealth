<?php

// -----------------------------------------------------------------#
// Default theme constants
// -----------------------------------------------------------------#
define( 'REPUBLICPG_THEME_DIRECTORY', get_template_directory() );
define( 'REPUBLICPG_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/republicpg/' );
define( 'REPUBLICPG_THEME_NAME', 'blueprint' );


if ( ! function_exists( 'get_republicpg_theme_version' ) ) {
	function republicpg_get_theme_version() {
		return '10.0';
	}
}


// -----------------------------------------------------------------#
// Load text domain
// -----------------------------------------------------------------#
add_action( 'after_setup_theme', 'republicpg_lang_setup' );

if ( ! function_exists( 'republicpg_lang_setup' ) ) {
	function republicpg_lang_setup() {

		load_theme_textdomain( REPUBLICPG_THEME_NAME, get_template_directory() . '/lang' );

	}
}


// -----------------------------------------------------------------#
// Helper to grab Blueprint theme options
// -----------------------------------------------------------------#
function get_republicpg_theme_options() {

	$legacy_options  = get_option( 'blueprint' );
	$current_options = get_option( 'blueprint_redux' );

	if ( ! empty( $current_options ) ) {
		return $current_options;
	} elseif ( ! empty( $legacy_options ) ) {
		return $legacy_options;
	} else {
		return $current_options;
	}
}

$republicpg_options                    = get_republicpg_theme_options();
$republicpg_get_template_directory_uri = get_template_directory_uri();


// Default WP video size.
$content_width = 1080;


// -----------------------------------------------------------------#
// Register/Enqueue JS
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/enqueue-scripts.php';


// -----------------------------------------------------------------#
// Register/Enqueue CSS
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/enqueue-styles.php';


// -----------------------------------------------------------------#
// Dynamic Styles
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/dynamic-styles.php';


// Dynamic CSS to be loadded in head.
$republicpg_external_dynamic = ( ! empty( $republicpg_options['external-dynamic-css'] ) && $republicpg_options['external-dynamic-css'] == 1 ) ? 'on' : 'off';
if ( $republicpg_external_dynamic != 'on' ) {

	add_action( 'wp_head', 'republicpg_colors_css_output' );
	add_action( 'wp_head', 'republicpg_custom_css_output' );
	add_action( 'wp_head', 'republicpg_fonts_output' );

}

// Dynamic CSS to be enqueued in a file.
else {
	add_action( 'wp_enqueue_scripts', 'republicpg_enqueue_dynamic_css' );
}


// -----------------------------------------------------------------#
// Category Custom Meta
// -----------------------------------------------------------------#
require 'republicpg/meta/category-meta.php';


// -----------------------------------------------------------------#
// Image sizes
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/media.php';


// -----------------------------------------------------------------#
// Navigation menu locations and custom fields
// -----------------------------------------------------------------#
require_once 'republicpg/assets/functions/wp-menu-custom-items/menu-item-custom-fields.php';

require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/nav-menus.php';


// -----------------------------------------------------------------#
// TGM
// -----------------------------------------------------------------#
$republicpg_disable_tgm = ( ! empty( $republicpg_options['disable_tgm'] ) && $republicpg_options['disable_tgm'] == '1' ) ? true : false;

if ( ! $republicpg_disable_tgm ) {
	require_once 'republicpg/tgm-plugin-activation/class-tgm-plugin-activation.php';
	require_once 'republicpg/tgm-plugin-activation/required_plugins.php';
}


// -----------------------------------------------------------------#
// Republicpg WPBakery Page Builder
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/wpbakery-init.php';


// -----------------------------------------------------------------#
// Theme Skin
// -----------------------------------------------------------------#
$republicpg_theme_skin    = ( ! empty( $republicpg_options['theme-skin'] ) ) ? $republicpg_options['theme-skin'] : 'original';
$republicpg_header_format = ( ! empty( $republicpg_options['header_format'] ) ) ? $republicpg_options['header_format'] : 'default';

if ( $republicpg_header_format == 'centered-menu-bottom-bar' ) {
	$republicpg_theme_skin = 'material';
}

add_filter( 'body_class', 'republicpg_theme_skin_class' );

function republicpg_theme_skin_class( $classes ) {
	global $republicpg_theme_skin;
	$classes[] = $republicpg_theme_skin;
	return $classes;
}


function republicpg_theme_skin_css() {
	global $republicpg_theme_skin;
	wp_enqueue_style( 'skin-' . $republicpg_theme_skin );
}

add_action( 'wp_enqueue_scripts', 'republicpg_theme_skin_css' );


// -----------------------------------------------------------------#
// Search
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/search.php';


// -----------------------------------------------------------------#
// General WP
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/wp-general.php';


// -----------------------------------------------------------------#
// Widget areas and custom widgets
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/widgets.php';


// -----------------------------------------------------------------#
// Header
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/header.php';


// -----------------------------------------------------------------#
// Blog
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/blog.php';


// -----------------------------------------------------------------#
// Portfolio
// -----------------------------------------------------------------#
// require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/portfolio.php';


// -----------------------------------------------------------------#
// Page
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/page.php';


// -----------------------------------------------------------------#
// Options panel
// -----------------------------------------------------------------#
define( 'CNKT_INSTALLER_PATH', REPUBLICPG_FRAMEWORK_DIRECTORY . 'redux-framework/extensions/wbc_importer/wbc_importer/connekt-plugin-installer/' );

$using_republicpg_redux_framework = false;

if ( ! class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/republicpg/redux-framework/ReduxCore/framework.php' ) ) {
	require_once dirname( __FILE__ ) . '/republicpg/redux-framework/ReduxCore/framework.php';
	$using_republicpg_redux_framework = true;
}
if ( ! isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/republicpg/redux-framework/options-config.php' ) ) {
	require_once dirname( __FILE__ ) . '/republicpg/redux-framework/options-config.php';
}

require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/redux-blueprint.php';

// -----------------------------------------------------------------#
// Republicpg love
// -----------------------------------------------------------------#
require_once 'republicpg/love/republicpg-love.php';


// -----------------------------------------------------------------#
// Page meta
// -----------------------------------------------------------------#
require 'republicpg/meta/page-meta.php';

$republicpg_disable_home_slider   = ( ! empty( $republicpg_options['disable_home_slider_pt'] ) && $republicpg_options['disable_home_slider_pt'] == '1' ) ? true : false;
$republicpg_disable_republicpg_slider = ( ! empty( $republicpg_options['disable_republicpg_slider_pt'] ) && $republicpg_options['disable_republicpg_slider_pt'] == '1' ) ? true : false;


// -----------------------------------------------------------------#
// Home slider
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/home-slider.php';


if ( $republicpg_disable_home_slider != true ) {
	include 'republicpg/meta/home-slider-meta.php';
}


// -----------------------------------------------------------------#
// Republicpg Slider
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/republicpg-slider.php';


if ( $republicpg_disable_republicpg_slider != true ) {
	include 'republicpg/meta/republicpg-slider-meta.php';
}


// -----------------------------------------------------------------#
// WPML
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/wpml.php';

// -----------------------------------------------------------------#
// Gutenberg
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/gutenberg.php';


// -----------------------------------------------------------------#
// Shortcodes
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/shortcodes.php';


// -----------------------------------------------------------------#
// Portfolio Meta
// -----------------------------------------------------------------#
require 'republicpg/meta/portfolio-meta.php';


// -----------------------------------------------------------------#
// Post meta
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/admin-enqueue.php';


// Post meta core functions.
require 'republicpg/meta/meta-config.php';
require 'republicpg/meta/post-meta.php';


// -----------------------------------------------------------------#
// Pagination
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/pagination.php';


// -----------------------------------------------------------------#
// Page header
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/page-header.php';


// -----------------------------------------------------------------#
// Woocommerce
// -----------------------------------------------------------------#
// global $woocommerce;
//
// // admin notice for left over uneeded template files.
// if ( $woocommerce && is_admin() && file_exists( dirname( __FILE__ ) . '/woocommerce/cart/cart.php' ) ) {
// 	include 'republicpg/woo/admin-notices.php';
// }
//
// // load product quickview.
// $republicpg_quick_view_in_use = 'false';
// if ( $woocommerce ) {
// 	$republicpg_quick_view = ( ! empty( $republicpg_options['product_quick_view'] ) && $republicpg_options['product_quick_view'] == '1' ) ? true : false;
// 	if ( $republicpg_quick_view ) {
// 		$republicpg_quick_view_in_use = 'true';
// 		require_once 'republicpg/woo/quick-view.php';
// 	}
// }

// require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/woocommerce.php';


// -----------------------------------------------------------------#
// Open Graph
// -----------------------------------------------------------------#
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/open-graph.php';


#-----------------------------------------------------------------#
# Dashboard Tools
#-----------------------------------------------------------------#
//Admin Dashboard Tools
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/admin-menu-functions.php';
//SVG Support
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/svg-support.php';
//Clean Up Header
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/remove-header-items.php';
//Remove Comments
require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/remove-comments.php';


#-----------------------------------------------------------------#
# Add Custom Footer Menu
#-----------------------------------------------------------------#

require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/republicpg-footer-menu.php';


#-----------------------------------------------------------------#
# Custom Fonts To Redux Admin Panel
#-----------------------------------------------------------------#

require_once REPUBLICPG_THEME_DIRECTORY . '/republicpg/helpers/custom-fonts.php';


// Remove Elements From Visual Builder

// After VC Init
add_action( 'vc_after_init', 'vc_after_init_actions' );

function vc_after_init_actions() {

    // Remove VC Elements
    if( function_exists('vc_remove_element') ){

        // Remove VC Button Element
        vc_remove_element( 'vc_pie' );

        // Remove VC Separator Element
        vc_remove_element( 'vc_zigzag' );

				// Remove Gradient Text
				vc_remove_element( 'republicpg_gradient_text' );

				// Remove Milestone
				vc_remove_element( 'milestone' );

				// Remove Morphing Outline
				vc_remove_element( 'morphing_outline' );

				// Remove Social Buttons
				vc_remove_element( 'social_buttons' );

				// Remove Google Map
				vc_remove_element( 'republicpg_gmap' );

				// Remove Animated Title
				vc_remove_element( 'republicpg_animated_title' );

				// Remove Category Grid
				vc_remove_element( 'republicpg_category_grid' );

				// Remove Highlighted Text
				vc_remove_element( 'republicpg_highlighted_text' );

				// Remove Loading Bar
				vc_remove_element( 'bar' );

				// Remove Image Comparrison
				vc_remove_element( 'republicpg_image_comparison' );

    }

}

#-----------------------------------------------------------------#
# Enqueue Newer Page Specific Version of Jquery and Deregister older version
#-----------------------------------------------------------------#

// function custom_jquery() {
//
//   	wp_deregister_script('jquery');
//   	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');
//     wp_enqueue_script('jquery');
//
// }
// add_action('wp_enqueue_scripts', 'custom_jquery');
