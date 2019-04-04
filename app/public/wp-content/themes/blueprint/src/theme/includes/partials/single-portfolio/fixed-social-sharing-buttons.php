<?php
/**
 * Portfolio single fixed position bottom sharing buttons
 *
 * @package Blueprint WordPress Theme
 * @subpackage Partials
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = get_republicpg_theme_options();

?>


<div class="republicpg-social-sharing-fixed"> 

	<?php
	// portfolio social sharting icons
	if ( ! empty( $options['portfolio_social'] ) && $options['portfolio_social'] == 1 ) {

		echo '<a href="#"><i class="icon-default-style steadysets-icon-share"></i></a> <div class="republicpg-social">';

		// facebook
		if ( ! empty( $options['portfolio-facebook-sharing'] ) && $options['portfolio-facebook-sharing'] == 1 ) {
			echo "<a class='facebook-share republicpg-sharing' href='#' title='" . esc_attr__( 'Share this', 'blueprint' ) . "'> <i class='fa fa-facebook'></i> </a>";
		}
		// twitter
		if ( ! empty( $options['portfolio-twitter-sharing'] ) && $options['portfolio-twitter-sharing'] == 1 ) {
			echo "<a class='twitter-share republicpg-sharing' href='#' title='" . esc_attr__( 'Tweet this', 'blueprint' ) . "'> <i class='fa fa-twitter'></i> </a>";
		}
		// google plus
		if ( ! empty( $options['portfolio-google-plus-sharing'] ) && $options['portfolio-google-plus-sharing'] == 1 ) {
			echo "<a class='google-plus-share republicpg-sharing-alt' href='#' title='" . esc_attr__( 'Share this', 'blueprint' ) . "'> <i class='fa fa-google-plus'></i> </a>";
		}

		// linkedIn
		if ( ! empty( $options['portfolio-linkedin-sharing'] ) && $options['portfolio-linkedin-sharing'] == 1 ) {
			echo "<a class='linkedin-share republicpg-sharing' href='#' title='" . esc_attr__( 'Share this', 'blueprint' ) . "'> <i class='fa fa-linkedin'></i> </a>";
		}
		// pinterest
		if ( ! empty( $options['portfolio-pinterest-sharing'] ) && $options['portfolio-pinterest-sharing'] == 1 ) {
			echo "<a class='pinterest-share republicpg-sharing' href='#' title='" . esc_attr__( 'Pin this', 'blueprint' ) . "'> <i class='fa fa-pinterest'></i> </a>";
		}

		echo '</div>';

	}
	?>
  </div><!--sharing-->
