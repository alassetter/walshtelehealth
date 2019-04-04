<?php
/**
 * Custom Fonts
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function blueprint_redux_custom_fonts( $custom_fonts ) {
    return array(
        'Custom Fonts' => array(
          'Domaine Display, Times New Roman,Times,serif;' => 'Domaine Display 500',
					'museo-sans, sans-serif;' => 'museo-sans',
        )
    );
}
add_filter( "redux/blueprint_redux/field/typography/custom_fonts", "blueprint_redux_custom_fonts" );
