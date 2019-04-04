<?php 

if (!defined( 'ABSPATH')) exit;

class Republicpg_Woo_Quickview {
  
  function __construct() {

      add_action( 'wp_ajax_republicpg_woo_get_product', array($this,'republicpg_woo_get_product_info') );
      add_action( 'wp_ajax_nopriv_republicpg_woo_get_product', array($this,'republicpg_woo_get_product_info') );
      add_action( 'republicpg_woocommerce_before_add_to_cart', array($this,'republicpg_woo_add_quick_view_button') );
      add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts'));
      add_action( 'wp_footer', array($this, 'republicpg_quick_view_markup'));
      
      $this->republicpg_add_template_actions();
  }
  
  
  function enqueue_scripts() {
    
    wp_register_script('republicpg_woo_quick_view_js', get_template_directory_uri() . '/republicpg/woo/js/quick_view_actions.js', array('jquery'), '1.1', true);
    wp_enqueue_script( 'wc-add-to-cart-variation' );
    wp_enqueue_script('republicpg_woo_quick_view_js');
    wp_enqueue_script('flickity');
  }
  
  public function republicpg_woo_add_quick_view_button() {
    
    global $republicpg_options;
		global $post;
    $product_style = (!empty($republicpg_options['product_style'])) ? $republicpg_options['product_style'] : 'classic';
    $button_class = ($product_style == 'classic') ? 'button' : '';
    $button_icon = ($product_style != 'material') ? '<i class="normal icon-blueprint-m-eye"></i>' : '';
    
    $get_product = wc_get_product( $post->ID );
    
    if($get_product->is_type( 'grouped' ) || $get_product->is_type( 'external' ) ) { return; }
    
    echo '<a class="republicpg_quick_view no-ajaxy '.$button_class.'" data-product-id="'.$post->ID.'"> '.$button_icon.'
    <span>' . esc_html__('Quick View', 'blueprint') . '</span></a>';
    
	}
  
  public function republicpg_quick_view_markup() {
    
    global $republicpg_options;
    $quick_view_sizing = 'cropped';
    
		echo '<div class="republicpg-quick-view-box-backdrop"></div>
    <div class="republicpg-quick-view-box" data-image-sizing="'.$quick_view_sizing.'">
    <div class="inner-wrap">
    
    <div class="close">
      <a href="#" class="no-ajaxy">
        <span class="close-wrap"> <span class="close-line close-line1"></span> <span class="close-line close-line2"></span> </span>		     	
      </a>
    </div>
        
        <div class="product-loading">
          <span class="dot"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
        
        <div class="preview_image"></div>
        
		    <div class="inner-content">
        
          <div class="product">  
             <div class="product type-product"> 
                  
                  <div class="woocommerce-product-gallery">
                  
                  </div>
                  
                  <div class="summary entry-summary scrollable">
                     <div class="summary-content">   
                     </div>
                  </div>
                  
             </div>
          </div>
          
        </div>
      </div>
		</div>';

		 
	}
  
  public function republicpg_add_template_actions() {
    
    add_action('republicpg_quick_view_summary_content','woocommerce_template_single_title');
    add_action('republicpg_quick_view_summary_content','woocommerce_template_single_rating');
    add_action('republicpg_quick_view_summary_content','woocommerce_template_single_price');
    add_action('republicpg_quick_view_summary_content','woocommerce_template_single_excerpt');
    add_action('republicpg_quick_view_summary_content','woocommerce_template_single_add_to_cart');
    
    add_action('republicpg_quick_view_sale_content','woocommerce_show_product_sale_flash');

  }
  
  
  public function republicpg_woo_get_product_info() {
    
    
		global $woocommerce;
    global $post;
    
		$product_id = intval($_POST['product_id']);
    
		if(intval($product_id)){
      
     //set the wp query for the product based on ID
		 wp('p=' . $product_id . '&post_type=product');
     
	   ob_start();
 	   
		 	while ( have_posts() ) : the_post(); ?>
      
	 	    <script>
          var wc_add_to_cart_variation_params = {};     
	 	    </script>
        
	        <div class="product">  
            
	                <div itemscope id="product-<?php the_ID(); ?>" <?php post_class('product'); ?> >  
                  
	                      <?php 
                        
                        do_action('republicpg_quick_view_sale_content');

                         global $product;
                         if ( has_post_thumbnail() ) { ?>
                          <div class="images"> 
                          <div class="republicpg-product-slider generate-markup">
                             
                           <div class="carousel-cell woocommerce-product-gallery__image">
           	                	<a href="#">
           	                		<?php echo get_the_post_thumbnail( $post->ID, 'large'); ?>
           	                	</a>
                           </div>
                           
                           <?php 
                           	$product_attach_ids = $product->get_gallery_image_ids(); 
                            if ( $product_attach_ids ) {
                    
                    					foreach ($product_attach_ids as $product_attach_id) {
                    
                    						$img_link = wp_get_attachment_url( $product_attach_id );
                    			
                    						if (!$img_link)
                    							continue;
                    
                    						printf( '<div class="carousel-cell woocommerce-product-gallery__image"><a href="%s" title="%s"> %s </a></div>', wp_get_attachment_url($product_attach_id),esc_attr( get_post($product_attach_id)->post_title ), wp_get_attachment_image($product_attach_id, 'large'));
                              
                    					}// foreach
                              
                    				} //if attach ids
                            
                            echo '</div> <!--republicpg-product-slider--> </div>';
                            
                         } else {
                           $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                           $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
                           $html .= '</div>';
                         }

 
                         ?>
                         
                    
 	                        <div class="summary entry-summary scrollable">
 	                                <div class="summary-content">   
                                       <?php
                                       
                                       echo '<div class="republicpg-full-product-link"><a href="'.esc_url(get_permalink()).'"><span>'. esc_html__('More Information', 'blueprint') .'</span></a></div>';
                                       
                                       do_action('republicpg_quick_view_summary_content');
      
                                      ?>
 	                                </div>
 	                        </div>
                          
 	                </div> 
 	        </div>
 	       
 	        <?php endwhile;

 	                  
 	        echo  ob_get_clean();
 	
 	        exit();
            
			
	    }
	}
  
  
  
}



$republicpg_quick_view = new Republicpg_Woo_Quickview();

?>