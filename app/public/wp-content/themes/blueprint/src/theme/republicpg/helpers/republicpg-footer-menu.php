<?php
/**
 * Custom Footer Menu
 *
 * @package Blueprint Custom Footer Menu
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


#-----------------------------------------------------------------#
# Add Custom Footer Menu
#-----------------------------------------------------------------#

function custom_footer_menu() {
  register_nav_menu('rpg-footer-menu',__( 'Footer Menu' ));
	register_nav_menu('rpg-legal-footer-menu',__( 'Legal Footer Menu' ));
}
add_action( 'init', 'custom_footer_menu' );
