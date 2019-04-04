<?php
/**
 * Blueprint widget areas and custom widgets
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}




function republicpg_register_widget_areas() {

	register_sidebar(
		array(
			'name'          => 'Blog Sidebar',
			'id'            => 'blog-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'Page Sidebar',
			'id'            => 'page-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'WooCommerce Sidebar',
			'id'            => 'woocommerce-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => 'Extra Sidebar',
			'id'            => 'republicpg-extra-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => 'Footer Area 1',
			'id'            => 'footer-area-1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	global $republicpg_options;
	$footer_columns           = ( ! empty( $republicpg_options['footer_columns'] ) ) ? $republicpg_options['footer_columns'] : '4';
	$copyright_footer_layout = ( ! empty( $republicpg_options['footer-copyright-layout'] ) ) ? $republicpg_options['footer-copyright-layout'] : 'default';

	if ( $footer_columns == '2' || $footer_columns == '3' || $footer_columns == '4' || $footer_columns == '5' ) {
		register_sidebar(
			array(
				'name'          => 'Footer Area 2',
				'id'            => 'footer-area-2',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>',
			)
		);
	}

	if ( $footer_columns == '3' || $footer_columns == '4' || $footer_columns == '5' ) {
		register_sidebar(
			array(
				'name'          => 'Footer Area 3',
				'id'            => 'footer-area-3',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>',
			)
		);
	}
	if ( $footer_columns == '4' || $footer_columns == '5' ) {
		register_sidebar(
			array(
				'name'          => 'Footer Area 4',
				'id'            => 'footer-area-4',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>',
			)
		);
	}

	$side_widget_area = ( ! empty( $republicpg_options['header-slide-out-widget-area'] ) ) ? $republicpg_options['header-slide-out-widget-area'] : 'off';
	if ( $side_widget_area == '1' ) {
		register_sidebar(
			array(
				'name'          => 'Off Canvas Menu',
				'id'            => 'slide-out-widget-area',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>',
			)
		);
	}

	if ( $copyright_footer_layout == 'centered' || $footer_columns == '1' ) {
		register_sidebar(
			array(
				'name'          => 'Footer Copyright',
				'id'            => 'footer-area-copyright',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4>',
				'after_title'   => '</h4>',
			)
		);
	}

}

add_action( 'widgets_init', 'republicpg_register_widget_areas' );






// Recent Posts Extra
get_template_part( 'includes/custom-widgets/recent-posts-extra-widget' );

// Recent portfolio items
get_template_part( 'includes/custom-widgets/recent-projects-widget' );

// Recent portfolio items
get_template_part( 'includes/custom-widgets/popular-posts' );


function register_republicpg_popular_posts_widget() {
	register_widget( 'Republicpg_Popular_Posts' );
}
add_action( 'widgets_init', 'register_republicpg_popular_posts_widget' );


// allow shortcodes in text widget
add_filter( 'widget_text', 'do_shortcode' );
