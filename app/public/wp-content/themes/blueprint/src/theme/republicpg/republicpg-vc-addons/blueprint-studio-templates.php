<?php


$republicpg_get_template_directory_uri = get_template_directory_uri();

add_action( 'vc_load_default_templates_action','republicpg_custom_studio_templates_for_vc' );

function republicpg_custom_studio_templates_for_vc() {

$cat_display_names = array(

);


global $republicpg_get_template_directory_uri;




vc_add_default_templates( $data );


/* WooCommerce specific templates end */

}






?>
