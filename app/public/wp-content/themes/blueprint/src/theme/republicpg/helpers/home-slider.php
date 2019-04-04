<?php
/**
 * Home slider helper functions
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

$republicpg_disable_home_slider = ( ! empty( $republicpg_options['disable_home_slider_pt'] ) && $republicpg_options['disable_home_slider_pt'] == '1' ) ? true : false;


// -----------------------------------------------------------------#
// Create admin slider section
// -----------------------------------------------------------------#
if ( ! function_exists( 'republicpg_home_slider_register' ) ) {

	function republicpg_home_slider_register() {

		$labels = array(
			'name'          => __( 'Slides', 'blueprint' ),
			'singular_name' => __( 'Slide', 'blueprint' ),
			'search_items'  => __( 'Search Slides', 'blueprint' ),
			'all_items'     => __( 'All Slides', 'blueprint' ),
			'parent_item'   => __( 'Parent Slide', 'blueprint' ),
			'edit_item'     => __( 'Edit Slide', 'blueprint' ),
			'update_item'   => __( 'Update Slide', 'blueprint' ),
			'add_new_item'  => __( 'Add New Slide', 'blueprint' ),
			'menu_name'     => __( 'Home Slider', 'blueprint' ),
		);

		 $homeslider_menu_icon = ( floatval( get_bloginfo( 'version' ) ) >= '3.8' ) ? 'dashicons-admin-home' : REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/icons/home-slider.png';

		 $args = array(
			 'labels'              => $labels,
			 'singular_label'      => esc_html__( 'Home Slider', 'blueprint' ),
			 'public'              => true,
			 'show_ui'             => true,
			 'hierarchical'        => false,
			 'menu_position'       => 10,
			 'menu_icon'           => $homeslider_menu_icon,
			 'exclude_from_search' => true,
			 'supports'            => false,
		 );

		register_post_type( 'home_slider', $args );
	}
}

if ( $republicpg_disable_home_slider != true ) {
	add_action( 'init', 'republicpg_home_slider_register' );
}



// -----------------------------------------------------------------#
// Custom slider columns
// -----------------------------------------------------------------#
if ( $republicpg_disable_home_slider != true ) {
	add_filter( 'manage_edit-home_slider_columns', 'edit_columns_home_slider' );
}

function edit_columns_home_slider( $columns ) {
	$column_thumbnail = array( 'thumbnail' => 'Thumbnail' );
	$column_caption   = array( 'caption' => 'Caption' );
	$columns          = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, null, true );
	$columns          = array_slice( $columns, 0, 2, true ) + $column_caption + array_slice( $columns, 2, null, true );
	return $columns;
}


if ( $republicpg_disable_home_slider != true ) {
	add_action( 'manage_home_slider_posts_custom_column', 'home_slider_custom_columns', 10, 2 );
}

function home_slider_custom_columns( $portfolio_columns, $post_id ) {

	switch ( $portfolio_columns ) {
		case 'thumbnail':
			$thumbnail = get_post_meta( $post_id, '_republicpg_slider_image', true );

			if ( ! empty( $thumbnail ) ) {
				echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . $thumbnail . '" /></a>';
			} else {
				echo '<a href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit"><img class="slider-thumb" src="' . REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" /></a>' .
					 '<strong><a class="row-title" href="' . esc_url( get_admin_url() ) . 'post.php?post=' . $post_id . '&action=edit">No image added yet</a></strong>';
			}
			break;

		case 'caption':
			$caption = get_post_meta( $post_id, '_republicpg_slider_caption', true );
			echo wp_kses_post( $caption );
			break;

		default:
			break;
	}
}


if ( $republicpg_disable_home_slider != true ) {
	add_action( 'admin_menu', 'republicpg_home_slider_ordering' );
}

function republicpg_home_slider_ordering() {
	add_submenu_page(
		'edit.php?post_type=home_slider',
		'Order Slides',
		'Order',
		'edit_pages',
		'slide-order',
		'republicpg_home_slider_order_page'
	);
}

function republicpg_home_slider_order_page(){ ?>
	
	<div class="wrap">
		<h2><?php echo esc_html__( 'Sort Slides', 'blueprint' ); ?></h2>
		<p><?php echo esc_html__( 'Simply drag the slide up or down and they will be saved in that order.', 'blueprint' ); ?></p>
	<?php
	$slides = new WP_Query(
		array(
			'post_type'      => 'home_slider',
			'posts_per_page' => -1,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
		)
	);
	?>
	<?php if ( $slides->have_posts() ) : ?>
		
		<?php wp_nonce_field( basename( __FILE__ ), 'republicpg_meta_box_nonce' ); ?>
		
		<table class="wp-list-table widefat fixed posts" id="sortable-table">
			<thead>
				<tr>
					<th class="column-order"><?php echo esc_html__( 'Order', 'blueprint' ); ?></th>
					<th class="manage-column column-thumbnail"><?php echo esc_html__( 'Image', 'blueprint' ); ?></th>
					<th class="manage-column column-caption"><?php echo esc_html__( 'Caption', 'blueprint' ); ?></th>
				</tr>
			</thead>
			<tbody data-post-type="home_slider">
			<?php
			while ( $slides->have_posts() ) :
				$slides->the_post();
				?>
				<tr id="post-<?php the_ID(); ?>">
					<td class="column-order"><img src="<?php echo REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/sortable.png'; ?>" alt="Move Icon" width="25" height="25" class="" /></td>
					<td class="thumbnail column-thumbnail">
						<?php
						global $post;
						$thumbnail = get_post_meta( $post->ID, '_republicpg_slider_image', true );

						if ( ! empty( $thumbnail ) ) {
							echo '<img class="slider-thumb" src="' . $thumbnail . '" />';
						} else {
							echo '<img class="slider-thumb" src="' . REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/slider-default-thumb.jpg" />' .
								 '<strong>No image added yet</strong>';
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

	<?php else : ?>

		<p>No slides found, why not <a href="post-new.php?post_type=home_slider">create one?</a></p>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>

	</div><!-- .wrap -->
	
	<?php
}


if ( $republicpg_disable_home_slider != true ) {
	add_action( 'admin_enqueue_scripts', 'home_slider_enqueue_scripts' );
}

function home_slider_enqueue_scripts() {
	global $typenow;
	if ( 'home_slider' == $typenow ) {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'republicpg-reorder', REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/js/republicpg-reorder.js' );
	}
}


add_action( 'wp_ajax_republicpg_update_slide_order', 'republicpg_update_slide_order' );

// slide order ajax callback
function republicpg_update_slide_order() {

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


// order the default home slider page correctly
function set_home_slider_admin_order( $wp_query ) {

	$post_type = ( isset( $wp_query->query['post_type'] ) ) ? $wp_query->query['post_type'] : '';

	if ( $post_type == 'home_slider' ) {

		$wp_query->set( 'orderby', 'menu_order' );
		$wp_query->set( 'order', 'ASC' );
	}

}

if ( is_admin() && $republicpg_disable_home_slider != true ) {
	add_filter( 'pre_get_posts', 'set_home_slider_admin_order' );
}
