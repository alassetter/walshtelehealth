<?php
/**
 * Shortcodes
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
// Shortcodes - have to load after taxonomy/post type declarations
// -----------------------------------------------------------------#

// utility function for republicpg shortcode generator conditional
if ( ! function_exists( 'republicpg_is_edit_page' ) ) {
	function republicpg_is_edit_page( $new_edit = null ) {
		global $pagenow;
		// make sure we are on the backend
		if ( ! is_admin() ) {
			return false; }

		if ( $new_edit == 'edit' ) {
			return in_array( $pagenow, array( 'post.php' ) );
		} elseif ( $new_edit == 'new' ) { // check for new post page
			return in_array( $pagenow, array( 'post-new.php' ) );
		} else { // check for either new or edit
			return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
		}
	}
}


// load republicpg shortcode button
function republicpg_shortcode_init() {

	require_once get_template_directory() . '/republicpg/tinymce/tinymce-class.php';

}


if ( is_admin() ) {
	if ( republicpg_is_edit_page() ) {

		add_action( 'init', 'republicpg_shortcode_init' );

	}
}

// Add button to page
add_action( 'media_buttons', 'republicpg_buttons', 100 );

function republicpg_buttons() {
	 echo "<a data-effect='mfp-zoom-in' class='button republicpg-shortcode-generator' href='#republicpg-sc-generator'><img src='" . get_template_directory_uri() . "/republicpg/assets/img/icons/n.png' /> " . esc_html__( 'Republicpg Shortcodes', 'blueprint' ) . '</a>';
}


// Shortcode Processing
if ( ! function_exists( 'republicpg_shortcode_processing' ) ) {
	function republicpg_shortcode_processing() {
		require_once get_template_directory() . '/republicpg/tinymce/shortcode-processing.php';
	}
}


add_action( 'init', 'republicpg_shortcode_processing' );
