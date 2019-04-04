<?php
/**
 * The template for displaying pages.
 *
 * @package Blueprint WordPress Theme
 * @version 9.0.2
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

get_header();
republicpg_page_header($post->ID);

$republicpg_fp_options = republicpg_get_full_page_options();

?>

<div class="container-wrap">
	<div class="<?php if ($republicpg_fp_options['page_full_screen_rows'] != 'on') {
    echo 'container';
} ?> main-content">
		<div class="row">

			<?php

            // Yoast breadcrumbs.
            if (function_exists('yoast_breadcrumb') && ! is_home() && ! is_front_page()) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }

             // Buddypress related.
            global $bp;
            if ($bp && ! bp_is_blog_page()) {
                echo '<h1>' . get_the_title() . '</h1>';
            }

             // Fullscreen row option.
            if ($republicpg_fp_options['page_full_screen_rows'] == 'on') {
                echo '<div id="republicpg_fullscreen_rows" data-animation="' . esc_attr($republicpg_fp_options['page_full_screen_rows_animation']) . '" data-row-bg-animation="' . esc_attr($republicpg_fp_options['page_full_screen_rows_bg_img_animation']) . '" data-animation-speed="' . esc_attr($republicpg_fp_options['page_full_screen_rows_animation_speed']) . '" data-content-overflow="' . esc_attr($republicpg_fp_options['page_full_screen_rows_content_overflow']) . '" data-mobile-disable="' . esc_attr($republicpg_fp_options['page_full_screen_rows_mobile_disable']) . '" data-dot-navigation="' . esc_attr($republicpg_fp_options['page_full_screen_rows_dot_navigation']) . '" data-footer="' . esc_attr($republicpg_fp_options['page_full_screen_rows_footer']) . '" data-anchors="' . esc_attr($republicpg_fp_options['page_full_screen_rows_anchors']) . '">';
            }

            if (have_posts()) :
                while (have_posts()) :

                    the_post();

                    the_content();

                 endwhile;
             endif;

            if ($republicpg_fp_options['page_full_screen_rows'] == 'on') {
                echo '</div>';
            }
            ?>


		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>
