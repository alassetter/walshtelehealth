<?php
/**
 * Republicpg Slider helper functions
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


global $republicpg_options;

$republicpg_disable_republicpg_slider = ( ! empty( $republicpg_options['disable_republicpg_slider_pt'] ) && $republicpg_options['disable_republicpg_slider_pt'] == '1' ) ? true : false;


// -----------------------------------------------------------------#
// Create republicpg slider section
// -----------------------------------------------------------------#
function republicpg_slider_register() {

	$labels = array(
		'name'          => __( 'Slides', 'blueprint' ),
		'singular_name' => __( 'Slide', 'blueprint' ),
		'search_items'  => __( 'Search Slides', 'blueprint' ),
		'all_items'     => __( 'All Slides', 'blueprint' ),
		'parent_item'   => __( 'Parent Slide', 'blueprint' ),
		'edit_item'     => __( 'Edit Slide', 'blueprint' ),
		'update_item'   => __( 'Update Slide', 'blueprint' ),
		'add_new_item'  => __( 'Add New Slide', 'blueprint' ),
		'menu_name'     => __( 'Republicpg Slider', 'blueprint' ),
	);

	 $republicpgslider_menu_icon = ( floatval( get_bloginfo( 'version' ) ) >= '3.8' ) ? 'dashicons-star-empty' : REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/icons/republicpg-slider.png';

	 $args = array(
		 'labels'              => $labels,
		 'singular_label'      => esc_html__( 'Republicpg Slider', 'blueprint' ),
		 'public'              => false,
		 'show_ui'             => true,
		 'hierarchical'        => false,
		 'menu_position'       => 10,
		 'menu_icon'           => $republicpgslider_menu_icon,
		 'exclude_from_search' => true,
		 'supports'            => false,
	 );

	register_post_type( 'republicpg_slider', $args );
}


$slider_locations_labels = array(
	'name'          => __( 'Slider Locations', 'blueprint' ),
	'singular_name' => __( 'Slider Location', 'blueprint' ),
	'search_items'  => __( 'Search Slider Locations', 'blueprint' ),
	'all_items'     => __( 'All Slider Locations', 'blueprint' ),
	'edit_item'     => __( 'Edit Slider Location', 'blueprint' ),
	'update_item'   => __( 'Update Slider Location', 'blueprint' ),
	'add_new_item'  => __( 'Add New Slider Location', 'blueprint' ),
	'new_item_name' => __( 'New Slider Location', 'blueprint' ),
	'menu_name'     => __( 'Slider Locations', 'blueprint' ),
);

register_taxonomy(
	'slider-locations',
	array( 'republicpg_slider' ),
	array(
		'hierarchical' => true,
		'labels'       => $slider_locations_labels,
		'show_ui'      => true,
		'public'       => false,
		'query_var'    => true,
		'rewrite'      => array( 'slug' => 'slider-locations' ),
	)
);



if ( $republicpg_disable_republicpg_slider != true ) {
	add_action( 'init', 'republicpg_slider_register' );
}





if ( $republicpg_disable_republicpg_slider != true ) {
	add_filter( 'manage_edit-republicpg_slider_columns', 'edit_columns_republicpg_slider' );
}

function edit_columns_republicpg_slider( $columns ) {
	$column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
	$column_caption   = array( 'caption' => 'Caption' );
	$columns          = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
	$columns          = array_slice( $columns, 0, 2, true ) + $column_caption + array_slice( $columns, 2, null, true );
	return $columns;
}


if ( $republicpg_disable_republicpg_slider != true ) {
	add_action( 'manage_republicpg_slider_posts_custom_column', 'republicpg_slider_custom_columns', 10, 2 );
}

function republicpg_slider_custom_columns( $portfolio_columns, $post_id ) {

	switch ( $portfolio_columns ) {
		case 'thumbnail':
			$background_type = get_post_meta( $post_id, '_republicpg_slider_bg_type', true );
			if ( $background_type == 'image_bg' ) {

				$thumbnail = get_post_meta( $post_id, '_republicpg_slider_image', true );

				if ( ! empty( $thumbnail ) ) {
					echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
				} else {
					echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" /></a>' .
						 '<strong><a class="row-title" href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit">No image added yet</a></strong>';
				}
			} else {
				 $thumbnail = get_post_meta( $post_id, '_republicpg_slider_preview_image', true );

				if ( ! empty( $thumbnail ) ) {
					echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
				} else {
					echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-video-thumb.jpg" /></a>' .
						 '<strong><a class="row-title" href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit">No video preview image added yet</a></strong>';
				}
			}

			break;

		case 'caption':
			$caption = get_post_meta( $post_id, '_republicpg_slider_caption', true );
			$heading = get_post_meta( $post_id, '_republicpg_slider_heading', true );
			echo '<h2>' . wp_kses_post( $heading ) . '</h2><p>' . wp_kses_post( $caption ) . '</p>';
			break;

		default:
			break;
	}
}


if ( $republicpg_disable_republicpg_slider != true ) {
	add_action( 'admin_menu', 'republicpg_slider_ordering' );
}

function republicpg_slider_ordering() {
	add_submenu_page(
		'edit.php?post_type=republicpg_slider',
		'Order Slides',
		'Slide Ordering',
		'edit_pages',
		'republicpg-slide-order',
		'republicpg_slider_order_page'
	);
}

function republicpg_slider_order_page(){ ?>
	
	<div class="wrap" data-base-url="<?php echo esc_url( admin_url( 'edit.php?post_type=republicpg_slider&page=republicpg-slide-order' ) ); ?>">
		<h2><?php echo esc_html__( 'Sort Slides', 'blueprint' ); ?></h2>
		<p><?php echo esc_html__( 'Choose your slider location below and simply drag your slides up or down - they will automatically be saved in that order.', 'blueprint' ); ?></p>
		
	<?php

	( isset( $_GET['slider-location'] ) ) ? $location = sanitize_text_field( $_GET['slider-location'] ) : $location = false;
	$slides = new WP_Query(
		array(
			'post_type'        => 'republicpg_slider',
			'slider-locations' => $location,
			'posts_per_page'   => -1,
			'order'            => 'ASC',
			'orderby'          => 'menu_order',
		)
	);
	?>
	<?php if ( $slides->have_posts() ) : ?>
		
		<?php
		wp_nonce_field( basename( __FILE__ ), 'republicpg_meta_box_nonce' );
		echo '<div class="slider-locations">';
		global $typenow;
		$args       = array(
			'public'   => false,
			'_builtin' => false,
		);
		$post_types = get_post_types( $args );
		if ( in_array( $typenow, $post_types ) ) {
			$filters = get_object_taxonomies( $typenow );
			foreach ( $filters as $tax_slug ) {
				$tax_obj = get_taxonomy( $tax_slug );
				wp_dropdown_categories(
					array(
						'show_option_all' => 'Slider Locations',
						'taxonomy'        => $tax_slug,
						'name'            => $tax_obj->name,
						// 'orderby' => 'term_order',
						'selected'        => isset( $location ) ? $location : false,
						'hierarchical'    => $tax_obj->hierarchical,
						'show_count'      => false,
						'hide_empty'      => true,
					)
				);
			}
		}
		echo '</div>';
		if ( isset( $location ) && $location != false ) {
			?>
		
		<table class="wp-list-table widefat fixed posts" id="sortable-table">
			<thead>
				<tr>
					<th class="column-order"><?php echo esc_html__( 'Order', 'blueprint' ); ?></th>
					<th class="manage-column column-thumbnail"><?php echo esc_html__( 'Image', 'blueprint' ); ?></th>
					<th class="manage-column column-caption"><?php echo esc_html__( 'Caption', 'blueprint' ); ?></th>
				</tr>
			</thead>
			<tbody data-post-type="republicpg_slider">
			<?php
			while ( $slides->have_posts() ) :
				$slides->the_post();
				?>
				<tr id="post-<?php the_ID(); ?>">
					<td class="column-order"><img src="<?php echo REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/sortable.png'; ?>" alt="Move Icon" width="25" height="25" class="" /></td>
					<td class="thumbnail column-thumbnail">
						<?php
						global $post;
						$post_id = $post->ID;

						$background_type = get_post_meta( $post_id, '_republicpg_slider_bg_type', true );
						if ( $background_type == 'image_bg' ) {

							$thumbnail = get_post_meta( $post_id, '_republicpg_slider_image', true );

							if ( ! empty( $thumbnail ) ) {
								echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
							} else {
								echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" /></a>' .
									 '<strong><a class="row-title" href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit">No image added yet</a></strong>';
							}
						} else {
							 $thumbnail = get_post_meta( $post_id, '_republicpg_slider_preview_image', true );

							if ( ! empty( $thumbnail ) ) {
								echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
							} else {
								echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-video-thumb.jpg" /></a>' .
									 '<strong><a class="row-title" href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit">No video preview image added yet</a></strong>';
							}
						}
						?>
						
					</td>
					<td class="caption column-caption">
						<?php
						$caption = get_post_meta( $post->ID, '_republicpg_slider_caption', true );
						echo wp_kses_post( $caption );
						?>
					</td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			<tfoot>
				<tr>
					<th class="column-order"><?php echo esc_html__( 'Order', 'blueprint' ); ?></th>
					<th class="manage-column column-thumbnail"><?php echo esc_html__( 'Image', 'blueprint' ); ?></th>
					<th class="manage-column column-caption"><?php echo esc_html__( 'Caption', 'blueprint' ); ?></th>
				</tr>
			</tfoot>

		</table>
	<?php } ?>
	
	<?php else : ?>

		<p>No slides found, why not <a href="post-new.php?post_type=republicpg_slider">create one?</a></p>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	</div><!-- .wrap -->
	
	<?php
}


if ( $republicpg_disable_republicpg_slider != true ) {
	add_action( 'admin_enqueue_scripts', 'republicpg_slider_enqueue_scripts' );
}

function republicpg_slider_enqueue_scripts() {
	global $typenow;
	global $republicpg_get_template_directory_uri;
	if ( 'republicpg_slider' == $typenow ) {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'republicpg-reorder', REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/js/republicpg-reorder.js' );
	}

	wp_register_script( 'chosen', $republicpg_get_template_directory_uri . '/republicpg/tinymce/shortcode_generator/js/chosen/chosen.jquery.min.js', array( 'jquery' ), '8.0.1', true );
	wp_register_style( 'chosen', $republicpg_get_template_directory_uri . '/republicpg/tinymce/shortcode_generator/css/chosen/chosen.css', array(), '8.0.1', 'all' );

	wp_enqueue_style( 'chosen' );
	wp_enqueue_script( 'chosen' );

}


if ( $republicpg_disable_republicpg_slider != true ) {
	add_action( 'wp_ajax_republicpg_update_slide_order', 'republicpg_slider_update_order' );
}

// slide order ajax callback
function republicpg_slider_update_order() {

		global $wpdb;

		$post_type = sanitize_text_field( $_POST['postType'] );
		$order     = $_POST['order'];

	if ( ! isset( $_POST['republicpg_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['republicpg_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	foreach ( $order as $menu_order => $post_id ) {
		$post_id    = intval( str_ireplace( 'post-', '', $post_id ) );
		$menu_order = intval( $menu_order );

		wp_update_post(
			array(
				'ID'         => stripslashes( htmlspecialchars( $post_id ) ),
				'menu_order' => stripslashes( htmlspecialchars( $menu_order ) ),
			)
		);
	}

		die( '1' );
}


// order the default republicpg slider page correctly
function set_republicpg_slider_admin_order( $wp_query ) {

	$post_type = ( isset( $wp_query->query['post_type'] ) ) ? $wp_query->query['post_type'] : '';

	if ( $post_type == 'republicpg_slider' ) {

		$wp_query->set( 'orderby', 'menu_order' );
		$wp_query->set( 'order', 'ASC' );
	}

}

if ( is_admin() && $republicpg_disable_republicpg_slider != true ) {
	add_filter( 'pre_get_posts', 'set_republicpg_slider_admin_order' );
}


function republicpg_my_restrict_manage_posts() {
	global $typenow;
	$args       = array(
		'public'   => false,
		'_builtin' => false,
	);
	$post_types = get_post_types( $args );
	if ( in_array( $typenow, $post_types ) ) {

		$filters = get_object_taxonomies( $typenow );
		if ( $typenow != 'product' ) {
			foreach ( $filters as $tax_slug ) {
				$tax_obj = get_taxonomy( $tax_slug );
				wp_dropdown_categories(
					array(
						'show_option_all' => esc_html__( 'Show All ', 'blueprint' ) . $tax_obj->label,
						'taxonomy'        => $tax_slug,
						'name'            => $tax_obj->name,
						// 'orderby' => 'term_order',
						'selected'        => isset( $_GET[ $tax_obj->query_var ] ) ? $_GET[ $tax_obj->query_var ] : false,
						'hierarchical'    => $tax_obj->hierarchical,
						'show_count'      => false,
						'hide_empty'      => true,
					)
				);
			}
		}
	}
}
function republicpg_my_convert_restrict( $query ) {
	global $pagenow;
	global $typenow;
	if ( $pagenow == 'edit.php' ) {
		$filters = get_object_taxonomies( $typenow );
		foreach ( $filters as $tax_slug ) {
			$var = &$query->query_vars[ $tax_slug ];
			if ( isset( $var ) ) {
				$term = get_term_by( 'id', $var, $tax_slug );
				if ( $term ) {
					$var = $term->slug; }
			}
		}
	}
}

if ( $republicpg_disable_republicpg_slider != true && is_admin() ) {
	add_action( 'restrict_manage_posts', 'republicpg_my_restrict_manage_posts' );
	add_filter( 'parse_query', 'republicpg_my_convert_restrict' );
}






// -----------------------------------------------------------------#
// Republicpg slider display
// -----------------------------------------------------------------#
$real_fs = 0;


if ( ! function_exists( 'republicpg_slider_display' ) ) {

	function republicpg_slider_display( $config_arr ) {
		 global $republicpg_disable_republicpg_slider;

		if ( $republicpg_disable_republicpg_slider == true ) {
			echo esc_html__( 'Republicpg Slider Post Type Disabled - please reanble in the Blueprint options panel > General Settings > Toggle Theme Features tab.', 'blueprint' );
			return false;
		}
		
		//no location supplied.
		if( empty($config_arr['location']) ) {
			return false;
		}
		 global $post;
		 global $republicpg_options;
		 global $real_fs;

		$midnight_parallax = null;
		$midnight_regular   = null;

		 $boxed = ( ! empty( $republicpg_options['boxed_layout'] ) && $republicpg_options['boxed_layout'] == '1' ) ? '1' : '0';
		if ( $config_arr['full_width'] == 'true' && $boxed != '1' ) {
			$fullwidth = 'true'; } elseif ( $config_arr['full_width'] == 'true' && $boxed == '1' ) {
			$fullwidth = 'boxed-full-width'; } else {
				$fullwidth = 'false'; 
			}

			$dynamic_height_style_markup = '';

			if ( ! empty( $config_arr['min_slider_height'] ) || ! empty( $config_arr['flexible_slider_height'] ) && $config_arr['flexible_slider_height'] == 'true' ) {
				$dynamic_height_style_markup .= 'style="';
			}
			// min height
			$dynamic_height_style_markup .= ( ! empty( $config_arr['min_slider_height'] ) ) ? 'min-height: ' . $config_arr['min_slider_height'] . 'px; ' : '';

			// flexible height
			if ( ! empty( $config_arr['flexible_slider_height'] ) && $config_arr['flexible_slider_height'] == 'true' && $fullwidth == 'true' && $config_arr['fullscreen'] != 'true' ) {
				$dynamic_height_style_markup .= ( ! empty( $config_arr['slider_height'] ) ) ? 'height: calc( ' . intval( $config_arr['slider_height'] ) . ' * 100vw / 1600 );' : '';
			}

			if ( ! empty( $config_arr['min_slider_height'] ) || ! empty( $config_arr['flexible_slider_height'] ) && $config_arr['flexible_slider_height'] == 'true' ) {
				$dynamic_height_style_markup .= '"';
			}

			// disable parallax for full page
			$page_full_screen_rows = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows', true ) : '';
			if ( $page_full_screen_rows == 'on' ) {
				$config_arr['parallax'] = 'false';
			}

			$animate_in_effect = ( ! empty( $republicpg_options['header-animate-in-effect'] ) ) ? $republicpg_options['header-animate-in-effect'] : 'none';

			// adding parallax wrapper if selected
			if ( $config_arr['parallax'] == 'true' ) {

				if ( stripos( $post->post_content, '[republicpg_slider' ) !== false && stripos( $post->post_content, '[republicpg_slider' ) === 0 && $real_fs == 0 ) {
					$first_section = '';
					$real_fs       = 1;
				} else {
					$first_section = '';
				}

				$midnight_parallax = 'data-midnight="republicpg-slider"';
				$midnight_regular  = null;

				$slider = '<div ' . $midnight_parallax . ' class="parallax_slider_outer ' . $first_section . '" ' . $dynamic_height_style_markup . '>';

			} else {
				$slider = ''; }

			if ( $config_arr['parallax'] != 'true' ) {

				if ( stripos( $post->post_content, '[republicpg_slider' ) !== false && stripos( $post->post_content, '[republicpg_slider' ) === 0 && $real_fs == 0 ) {
					$first_section     = '';
					$real_fs           = 1;
					$midnight_parallax = null;
					$midnight_regular  = 'data-midnight="republicpg-slider"';
				} else {
					$first_section = ''; }
			} else {
						$midnight_parallax = null;
						$midnight_regular  = null;
						$first_section     = '';
			}

			$text_overrides = null;
			if ( ! empty( $config_arr['tablet_header_font_size'] ) ) {
				$text_overrides .= ' data-tho="' . $config_arr['tablet_header_font_size'] . '"';
			}
			if ( ! empty( $config_arr['tablet_caption_font_size'] ) ) {
				$text_overrides .= ' data-tco="' . $config_arr['tablet_caption_font_size'] . '"';
			}
			if ( ! empty( $config_arr['phone_header_font_size'] ) ) {
				$text_overrides .= ' data-pho="' . $config_arr['phone_header_font_size'] . '"';
			}
			if ( ! empty( $config_arr['phone_caption_font_size'] ) ) {
				$text_overrides .= ' data-pco="' . $config_arr['phone_caption_font_size'] . '"';
			}

			$republicpg_slider_unique_id = 'ns-id-' . uniqid();

			$slider .= '<div ' . $midnight_regular . ' data-transition="' . $config_arr['slider_transition'] . '" data-overall_style="' . $config_arr['overall_style'] . '" data-flexible-height="' . $config_arr['flexible_slider_height'] . '" data-animate-in-effect="' . $animate_in_effect . '" data-fullscreen="' . $config_arr['fullscreen'] . '" ';
			$slider .= 'data-button-sizing="' . $config_arr['button_sizing'] . '" data-button-styling="' . $config_arr['slider_button_styling'] . '" data-autorotate="' . $config_arr['autorotate'] . '" data-parallax="' . $config_arr['parallax'] . '" data-parallax-disable-mobile="' . $config_arr['disable_parallax_mobile'] . '" data-caption-trans="' . $config_arr['caption_transition'] . '" data-parallax-style="bg_only" data-bg-animation="' . $config_arr['bg_animation'] . '" data-full-width="' . $fullwidth . '" ';
			$slider .= 'class="republicpg-slider-wrap ' . $first_section . '" id="' . $republicpg_slider_unique_id . '" ' . $dynamic_height_style_markup . '>';
			$slider .= '<div class="swiper-container" ' . $dynamic_height_style_markup . ' ' . $text_overrides . ' data-loop="' . $config_arr['loop'] . '" data-height="' . $config_arr['slider_height'] . '" data-min-height="' . $config_arr['min_slider_height'] . '" data-arrows="' . $config_arr['arrow_navigation'] . '" data-bullets="' . $config_arr['bullet_navigation'] . '" ';
			$slider .= 'data-bullet_style="' . $config_arr['bullet_navigation_style'] . '" data-bullet_position="' . $config_arr['bullet_navigation_position'] . '" data-desktop-swipe="' . $config_arr['desktop_swipe'] . '" data-settings=""> <div class="swiper-wrapper">';

					  $slide_count = 0;

					  // get slider location by slug instead of raw name
					  $slider_terms = get_term_by( 'name', $config_arr['location'], 'slider-locations' );

					// loop through and get all the slides in selected location
					$slides = new WP_Query(
						array(
							'post_type'      => 'republicpg_slider',
							'tax_query'      => array(
								array(
									'taxonomy' => 'slider-locations',
									'field'    => 'slug',
									'terms'    => $slider_terms->slug,
								),
							),
							'posts_per_page' => -1,
							'order'          => 'ASC',
							'orderby'        => 'menu_order',
						)
					);

		if ( $slides->have_posts() ) :
			while ( $slides->have_posts() ) :
				$slides->the_post();

						global $post;

						$background_type      = get_post_meta( $post->ID, '_republicpg_slider_bg_type', true );
						$background_alignment = get_post_meta( $post->ID, '_republicpg_slider_slide_bg_alignment', true );

						$slide_title = get_post_meta( $post->ID, '_republicpg_slider_heading', true );

						$slide_description         = get_post_meta( $post->ID, '_republicpg_slider_caption', true );
						$slide_description_wrapped = '<span>' . $slide_description . '</span>';
						$slide_description_bg      = get_post_meta( $post->ID, '_republicpg_slider_caption_background', true );
						$caption_bg                = ( $slide_description_bg == 'on' ) ? 'class="transparent-bg"' : '';

						$down_arrow = get_post_meta( $post->ID, '_republicpg_slider_down_arrow', true );

						$poster        = get_post_meta( $post->ID, '_republicpg_slider_preview_image', true );
						$poster_markup = ( ! empty( $poster ) ) ? 'poster="' . $poster . '"' : null;

						$x_pos = get_post_meta( $post->ID, '_republicpg_slide_xpos_alignment', true );
					  $y_pos   = get_post_meta( $post->ID, '_republicpg_slide_ypos_alignment', true );

						$link_type = get_post_meta( $post->ID, '_republicpg_slider_link_type', true );

						$full_slide_link = get_post_meta( $post->ID, '_republicpg_slider_entire_link', true );

						$button_1_text  = get_post_meta( $post->ID, '_republicpg_slider_button', true );
						$button_1_link  = get_post_meta( $post->ID, '_republicpg_slider_button_url', true );
						$button_1_style = get_post_meta( $post->ID, '_republicpg_slider_button_style', true );
						$button_1_color = get_post_meta( $post->ID, '_republicpg_slider_button_color', true );

						$button_2_text  = get_post_meta( $post->ID, '_republicpg_slider_button_2', true );
						$button_2_link  = get_post_meta( $post->ID, '_republicpg_slider_button_url_2', true );
						$button_2_style = get_post_meta( $post->ID, '_republicpg_slider_button_style_2', true );
						$button_2_color = get_post_meta( $post->ID, '_republicpg_slider_button_color_2', true );

					  $video_mp4       = get_post_meta( $post->ID, '_republicpg_media_upload_mp4', true );
						$video_webm    = get_post_meta( $post->ID, '_republicpg_media_upload_webm', true );
						$video_ogv     = get_post_meta( $post->ID, '_republicpg_media_upload_ogv', true );
						$video_texture = get_post_meta( $post->ID, '_republicpg_slider_video_texture', true );
						  $muted       = 'on'; // get_post_meta($post->ID, '_republicpg_slider_video_muted', true);

						  $desktop_content_width = get_post_meta( $post->ID, '_republicpg_slider_slide_content_width_desktop', true );
						$tablet_content_width    = get_post_meta( $post->ID, '_republicpg_slider_slide_content_width_tablet', true );

						$slide_image     = get_post_meta( $post->ID, '_republicpg_slider_image', true );
						  $overlay_color = get_post_meta( $post->ID, '_republicpg_slider_bg_overlay_color', true );

						  $overlay_markup = ( ! empty( $overlay_color ) ) ? '<div class="slide-bg-overlay" style="background-color: ' . $overlay_color . ';"> &nbsp; </div>' : '';
						$img_bg           = null;

						$slide_color = get_post_meta( $post->ID, '_republicpg_slider_slide_font_color', true );

						$custom_class     = get_post_meta( $post->ID, '_republicpg_slider_slide_custom_class', true );
						$custom_css_class = ( ! empty( $custom_class ) ) ? ' ' . $custom_class : null;

				if ( $background_type == 'image_bg' ) {
					$bg_img_markup = 'style="background-image: url(' . republicpg_ssl_check( $slide_image ) . ');"';
				} else {
					$bg_img_markup = null;}

				( ! empty( $x_pos )) ? $x_pos_markup  = $x_pos : $x_pos_markup = 'center';
				( ! empty( $y_pos ) ) ? $y_pos_markup = $y_pos : $y_pos_markup = 'middle';

				$slider .= '<div class="swiper-slide' . $custom_css_class . '" data-desktop-content-width="' . $desktop_content_width . '" data-tablet-content-width="' . $tablet_content_width . '" data-bg-alignment="' . $background_alignment . '" data-color-scheme="' . $slide_color . '" data-x-pos="' . $x_pos_markup . '" data-y-pos="' . $y_pos_markup . '" ' . $dynamic_height_style_markup . '> 
								';

				if ( $background_type == 'image_bg' ) {
					$slider .= '<div class="slide-bg-wrap"><div class="image-bg" ' . $bg_img_markup . '> &nbsp; </div>' . $overlay_markup . '</div>';
				}

				if ( ! empty( $slide_title ) || ! empty( $slide_description ) || ! empty( $button_1_text ) || ! empty( $button_2_text ) ) {

					   $slider .= '<div class="container">
									<div class="content">';

					if ( ! empty( $slide_title ) ) {
						$slider .= '<h2>' . $slide_title . '</h2>'; }
					if ( ! empty( $slide_description ) ) {
						$slider .= '<p ' . $caption_bg . ' >' . $slide_description_wrapped . '</p>'; }

					if ( $link_type == 'button_links' && ! empty( $button_1_text ) || $link_type == 'button_links' && ! empty( $button_2_text ) ) {
						$slider .= '<div class="buttons">';

						if ( ! empty( $button_1_text ) ) {

						  $button_1_link = ! empty( $button_1_link ) ? $button_1_link : '#';

						  // check button link to see if it's a video or googlemap
						  $link_extra = null;

							if ( strpos( $button_1_link, 'youtube.com/watch' ) !== false ) {
								$link_extra = 'pp ';
							}
							if ( strpos( $button_1_link, 'vimeo.com/' ) !== false ) {
								$link_extra = 'pp ';
							}
							if ( strpos( $button_1_link, 'maps.google.com/maps' ) !== false ) {
								$link_extra = 'map-popup ';
							}

						   // wrapper for tilt button
						   $button_wrap_begin = ( $button_1_style == 'solid_color_2' ) ? "<div class='button-wrap'>" : null;
						   $button_wrap_end   = ( $button_1_style == 'solid_color_2' ) ? '</div>' : null;

						   $slider .=
						   '<div class="button ' . $button_1_style . '">
							 		' . $button_wrap_begin . ' <a class="' . $link_extra . $button_1_color . '" href="' . $button_1_link . '">' . $button_1_text . '</a>' . $button_wrap_end . '
							 	 </div>';
						}

						if ( ! empty( $button_2_text ) ) {

						   $button_2_link = ! empty( $button_2_link ) ? $button_2_link : '#';

						   // check button link to see if it's a video or googlemap
						   $link_extra = null;

							if ( strpos( $button_2_link, 'youtube.com/watch' ) !== false ) {
													   $link_extra = 'pp ';
							}
							if ( strpos( $button_2_link, 'vimeo.com/' ) !== false ) {
								$link_extra = 'pp ';
							}
							if ( strpos( $button_2_link, 'maps.google.com/maps' ) !== false ) {
								$link_extra = 'map-popup ';
							}

								$slider .=
								'<div class="button ' . $button_2_style . '">
					 		 <a class="' . $link_extra . $button_2_color . '" href="' . $button_2_link . '">' . $button_2_text . '</a>
					 	 </div>';
						 
						}

						$slider .= '</div>';
						
					}

					$slider .= '</div>
				</div><!--/container-->';

				}

				if ( ! empty( $down_arrow ) && $down_arrow == 'on' ) {

					$header_down_arrow_style = ( ! empty( $republicpg_options['header-down-arrow-style'] ) ) ? $republicpg_options['header-down-arrow-style'] : 'default';
					$theme_button_styling    = ( ! empty( $republicpg_options['button-styling'] ) ) ? $republicpg_options['button-styling'] : 'default';

					if ( $header_down_arrow_style == 'scroll-animation' || $theme_button_styling == 'slightly_rounded' || $theme_button_styling == 'slightly_rounded_shadow' ) {
						$slider .= '<a href="#" class="slider-down-arrow no-border"><svg class="republicpg-scroll-icon" viewBox="0 0 30 45" enable-background="new 0 0 30 45">
					                			<path class="republicpg-scroll-icon-path" fill="none" stroke="#ffffff" stroke-width="2" stroke-miterlimit="10" d="M15,1.118c12.352,0,13.967,12.88,13.967,12.88v18.76  c0,0-1.514,11.204-13.967,11.204S0.931,32.966,0.931,32.966V14.05C0.931,14.05,2.648,1.118,15,1.118z"></path>
					            			  </svg></a>';
					} else {

						$slider .= '<a href="#" class="slider-down-arrow"><i class="icon-blueprint-down-arrow icon-default-style"> <span class="ie-fix"></span> </i></a>';
					}
				}

				$active_texture = ( $video_texture == 'on' ) ? 'active_texture' : '';
				$slider        .= '<div class="video-texture ' . $active_texture . '"> <span class="ie-fix"></span> </div>';

				if ( $background_type == 'video_bg' ) {

						 $muted_markup = '';

					if ( $muted == 'on' ) {
						$muted_markup = ' autoplay muted playsinline';
					}
					$slider .= '
									<div class="mobile-video-image" style="background-image: url(' . $poster . ')"> <span class="ie-fix"></span>  </div>
									<div class="slide-bg-wrap">
									  <div class="video-wrap">
										
										
										<video class="slider-video" width="1800" height="700" preload="auto" loop' . $muted_markup . '>';

					if ( ! empty( $video_webm ) ) {
						  $slider .= '<source type="video/webm" src="' . $video_webm . '">'; }
					if ( ! empty( $video_mp4 ) ) {
						$slider .= '<source type="video/mp4" src="' . $video_mp4 . '">'; }
					if ( ! empty( $video_ogv ) ) {
						$slider .= '<source type="video/ogg" src="' . $video_ogv . '">'; }

													$slider .= '</video></div> ' . $overlay_markup . '</div>';

				}

				if ( $link_type == 'full_slide_link' && ! empty( $full_slide_link ) ) {
					$slider .= '<a href="' . $full_slide_link . '" class="entire-slide-link"> <span class="ie-fix"></span> </a>';
				}

					$slider .= '</div> <!--/swiper-slide-->';

					$slide_count ++;

					endwhile;
endif;

					wp_reset_postdata();

				   $slider .= '</div>';

		if ( $config_arr['arrow_navigation'] == 'true' && $slide_count > 1 && $config_arr['slider_button_styling'] != 'btn_with_preview' && $config_arr['overall_style'] != 'directional' ) {

			$slider .= '<a href="" class="slider-prev"><i class="icon-blueprint-left-arrow"></i> <div class="slide-count"> <span class="slide-current">1</span> <i class="icon-blueprint-right-line"></i> <span class="slide-total"></span> </div> </a>
				     		<a href="" class="slider-next"><i class="icon-blueprint-right-arrow"></i> <div class="slide-count"> <span class="slide-current">1</span> <i class="icon-blueprint-right-line"></i> <span class="slide-total"></span> </div> </a>';
		} elseif ( $config_arr['arrow_navigation'] == 'true' && $slide_count > 1 && $config_arr['slider_button_styling'] == 'btn_with_preview' || $config_arr['overall_style'] == 'directional' ) {
			$slider .= '<a href="" class="slider-prev"><i class="icon-angle-left"></i> </a>
				     		<a href="" class="slider-next"><i class="icon-angle-right"></i> </a>';
		}

		if ( $config_arr['bullet_navigation'] == 'true' && $slide_count > 1 ) {
			$slider .= '<div class="container normal-container slider-pagination-wrap"><div class="slider-pagination"></div></div>';
		}

				$loading_animation    = ( ! empty( $republicpg_options['loading-image-animation'] ) && ! empty( $republicpg_options['loading-image'] ) ) ? $republicpg_options['loading-image-animation'] : null;
				$default_loader       = ( empty( $republicpg_options['loading-image'] ) && ! empty( $republicpg_options['theme-skin'] ) && $republicpg_options['theme-skin'] == 'ascend' ) ? '<span class="default-loading-icon spin"></span>' : null;
				$default_loader_class = ( empty( $republicpg_options['loading-image'] ) && ! empty( $republicpg_options['theme-skin'] ) && $republicpg_options['theme-skin'] == 'ascend' ) ? 'default-loader' : null;
				$slider              .= '<div class="republicpg-slider-loading ' . $default_loader_class . '"> <span class="loading-icon ' . $loading_animation . '"> ' . $default_loader . '  </span> </div> </div> 
				
			</div>';

		if ( $config_arr['parallax'] == 'true' ) {
			$slider .= '</div>'; }

		return $slider;

	}
}
