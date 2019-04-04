<?php
/**
 * The template for search results.
 *
 * @package Blueprint WordPress Theme
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $republicpg_options;
$header_format = ( ! empty( $republicpg_options['header_format'] ) ) ? $republicpg_options['header_format'] : 'default';
$theme_skin    = ( ! empty( $republicpg_options['theme-skin'] ) ) ? $republicpg_options['theme-skin'] : 'original';
if ( $header_format == 'centered-menu-bottom-bar' ) {
	$theme_skin  = 'material';
}

$search_results_layout            = ( ! empty( $republicpg_options['search-results-layout'] ) ) ? $republicpg_options['search-results-layout'] : 'default';
$search_results_header_bg_color   = ( ! empty( $republicpg_options['search-results-header-bg-color'] ) ) ? $republicpg_options['search-results-header-bg-color'] : '#f4f4f4';
$search_results_header_font_color = ( ! empty( $republicpg_options['search-results-header-font-color'] ) ) ? $republicpg_options['search-results-header-font-color'] : '#000000';
$search_results_header_bg_image   = ( ! empty( $republicpg_options['search-results-header-bg-image'] ) && isset( $republicpg_options['search-results-header-bg-image'] ) ) ? republicpg_options_img( $republicpg_options['search-results-header-bg-image'] ) : null;

?>

<div id="page-header-bg" data-midnight="light" data-text-effect="none" data-bg-pos="center" data-alignment="center" data-alignment-v="middle" data-height="250" style="background-color: <?php echo esc_attr( $search_results_header_bg_color ); ?>;">
	
	<?php if ( $search_results_header_bg_image ) { ?>
		<div class="page-header-bg-image-wrap" id="republicpg-page-header-p-wrap">
			<div class="page-header-bg-image" style="background-image: url(<?php echo esc_url( $search_results_header_bg_image ); ?>);"></div>
	  </div> 
		
		<div class="page-header-overlay-color" style="background-color: #333333;"></div> 
	<?php } ?>
	
	<div class="container">
				 <div class="row">
					<div class="col span_6 ">
						<div class="inner-wrap">
							<h1 style="color: <?php echo esc_attr( $search_results_header_font_color ); ?>;"><?php echo esc_html__( 'Results For', 'blueprint' ); ?> <span>"<?php echo esc_html( get_search_query( false ) ); ?>"</span></h1>	
							<?php
							if ( $wp_query->found_posts ) {
								echo '<span class="result-num" style="color: ' . esc_attr( $search_results_header_font_color ) . ';">' . esc_html( $wp_query->found_posts ) . ' ' . esc_html__( 'results found', 'blueprint' ) . '</span>'; }
							?>
														
						</div>
					</div>
				</div>
	</div>
</div>


<div class="container-wrap" data-layout="<?php echo esc_attr( $search_results_layout ); ?>">
	<div class="container main-content">

		<div class="row">
			
			<?php $search_col_span = ( $search_results_layout == 'default' ) ? '9' : '12'; ?>
			<div class="col span_<?php echo esc_attr( $search_col_span ); // WPCS: XSS ok. ?>">
				
				<div id="search-results" data-layout="<?php echo esc_attr( $search_results_layout ); ?>">
						
					<?php

					add_filter( 'wp_get_attachment_image_attributes', 'republicpg_remove_lazy_load_functionality' );

					if ( have_posts() ) :
						while ( have_posts() ) :

							the_post();

							$using_post_thumb = has_post_thumbnail( $post->ID );

							if ( get_post_type( $post->ID ) == 'post' ) {
								?>
								<article class="result" data-post-thumb="<?php echo esc_attr( $using_post_thumb ); ?>">
									<div class="inner-wrap">
										<?php
										if ( has_post_thumbnail( $post->ID ) ) {
											echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';
										}
										?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo esc_html__( 'Blog Post', 'blueprint' ); ?></span></h2>
										<?php
										if ( $search_results_layout == 'list-no-sidebar' ) {
											the_excerpt(); }
										?>
									</div>
								</article><!--/search-result-->	
								<?php
							} elseif ( get_post_type( $post->ID ) == 'page' ) {
								?>
								<article class="result">
									<div class="inner-wrap">
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo esc_html__( 'Page', 'blueprint' ); ?></span></h2>	
										
										<?php
										if ( has_excerpt() ) {
											the_excerpt();}
										?>
									</div>
								</article><!--/search-result-->	
								<?php
							} elseif ( get_post_type( $post->ID ) == 'portfolio' ) {
								?>
								<article class="result" data-post-thumb="<?php echo esc_attr( $using_post_thumb ); ?>">
									<div class="inner-wrap">
										<?php

										$republicpg_custom_project_link   = get_post_meta( $post->ID, '_republicpg_external_project_url', true );
										$republicpg_portfolio_project_url = ( ! empty( $republicpg_custom_project_link ) ) ? $republicpg_custom_project_link : esc_url( get_permalink() );

										if ( has_post_thumbnail( $post->ID ) ) {
											echo '<a href="' . esc_url( $republicpg_portfolio_project_url ) . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';
										}
										?>
										<h2 class="title"><a href="<?php echo esc_url( $republicpg_portfolio_project_url ); ?>"><?php the_title(); ?></a> <span><?php echo esc_html__( 'Portfolio Item', 'blueprint' ); ?></span></h2>
									</div>
								</article><!--/search-result-->		
								<?php
							} elseif ( get_post_type( $post->ID ) == 'product' ) {
								?>
								<article class="result" data-post-thumb="<?php echo esc_attr( $using_post_thumb ); ?>">
									<div class="inner-wrap">
										<?php
										if ( has_post_thumbnail( $post->ID ) ) {
											echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';
										}
										?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo esc_html__( 'Product', 'blueprint' ); ?></span></h2>	
										<?php
										if ( $search_results_layout == 'list-no-sidebar' ) {
											the_excerpt(); }
										?>
									</div>
								</article><!--/search-result-->	
							<?php } else { ?>
								<article class="result" data-post-thumb="<?php echo esc_attr( $using_post_thumb ); ?>">
									<div class="inner-wrap">
										<?php
										if ( has_post_thumbnail( $post->ID ) ) {
											echo '<a href="' . esc_url( get_permalink() ) . '">' . get_the_post_thumbnail( $post->ID, 'full', array( 'title' => '' ) ) . '</a>';
										}
										?>
										<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<?php
										if ( $search_results_layout == 'list-no-sidebar' ) {
											the_excerpt(); }
										?>
									</div>
								</article><!--/search-result-->	
							<?php } ?>
							
							<?php
					endwhile;

					else :

						echo '<h3>' . esc_html__( 'Sorry, no results were found.', 'blueprint' ) . '</h3>';
						echo '<p>' . esc_html__( 'Please try again with different keywords.', 'blueprint' ) . '</p>';
						get_search_form();

				  endif;

					remove_filter( 'wp_get_attachment_image_attributes', 'republicpg_remove_lazy_load_functionality' );

					?>

				</div><!--/search-results-->
				
				<?php if ( get_next_posts_link() || get_previous_posts_link() ) { ?>
					<div id="pagination" data-layout="<?php echo esc_attr( $search_results_layout ); ?>">
						<div class="prev"><?php previous_posts_link( '&laquo; Previous Entries' ); ?></div>
						<div class="next"><?php next_posts_link( 'Next Entries &raquo;', '' ); ?></div>
					</div>	
				<?php } ?>
				
			</div><!--/span_9-->
			
			<?php if ( $search_results_layout == 'default' ) { ?>
				
				<div id="sidebar" class="col span_3 col_last">
					<?php get_sidebar(); ?>
				</div><!--/span_3-->
				
			<?php } ?>
		
		</div><!--/row-->
		
	</div><!--/container-->

</div><!--/container-wrap-->

<?php get_footer(); ?>