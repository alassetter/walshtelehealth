<?php
/**
 * Redux theme options Blueprint helpers
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




// add republicpg redux styling/custom deps
function republicpg_redux_deps( $hook_suffix ) {
	global $using_republicpg_redux_framework;
	if ( strstr( $hook_suffix, 'Blueprint' ) || strstr( $hook_suffix, 'blueprint' ) ) {

		wp_enqueue_style( 'republicpg_redux_admin_style', get_template_directory_uri() . '/republicpg/redux-framework/ReduxCore/assets/css/blueprint-redux-styling.css', array(), '9.0.2', 'all' );

		if ( $using_republicpg_redux_framework == false ) {
			wp_enqueue_style( 'republicpg_redux_select_2', get_template_directory_uri() . '/republicpg/redux-framework/extensions/vendor_support/vendor/select2/select2.css', array(), time(), 'all' );
			wp_enqueue_script( 'republicpg_redux_ace', get_template_directory_uri() . '/republicpg/redux-framework/extensions/vendor_support/vendor/ace_editor/ace.js', array(), time(), 'all' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'republicpg_redux_deps' );




function republicpg_removeDemoModeLink() {
	if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks' ), null, 2 );
	}
	if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
	}
}




if ( ! function_exists( 'republicpg_update_woo_cat_thumb' ) ) {
	function republicpg_update_woo_cat_thumb( $cat_slug, $thumb_id ) {

			$n_woo_category    = get_term_by( 'slug', $cat_slug, 'product_cat' );
			$n_woo_category_id = ( $n_woo_category && isset( $n_woo_category->term_id ) ) ? $n_woo_category->term_id : false;
		if ( $n_woo_category_id ) {
			update_woocommerce_term_meta( $n_woo_category_id, 'thumbnail_id', $thumb_id );
		}

	}
}





if ( is_admin() ) {

	add_action( 'init', 'republicpg_removeDemoModeLink' );

	add_action( 'admin_menu', 'republicpg_remove_redux_menu', 12 );
	function republicpg_remove_redux_menu() {
		remove_submenu_page( 'tools.php', 'redux-about' );
	}

	if ( ! function_exists( 'republicpg_admin_lovelo_font' ) ) {
		function republicpg_admin_lovelo_font() {
			echo "
			<!-- A font fabric font - http://fontfabric.com/lovelo-font/ -->
			<style> @font-face { font-family: 'Lovelo'; src: url('" . get_template_directory_uri() . "/css/fonts/Lovelo_Black.eot'); src: url('" . get_template_directory_uri() . "/css/fonts/Lovelo_Black.eot?#iefix') format('embedded-opentype'), url('" . get_template_directory_uri() . "/css/fonts/Lovelo_Black.woff') format('woff'),  url('" . get_template_directory_uri() . "/css/fonts/Lovelo_Black.ttf') format('truetype'), url('" . get_template_directory_uri() . "/css/fonts/Lovelo_Black.svg#loveloblack') format('svg'); font-weight: normal; font-style: normal; } </style>";
		}
	}
	add_action( 'admin_head', 'republicpg_admin_lovelo_font' );

	/*alter demo importer tab top text*/
	if ( ! function_exists( 'republicpg_wbc_importer_description_text' ) ) {

		function republicpg_wbc_importer_description_text( $description ) {
			$message  = '<p>' . esc_html__( 'A note for users importing demos on an existing WordPress install: When the option is selected to import "Theme option settings", your current theme options will be overwritten.', 'blueprint' ) . '</p>';
			$message .= '<p>' . esc_html__( 'Ensure that you have all required plugins installed & activated for the demo you wish to import before confirming the import.', 'blueprint' ) . ' ' . esc_html__( 'For demos that require the WooCommerce plugin - do not forget to run the', 'blueprint' ) . ' <a href="' . esc_url( get_admin_url() ) . 'admin.php?page=wc-setup">' . esc_html( 'plugin setup wizard', 'blueprint' ) . '</a> ' . esc_html( 'before the demo import if you have not previously used the plugin on your site.', 'blueprint' ) . '</p>';
			$message .= '<p>' . esc_html__( 'See the', 'blueprint' ) . ' <a href="http://republicpg.com/docs/blueprint/importing-demo-content/" target="_blank">' . esc_html__( 'documentation', 'blueprint' ) . '</a> ' . esc_html__( 'if you run into trouble importing a demo.', 'blueprint' ) . '</p>';
			return $message;
		}
		add_filter( 'wbc_importer_description', 'republicpg_wbc_importer_description_text', 10 );
	}


	if ( ! function_exists( 'republicpg_after_ecommerce_demo_import' ) ) {

		function republicpg_after_ecommerce_demo_import( $demo_active_import, $demo_directory_path ) {

				global $woocommerce;

			if ( isset( $demo_directory_path ) && strpos( $demo_directory_path, 'Ecommerce-Ultimate' ) && $woocommerce ) {

				// update shop page page header
				$shop_page_id = wc_get_page_id( 'shop' );
				if ( $shop_page_id ) {

					update_post_meta( $shop_page_id, '_republicpg_header_bg_color', '#eaf0ff' );
					update_post_meta( $shop_page_id, '_republicpg_header_title', 'All Products' );
					update_post_meta( $shop_page_id, '_republicpg_header_font_color', '#000000' );
					update_post_meta( $shop_page_id, '_republicpg_header_subtitle', 'Affordable designer clothing with unmatched quality' );
					update_post_meta( $shop_page_id, '_republicpg_page_header_alignment', 'center' );
					update_post_meta( $shop_page_id, '_republicpg_header_bg_height', '230' );
					update_post_meta( $shop_page_id, '_disable_transparent_header', 'on' );
				}

				// update category thumbnails
				republicpg_update_woo_cat_thumb( 'accessories', 5688 );
				republicpg_update_woo_cat_thumb( 'basic-t-shirts', 17 );
				republicpg_update_woo_cat_thumb( 'casual-shirts', 29 );
				republicpg_update_woo_cat_thumb( 'fresh-clothing', 18 );
				republicpg_update_woo_cat_thumb( 'hipster-style', 41 );
				republicpg_update_woo_cat_thumb( 'outerwear', 38 );
				republicpg_update_woo_cat_thumb( 'sports-clothing', 5767 );

			} // end ecommerce ultimate

			elseif ( isset( $demo_directory_path ) && strpos( $demo_directory_path, 'Ecommerce-Creative' ) && $woocommerce ) {

				// update shop page page header
				$shop_page_id = wc_get_page_id( 'shop' );
				if ( $shop_page_id ) {
					update_post_meta( $shop_page_id, '_republicpg_header_title', 'The Shop' );
					update_post_meta( $shop_page_id, '_republicpg_header_subtitle', 'Affordable designer clothing with unmatched quality' );
					update_post_meta( $shop_page_id, '_republicpg_page_header_alignment', 'center' );
					update_post_meta( $shop_page_id, '_republicpg_header_bg_height', '400' );
					update_post_meta( $shop_page_id, '_republicpg_header_bg', 'http://republicpg.com/demo/blueprint-ecommerce-creative/wp-content/uploads/2018/08/adrian-sava-184378-unsplash.jpg' );
				}

				// update category thumbnails
				republicpg_update_woo_cat_thumb( 'basic-t-shirts', 3002 );
				republicpg_update_woo_cat_thumb( 'casual-shirts', 3004 );
				republicpg_update_woo_cat_thumb( 'cool-clothing', 3003 );
				republicpg_update_woo_cat_thumb( 'fresh-accessories', 3001 );
				republicpg_update_woo_cat_thumb( 'hipster-style', 2960 );
				republicpg_update_woo_cat_thumb( 'outerwear', 3060 );
				republicpg_update_woo_cat_thumb( 'sport-clothing', 2970 );

			} // end ecommerce creative

		} // main function end

	}


	add_action( 'wbc_importer_after_content_import', 'republicpg_after_ecommerce_demo_import', 10, 2 );

}
