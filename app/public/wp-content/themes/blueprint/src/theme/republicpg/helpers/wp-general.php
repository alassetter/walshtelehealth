<?php
/**
 * General setup functions
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




// -----------------------------------------------------------------#
// Add Theme Support
// -----------------------------------------------------------------#
function republicpg_add_theme_support() {
	add_theme_support( 'post-formats', array( 'quote', 'video', 'audio', 'gallery', 'link' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
}

add_action( 'after_setup_theme', 'republicpg_add_theme_support' );




// -----------------------------------------------------------------#
// Site Title
// -----------------------------------------------------------------#
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function republicpg_theme_slug_render_title() { ?>
			<title><?php wp_title( '|', true, 'right' ); ?></title> 
			<?php
	}
		add_action( 'wp_head', 'republicpg_theme_slug_render_title' );
}



// -----------------------------------------------------------------#
// Republicpg Hooks
// -----------------------------------------------------------------#
function republicpg_hook_after_body_open() {
	do_action( 'republicpg_hook_after_body_open' );
}

function republicpg_hook_before_body_close() {
	do_action( 'republicpg_hook_before_body_close' );
}

function republicpg_hook_pull_right_menu_items() {
	do_action( 'republicpg_hook_pull_right_menu_items' );
}

function republicpg_hook_secondary_header_menu_items() {
	do_action( 'republicpg_hook_secondary_header_menu_items' );
}

function republicpg_hook_before_footer_widget_area() {
	do_action( 'republicpg_hook_before_footer_widget_area' );
}

function republicpg_hook_after_footer_widget_area() {
	do_action( 'republicpg_hook_after_footer_widget_area' );
}

function republicpg_hook_ocm_bottom_meta() {
	do_action( 'republicpg_hook_ocm_bottom_meta' );
}




/**
 * Add iFrame to allowed wp_kses_post tags
 *
 * @param string $tags Allowed tags, attributes, and/or entities.
 * @param string $context Context to judge allowed tags by. Allowed values are 'post',
 *
 * @return mixed
 */
function republicpg_custom_wpkses_post_tags( $tags, $context ) {
	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);
	}
	return $tags;
}
add_filter( 'wp_kses_allowed_html', 'republicpg_custom_wpkses_post_tags', 10, 2 );




// -----------------------------------------------------------------#
// Remove Lazy Load Helper
// -----------------------------------------------------------------#
if ( ! function_exists( 'republicpg_remove_lazy_load_functionality' ) ) {
	function republicpg_remove_lazy_load_functionality( $attr ) {
		$attr['class'] .= ' skip-lazy';
		return $attr;
	}
}



// -----------------------------------------------------------------#
// Check for HTTPS
// -----------------------------------------------------------------#
$republicpg_is_ssl = is_ssl();

function republicpg_ssl_check( $src ) {

	global $republicpg_is_ssl;

	if ( strpos( $src, 'http://' ) !== false && $republicpg_is_ssl == true ) {
		$converted_start = str_replace( 'http://', 'https://', $src );
		return $converted_start;
	} else {
		return $src;
	}
}





// -----------------------------------------------------------------#
// If Using Ajaxify
// -----------------------------------------------------------------#
function republicpg_ajaxify_non_cached_scripts( $url ) {

	if ( false !== strpos( $url, 'vc_chart.js' ) ) {
		return "$url' class='always";
	}

	if ( false !== strpos( $url, 'ProgressCircle.js' ) ) {
		return "$url' class='always";
	}

	// not our file
	return $url;

}

global $republicpg_options;
if ( ! empty( $republicpg_options['ajax-page-loading'] ) && $republicpg_options['ajax-page-loading'] == '1' ) {
	add_filter( 'clean_url', 'republicpg_ajaxify_non_cached_scripts', 11, 1 );
}
