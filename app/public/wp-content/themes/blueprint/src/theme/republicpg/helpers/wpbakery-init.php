<?php
/**
 * Blueprint WPBakery page builder initialization
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$republicpg_using_VC_front_end_editor = (isset($_GET['vc_editable'])) ? sanitize_text_field($_GET['vc_editable']) : '';
$republicpg_using_VC_front_end_editor = ($republicpg_using_VC_front_end_editor == 'true') ? true : false;

// Add Republicpg Functionality to WPBakery page builder
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) && defined( 'BLUEPRINT_VC_ACTIVE' ) ) {
	function add_republicpg_to_vc() {

		if ( version_compare( WPB_VC_VERSION, '4.9', '>=' ) ) {
			require_once locate_template( '/republicpg/republicpg-vc-addons/republicpg-addons.php' );
		} else {
			require_once locate_template( '/republicpg/republicpg-vc-addons/republicpg-addons-no-lean.php' );
		}
	}

	add_action( 'init', 'add_republicpg_to_vc', 5 );
	add_action( 'admin_enqueue_scripts', 'republicpg_vc_styles' );
	if($republicpg_using_VC_front_end_editor) {
		add_action( 'wp_enqueue_scripts', 'republicpg_frontend_vc_styles' );
	}

	function republicpg_vc_styles() {
		$republicpg_theme_version = republicpg_get_theme_version();
		global $republicpg_get_template_directory_uri;
		wp_enqueue_style( 'republicpg_vc', $republicpg_get_template_directory_uri . '/republicpg/republicpg-vc-addons/republicpg-addons.css', array(), $republicpg_theme_version, 'all' );
	}

	function republicpg_frontend_vc_styles() {
		$republicpg_theme_version = republicpg_get_theme_version();
		global $republicpg_get_template_directory_uri;
		wp_enqueue_style( 'republicpg_vc_frontend', $republicpg_get_template_directory_uri . '/republicpg/republicpg-vc-addons/republicpg-addons-frontend.css', array(), $republicpg_theme_version, 'all' );
	}

	function republicpg_vc_library_cat_list() {
		return array(

		);
	}

	if ( ! function_exists( 'add_blueprint_studio_to_vc' ) ) {
		function add_blueprint_studio_to_vc() {
			if ( is_admin() ) {
				require_once locate_template( '/republicpg/republicpg-vc-addons/blueprint-studio-templates.php' );
			}
		}
	}

	add_blueprint_studio_to_vc();


} elseif ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

	function republicpg_font_awesome() {
		global $republicpg_get_template_directory_uri;
		wp_enqueue_style( 'font-awesome', $republicpg_get_template_directory_uri . '/css/font-awesome.min.css' );
	}

	if ( ! is_admin() ) {
		add_action( 'init', 'republicpg_font_awesome', 99 );
	}
}
