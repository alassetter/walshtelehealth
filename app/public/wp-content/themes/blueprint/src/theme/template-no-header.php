<?php 
/*template name: No Header */
?>

<!doctype html>

<html <?php language_attributes(); ?> class="no-js">
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php
$options = get_republicpg_theme_options();

if ( ! empty( $options['responsive'] ) && $options['responsive'] == 1 ) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

<?php } else { ?>
	<meta name="viewport" content="width=1200" />
<?php } ?>	

<!--Shortcut icon-->
<?php if ( ! empty( $options['favicon'] ) && ! empty( $options['favicon']['url'] ) ) { ?>
	<link rel="shortcut icon" href="<?php echo republicpg_options_img( $options['favicon'] ); ?>" />
<?php } 

wp_head();

if ( ! empty( $options['google-analytics'] ) ) {
	echo $options['google-analytics'];}
?>
 
</head>

<?php

 global $post;
 global $woocommerce;
 $republicpg_header_options = republicpg_get_header_variables();
 
?>

<body <?php body_class(); republicpg_body_attributes(); ?>>

<?php 

if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1') { echo '<div id="boxed">'; }

?>

<?php republicpg_page_trans_markup(); ?>

<div id="header-outer" <?php republicpg_header_nav_attributes(); ?>> <header id="top"> <div class="span_3"></div><div class="span_9"></div> </header> </div><!--/header-outer-->

<div id="ajax-content-wrap">

<?php

if ( $republicpg_header_options['side_widget_area'] == '1' && $republicpg_header_options['side_widget_class'] == 'fullscreen' ) {
	echo '<div class="blurred-wrap">';
}


republicpg_page_header($post->ID);

$republicpg_fp_options = republicpg_get_full_page_options();

?>

<div class="container-wrap">
	<div class="<?php if ( $republicpg_fp_options['page_full_screen_rows'] != 'on' ) { echo 'container';} ?> main-content">
		<div class="row">
			
			<?php

			// breadcrumbs
			if ( function_exists( 'yoast_breadcrumb' ) && ! is_home() && ! is_front_page() ) {
				yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ); }

			 // buddypress
			 global $bp;
			if ( $bp && ! bp_is_blog_page() ) {
				echo '<h1>' . get_the_title() . '</h1>';
			}

			 // fullscreen rows
			if ( $republicpg_fp_options['page_full_screen_rows'] == 'on' ) {
				echo '<div id="republicpg_fullscreen_rows" data-animation="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_animation'] ) . '" data-row-bg-animation="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_bg_img_animation'] ) . '" data-animation-speed="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_animation_speed'] ) . '" data-content-overflow="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_content_overflow'] ) . '" data-mobile-disable="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_mobile_disable'] ) . '" data-dot-navigation="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_dot_navigation'] ) . '" data-footer="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_footer'] ) . '" data-anchors="' . esc_attr( $republicpg_fp_options['page_full_screen_rows_anchors'] ) . '">';
			}

			if ( have_posts() ) :
				while ( have_posts() ) :

					the_post();

					the_content();

				 endwhile;
			 endif;

			if ( $republicpg_fp_options['page_full_screen_rows'] == 'on' ) {
				echo '</div>';
			}
			?>

		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->

<?php get_footer(); ?>