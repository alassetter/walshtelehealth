<?php
/**
 * Extension-Boilerplate
 * @link https://github.com/ReduxFramework/extension-boilerplate
 *
 * Radium Importer - Modified For ReduxFramework
 * @link https://github.com/FrankM1/radium-one-click-demo-install
 *
 * @package     WBC_Importer - Extension for Importing demo content
 * @author      Webcreations907
 * @version     1.0.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if ( !class_exists( 'ReduxFramework_wbc_importer' ) ) {

    /**
     * Main ReduxFramework_wbc_importer class
     *
     * @since       1.0.0
     */
    class ReduxFramework_wbc_importer {

        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent ) {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            $class = ReduxFramework_extension_wbc_importer::get_instance();

            if ( !empty( $class->demo_data_dir ) ) {
                $this->demo_data_dir = trailingslashit( str_replace( '\\', '/',  $class->demo_data_dir ) );
                $this->demo_data_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->demo_data_dir ) );
            }

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = get_template_directory() . '/republicpg/redux-framework/extensions/wbc_importer/';
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }
        }

        /**
         * Field Render Function.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            echo '</fieldset></td></tr><tr><td colspan="2"><fieldset class="redux-field wbc_importer">';

            $nonce = wp_create_nonce( "redux_{$this->parent->args['opt_name']}_wbc_importer" );

            // No errors please
            $defaults = array(
                'id'        => '',
                'url'       => '',
                'width'     => '',
                'height'    => '',
                'thumbnail' => '',
            );

            $this->value = wp_parse_args( $this->value, $defaults );

            $imported = false;

            $this->field['wbc_demo_imports'] = apply_filters( "redux/{$this->parent->args['opt_name']}/field/wbc_importer_files", array() );
            
            /*republicpg addition*/
            
            
            echo '<div class="republicpg-demo-importer-selection-modal-backdrop"></div> <div class="republicpg-demo-importer-selection-modal">';
            
            echo '
                <div class="republicpg-demo-preview-header"><div class="republicpg-preview-img"></div><span>'. esc_html__("Selected Demo","blueprint") .'</span><h2></h2></div>
                <div class="inner-wrap">';
                
                $plugin_array = array(
                  array(
                    'name'          => 'Blueprint WPBakery Page Builder',
                    'slug'          => 'js_composer_blueprint', 
                    'source'            => get_template_directory() . '/plugins/js_composer_blueprint.zip'
                  ),
                  array(
                    'slug' => 'woocommerce'
                  ),
                  array(
                    'slug' => 'yith-woocommerce-ajax-navigation'
                  ),
                  array(
                    'slug' => 'popup-maker'
                  )
                );

                if(class_exists('Connekt_Plugin_Installer')){
                  Connekt_Plugin_Installer::init($plugin_array);
                }
                
                echo '<h3>'. esc_html__('Demo Content To Import','blueprint').'</h3>';
                
                echo '<div class="demo-importer-form-row first-row">
                    
                    <div class="redux-container-switch import-republicpg-theme-demo-content">
                      <div class="switch-options blueprint activated">
                      </div>
                    </div>
                    
                    <a class="theme-demo-import-option" href="#">' . esc_html__("Demo Content","blueprint") . '<span>'. esc_html__("This includes all pages, posts and other content shown in the demo.","blueprint") . '</span></a>
                  </div>
                  
                  <div class="demo-importer-form-row">
                  
                    <div class="redux-container-switch import-republicpg-theme-option-settings">
                      <div class="switch-options blueprint activated">
                      </div>
                    </div>
                    <a class="theme-demo-import-option" href="#">' . esc_html__("Theme Option Settings","blueprint") . '<span>'. esc_html__("This will override your current theme option settings.","blueprint") . '</span></a>
                  
                  </div>
                  
                  <div class="demo-importer-form-row">
                  
                    <div class="redux-container-switch import-republicpg-theme-demo-widgets">
                      <div class="switch-options blueprint activated">
                      </div>
                    </div>
                  
                    <a class="theme-demo-import-option" href="#">' . esc_html__("Widgets","blueprint") . '<span>'. esc_html__("This will only add new widgets - your existing widgets will be retained.","blueprint") . '</span></a>
                  </div>
                  
                  <div class="demo-importer-form-row">
                    <a href="#" class="button submit">'. esc_html__('Confirm Demo Import','blueprint') . '</a>
                    <a href="#" class="close button">'. esc_html__('Cancel','blueprint') . '</a>
                  </div>';
            
            echo '</div></div>';
            
            //screenshots
            /*republicpg addition end*/
            echo '<div class="theme-browser"><div class="themes">';

            if ( !empty( $this->field['wbc_demo_imports'] ) ) {

                foreach ( $this->field['wbc_demo_imports'] as $section => $imports ) {

                    if ( empty( $imports ) ) {
                        continue;
                    }

                    if ( !array_key_exists( 'imported', $imports ) ) {
                        $extra_class = 'not-imported';
                        $imported = false;
                        $import_message = esc_html__( 'Import Demo', 'blueprint' );
                    }else {
                        $imported = true;
                        $extra_class = 'active imported';
                        $import_message = esc_html__( 'Demo Imported', 'blueprint' );
                    }
                    echo '<div class="wrap-importer theme '.$extra_class.'" data-demo-id="'.esc_attr( $section ).'"  data-nonce="' . $nonce . '" id="' . $this->field['id'] . '-custom_imports">';

                    echo '<div class="theme-screenshot">';

                    if ( isset( $imports['image'] ) ) {
                        echo '<img class="wbc_image" src="'.esc_attr( esc_url( get_template_directory_uri() . '/republicpg/redux-framework/extensions/wbc_importer/demo-data/'.$imports['directory'].'/'.$imports['image'] ) ).'"/>';

                    }
                    echo '</div>';

                    echo '<span class="more-details">'.$import_message.'</span>';
                    echo '<h3 class="theme-name">'. esc_html( apply_filters( 'wbc_importer_directory_title', $imports['directory'] ) ) .'</h3>';

                    echo '<div class="theme-actions">';
                    if ( false == $imported ) {
                        echo '<div class="wbc-importer-buttons"><span class="spinner">'.esc_html__( 'Please Wait...', 'blueprint' ).'</span><span class="button-primary importer-button import-demo-data">' . __( 'Import Demo', 'blueprint' ) . '</span></div>';
                    }else {
                        echo '<div class="wbc-importer-buttons button-secondary importer-button">'.esc_html__( 'Imported', 'blueprint' ).'</div>';
                        echo '<span class="spinner">'.esc_html__( 'Please Wait...', 'blueprint' ).'</span>';
                        echo '<div id="wbc-importer-reimport" class="wbc-importer-buttons button-primary import-demo-data importer-button">'.esc_html__( 'Re-Import', 'blueprint' ).'</div>';
                    }
                    echo '</div>';
                    echo '</div>';


                }

            } else {
                echo "<h5>".esc_html__( 'No Demo Data Provided', 'blueprint' )."</h5>";
            }

            echo '</div></div>';
            echo '</fieldset></td></tr>';

        }

        /**
         * Enqueue Function.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            $min = Redux_Functions::isMin();
            
            wp_enqueue_script(
                'redux-field-wbc-importer-js',
                get_template_directory_uri() . '/republicpg/redux-framework/extensions/wbc_importer/wbc_importer/field_wbc_importer.js',
                array( 'jquery' ),
                time(),
                true
            );

            wp_enqueue_style(
                'redux-field-wbc-importer-css',
                get_template_directory_uri() . '/republicpg/redux-framework/extensions/wbc_importer/wbc_importer/field_wbc_importer.css',
                time(),
                true
            );

        }
    }
}
