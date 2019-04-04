<?php
/**
 * Header menu items and logo
 *
 * @package Blueprint WordPress Theme
 * @subpackage Partials
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce;

$republicpg_header_options = republicpg_get_header_variables();
$options = get_republicpg_theme_options();

?>

<header id="top">
  <div class="container">
	<div class="row">
	  <div class="col span_3">
		<a id="logo" href="<?php echo esc_url( home_url() ); ?>" data-supplied-ml="<?php echo esc_attr( $republicpg_header_options['using_mobile_logo'] ); ?>" <?php echo $republicpg_header_options['logo_class']; // WPCS: XSS ok. ?>>
			<?php republicpg_logo_output( $republicpg_header_options['activate_transparency'], $republicpg_header_options['side_widget_class'], $republicpg_header_options['using_mobile_logo'] ); ?> 
		</a>
		
		<?php
		if ( $republicpg_header_options['header_format'] == 'centered-menu-bottom-bar' ) {
			$has_pull_left_menu = ( has_nav_menu( 'top_nav_pull_left' ) ) ? 'true' : 'false';
			?>
		  <nav class="left-side" data-using-pull-menu="<?php echo esc_attr( $has_pull_left_menu ); ?>">
			<?php
			// pull left
			if ( has_nav_menu( 'top_nav_pull_left' ) ) {
				wp_nav_menu(
					array(
						'walker'          => new Republicpg_Arrow_Walker_Nav_Menu(),
						'theme_location'  => 'top_nav_pull_left',
						'container'       => '',
						'container_class' => 'pull-left-wrap',
						'items_wrap'      => '<ul id="%1$s" class="sf-menu">%3$s</ul>',
					)
				);
			}
			republicpg_hook_pull_right_menu_items();
			?>
			<ul class="republicpg-social"><li id="social-in-menu" class="button_social_group"><?php republicpg_header_social_icons( 'main-nav' ); ?> </li></ul> 
		  </nav>
		  <nav class="right-side">
			<ul class="buttons" data-user-set-ocm="<?php echo esc_attr( $republicpg_header_options['user_set_side_widget_area'] ); ?>"><?php republicpg_header_button_items(); ?></ul>
			 <?php if ( $republicpg_header_options['side_widget_area'] == '1' ) { ?>
			  <div class="slide-out-widget-area-toggle mobile-icon <?php echo esc_attr( $republicpg_header_options['side_widget_class'] ); ?>" data-icon-animation="simple-transform">
				<div> <a href="#sidewidgetarea" class="closed"> <span> <i class="lines-button x2"> <i class="lines"></i> </i> </span> </a> </div> 
			  </div>
			<?php } ?>
		  </nav>
		<?php } ?>
	  </div><!--/span_3-->
	   
	  <div class="col span_9 col_last">
		<?php if ( $republicpg_header_options['has_main_menu'] == 'true' && $republicpg_header_options['mobile_fixed'] == 'false' && $republicpg_header_options['prepend_top_nav_mobile'] != '1' && $republicpg_header_options['theme_skin'] != 'material' ) { ?>
		  <div class="slide-out-widget-area-toggle mobile-icon std-menu <?php echo esc_attr( $republicpg_header_options['side_widget_class'] ); ?>" data-icon-animation="simple-transform">
			<div> <a id="toggle-nav" href="#sidewidgetarea" class="closed"> <span> <i class="lines-button x2"> <i class="lines"></i> </i> </span> </a> </div> 
		  </div>
			<?php
}

if ( $republicpg_header_options['header_search'] != 'false' && $republicpg_header_options['theme_skin'] == 'material' ) {
	?>
		  <a class="mobile-search" href="#searchbox"><span class="republicpg-icon icon-blueprint-search" aria-hidden="true"></span></a>
		<?php
}

if ( $republicpg_header_options['user_account_btn'] != 'false' ) {
	?>
		  <a class="mobile-user-account" href="<?php echo esc_url( $republicpg_header_options['user_account_btn_url'] ); ?>"><span class="normal icon-blueprint-m-user" aria-hidden="true"></span></a>
		<?php
}

if ( ! empty( $options['enable-cart'] ) && $options['enable-cart'] == '1' ) {
	if ( $woocommerce ) {
		?>
		   
			<!--mobile cart link-->
			<a id="mobile-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><i class="icon-blueprint-cart"></i><div class="cart-wrap"><span><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?> </span></div></a>
			<?php
	}
}


if ( $republicpg_header_options['side_widget_area'] == '1' ) {
	?>
		  <div class="slide-out-widget-area-toggle mobile-icon <?php echo esc_attr( $republicpg_header_options['side_widget_class'] ); ?>" data-icon-animation="simple-transform">
			<div> <a href="#sidewidgetarea" class="closed"> <span> <i class="lines-button x2"> <i class="lines"></i> </i> </span> </a> </div> 
		  </div>
		<?php } ?>
		
		<?php
		if ( $republicpg_header_options['header_format'] == 'left-header' ) {
			echo '<div class="nav-outer">';}
		?>

		<nav>

			<?php if ( $republicpg_header_options['theme_skin'] == 'material' ) { ?>
			<ul class="sf-menu">	
				<?php
				if ( $republicpg_header_options['has_main_menu'] == 'true' ) {
					wp_nav_menu(
						array(
							'walker'         => new Republicpg_Arrow_Walker_Nav_Menu(),
							'theme_location' => 'top_nav',
							'container'      => '',
							'items_wrap'     => '%3$s',
						)
					);
				} else {
					echo '<li class="no-menu-assigned"><a href="#">No menu assigned</a></li>';
				}

				if ( ! empty( $options['enable_social_in_header'] ) && $options['enable_social_in_header'] == '1' && $republicpg_header_options['using_secondary'] != 'header_with_secondary' && $republicpg_header_options['header_format'] != 'menu-left-aligned' && $republicpg_header_options['header_format'] != 'centered-menu' && $republicpg_header_options['header_format'] != 'left-header' && $republicpg_header_options['header_format'] != 'centered-menu-bottom-bar' ) {
					echo '<li id="social-in-menu" class="button_social_group">';
					republicpg_header_social_icons( 'main-nav' );
					echo '</li>';
				}
				?>
			</ul>
			
				<?php


} //material skin
?>


			<?php if ( $republicpg_header_options['header_format'] != 'menu-left-aligned' && $republicpg_header_options['header_format'] != 'centered-menu-bottom-bar' ) { ?>
			<ul class="buttons" data-user-set-ocm="<?php echo esc_attr( $republicpg_header_options['user_set_side_widget_area'] ); ?>">

				<?php

				if ( ! empty( $options['enable_social_in_header'] ) && $options['enable_social_in_header'] == '1' && $republicpg_header_options['using_secondary'] != 'header_with_secondary' && $republicpg_header_options['header_format'] == 'centered-menu' ) {
					echo '<li id="social-in-menu" class="button_social_group">';
					republicpg_header_social_icons( 'main-nav' );
					echo '</li>';
				}

				// pull right
				if ( $republicpg_header_options['header_format'] == 'centered-menu' && $republicpg_header_options['using_pr_menu'] == 'true' ) {
					wp_nav_menu(
						array(
							'walker'         => new Republicpg_Arrow_Walker_Nav_Menu(),
							'theme_location' => 'top_nav_pull_right',
							'container'      => '',
							'items_wrap'     => '%3$s',
						)
					);
					republicpg_hook_pull_right_menu_items();
				}

				republicpg_header_button_items();
				?>
			   
			</ul>
			<?php } ?>

			<?php if ( $republicpg_header_options['theme_skin'] != 'material' ) { ?>
			<ul class="sf-menu">	
				<?php
				if ( $republicpg_header_options['has_main_menu'] == 'true' ) {
					wp_nav_menu(
						array(
							'walker'         => new Republicpg_Arrow_Walker_Nav_Menu(),
							'theme_location' => 'top_nav',
							'container'      => '',
							'items_wrap'     => '%3$s',
						)
					);
				} else {
					echo '<li class="no-menu-assigned"><a href="#">No menu assigned</a></li>';
				}

				if ( ! empty( $options['enable_social_in_header'] ) && $options['enable_social_in_header'] == '1' && $republicpg_header_options['using_secondary'] != 'header_with_secondary' && $republicpg_header_options['header_format'] != 'menu-left-aligned' && $republicpg_header_options['header_format'] != 'centered-menu' && $republicpg_header_options['header_format'] != 'left-header' ) {
					echo '<li id="social-in-menu" class="button_social_group">';
					republicpg_header_social_icons( 'main-nav' );
					echo '</li>';
				}
				?>
			</ul>
			<?php } //non material skin ?>
		   
		</nav>

		<?php
		if ( $republicpg_header_options['header_format'] == 'left-header' ) {
			echo '</div>';}
		?>

		<?php
		if ( $republicpg_header_options['theme_skin'] == 'material' && $republicpg_header_options['header_format'] == 'centered-menu' || $republicpg_header_options['theme_skin'] == 'material' && $republicpg_header_options['header_format'] == 'centered-logo-between-menu' ) {
			republicpg_logo_spacing(); }
		?>
		
	  </div><!--/span_9-->

		<?php if ( $republicpg_header_options['header_format'] == 'menu-left-aligned' ) { ?>
		<div class="right-aligned-menu-items">
		  <nav>
			<ul class="buttons" data-user-set-ocm="<?php echo esc_attr( $republicpg_header_options['user_set_side_widget_area'] ); ?>">

			  <?php
				if ( $republicpg_header_options['using_pr_menu'] == 'true' ) {
					wp_nav_menu(
						array(
							'walker'         => new Republicpg_Arrow_Walker_Nav_Menu(),
							'theme_location' => 'top_nav_pull_right',
							'container'      => '',
							'items_wrap'     => '%3$s',
						)
					);
					republicpg_hook_pull_right_menu_items();
				}

				republicpg_header_button_items();
				?>
			   
			</ul>

			<?php
			if ( ! empty( $options['enable_social_in_header'] ) && $options['enable_social_in_header'] == '1' && $republicpg_header_options['using_secondary'] != 'header_with_secondary' ) {
				echo '<ul><li id="social-in-menu" class="button_social_group">';
				republicpg_header_social_icons( 'main-nav' );
				echo '</li></ul>';
			}
			?>
		  </nav>
		</div><!--/right-aligned-menu-items-->

			<?php
} elseif ( $republicpg_header_options['header_format'] == 'left-header' ) {

	if ( ! empty( $options['enable_social_in_header'] ) && $options['enable_social_in_header'] == '1' && $republicpg_header_options['using_secondary'] != 'header_with_secondary' ) {
		echo '<div class="button_social_group"><ul><li id="social-in-menu">';
		republicpg_header_social_icons( 'main-nav' );
		echo '</li></ul></div>';
	}
}
?>

	</div><!--/row-->
  </div><!--/container-->
</header>
