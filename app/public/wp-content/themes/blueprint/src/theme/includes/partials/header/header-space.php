<?php
/**
 * Header nav space
 *
 * @package    Blueprint WordPress Theme
 * @subpackage Partials
 * @version    9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$republicpg_header_options = republicpg_get_header_variables();

if ( $republicpg_header_options['perm_trans'] != 1 || $republicpg_header_options['perm_trans'] == 1 && $republicpg_header_options['bg_header'] == 'false' || $republicpg_header_options['page_full_screen_rows'] == 'on' ) { ?>
  
<div id="header-space" data-header-mobile-fixed='<?php echo esc_attr( $republicpg_header_options['mobile_fixed'] ); ?>'></div> 

	<?php

}