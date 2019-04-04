<?php
/**
 * Blueprint search related functions
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'republicpg_add_ajax_to_search' ) ) {
	function republicpg_add_ajax_to_search() {

		global $republicpg_theme_skin;
		global $republicpg_options;

		$ajax_search  = ( ! empty( $republicpg_options['header-disable-ajax-search'] ) && $republicpg_options['header-disable-ajax-search'] == '1' ) ? 'no' : 'yes';
		$headerSearch = ( ! empty( $republicpg_options['header-disable-search'] ) && $republicpg_options['header-disable-search'] == '1' ) ? 'false' : 'true';

		if ( $ajax_search == 'yes' && $headerSearch != 'false' && $republicpg_theme_skin != 'material' ) {
			get_template_part( 'republicpg/assets/functions/ajax-search/wp-search-suggest' );
		}
	}
}
republicpg_add_ajax_to_search();


if ( ! function_exists( 'republicpg_change_wp_search_size' ) ) {
	function republicpg_change_wp_search_size( $query ) {
		if ( $query->is_search ) {
			$query->query_vars['posts_per_page'] = 12;
		}

		return $query;
	}
}
if ( ! is_admin() ) {
	add_filter( 'pre_get_posts', 'republicpg_change_wp_search_size' );
}
