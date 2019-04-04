<?php
/**
 * Gutenberg helpers
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
// Gutenberg
// -----------------------------------------------------------------#
function republicpg_disable_gutenberg_on_cpts( $can_edit, $post_type ) {
	if ( $post_type == 'portfolio' || $post_type == 'republicpg_slider' || $post_type == 'home_slider' ) {
		$can_edit = false;
	}
	return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'republicpg_disable_gutenberg_on_cpts', 10, 2 );


add_action( 'after_setup_theme', 'republicpg_gutenberg_editor_fullwidth_support' );
function republicpg_gutenberg_editor_fullwidth_support() {
	add_theme_support(
		'gutenberg',
		array( 'wide-images' => true )
	);
}
