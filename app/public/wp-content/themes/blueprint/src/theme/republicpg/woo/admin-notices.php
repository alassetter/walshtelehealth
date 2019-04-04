<?php 

/* admin notice for left over uneeded template files */
if( get_option( 'republicpg_dismiss_older_woo_templates_notice' ) != true ) {
    add_action( 'admin_notices', 'republicpg_add_dismissible_woo_notice' );
}

function republicpg_add_dismissible_woo_notice() { ?>
      <div class='notice notice-error republicpg-dismiss-notice is-dismissible'>
          <p><?php echo esc_html__('There are some outdated WooCommerce template files in your blueprint theme directory that are likely lingering around from a previous version of the theme. Blueprint no longer includes any files in the blueprint/woocommerce/cart directory. Please ensure none of the following files are present in your theme directory (wp-content/themes/blueprint).','blueprint'); ?></p>
          <p>
          <?php echo esc_html__('blueprint/woocommerce/cart/cart.php', 'blueprint'); ?> <br />
          <?php echo esc_html__('blueprint/woocommerce/cart/cart-shipping.php', 'blueprint'); ?> <br />
          <?php echo esc_html__('blueprint/woocommerce/cart/cart-totals.php', 'blueprint'); ?> <br />
          <?php echo esc_html__('blueprint/woocommerce/cart/shipping-calculator.php', 'blueprint'); ?> <br />
          </p>
      </div>
<?php }


add_action( 'admin_enqueue_scripts', 'republicpg_add_admin_notice_script' );
function republicpg_add_admin_notice_script() {
	
		global $republicpg_get_template_directory_uri;
		
	  wp_register_script( 'republicpg-woo-admin-notice-update', $republicpg_get_template_directory_uri . '/republicpg/woo/js/admin_notices.js','','1.0', false );
	  
	  wp_localize_script( 'republicpg-woo-admin-notice-update', 'notice_params', array(
	      'ajaxurl' => esc_url(get_admin_url()) . 'admin-ajax.php', 
	  ));
	  
	  wp_enqueue_script(  'republicpg-woo-admin-notice-update' );
		
}

add_action( 'wp_ajax_republicpg_dismiss_older_woo_templates_notice', 'republicpg_dismiss_older_woo_templates_notice' );
function republicpg_dismiss_older_woo_templates_notice() {
      update_option( 'republicpg_dismiss_older_woo_templates_notice', true );
}