<?php
/**
 * Page related helpers
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


add_filter( 'the_password_form', 'republicpg_custom_password_form' );
function republicpg_custom_password_form() {
	global $post;
	$post   = get_post( $post );
	$label  = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p>' . __( 'This content is password protected. To view it please enter your password below:', 'default' ) . '</p>
	<p><label for="' . $label . '">' . __( 'Password:', 'default' ) . ' </label>  <input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'default' ) . '" /></p></form>';
	return $output;
}


if ( ! function_exists( 'current_page_url' ) ) {
	function current_page_url() {
		$pageURL = 'http';
		if ( isset( $_SERVER['HTTPS'] ) ) {
			if ( $_SERVER['HTTPS'] == 'on' ) {
				$pageURL .= 's';}
		}
		$pageURL .= '://';
		if ( $_SERVER['SERVER_PORT'] != '80' ) {
			$pageURL .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
		} else {
			$pageURL .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		}
		return $pageURL;
	}
}

$republicpg_using_VC_front_end_editor = (isset($_GET['vc_editable'])) ? sanitize_text_field($_GET['vc_editable']) : '';
$republicpg_using_VC_front_end_editor = ($republicpg_using_VC_front_end_editor == 'true') ? true : false;

function republicpg_get_full_page_options() {

	global $post;

	$page_full_screen_rows                  = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows', true ) : '';
	$page_full_screen_rows_animation        = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_animation', true ) : '';
	$page_full_screen_rows_animation_speed  = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_animation_speed', true ) : '';
	$page_full_screen_rows_anchors          = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_anchors', true ) : '';
	$page_full_screen_rows_dot_navigation   = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_dot_navigation', true ) : '';
	$page_full_screen_rows_footer           = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_footer', true ) : '';
	$page_full_screen_rows_content_overflow = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_content_overflow', true ) : '';
	$page_full_screen_rows_bg_img_animation = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_row_bg_animation', true ) : '';
	$page_full_screen_rows_mobile_disable   = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows_mobile_disable', true ) : '';

	global $republicpg_using_VC_front_end_editor;
	//on feditor certain values are forced
	if($republicpg_using_VC_front_end_editor) {
		$page_full_screen_rows_animation = 'none';
		$page_full_screen_rows_dot_navigation = 'tooltip_alt';
		$page_full_screen_rows_footer = 'none';
	}

	$republicpg_full_page_options = array(
		'page_full_screen_rows'                  => $page_full_screen_rows,
		'page_full_screen_rows_animation'        => $page_full_screen_rows_animation,
		'page_full_screen_rows_animation_speed'  => $page_full_screen_rows_animation_speed,
		'page_full_screen_rows_anchors'          => $page_full_screen_rows_anchors,
		'page_full_screen_rows_dot_navigation'   => $page_full_screen_rows_dot_navigation,
		'page_full_screen_rows_footer'           => $page_full_screen_rows_footer,
		'page_full_screen_rows_content_overflow' => $page_full_screen_rows_content_overflow,
		'page_full_screen_rows_bg_img_animation' => $page_full_screen_rows_bg_img_animation,
		'page_full_screen_rows_mobile_disable'   => $page_full_screen_rows_mobile_disable,
	);

	return $republicpg_full_page_options;
}





function republicpg_add_pfsr_bodyclass(){

		$post_id = (int) vc_get_param( 'vc_post_id' );

		$page_full_screen_rows = (isset($post_id)) ? get_post_meta($post_id, '_republicpg_full_screen_rows', true) : '';
		if($page_full_screen_rows == 'on') {
			add_filter( 'body_class','republicpg_using_pfsr_editor_class' );
		}
}

function republicpg_using_pfsr_editor_class( $classes ) {

	 	$classes[] = 'republicpg_using_pfsr';
    return $classes;
}


if($republicpg_using_VC_front_end_editor) {
	republicpg_add_pfsr_bodyclass();
}



/**
 * Get Google Share count
 *
 * @deprecated since 8.0 - no longer used
 * @since 4.0
 */
if ( ! function_exists( 'GetGooglePlusShares' ) ) {
	function GetGooglePlusShares( $url ) {
		return 0;
	}
}
