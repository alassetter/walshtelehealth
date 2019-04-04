<?php
/**
 * Blueprint admin enqueue
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( ! function_exists( 'republicpg_enqueue_media' ) ) {

	function republicpg_enqueue_media() {

		// enqueue the correct media scripts for the media library
		if ( floatval( get_bloginfo( 'version' ) ) < '3.5' ) {
			wp_enqueue_script(
				'redux-opts-field-upload-js',
				ReduxFramework::$_url . 'inc/fields/upload/field_upload_3_4.js',
				array( 'jquery', 'thickbox', 'media-upload' ),
				'8.5.4',
				true
			);
			wp_enqueue_style( 'thickbox' );
		}

	}
}

// post meta styling
function republicpg_metabox_styles() {
	wp_enqueue_style( 'republicpg_meta_css', REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/css/republicpg_meta.css', '', '9.0.1' );
}

// post meta scripts
function republicpg_metabox_scripts() {
	wp_register_script( 'republicpg-upload', REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/js/republicpg-meta.js', array( 'jquery' ), '9.0.2' );
	wp_enqueue_script( 'republicpg-upload' );
	wp_localize_script( 'redux-opts-field-upload-js', 'redux_upload', array( 'url' => get_template_directory_uri() . '/republicpg/redux-framework/ReduxCore/inc/fields/upload/blank.png' ) );

	if ( floatval( get_bloginfo( 'version' ) ) >= '3.5' ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script(
			'redux-opts-field-upload-js',
			get_template_directory_uri() . '/republicpg/redux-framework/ReduxCore/inc/fields/upload/field_upload.js',
			array( 'jquery' ),
			'8.5.4',
			true
		);
		wp_enqueue_script(
			'redux-opts-field-color-js',
			REPUBLICPG_FRAMEWORK_DIRECTORY . 'options/fields/color/field_color.js',
			array( 'wp-color-picker' ),
			'8.0.1',
			true
		);
		 wp_enqueue_media();
	} else {

		wp_enqueue_script(
			'redux-opts-field-color-js',
			REPUBLICPG_FRAMEWORK_DIRECTORY . 'options/fields/color/field_color_farb.js',
			array( 'jquery', 'farbtastic' ),
			time(),
			true
		);

	}

}

add_action( 'admin_enqueue_scripts', 'republicpg_metabox_scripts' );
add_action( 'admin_print_styles', 'republicpg_metabox_styles' );
add_action( 'admin_print_styles', 'republicpg_enqueue_media' );
