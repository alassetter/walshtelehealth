<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "blueprint_redux";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );



    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $theme_menu_icon = null;
    if(floatval(get_bloginfo('version')) >= "3.8") {
        $current_color = get_user_option( 'admin_color' );
        if($current_color == 'light') {
            $theme_menu_icon = REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/icons/blueprint-grey.svg';
        } else {
            $theme_menu_icon = REPUBLICPG_FRAMEWORK_DIRECTORY . 'assets/img/icons/blueprint.svg';
        }
    }


    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        'disable_tracking' => true,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Blueprint', 'redux-framework-demo' ),
        'page_title'           => esc_html__( 'Blueprint Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 54,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => $theme_menu_icon,
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => '',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => ' ',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = '';
    } else {
         $args['intro_text'] = '';
    }

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /* EXT LOADER */
    if(!function_exists('redux_register_custom_extension_loader')) :
    function redux_register_custom_extension_loader($ReduxFramework) {
        $path = dirname( __FILE__ ) . '/extensions/';
        $folders = scandir( $path, 1 );
        foreach($folders as $folder) {
            if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
                continue;
            }
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if( !class_exists( $extension_class ) ) {
                // In case you wanted override your override, hah.
                $class_file = $path . $folder . '/extension_' . $folder . '.php';
                $class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
                if( $class_file ) {
                    require_once( $class_file );
                    $extension = new $extension_class( $ReduxFramework );
                }
            }
        }
    }
    // Modify {$redux_opt_name} to match your opt_name
    add_action("redux/extensions/".$opt_name ."/before", 'redux_register_custom_extension_loader', 0);
    endif;


    //write dynamic css
    //$options = get_republicpg_theme_options();
    //if(!empty($options['external-dynamic-css']) && $options['external-dynamic-css'] == 1) {
        add_action ('redux/options/blueprint_redux/saved', 'republicpg_generate_options_css');
    //}


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */



     Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General Settings', 'blueprint' ),
        'id'               => 'general-settings',
        'customizer_width' => '450px',
        'desc'             => esc_html__('Welcome to the Blueprint options panel! You can switch between option groups by using the left-hand tabs.', 'blueprint'),
        'fields'           => array(

        )
    ) );

    $border_border_sizes = array();
    for($i = 1; $i<100; $i++) {
         $border_border_sizes[$i] = $i;
    }

    $legacy_wp_favicon = array(
        'id' => 'favicon',
        'type' => 'media',
        'title' => esc_html__('Favicon Upload', 'blueprint'),
        'subtitle' => esc_html__('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'blueprint'),
        'desc' => ''
    );

    $options = get_republicpg_theme_options();
    $using_legacy_favicon = (!empty($options['favicon']) && !empty($options['favicon']['url'])) ? true : false;

    if(floatval(get_bloginfo('version')) >= "4.3" && !$using_legacy_favicon) {
      $legacy_wp_favicon = array(
          'id'    => 'info_success',
          'type'  => 'info',
          'style' => 'success',
          'title' => esc_html__('Favicon', 'redux-framework-demo'),
          'icon'  => 'el-icon-info-sign',
          'desc'  => esc_html__( 'As of WP 4.3, the favicon setting is now available in the default WordPress customizer (Appearance > Customize).', 'blueprint')
      );
    }

     Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Styling', 'redux-framework-demo' ),
        'id'               => 'general-settings-styling',
        'subsection'       => true,
        'fields'           => array(
           array(
                'id' => 'theme-skin',
                'type' => 'select',
                'title' => esc_html__('Theme Skin', 'blueprint'),
                'subtitle' => esc_html__('This will alter the overall styling of various theme elements', 'blueprint'),
                'options' => array(
                    "original" => esc_html__('Original', 'blueprint'),
                    "ascend" => esc_html__('Ascend', 'blueprint'),
                    "material" => esc_html__('Material', 'blueprint')
                ),
                'default' => 'material'
            ),
            array(
                'id' => 'button-styling',
                'type' => 'select',
                'title' => esc_html__('Button Styling', 'blueprint'),
                'subtitle' => esc_html__('This will effect the overall styling of buttons', 'blueprint'),
                'options' => array(
                    "default" => esc_html__("Default", "blueprint"),
                    "slightly_rounded" => esc_html__("Slightly Rounded", "blueprint"),
                    "slightly_rounded_shadow" => esc_html__("Slightly Rounded W/ Shadow", "blueprint"),
                    "rounded" => esc_html__("Rounded", "blueprint"),
                    "rounded_shadow" => esc_html__("Rounded W/ Shadow", "blueprint")
                ),
                'default' => 'slightly_rounded_shadow'
            ),

            array(
                'id' => 'overall-bg-color',
                'type' => 'color',
                'title' => esc_html__('Overall Background Color', 'blueprint'),
                'subtitle' => 'Default is #ffffff',
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),

             array(
                'id' => 'overall-font-color',
                'type' => 'color',
                'title' => esc_html__('Overall Font Color', 'blueprint'),
                'subtitle' => 'Default is #676767',
                'transparent' => false,
                'desc' => '',
                'default' => ''
            ),
            array(
                'id' => 'body-border',
                'type' => 'switch',
                'title' => esc_html__('Body Border (Passepartout)', 'blueprint'),
                'subtitle' => esc_html__('This will add a border around the edges of the screen', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
            array(
                'id' => 'body-border-color',
                'type' => 'color',
                'required' => array( 'body-border', '=', '1' ),
                'title' => esc_html__('Body Border Color', 'blueprint'),
                'subtitle' => 'Default is #ffffff',
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),
            array(
                'id' => 'body-border-size',
                'type' => 'select',
                'required' => array( 'body-border', '=', '1' ),
                'title' => esc_html__('Body Border Size', 'blueprint'),
                'subtitle' => esc_html__('Please choose your desired size in px here. Default is 20px.', 'blueprint'),
                'options' => $border_border_sizes,
                'default' => '20px'
            ),
            $legacy_wp_favicon
        )
    ) );

     Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Functionality', 'redux-framework-demo' ),
        'id'               => 'general-settings-functionality',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id' => 'back-to-top',
                'type' => 'switch',
                'title' => esc_html__('Back To Top Button', 'blueprint'),
                'subtitle' => esc_html__('Toggle whether or not to enable a back to top button on your pages.', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
            array(
                'id' => 'back-to-top-mobile',
                'type' => 'switch',
                'title' => esc_html__('Keep Back To Top Button On Mobile', 'blueprint'),
                'subtitle' => esc_html__('Toggle whether or not to show or hide the back to top button when viewing on a mobile device.', 'blueprint'),
                'desc' => '',
                'required' => array( 'back-to-top', '=', '1' ),
                'default' => '0'
            ),
            array(
                'id' => 'one-page-scrolling',
                'type' => 'switch',
                'title' => esc_html__('One Page Scroll Support (Animated Anchor Links)', 'blueprint'),
                'subtitle' => esc_html__('Toggle whether or not to enable one page scroll support', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
            array(
                'id' => 'responsive',
                'type' => 'switch',
                'title' => esc_html__('Enable Responsive Design', 'blueprint'),
                'subtitle' => esc_html__('This adjusts the layout of your website depending on the screen size/device.', 'blueprint'),
                'desc' => '',
                'next_to_hide' => '1',
                'default' => '1'
            ),
            array(
                'id' => 'ext_responsive',
                'type' => 'switch',
                'required' => array( 'responsive', '=', '1' ),
                'title' => esc_html__('Extended Responsive Design', 'blueprint'),
                'subtitle' => esc_html__('This will enhance the way the theme responds when viewing on screens larger than 1000px & increase the max width.', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
            array(
                'id'        => 'max_container_width',
                'type'      => 'slider',
                'required' => array( 'ext_responsive', '=', '1' ),
                'title'     => esc_html__('Max Website Container Width', 'blueprint'),
                'subtitle'  => esc_html__('When using the extended responsive design your container will scale to a maximum width of 1425px, use this option if you\'d like to increase that value.', 'blueprint'),
                'desc'      => '',
                "default"   => 1425,
                "min"       => 1425,
                "step"      => 1,
                "max"       => 2000,
                'display_value' => 'text'
            ),
                         array(
                'id' => 'lightbox_script',
                'type' => 'select',
                'title' => esc_html__('Theme Lightbox', 'blueprint'),
                'subtitle' => esc_html__('Please choose your desired lightbox script here', 'blueprint'),
                'options' => array(
                    "magnific" => "Magnific",
                    "fancybox" => "fancyBox3",
                    "none" => "None"
                ),
                'default' => 'fancybox'
            ),
            array(
                'id' => 'default-lightbox',
                'type' => 'switch',
                'title' => esc_html__('Auto Lightbox Image Links', 'blueprint'),
                'subtitle' => esc_html__('This will allow all image links to open in a lightbox - including the images links within standard WordPress galleries.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
            array(
                'id' => 'disable-mobile-parallax',
                'type' => 'switch',
                'title' => esc_html__('Disable Parallax Backgrounds On Mobile Devices', 'blueprint'),
                'subtitle' => esc_html__('This will remove the parallax scrolling effect from your row backgrounds/page headers that use the option.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
            array(
                'id' => 'disable-mobile-video-bgs',
                'type' => 'switch',
                'title' => esc_html__('Disable Video Backgrounds On Mobile Devices', 'blueprint'),
                'subtitle' => esc_html__('This will remove all self hosted video backgrounds from your rows/page headers that use them on mobile devices and cause the supplied preview image to be shown instead.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
             array(
                'id' => 'column_animation_easing',
                'type' => 'select',
                'title' => esc_html__('Column/Image Animation Easing', 'blueprint'),
                'subtitle' => esc_html__('This is the easing that will be used on all animated column/images you set', 'blueprint'),
                'options' => array(
                    'linear'=>'linear',
                    'swing'=>'swing',
                    'easeInQuad'=>'easeInQuad',
                    'easeOutQuad' => 'easeOutQuad',
                    'easeInOutQuad'=>'easeInOutQuad',
                    'easeInCubic'=>'easeInCubic',
                    'easeOutCubic'=>'easeOutCubic',
                    'easeInOutCubic'=>'easeInOutCubic',
                    'easeInQuart'=>'easeInQuart',
                    'easeOutQuart'=>'easeOutQuart',
                    'easeInOutQuart'=>'easeInOutQuart',
                    'easeInQuint'=>'easeInQuint',
                    'easeOutQuint'=>'easeOutQuint',
                    'easeInOutQuint'=>'easeInOutQuint',
                    'easeInExpo'=>'easeInExpo',
                    'easeOutExpo'=>'easeOutExpo',
                    'easeInOutExpo'=>'easeInOutExpo',
                    'easeInSine'=>'easeInSine',
                    'easeOutSine'=>'easeOutSine',
                    'easeInOutSine'=>'easeInOutSine',
                    'easeInCirc'=>'easeInCirc',
                    'easeOutCirc'=>'easeOutCirc',
                    'easeInOutCirc'=>'easeInOutCirc',
                    'easeInElastic'=>'easeInElastic',
                    'easeOutElastic'=>'easeOutElastic',
                    'easeInOutElastic'=>'easeInOutElastic',
                    'easeInBack'=>'easeInBack',
                    'easeOutBack'=>'easeOutBack',
                    'easeInOutBack'=>'easeInOutBack',
                    'easeInBounce'=>'easeInBounce',
                    'easeOutBounce'=>'easeOutBounce',
                    'easeInOutBounce'=>'easeInOutBounce'
                ),
                'default' => 'easeOutCubic'
            ),
            array(
                'id' => 'column_animation_timing',
                'type' => 'text',
                'title' => esc_html__('Column/Image Animation Timing', 'blueprint'),
                'subtitle' => esc_html__('Enter the time in miliseconds e.g. "400" - default is "650"', 'blueprint'),
                'desc' => '',
                'default' => '750'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'CSS/Script Related', 'redux-framework-demo' ),
        'id'               => 'general-settings-extra',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id' => 'external-dynamic-css',
                'type' => 'switch',
                'title' => esc_html__('Move Dynamic/Custom CSS Into External Stylesheet?', 'blueprint'),
                'subtitle' => esc_html__('This gives you the option move all the dynamic css that lives in the head by default into its own file for aesthetic & caching purposes. Note: your server will need the ability/permission to write to the static file (dynamic-combined.css) using file_put_contents', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
            array(
                'id' => 'google-analytics',
                'type' => 'textarea',
                'title' => esc_html__('Google Analytics', 'blueprint'),
                'subtitle' => esc_html__('Please enter in your google analytics tracking code here. Remember to include the entire script from google, if you just enter your tracking ID it won\'t work.', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'google-maps-api-key',
                'type' => 'text',
                'title' => esc_html__('Google Maps API Key', 'blueprint'),
                'subtitle' => esc_html__('In order to use Google maps you need to generate an API key and enter it here - please see the', 'blueprint') . ' <a rel="nofollow" href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key">' . __('official documentation', 'blueprint') . '</a> ' . __('for more information', 'blueprint'),
                'desc' => '',
                'default' => ''
            ),
             array(
                'id'=>'custom-css',
                'type' => 'ace_editor',
                'title' => esc_html__('Custom CSS Code', 'blueprint'),
                'subtitle' => esc_html__('If you have any custom CSS you would like added to the site, please enter it here.', 'blueprint'),
                'mode' => 'css',
                'theme' => 'monokai',
                'hint' => array('content' => 'Note - if you\'ve pasted CSS in here from an external source, ensure no accidental <b>pre</b> tags pasted in with the snippet. If unintentional tags like that are present, it will prevent the css from parsing correctly.', 'title' => ''),
                'desc' => '',
                'options' => array('minLines' => 20)
            )
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Toggle Theme Features', 'redux-framework-demo' ),
        'id'               => 'general-settings-theme-features',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id' => 'disable_tgm',
                'type' => 'checkbox',
                'title' => esc_html__('Disable Theme Reccomended Plugin Notifications', 'blueprint'),
                'subtitle' => esc_html__('This will remove the notifications shown for installing/updating reccomended theme plugins (Blueprint Visual Composer/WooCommerce/Contact From 7). Enable if you don\'t need them anymore & are fimilar with keeping track of plugin updates in WordPress. Will yield Admin panel performance improvement.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

            array(
                'id' => 'disable_home_slider_pt',
                'type' => 'checkbox',
                'title' => esc_html__('Disable Home Slider', 'blueprint'),
                'subtitle' => esc_html__('This will remove the Home Slider post type <b>Will yield Admin panel & front-end performance improvement</b>', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

            array(
                'id' => 'disable_republicpg_slider_pt',
                'type' => 'checkbox',
                'title' => esc_html__('Disable Republicpg Slider', 'blueprint'),
                'subtitle' => esc_html__('This will remove the Republicpg Slider post type. Will yield Admin panel & front-end performance improvement.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

        )
    ) );




    Redux::setSection( $opt_name, array(
        'id'               => 'accent-color',
        'customizer_width' => '450px',
        'icon' => 'el el-brush',
        'title' => esc_html__('Accent Colors', 'blueprint'),
        'desc' => esc_html__('All accent color related options are listed here.', 'blueprint'),
        'fields'           => array(
              array(
                'id' => 'accent-color',
                'type' => 'color',
                 'transparent' => false,
                'title' => esc_html__('Accent Color', 'blueprint'),
                'subtitle' => esc_html__('Change this color to alter the accent color globally for your site.', 'blueprint'),
                'desc' => '',
                'default' => '#3452ff'
            ),
            array(
                'id' => 'extra-color-1',
                'type' => 'color',
                 'transparent' => false,
                'title' => esc_html__('Extra Color #1', 'blueprint'),
                'subtitle' => esc_html__('Applicable theme elements will have the option to choose this as a color (i.e. buttons, icons etc..)', 'blueprint'),
                'desc' => '',
                'default' => '#ff1053'
            ),
            array(
                'id' => 'extra-color-2',
                'type' => 'color',
                 'transparent' => false,
                'title' => esc_html__('Extra Color #2', 'blueprint'),
                'subtitle' => esc_html__('Applicable theme elements will have the option to choose this as a color (i.e. buttons, icons etc..)', 'blueprint'),
                'desc' => '',
                'default' => '#2AC4EA'
            ),
            array(
                'id' => 'extra-color-3',
                'type' => 'color',
                 'transparent' => false,
                'title' => esc_html__('Extra Color #3', 'blueprint'),
                'subtitle' => esc_html__('Applicable theme elements will have the option to choose this as a color (i.e. buttons, icons etc..)', 'blueprint'),
                'desc' => '',
                'default' => '#333333'
            ),

            array(
                'id' => 'extra-color-gradient',
                'type' => 'color_gradient',
                'transparent' => false,
                'title' => esc_html__('Extra Color Gradient', 'blueprint'),
                'subtitle' => esc_html__('Applicable theme elements will have the option to choose this as a color (i.e. buttons, icons etc..)', 'blueprint'),
                'desc' => '',
                'default'  => array(
                    'from' => '#3452ff',
                    'to'   => '#ff1053'
                ),
            ),

             array(
                'id' => 'extra-color-gradient-2',
                'type' => 'color_gradient',
                'transparent' => false,
                'title' => esc_html__('Extra Color Gradient #2', 'blueprint'),
                'subtitle' => esc_html__('Applicable theme elements will have the option to choose this as a color (i.e. buttons, icons etc..)', 'blueprint'),
                'desc' => '',
                'default'  => array(
                    'from' => '#2AC4EA',
                    'to'   => '#32d6ff'
                ),
            ),

        )
    ) );



     Redux::setSection( $opt_name, array(
        'id'               => 'boxed-layout',
        'customizer_width' => '450px',
        'icon' => 'el el-website',
        'title' => esc_html__('Boxed Layout', 'blueprint'),
        'desc' => esc_html__('All boxed layout related options are listed here.', 'blueprint'),
        'fields'           => array(
             array(
                'id' => 'boxed_layout',
                'type' => 'switch',
                'title' => esc_html__('Enable Boxed Layout?', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'next_to_hide' => '6',
                'default' => '0'
            ),
            array(
                'id' => 'background-color',
                'type' => 'color',
                'title' => esc_html__('Background Color', 'blueprint'),
                'subtitle' => esc_html__('If you would rather simply use a solid color for your background, select one here.', 'blueprint'),
                'desc' => '',
                'transparent' => false,
                'required' => array( 'boxed_layout', '=', '1' ),
                'default' => '#f1f1f1'
            ),
            array(
                'id' => 'background_image',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'blueprint'),
                'subtitle' => esc_html__('Upload your background here', 'blueprint'),
                'required' => array( 'boxed_layout', '=', '1' ),
                'desc' => ''
            ),
            array(
                'id' => 'background-repeat',
                'type' => 'select',
                'title' => esc_html__('Background Repeat', 'blueprint'),
                'subtitle' => esc_html__('Do you want your background to repeat? (Turn on when using patterns)', 'blueprint'),
                'required' => array( 'boxed_layout', '=', '1' ),
                'options' => array(
                    "no-repeat" => esc_html__('No-Repeat', 'blueprint'),
                    "repeat" => esc_html__('Repeat', 'blueprint'),
                )
            ),
            array(
                'id' => 'background-position',
                'type' => 'select',
                'title' => esc_html__('Background Position', 'blueprint'),
                'subtitle' => esc_html__('How would you like your background image to be aligned?', 'blueprint'),
                'required' => array( 'boxed_layout', '=', '1' ),
                'options' => array(
                    "left top" => "Left Top",
                     "left center" => "Left Center",
                     "left bottom" => "Left Bottom",
                     "center top" => "Center Top",
                     "center center" => "Center Center",
                     "center bottom" => "Center Bottom",
                     "right top" => "Right Top",
                     "right center" => "Right Center",
                     "right bottom" => "Right Bottom"
                )
            ),
            array(
                'id' => 'background-attachment',
                'type' => 'select',
                'title' => esc_html__('Background Attachment', 'blueprint'),
                'subtitle' => esc_html__('Would you prefer your background to scroll with your site or be fixed and not move', 'blueprint'),
                'required' => array( 'boxed_layout', '=', '1' ),
                'options' => array(
                    "scroll" => "Scroll",
                    "fixed" => "Fixed"
                )
            ),
            array(
                'id' => 'background-cover',
                'type' => 'switch',
                'title' => esc_html__('Auto resize background image to fit window?', 'blueprint'),
                'subtitle' => esc_html__('This will ensure your background image always fits no matter what size screen the user has. (Don\'t use with patterns)', 'blueprint'),
                'required' => array( 'boxed_layout', '=', '1' ),
                'desc' => '',
                'default' => '0'
            ),

        )
    ) );


     // -> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'redux-framework-demo' ),
        'id'     => 'typography',
        'desc'   => esc_html__( 'All typography related options are listed here', 'redux-framework-demo' ),
        'icon'   => 'el el-font',
        'fields' => array(

        )
    ) );


    $republicpg_std_fonts = array(
        'Arial, sans-serif'                                    => 'Arial',
        'Cambria, Georgia, serif'                              => 'Cambria',
        'Copse, sans-serif'                                    => 'Copse',
        "Courier, monospace"                                   => "Courier, monospace",
        "Garamond, serif"                                      => "Garamond",
        "Georgia, serif"                                       => "Georgia",
        "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
        'Helvetica, sans-serif'                                => 'Sans Serif',
        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
        "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
        "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
        "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
        "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
        "Tahoma,Geneva, sans-serif"                            => "Tahoma",
        "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
        "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        'Lovelo, sans-serif' => 'Lovelo'
    );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Navigation & Page Header', 'redux-framework-demo' ),
        'id'               => 'typography-slider',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id' => 'extended-theme-font',
                'type' => 'checkbox',
                'title' => esc_html__('Load Ext. Characters in Default Font', 'blueprint'),
                'subtitle' => esc_html__('Check this option if you wish to use ext latin characters in the default theme font', 'blueprint'),
                'default' => '0'
            ),

            array(
                'id'       => 'navigation_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Navigation Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Navigation font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),
            array(
                'id'       => 'navigation_dropdown_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Navigation Dropdown Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Navigation Dropdown font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'compiler' => true,
                'default'  => array()
            ),


            array(
                'id'       => 'page_heading_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Page Heading Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Page Heading font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'page_heading_subtitle_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Page Heading Subtitle Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Page Heading Subtitle font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

             array(
                'id'       => 'off_canvas_nav_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Off Canvas Navigation', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Off Canvas Navigation properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

             array(
                'id'       => 'off_canvas_nav_subtext_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Off Canvas Navigation Sub Text', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Off Canvas Navigation Sub Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General HTML elements', 'redux-framework-demo' ),
        'id'               => 'typography-general',
        'subsection'       => true,
        'fields'           => array(
             array(
                'id'       => 'body_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Body font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()

            ),
             array(
                'id'       => 'h1_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading 1', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the H1 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'h2_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading 2', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the H2 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

              array(
                'id'       => 'h3_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading 3', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the H3 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'h4_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading 4', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the H4 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'h5_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading 5', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the H5 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'h6_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading 6', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the H6 Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'i_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Italic', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the italic Text properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

             array(
                'id'       => 'label_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Form Labels', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Form Label properties. When using the "Material" theme skin, sidebar links will inherit this as well.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),
        )
    ) );

 Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Republicpg Specific elements', 'redux-framework-demo' ),
        'id'               => 'typography-republicpg',
        'subsection'       => true,
        'fields'           => array(

              array(
                'id'       => 'republicpg_slider_heading_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Republicpg/Home Slider Heading Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Republicpg Slider Heading font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'home_slider_caption_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Republicpg/Home Slider Caption Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Republicpg Slider Caption font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),


              array(
                'id'       => 'testimonial_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Testimonial Slider/Blockquote Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Testimonial Slider/Blockquote font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'all_styles'  => false,
                'fonts' =>  $republicpg_std_fonts,
                'default'  => array()
            ),

            array(
                'id'       => 'sidebar_footer_h_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Sidebar, Carousel, Republicpg Button & Footer Headers Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Sidebar, Carousel, Republicpg Button & Footer Headers font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

            array(
                'id'       => 'portfolio_filters_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Portfolio Filters', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Portfolio filter font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

            array(
                'id'       => 'portfolio_caption_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Portfolio Caption/Excerpt', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Portfolio project caption/excerpt font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

             array(
                'id'       => 'team_member_h_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Sub-headers & Team Member Names Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the Sub-headers & Team Member Name properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

            array(
                'id'       => 'republicpg_dropcap_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Dropcap', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the dropcap font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

            array(
                'id'       => 'republicpg_sidebar_footer_headers_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'Sidebar/Footer Headers', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the font properties for headers used in sidebars & the footer.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

            array(
                'id'       => 'republicpg_woo_shop_product_title_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'WooCommerce Product Title Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the WooCommerce Product Title font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),

            array(
                'id'       => 'republicpg_woo_shop_product_secondary_font_family',
                'type'     => 'typography',
                'title'    => esc_html__( 'WooCommerce Product Secondary Font', 'redux-framework-demo' ),
                'subtitle' => esc_html__( 'Specify the WooCommerce Product Secondary font properties.', 'redux-framework-demo' ),
                'google'   => true,
                'fonts' =>  $republicpg_std_fonts,
                'all_styles'  => false,
                'default'  => array()
            ),


        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Responsive Settings', 'redux-framework-demo' ),
        'id'               => 'typography-responsive',
        'subsection'       => true,
        'fields'           => array(

            array(
                'id' => 'use-responsive-heading-typography',
                'type' => 'switch',
                'title' => esc_html__('Custom Responsive Headings', 'blueprint'),
                'subtitle' => esc_html__('If left off, Blueprint will calculate the responsive typography settings for your h1-h6 tags & body automatically.', 'blueprint'),
                'desc' => ''
            ),

            array(
                'id'    => 'info-use-responsive-heading-typography',
                'type'  => 'info',
                'style' => 'success',
                'title' => esc_html__('How These Settings Work',  'blueprint'),
                'icon'  => 'el el-info-circle',
                'required' => array( 'use-responsive-heading-typography', '=', '1' ),
                'desc'  => esc_html__( 'Set the amount (in %) you would like each heading tag to decrease by for every viewport. For example, a value of "100" would mean the font stays at 100% of the font size defined and a value of "50" would mean the font shrinks to "50%" of the font size defined. Note: these will apply to all heading tags defined by you throughout your site, but some Republicpg Elements will override the sizing within themselves.',  'blueprint')
            ),

            array(
                'id'        => 'h1-small-desktop-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H1 Small Desktop', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 75,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h1-tablet-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H1 Tablet', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 70,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h1-phone-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H1 Phone', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 65,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'   =>'responsive-heading-typography-divider-1',
                'desc' => '',
                'type' => 'divide',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),



            array(
                'id'        => 'h2-small-desktop-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H2 Small Desktop', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 85,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h2-tablet-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H2 Tablet', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 80,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h2-phone-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H2 Phone', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 70,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'   =>'responsive-heading-typography-divider-2',
                'desc' => '',
                'type' => 'divide',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),


            array(
                'id'        => 'h3-small-desktop-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H3 Small Desktop', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 85,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h3-tablet-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H3 Tablet', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 80,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h3-phone-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H3 Phone', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 70,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'   =>'responsive-heading-typography-divider-3',
                'desc' => '',
                'type' => 'divide',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),


            array(
                'id'        => 'h4-small-desktop-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H4 Small Desktop', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h4-tablet-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H4 Tablet', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 90,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h4-phone-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H4 Phone', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 90,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'   =>'responsive-heading-typography-divider-4',
                'desc' => '',
                'type' => 'divide',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),



            array(
                'id'        => 'h5-small-desktop-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H5 Small Desktop', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h5-tablet-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H5 Tablet', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h5-phone-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H5 Phone', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'   =>'responsive-heading-typography-divider-5',
                'desc' => '',
                'type' => 'divide',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),



             array(
                'id'        => 'h6-small-desktop-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H6 Small Desktop', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h6-tablet-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H6 Tablet', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'h6-phone-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('H6 Phone', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'   =>'responsive-heading-typography-divider-6',
                'desc' => '',
                'type' => 'divide',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'body-small-desktop-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('Body Font Small Desktop', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'body-tablet-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('Body Font Tablet', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),

            array(
                'id'        => 'body-phone-font-size',
                'type'      => 'slider',
                'title'     => esc_html__('Body Font Phone', 'blueprint'),
                'subtitle'  => '',
                'desc'      => '',
                "default"   => 100,
                "min"       => 10,
                "step"      => 5,
                "max"       => 100,
                'display_value' => 'text',
                'required' => array( 'use-responsive-heading-typography', '=', '1' )
            ),




        )
    ) );




     Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Header Navigation', 'redux-framework-demo' ),
        'id'     => 'header-nav',
        'desc'   => esc_html__( 'All header navigation related options are listed here.', 'redux-framework-demo' ),
        'icon'   => 'el el-lines',
        'fields' => array(

        )
    ) );




Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Logo & General Styling', 'redux-framework-demo' ),
        'id'               => 'header-nav-general',
        'subsection'       => true,
        'fields'           => array(

             array(
                'id' => 'use-logo',
                'type' => 'switch',
                'title' => esc_html__('Use Image for Logo?', 'blueprint'),
                'subtitle' => esc_html__('If left unchecked, plain text will be used instead (generated from site name).', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'title' => esc_html__('Logo Upload', 'blueprint'),
                'subtitle' => esc_html__('Upload your logo here and enter the height of it below.','blueprint') . '<br/><br/>' .  esc_html__('Note: there are additional logo upload fields in the transparent header effect tab.', 'blueprint'),
                'required' => array( 'use-logo', '=', '1' ),
                'desc' => ''
            ),
            array(
                'id' => 'retina-logo',
                'type' => 'media',
                'title' => esc_html__('Retina Logo Upload', 'blueprint'),
                'subtitle' => esc_html__('Upload at exactly 2x the size of your standard logo. Supplying this will keep your logo crisp on screens with a higher pixel density.', 'blueprint'),
                'desc' => '' ,
                 'required' => array( 'use-logo', '=', '1' )
            ),
            array(
                'id' => 'logo-height',
                'type' => 'text',
                'title' => esc_html__('Logo Height', 'blueprint'),
                'subtitle' => esc_html__('Don\'t include "px" in the string. e.g. 30', 'blueprint'),
                'desc' => '',
                'validate' => 'numeric',
                 'required' => array( 'use-logo', '=', '1' ),
            ),
            array(
                'id' => 'mobile-logo-height',
                'type' => 'text',
                'title' => esc_html__('Mobile Logo Height', 'blueprint'),
                'subtitle' => esc_html__('Don\'t include "px" in the string. e.g. 24', 'blueprint'),
                'desc' => '',
                 'required' => array( 'use-logo', '=', '1' ),
                'validate' => 'numeric'
            ),

            array(
                'id' => 'mobile-logo',
                'type' => 'media',
                'title' => esc_html__('Mobile Only Logo Upload', 'blueprint'),
                'subtitle' => esc_html__('An optional field that allows you to display a separate logo that will be shown on mobile devices only.', 'blueprint'),
                'required' => array( 'use-logo', '=', '1' ),
                'desc' => ''
            ),

            array(
                'id' => 'header-padding',
                'type' => 'text',
                'title' => esc_html__('Header Padding', 'blueprint'),
                'subtitle' => esc_html__('Don\'t include "px" in the string. e.g. 28', 'blueprint'),
                'desc' => '',
                'validate' => 'numeric'
            ),



             array(
                'id' => 'header-remove-fixed',
                'type' => 'switch',
                'title' => esc_html__('Header Remove Desktop Stickiness', 'blueprint'),
                'subtitle' => esc_html__('By default your header will always remain at the top of the screen even when scrolling down the page. Enabling this will remove that functionality and cause it to stay at the top of the page.', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),

             array(
                'id' => 'header-mobile-fixed',
                'type' => 'switch',
                'title' => esc_html__('Header Sticky On Mobile', 'blueprint'),
                'subtitle' => esc_html__('Do you want the header to be sticky on mobile devices?', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '1'
            ),

             array(
                'id'        => 'header-menu-mobile-breakpoint',
                'type'      => 'slider',
                'title'     => esc_html__('Mobile Breakpoint', 'blueprint'),
                'subtitle'  => esc_html__('Define at what window size (in px) the header navigation menu will collapse into the mobile menu style - larger values are useful when you have navigations with many items which wouldn\'t fit on one line when viewed on small desktops/laptops.', 'blueprint'),
                'desc'      => '',
                "default"   => 1000,
                "min"       => 1000,
                "step"      => 10,
                "max"       => 1450,
                'display_value' => 'text'
            ),
             array(
                'id' => 'header-box-shadow',
                'type' => 'select',
                'title' => esc_html__('Header Box Shadow', 'blueprint'),
                'subtitle' => esc_html__('Please select your header box shadow here.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'small' => esc_html__('Small', 'blueprint'),
                    'large' => esc_html__('Large', 'blueprint'),
                    'none' => esc_html__('None', 'blueprint')
                ),
                'default' => 'small'
            ),
             array(
                'id'        => 'header-menu-item-spacing',
                'type'      => 'slider',
                'title'     => esc_html__('Menu Item Spacing', 'blueprint'),
                'subtitle'  => esc_html__('Set the padding that will display on each side of your header menu items - space will be set in pixels.', 'blueprint'),
                'desc'      => '',
                "default"   => 10,
                "min"       => 8,
                "step"      => 1,
                "max"       => 50,
                'display_value' => 'label'
            ),
              array(
                'id' => 'header-bg-opacity',
                'type'      => 'slider',
                'title'     => esc_html__('Header BG Opacity', 'blueprint'),
                'subtitle'  => esc_html__('Please set your header BG opacity here.', 'blueprint'),
                'desc'      => '',
                "default"   => 100,
                "min"       => 1,
                "step"      => 1,
                "max"       => 100,
                'hint' => array('content' => 'If you are trying to have your header navigation completely see through before scrolling, setting this very low is not how to achieve it. The fully transparent style as shown on many of the demos is the option titled <b>Use Transparent Header When Applicable</b> which is available in the Header Navigation ~ Transparent Header Effect tab.', 'title' => ''),
                'display_value' => 'label'
            ),

            array(
                'id' => 'header-color',
                'type' => 'select',
                'title' => esc_html__('Header Color Scheme', 'blueprint'),
                'subtitle' => esc_html__('Please select your header color scheme here. Color pickers below will only be used when using "Custom" for the color scheme.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'light' => esc_html__('Light', 'blueprint'),
                    'dark' => esc_html__('Dark', 'blueprint'),
                    'custom' => esc_html__('Custom', 'blueprint')
                ),
                'hint' => array('content' => 'Blueprint will use the accent color with the light/dark schemes. To create your own color scheme and use the color pickers below, ensure that you choose <strong>Custom</strong>.', 'title' => ''),
                'default' => 'light'
            ),


            array(
                'id' => 'header-background-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Header Background', 'blueprint'),
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#ffffff'
            ),

            array(
                'id' => 'header-font-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Header Font', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#888888'
            ),

            array(
                'id' => 'header-font-hover-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Header Font Hover', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#27CCC0'
            ),

            array(
                'id' => 'header-dropdown-background-color',
                'type' => 'color',
                'title' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'subtitle' => esc_html__('Dropdown Background', 'blueprint'),
                'desc' => '',
                'default' => '#1F1F1F'
            ),

            array(
                'id' => 'header-dropdown-background-hover-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Dropdown Background Hover', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#313233'
            ),

            array(
                'id' => 'header-dropdown-font-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Dropdown Font', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#CCCCCC'
            ),

            array(
                'id' => 'header-dropdown-font-hover-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Dropdown Font Hover', 'blueprint'),
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#27CCC0'
            ),

            array(
                'id' => 'header-dropdown-heading-font-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Mega Menu Heading Font', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),

            array(
                'id' => 'header-dropdown-heading-font-hover-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Mega Menu Heading Font Hover', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),

            array(
                'id' => 'header-separator-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Header Separators', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#eeeeee'
            ),

            array(
                'id' => 'secondary-header-background-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('2nd Header Background', 'blueprint'),
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#F8F8F8'
            ),

            array(
                'id' => 'secondary-header-font-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('2nd Header Font', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#666666'
            ),

            array(
                'id' => 'secondary-header-font-hover-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('2nd Header Font Hover', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#222222'
            ),

             array(
                'id' => 'header-slide-out-widget-area-background-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Off Canvas Navigation Background', 'blueprint'),
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#3452ff'
            ),

             array(
                'id' => 'header-slide-out-widget-area-background-color-2',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Off Canvas Navigation Background 2 (Used for gradient)', 'blueprint'),
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => ''
            ),


             array(
                'id' => 'header-slide-out-widget-area-header-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Off Canvas Navigation Headers', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),

            array(
                'id' => 'header-slide-out-widget-area-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Off Canvas Navigation Text', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#eefbfa'
            ),

            array(
                'id' => 'header-slide-out-widget-area-hover-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Off Canvas Navigation Link Hover', 'blueprint'),
                'class' => 'five-columns',
                'transparent' => false,
                'desc' => '',
                'default' => '#ffffff'
            ),
            array(
                'id' => 'header-slide-out-widget-area-close-bg-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Off Canvas Navigation Close Button Background', 'blueprint'),
                'required' => array( 'theme-skin', '=', 'material') ,
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#ff1053'
            ),
            array(
                'id' => 'header-slide-out-widget-area-close-icon-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Off Canvas Navigation Close Button Icon', 'blueprint'),
                'required' => array( 'theme-skin', '=', 'material') ,
                'desc' => '',
                'class' => 'five-columns',
                'transparent' => false,
                'default' => '#ffffff'
            ),


        )
    ) );





Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Layout Related', 'redux-framework-demo' ),
        'id'               => 'header-nav-layout',
        'subsection'       => true,
        'fields'           => array(


            array(
                'id' => 'header_format',
                'type' => 'image_select',
                'title' => esc_html__('Header Layout', 'blueprint'),
                'subtitle' => esc_html__('Please select the layout you desire.', 'blueprint'),
                'desc' => '',
                'options' => array(
                      'default' => array('title' => 'Default Layout', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/default-header.png'),
                      'centered-menu' => array('title' => 'Centered Menu', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/centered-menu.png'),
                      'centered-menu-under-logo' => array('title' => 'Centered Menu Alt', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/centered-menu-under-logo.png'),
                      'centered-menu-bottom-bar' => array('title' => 'Centered Menu Bottom Bar', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/centered-menu-bottom-bar.png', 'tooltip' => 'Relies on the 	<b>&quot;Material&quot;</b> theme skin and will use that option even if not selected. <br/><br/> Top left: Social Icon Area <br/> Top right: Header Buttons <br/> Bottom: Navigation Links'),
                      'centered-logo-between-menu' => array('title' => 'Centered Logo Between Menu', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/centered-logo-menu.png'),
                      'menu-left-aligned' => array('title' => 'Menu Left Aligned', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/menu-left-aligned.png'),
                      'left-header' => array('title' => 'Left Header', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/fixed-left.png', 'tooltip' => 'Does not allow 	&quot;Transparency&quot; options, and some options in	&quot;Animation Effects&quot;')
                  ),
                'default' => 'default'
            ),
            array(
                'id' => 'header-fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Full Width Header', 'blueprint'),
                'subtitle' => esc_html__('Do you want the header to span the full width of the page?', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),

            array(
                'id' => 'header-disable-search',
                'type' => 'checkbox',
                'title' => esc_html__('Remove Header search', 'blueprint'),
                'subtitle' => esc_html__('Active to remove the search functionality from your header', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

             array(
                'id' => 'header-disable-ajax-search',
                'type' => 'checkbox',
                'title' => esc_html__('Disable AJAX from search', 'blueprint'),
                'subtitle' => esc_html__('This will turn off the autocomplete suggestions from appearing when typing in the search box.', 'blueprint'),
                'desc' => '',
                'required' => array( 'theme-skin', '!=', 'material'),
                'default' => '1'
            ),

            array(
                'id' => 'header-account-button',
                'type' => 'switch',
                'title' => esc_html__('Add User Account Button', 'blueprint'),
                'subtitle' => esc_html__('This will add a user account icon button within the button area of your header navigation', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),
            array(
               'id' => 'header-account-button-url',
               'type' => 'text',
               'title' => esc_html__('User Account Button URL', 'blueprint'),
               'required' => array( 'header-account-button', '=', '1' ),
               'subtitle' => esc_html__('Enter the URL of your user account button', 'blueprint'),
               'desc' => '',
               'default' => ''
            ),
             array(
                'id' => 'header_layout',
                'type' => 'select',
                'title' => esc_html__('Header Secondary Nav', 'blueprint'),
                'subtitle' => esc_html__('Please select your header layout here.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'standard' => esc_html__('Standard Header', 'blueprint'),
                    'header_with_secondary' => esc_html__('Header With Secondary Navigation', 'blueprint'),
                ),
                'default' => 'standard'
            ),

              array(
                  'id' => 'secondary-header-text',
                  'type' => 'text',
                  'title' => esc_html__('Secondary Header Text', 'blueprint'),
                  'required' => array( 'header_layout', '=', 'header_with_secondary' ),
                  'subtitle' => esc_html__('Add the text that you would like to appear in the secondary header.', 'blueprint'),
                  'desc' => ''
              ),
              array(
                  'id' => 'secondary-header-link',
                  'type' => 'text',
                  'title' => esc_html__('Secondary Header Link URL', 'blueprint'),
                  'required' => array( 'header_layout', '=', 'header_with_secondary' ),
                  'subtitle' => esc_html__('Please enter an optional URL for the secondary header text here.', 'blueprint'),
                  'desc' => ''
              ),

            array(
                'id' => 'enable_social_in_header',
                'type' => 'switch',
                'title' => esc_html__('Enable Social Icons?', 'blueprint'),
                'subtitle' => esc_html__('Do you want the your nav to display social icons? If using the secondary header navigation option, the icons will be displayed in that top bar instead of the main navigation.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
             array(
                'id' => 'use-facebook-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Facebook Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-twitter-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Twitter Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-google-plus-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Google+ Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-vimeo-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Vimeo Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
            ),
            array(
                'id' => 'use-dribbble-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Dribbble Icon', 'blueprint'),
                'subtitle' => '',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'desc' => ''
            ),
            array(
                'id' => 'use-pinterest-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Pinterest Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-youtube-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Youtube Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-tumblr-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Tumblr Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-linkedin-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use LinkedIn Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-rss-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use RSS Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-behance-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Behance Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-instagram-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Instagram Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-flickr-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Flickr Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-spotify-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use Spotify Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-github-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use GitHub Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-stackexchange-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use StackExchange Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-soundcloud-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use SoundCloud Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
             array(
                'id' => 'use-vk-icon-header',
                'type' => 'checkbox',
                'title' => esc_html__('Use VK Icon', 'blueprint'),
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vine-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Vine Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-houzz-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Houzz Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-yelp-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Yelp Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-mixcloud-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Mixcloud Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-snapchat-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Snapchat Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-bandcamp-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Bandcamp Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-tripadvisor-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Tripadvisor Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-telegram-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Telegram Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-slack-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Slack Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-medium-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Medium Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-email-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Email Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-phone-icon-header',
                'type' => 'checkbox',
                'required' => array( 'enable_social_in_header', '=', '1' ),
                'title' => esc_html__('Use Phone Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            )



        )
    ) );







     Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Transparent Header Effect', 'redux-framework-demo' ),
        'id'               => 'header-nav-transparency',
        'subsection'       => true,
        'fields'           => array(


            array(
                'id' => 'transparent-header',
                'type' => 'switch',
                'title' => esc_html__('Use Transparent Header When Applicable?', 'blueprint'),
                'subtitle' => esc_html__('If activated this will cause your header to be completely transparent before the user scrolls. Valid instances where this will get used include using a Page Header or using a Full width/screen Republicpg Slider at the top of a page.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

            array(
                'id' => 'header-starting-logo',
                'type' => 'media',
                'title' => esc_html__('Header Starting Logo Upload', 'blueprint'),
                'subtitle' => esc_html__('This will be used when the header is transparent before the user scrolls. (Will be swapped for the regualr logo upon scrolling)', 'blueprint'),
                'desc' => '' ,
                'required' => array( 'transparent-header', '=', '1' ),

            ),
            array(
                'id' => 'header-starting-retina-logo',
                'type' => 'media',
                'title' => esc_html__('Header Starting Retina Logo Upload', 'blueprint'),
                'subtitle' => esc_html__('Retina version of the header starting logo.', 'blueprint'),
                'required' => array( 'transparent-header', '=', '1' ),
                'desc' => ''
            ),

            array(
                'id' => 'header-starting-logo-dark',
                'type' => 'media',
                'title' => esc_html__('Header Starting Dark Logo Upload', 'blueprint'),
                'subtitle' => esc_html__('This will be used when on a Republicpg Slide set to use the dark text color and the header is transparent before the user scrolls. (If nothing is uploaded, the default logo will be used)', 'blueprint'),
                'desc' => '' ,
                'required' => array( 'transparent-header', '=', '1' ),
            ),
            array(
                'id' => 'header-starting-retina-logo-dark',
                'type' => 'media',
                'title' => esc_html__('Header Starting Dark Retina Logo Upload', 'blueprint'),
                'subtitle' => esc_html__('Retina version of the header starting dark logo.  (If nothing is uploaded, the default logo will be used)', 'blueprint'),
                'desc' => '',
                'required' => array( 'transparent-header', '=', '1' ),
            ),

            array(
                'id' => 'header-starting-color',
                'type' => 'color',
                'title' => esc_html__('Header Starting Text Color', 'blueprint'),
                'subtitle' => esc_html__('Please select the color you desire for your header text before the user scrolls', 'blueprint'),
                'desc' => '',
                'transparent' => false,
                'required' => array( 'transparent-header', '=', '1' ),
                'default' => '#ffffff'
            ),
            array(
                'id' => 'header-transparent-dark-color',
                'type' => 'color',
                'title' => esc_html__('Header Dark Text Color', 'blueprint'),
                'subtitle' => esc_html__('Please select the color you desire for your header navigation links when the dark header is triggered. This occurs on dark Republicpg Slides, dark rows when using permenant transparent etc.', 'blueprint'),
                'desc' => '',
                'transparent' => false,
                'required' => array( 'transparent-header', '=', '1' ),
                'default' => '#000000'
            ),
            array(
                'id' => 'header-permanent-transparent',
                'type' => 'switch',
                'title' => esc_html__('Header Permanent Transparent', 'blueprint'),
                'subtitle' => esc_html__('Turning this on will allow your header to remain transparent even after scroll down', 'blueprint'),
                'required' => array( array( 'transparent-header', '=', '1' ), array( 'header_format', '!=', 'centered-menu-bottom-bar' ) ),
                'desc' => '',
                'hint' => array('content' => 'Your navigation will alternate between dark and light color schemes based on the intersecting row. When editing your pages, every row in the page builder has a field for <b>Text Color</b> to set this.', 'title' => ''),
                'default' => '0'
            ),
            array(
                'id' => 'header-inherit-row-color',
                'type' => 'switch',
                'title' => esc_html__('Header Inherit Row Color', 'blueprint'),
                'subtitle' => esc_html__('Turning this on will allow your header to take on the background color of the row that it passes.', 'blueprint'),
                'desc' => '',
                'hint' => array('content' => 'Hint: The navigation logo and links will alternative between dark and light based on what the intersecting row has set. When editing your pages, every row in the page builder has a field for <b>Text Color</b> to set this.', 'title' => ''),
                'switch' => true,
                'required' => array( array( 'transparent-header', '=', '1' ), array( 'header_format', '!=', 'centered-menu-bottom-bar' ) ),
                'default' => '0'
            ),
            array(
                'id' => 'header-remove-border',
                'type' => 'switch',
                'title' => esc_html__('Remove Border On Transparent Header', 'blueprint'),
                'subtitle' => esc_html__('Turning this on will remove the border that normally appears with the transparent header', 'blueprint'),
                'desc' => '',
                'required' => array( array( 'transparent-header', '=', '1' ), array( 'theme-skin', '!=', 'material') ),
                'default' => '0'
            ),
            array(
                'id' => 'transparent-header-shadow-helper',
                'type' => 'switch',
                'title' => esc_html__('Add Shadow Behind Transparent Header', 'blueprint'),
                'subtitle' => esc_html__('If activated this will add a subtle shadow behind your transparent header to help with the visibility of your navigation items.', 'blueprint'),
                'desc' => '',
                'required' => array( 'transparent-header', '=', '1' ),
                'default' => '0'
            ),


        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Animation Effects', 'redux-framework-demo' ),
        'id'               => 'header-nav-animation-effects',
        'subsection'       => true,
        'fields'           => array(


            array(
                'id' => 'header-hover-effect',
                'type' => 'select',
                'title' => esc_html__('Header Link Hover/Active Effect', 'blueprint'),
                'subtitle' => esc_html__('Please select your header link hover/active effect here.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'default' => esc_html__('Color Change', 'blueprint'),
                    'animated_underline' => esc_html__('Animated Underline', 'blueprint')
                ),
                'default' => 'animated_underline'
            ),
            array(
                'id' => 'header-hide-until-needed',
                'type' => 'switch',
                'title' => esc_html__('Header Hide Until Needed', 'blueprint'),
                'subtitle' => esc_html__('Do you want the header to be hidden after scrolling until needed? i.e. the user scrolls back up towards the top', 'blueprint'),
                'desc' => '',
                'required' => array( 'header_format', '!=', 'centered-menu-bottom-bar' ),
                'default' => ''
            ),

             array(
                'id' => 'header-resize-on-scroll',
                'type' => 'switch',
                'title' => esc_html__('Header Resize On Scroll', 'blueprint'),
                'subtitle' => esc_html__('Do you want the header to shrink a little when you scroll?', 'blueprint'),
                'desc' => '',
                'required' => array( 'header_format', '!=', 'centered-menu-bottom-bar' ),
                'default' => '1' ,
                'hint' => array('content' => 'This will only be active when the <b>Header Hide Until Needed</b> effect is turned off', 'title' => ''),
            ),
            array(
                'id' => 'header-resize-on-scroll-shrink-num',
                'type' => 'text',
                'title' => esc_html__('Header Logo Shrink Number (in px)', 'blueprint'),
                'subtitle' => esc_html__('Don\'t include "px" in the string. e.g. 6', 'blueprint'),
                'desc' => '',
                 'required' => array( 'header-resize-on-scroll', '=', '1' ),
                'validate' => 'numeric'
            ),

            array(
                'id' => 'condense-header-on-scroll',
                'type' => 'switch',
                'title' => esc_html__('Condense Header On Scroll', 'blueprint'),
                'subtitle' => esc_html__('Adds the logo/header buttons into the bottom nav bar when scrolling. Uses the "Mobile Only Logo" if supplied. This option is specific to "Centered Menu Bottom Bar" Header Format', 'blueprint'),
                'desc' => '',
                'required' => array( 'header_format', '=', 'centered-menu-bottom-bar' ),
                'default' => ''
            ),



        )
    ) );


Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Dropdown/Megamenu', 'redux-framework-demo' ),
        'id'               => 'header-nav-dropdowns',
        'subsection'       => true,
        'fields'           => array(



             array(
                'id' => 'header-dropdown-style',
                'type' => 'select',
                'title' => esc_html__('Header Dropdown Style', 'blueprint'),
                'subtitle' => esc_html__('Please select the style that will be used for submenus in your main navigation', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'classic' => esc_html__('Classic', 'blueprint'),
                    'minimal' => esc_html__('Minimal', 'blueprint')
                ),
                'default' => 'classic'
            ),

            array(
                'id' => 'header-dropdown-opacity',
                'type'      => 'slider',
                'title'     => esc_html__('Header Dropdown Opacity', 'blueprint'),
                'subtitle'  => esc_html__('Please select your dropdown opacity here', 'blueprint'),
                'desc'      => '',
                "default"   => 100,
                "min"       => 1,
                "step"      => 1,
                "max"       => 100,
                'display_value' => 'label'
            ),

            array(
                'id' => 'header-dropdown-arrows',
                'type' => 'select',
                'title' => esc_html__('Header Dropdown Arrows', 'blueprint'),
                'subtitle' => esc_html__('Please choose whether you would like your dropdowns to show a down arrow.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'inherit' => esc_html__('Inherit From Theme Skin', 'blueprint'),
                    'show' => esc_html__('Show Arrow', 'blueprint'),
                    'dont_show' => esc_html__('Don\'t Show Arrow', 'blueprint')
                ),
                'default' => 'inherit'
            ),

            array(
                'id' => 'header-megamenu-width',
                'type' => 'select',
                'title' => esc_html__('Header Mega Menu Width', 'blueprint'),
                'subtitle' => esc_html__('Please choose whether you would like your megamenu to be constraiuned to the same width of the header container or if you would prefer to be the full width of the page.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'contained' => esc_html__('Contained To Header Item Width', 'blueprint'),
                    'full-width' => esc_html__('Full Screen Width', 'blueprint')
                ),
                'default' => 'contained'
            ),

            array(
                'id' => 'header-megamenu-remove-transparent',
                'type' => 'switch',
                'title' => esc_html__('Megamenu Removes Transparent Header', 'blueprint'),
                'subtitle' => esc_html__('This will cause your header navigation to temporarily disable the transparent effect when your megamenu is open', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),



        )
    ) );


Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Off Canvas Navigation', 'redux-framework-demo' ),
        'id'               => 'header-nav-off-canvas-navigation',
        'subsection'       => true,
        'fields'           => array(

          array(
                'id' => 'header-slide-out-widget-area',
                'type' => 'switch',
                'title' => esc_html__('Off Canvas Menu', 'blueprint'),
                'subtitle' => esc_html__('This will add a header link that reveals an off canvas menu', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

          array(
                'id' => 'header-slide-out-widget-area-style',
                'type' => 'select',
                'title' => esc_html__('Off Canvas Menu Style', 'blueprint'),
                'subtitle' => esc_html__('Please select your off canvas menu style here. The "Slide Out From Right Hover Triggered" style will force the "Full Width Header" option regardless of your selection.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'slide-out-from-right' => esc_html__('Slide Out From Right', 'blueprint'),
                    'slide-out-from-right-hover' => esc_html__('Slide Out From Right Hover Triggered', 'blueprint'),
                    'fullscreen' => esc_html__('Fullscreen Cover Slide + Blur BG', 'blueprint'),
                    'fullscreen-alt' => esc_html__('Fullscreen Cover Fade', 'blueprint')
                ),
                'default' => 'slide-out-from-right',
            ),
          array(
              'id' => 'header-slide-out-widget-area-dropdown-behavior',
              'type' => 'select',
              'title' => esc_html__('Off Canvas Menu Dropdown Behavior', 'blueprint'),
              'subtitle' => esc_html__('Please select the functionality for how dropdowns will behave in your off canvas menu', 'blueprint'),
              'desc' => '',
              'options' => array(
                  'default' => esc_html__('Dropdown Parent Link Toggles Submenu', 'blueprint'),
                  'separate-dropdown-parent-link' => esc_html__('Separate Dropdown Parent Link From Dropdown Toggle', 'blueprint')
              ),
              'default' => 'default',
              'required' => array(  array('header-slide-out-widget-area-style', '!=', 'fullscreen'), array('header-slide-out-widget-area-style', '!=', 'fullscreen-alt' ) ),
          ),

            array(
                'id' => 'header-slide-out-widget-area-social',
                'type' => 'switch',
                'title' => esc_html__('Off Canvas Menu Add Social', 'blueprint'),
                'subtitle' => esc_html__('This will add the social links you have links set for in the "Social Media" tab to your off canvas menu', 'blueprint'),
                'desc' => '',
                'default' => '0' ,
                  'required' => array( 'header-slide-out-widget-area', '=', '1' ),
            ),
             array(
                'id' => 'header-slide-out-widget-area-bottom-text',
                'type' => 'text',
                'title' => esc_html__('Off Canvas Menu Bottom Text', 'blueprint'),
                 'required' => array( 'header-slide-out-widget-area', '=', '1' ),
                'subtitle' => esc_html__('This will add some text fixed at the bottom of your off canvas menu - useful for copyright or quick contact info etc.', 'blueprint'),
                'desc' => '',
                'default' => ''
            ),
            array(
                'id' => 'header-slide-out-widget-area-overlay-opacity',
                'type' => 'select',
                'title' => esc_html__('Off Canvas Menu Overlay Strength', 'blueprint'),
                'subtitle' => esc_html__('Please select your Slide Out Widget Area overlay strength here.', 'blueprint'),
                'desc' => '',
                 'required' => array( 'header-slide-out-widget-area', '=', '1' ),
                'options' => array(
                    'solid' => esc_html__('Solid', 'blueprint'),
                    'dark' => esc_html__('Dark', 'blueprint'),
                    'medium' => esc_html__('Medium', 'blueprint'),
                    'light' => esc_html__('Light', 'blueprint')
                ),
                'default' => 'dark'
            ),
            array(
                'id' => 'header-slide-out-widget-area-top-nav-in-mobile',
                'type' => 'switch',
                  'required' => array( 'header-slide-out-widget-area', '=', '1' ),
                'title' => esc_html__('Off Canvas Menu Mobile Nav Menu items', 'blueprint'),
                'subtitle' => esc_html__('This will cause your off canvas menu to inherit any navigation items assigned in your "Top Navigation" menu location when viewing on a mobile device', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),


        )
    ) );




     Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Footer', 'redux-framework-demo' ),
        'id'     => 'footer',
        'desc'   => esc_html__( 'All footer related options are listed here.', 'redux-framework-demo' ),
        'icon'   => 'el el-file',
        'fields' => array(
             array(
                'id' => 'enable-main-footer-area',
                'type' => 'switch',
                'title' => esc_html__('Main Footer Area', 'blueprint'),
                'subtitle' => esc_html__('Do you want use the main footer that contains all the widgets areas?', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),

            array(
                'id' => 'footer_columns',
                'type' => 'image_select',
                'required' => array( 'enable-main-footer-area', '=', '1' ),
                'title' => esc_html__('Footer Columns', 'blueprint'),
                'subtitle' => esc_html__('Please select the number of columns you would like for your footer. Note: using the 1 Column layout will also center the copyright area.', 'blueprint'),
                'desc' => '',
                'options' => array(
                                '1' => array('title' => '1 Column Centered', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/1colg.png'),
                                '2' => array('title' => '2 Columns', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/2col.png'),
                                '3' => array('title' => '3 Columns', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/3col.png'),
                                '4' => array('title' => '4 Columns', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/4col.png'),
                                '5' => array('title' => '4 Columns Alt', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/4colalt.png')
                            ),
                'default' => '4'
            ),

            array(
                'id' => 'footer-custom-color',
                'type' => 'switch',
                'title' => esc_html__('Custom Footer Color Scheme', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

            array(
                'id' => 'footer-background-color',
                'type' => 'color',
                'title' => '',
                'subtitle' => esc_html__('Footer Background Color', 'blueprint'),
                'desc' => '',
                'required' => array( 'footer-custom-color', '=', '1' ),
                'class' => 'five-columns always-visible',
                'default' => '#313233',
                'transparent' => false
            ),

            array(
                'id' => 'footer-font-color',
                'type' => 'color',
                'title' => '',
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'subtitle' => esc_html__('Footer Font Color', 'blueprint'),
                'class' => 'five-columns always-visible',
                'desc' => '',
                'default' => '#CCCCCC',
                'transparent' => false
            ),

            array(
                'id' => 'footer-secondary-font-color',
                'type' => 'color',
                'title' => '',
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'subtitle' => esc_html__('2nd Footer Font Color', 'blueprint'),
                'class' => 'five-columns always-visible',
                'desc' => '',
                'default' => '#777777',
                'transparent' => false
            ),

            array(
                'id' => 'footer-copyright-background-color',
                'type' => 'color',
                'title' => '',
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'class' => 'five-columns always-visible',
                'subtitle' => esc_html__('Copyright Background Color', 'blueprint'),
                'desc' => '',
                'default' => '#1F1F1F',
                'transparent' => false
            ),

            array(
                'id' => 'footer-copyright-font-color',
                'type' => 'color',
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'title' => '',
                'class' => 'five-columns always-visible',
                'subtitle' => esc_html__('Footer Copyright Font Color', 'blueprint'),
                'desc' => '',
                'default' => '#777777',
                'transparent' => false
            ),
            array(
                'id' => 'footer-copyright-icon-hover-color',
                'type' => 'color',
                 'required' => array( 'footer-custom-color', '=', '1' ),
                'title' => '',
                'class' => 'five-columns always-visible',
                'subtitle' => esc_html__('Footer Copyright Icon  Hover Color', 'blueprint'),
                'desc' => '',
                'default' => '#ffffff',
                'transparent' => false
            ),
              array(
                'id' => 'footer-copyright-line',
                'type' => 'switch',
                'title' => esc_html__('Footer Add Line Above Copyright', 'blueprint'),
                'subtitle' => esc_html__('This will add a thin line to separate your footer widget area from the copyright section', 'blueprint'),
                'default' => ''
            ),

            array(
                'id' => 'footer-full-width',
                'type' => 'switch',
                'title' => esc_html__('Footer Full Width', 'blueprint'),
                'subtitle' => esc_html__('This to cause your footer content to display full width.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),


             array(
                'id' => 'footer-reveal',
                'type' => 'switch',
                'title' => esc_html__('Footer Reveal Effect', 'blueprint'),
                'subtitle' => esc_html__('This to cause the footer to appear as though it\'s being reveal by the main content area when scrolling down to it', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

            array(
                'id' => 'footer-reveal-shadow',
                'type' => 'select',
                'required' => array( 'footer-reveal', '=', '1' ),
                'title' => esc_html__('Footer Reveal Shadow', 'blueprint'),
                'subtitle' => esc_html__('Please select the type of shadow you would like to appear on your footer', 'blueprint'),
                'options' => array(
                    "none" => "None",
                    "small" => "Small",
                    "large" => "Large",
                    "large_2" => "Large & same color as footer BG"
                ),
                'default' => 'none'
            ),

            array(
                'id' => 'footer-copyright-layout',
                'type' => 'select',
                'title' => esc_html__('Footer Copyright Layout', 'blueprint'),
                'subtitle' => esc_html__('Please select the layout you would like for your footer copyright area.', 'blueprint'),
                'options' => array(
                    "default" => "Determined by Footer Columns",
                    "centered" => "Centered",
                ),
                'default' => 'default'
            ),

             array(
                'id' => 'disable-copyright-footer-area',
                'type' => 'switch',
                'title' => esc_html__('Disable Footer Copyright Area', 'blueprint'),
                'subtitle' => esc_html__('This will hide the copyright bar in your footer', 'blueprint'),
                'desc' => '',
                'default' => ''
            ),

            array(
                'id' => 'footer-copyright-text',
                'type' => 'text',
                'title' => esc_html__('Footer Copyright Section Text', 'blueprint'),
                'subtitle' => esc_html__('Please enter the copyright section text. e.g. All Rights Reserved, Blueprint Inc.', 'blueprint'),
                'desc' => ''
            ),

             array(
                'id' => 'disable-auto-copyright',
                'type' => 'switch',
                'title' => esc_html__('Disable Automatic Copyright', 'blueprint'),
                'subtitle' => esc_html__('By default, your copyright section will say "© {YEAR} {SITENAME}" before the additional text you add above in the Footer Copyright Section Text input - This option allows you to remove that.', 'blueprint'),
                'desc' => ''
            ),

            array(
                'id' => 'footer-background-image',
                'type' => 'media',
                'title' => esc_html__('Footer Background Image', 'blueprint'),
                'subtitle' => esc_html__('Upload an image that will be used as the background image on your footer. ', 'blueprint'),
                'desc' => ''
            ),

            array(
                'id'        => 'footer-background-image-overlay',
                'type'      => 'slider',
                'title'     => esc_html__('Footer Background Overlay', 'blueprint'),
                'subtitle'  => esc_html__('Adjust the overlay opacity here - the overlay colors pulls from your defined footer background color.', 'blueprint'),
                'desc'      => '',
                "default"   => 0.8,
                "min"       => 0,
                "step"      => 0.1,
                "max"       => 1,
                "resolution" => 0.1,
                'display_value' => 'text'
            ),

            array(
                'id' => 'use-facebook-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Facebook Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-twitter-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Twitter Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-google-plus-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Google+ Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vimeo-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Vimeo Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-dribbble-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Dribbble Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-pinterest-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Pinterest Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-youtube-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Youtube Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-tumblr-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Tumblr Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-linkedin-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use LinkedIn Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-rss-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use RSS Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-behance-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Behance Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-instagram-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Instagram Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-flickr-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Flickr Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-spotify-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Spotify Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-github-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use GitHub Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-stackexchange-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use StackExchange Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-soundcloud-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use SoundCloud Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vk-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use VK Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-vine-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Vine Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-houzz-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Houzz Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-yelp-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Yelp Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-snapchat-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Snapchat Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-mixcloud-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Mixcloud Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-bandcamp-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Bandcamp Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-tripadvisor-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Tripadvisor Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-telegram-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Telegram Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-slack-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Slack Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            ),
            array(
                'id' => 'use-medium-icon',
                'type' => 'checkbox',
                'title' => esc_html__('Use Medium Icon', 'blueprint'),
                'subtitle' => '',
                'desc' => ''
            )
        )
    ) );





    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Page Transitions', 'redux-framework-demo' ),
        'id'               => 'page_transitions',
        'desc'             => esc_html__( 'All page transition options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'   => 'el el-refresh',
        'fields' => array(

            array(
                'id' => 'ajax-page-loading',
                'type' => 'switch',
                'title' => esc_html__('Animated Page Transitions', 'blueprint'),
                'subtitle' => esc_html__('This will enable an animation between loading your pages.', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),

             array(
                'id' => 'transition-method',
                'type' => 'select',
                'title' => esc_html__('Animated Transition Method', 'blueprint'),
                'subtitle' => '<b>'. esc_html__('Standard', 'blueprint') .'</b> '. esc_html__('will simulate the effect of AJAX loading and allow for the use of any plugins to function regularly (recommended).', 'blueprint') . '<br/> <br/> <b>' . esc_html__('AJAX', 'blueprint') . '</b> ' . esc_html__('won\'t work by default for pages that use plugins which rely on Javascript. (only for advanced users)', 'blueprint'),
                'options' => array(
                    "standard" => esc_html__('Standard','blueprint'),
                    "ajax" => esc_html__('AJAX','blueprint')
                ),
                'default' => 'standard'
            ),

              array(
                'id' => 'disable-transition-fade-on-click',
                'type' => 'switch',
                'title' => esc_html__('Disable Fade Out On Click', 'blueprint'),
                'subtitle' => esc_html__('This will disable the default functionality of your page fading out when clicking a link with the Standard transition method. Is useful if your page transitions are conflicting with third party plugins that take over certain anchors such as lighboxes.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

            array(
              'id' => 'disable-transition-on-mobile',
              'type' => 'switch',
              'title' => esc_html__('Disable Page Transitions On Mobile', 'blueprint'),
              'subtitle' => esc_html__('This will remove page transitions when viewed on a mobile device (produces faster loading)', 'blueprint'),
              'desc' => '',
              'required' => array( 'ajax-page-loading', '=', '1' ),
              'default' => '1'
          ),

            array(
                'id' => 'transition-effect',
                'type' => 'select',
                'title' => esc_html__('Transition Effect', 'blueprint'),
                'subtitle' => esc_html__('Please select your transition effect here', 'blueprint'),
                'options' => array(
                    "standard" => esc_html__('Fade with loading icon', 'blueprint'),
                    "center_mask_reveal" => esc_html__('Center mask reveal', 'blueprint'),
                    "horizontal_swipe_basic" => esc_html__('Horizontal basic swipe', 'blueprint'),
                    "horizontal_swipe" => esc_html__('Horizontal multi layer swipe', 'blueprint')
                ),
                'default' => 'standard'
            ),

            array(
                'id' => 'loading-icon',
                'type' => 'select',
                'required' => array( 'transition-effect', '=', 'standard' ),
                'title' => esc_html__('Loading Icon Style', 'blueprint'),
                'subtitle' => esc_html__('Select your loading icon style here', 'blueprint'),
                'options' => array(
                    "default" => esc_html__('Default', 'blueprint'),
                    "material" => esc_html__('Material Design', 'blueprint')
                ),
                'default' => 'material'
            ),
            array(
                'id' => 'loading-icon-colors',
                'type' => 'color_gradient',
                'transparent' => false,
                'title' => esc_html__('Loading Icon Coloring', 'blueprint'),
                'subtitle' => esc_html__('The icon will animate between the two colors - or just use the first if a second is not supplied.', 'blueprint'),
                'desc' => '',
                'required' => array( 'loading-icon', '=', 'material' ),
                'default'  => array(
                    'from' => '#3452ff',
                    'to'   => '#3452ff'
                ),
            ),
             array(
                'id' => 'loading-image',
                'type' => 'media',
                'required' => array( 'transition-effect', '=', 'standard' ),
                'title' => esc_html__('Custom Loading Image', 'blueprint'),
                'subtitle' => esc_html__('Upload a .png or .gif image that will be used in all applicable areas on your site as the loading image. ', 'blueprint'),
                'desc' => ''
            ),
             array(
                'id' => 'loading-image-animation',
                'type' => 'select',
                'required' => array( 'transition-effect', '=', 'standard' ),
                'title' => esc_html__('Loading Image CSS Animation', 'blueprint'),
                'subtitle' => esc_html__('This will add a css based animation onto your defined image', 'blueprint'),
                'options' => array(
                    "none" => esc_html__('Default', 'blueprint'),
                    "spin" => esc_html__('Smooth Spin', 'blueprint')
                ),
                'default' => 'none'
            ),
             array(
                'id' => 'transition-bg-color',
                'type' => 'color',
                'title' => esc_html__('Page Transition BG Color', 'blueprint'),
                'subtitle' =>  esc_html__('Use this to define the color of your page transition background.', 'blueprint'),
                'desc' => '',
                'default' => '',
                'transparent' => false
            ),
              array(
                'id' => 'transition-bg-color-2',
                'type' => 'color',
                'title' => esc_html__('Page Transition BG Color 2', 'blueprint'),
                'subtitle' =>  esc_html__('Use this to define the second color of your page transition background.', 'blueprint'),
                'desc' => '',
                'default' => '',
                'required' => array( 'transition-effect', '=', 'horizontal_swipe' ),
                'transparent' => false
            )


        )
    ) );




    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Page Header', 'redux-framework-demo' ),
        'id'               => 'page_header',
        'desc'             => esc_html__( 'All global page header options are listed here. (there are also many options located in your page header metabox available on every edit page screen which are configured on a per-page basis', 'redux-framework-demo' ),
        'customizer_width' => '400px',
         'icon'   => 'el el-file',
        'fields' => array(

           array(
              'id' => 'header-auto-title',
              'type' => 'switch',
              'title' => esc_html__('Automatically Add Page Title to Page Header.', 'blueprint'),
              'subtitle' => esc_html__('Convenient if you are transitioning an existing WP site to Blueprint to avoid having to manually add in page titles into the Page Header Settings metabox.', 'blueprint'),
              'desc' => '',
              'default' => '0'
           ),
            array(
                'id' => 'header-animate-in-effect',
                'type' => 'select',
                'title' => esc_html__('Load In Animation', 'blueprint'),
                'subtitle' => esc_html__('Page headers refer to any page header set in the page header meta box.', 'blueprint') . '<br/> <br/>' . __('<strong>None:</strong> No animation will occur (default). <br/> <strong>Slide down:</strong> Will apply for all non full screen page headers. <br/> <strong>Slight zoom out:</strong> Will apply to all page headers that have an image/video set (bg color only won\'t show the effect).', 'blueprint'),
                'options' => array(
                    "none" => esc_html__('None', 'blueprint'),
                    "slide-down" => esc_html__('Slide Down', 'blueprint'),
                    "zoom-out" => esc_html__('Slight Zoom Out', 'blueprint')
                ),
                'default' => 'none'
            ),

            array(
                'id' => 'header-down-arrow-style',
                'type' => 'select',
                'title' => esc_html__('Down Arrow Style', 'blueprint'),
                'subtitle' => esc_html__('Page headers that are set to fullscreen will show an arrow at the bottom so the user knows there is more content below - select the style for that here.', 'blueprint'),
                'options' => array(
                    "default" => esc_html__("Default", 'blueprint'),
                    "scroll-animation" => esc_html__("Scroll Animation", 'blueprint')
                ),
                'default' => 'default'
            ),


        )
    ) );




    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Form Styling', 'redux-framework-demo' ),
        'id'               => 'form_styling',
        'desc'             => esc_html__( 'All form styling options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-edit',
        'fields' => array(

               array(
                'id' => 'form-style',
                'type' => 'select',
                'title' => esc_html__('Overall Form Style', 'blueprint'),
                'subtitle' => esc_html__('Sets the style of all form elements used.', 'blueprint'),
                'hint' => array('content' => 'If you\'re trying to get third party forms to display without any styling from Blueprint, simply select the <b>Inherit</b> option.', 'title' => ''),
                'options' => array(
                    "default" => "Inherit",
                    "minimal" => "Minimal"
                ),
                'default' => 'default'
            ),

              array(
                'id' => 'form-fancy-select',
                'type' => 'switch',
                'title' => esc_html__('Enable Fancy Select Styling', 'blueprint'),
                'subtitle' => esc_html__('This will add additional styling and functionality to your select (dropdown) elements.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

            array(
                'id' => 'form-submit-btn-style',
                'type' => 'select',
                'title' => esc_html__('Submit Button Style', 'blueprint'),
                'subtitle' => esc_html__('Select your desired style which will be used for submit buttons throughout your site', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'default' => esc_html__('Default', 'blueprint'),
                    'regular' => esc_html__('Republicpg Btn', 'blueprint'),
                    'see-through' => esc_html__('Republicpg Btn See Through', 'blueprint')
                ),
                'default' => 'regular'
            )


        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Call To Action', 'redux-framework-demo' ),
        'id'               => 'cta',
        'desc'             => esc_html__( 'All call to action options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-bell',
        'fields' => array(

                array(
                'id' => 'cta-text',
                'type' => 'text',
                'title' => esc_html__('Call to Action Text', 'blueprint'),
                'subtitle' => esc_html__('Add the text that you would like to appear in the global call to action section.', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'cta-btn',
                'type' => 'text',
                'title' => esc_html__('Call to Action Button Text', 'blueprint'),
                'subtitle' => esc_html__('If you would like a button to be the link in the global call to action section, please enter the text for it here.', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'cta-btn-link',
                'type' => 'text',
                'title' => esc_html__('Call to Action Button Link URL', 'blueprint'),
                'subtitle' => esc_html__('Please enter the URL for the call to action section here.', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'exclude_cta_pages',
                'title' => esc_html__('Pages to Exclude the Call to Action Section', 'blueprint'),
                'subtitle' => esc_html__('Select any pages you wish to exclude the Call to Action section from. You can select multiple pages.', 'blueprint'),
                'args' => array(
                    'sort_order' => 'ASC'
                ),
                'desc' => '',
                'type'     => 'select',
                'data'     => 'pages',
                'multi'    => true,
            ),

            array(
                'id' => 'cta-background-color',
                'type' => 'color',
                'title' => esc_html__('Call to Action Background Color', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'default' => '#ECEBE9',
                'transparent' => false
            ),

            array(
                'id' => 'cta-text-color',
                'type' => 'color',
                'title' => esc_html__('Call to Action Font Color', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'default' => '#4B4F52',
                'transparent' => false
            ),

            array(
                'id' => 'cta-btn-color',
                'type' => 'select',
                'title' => esc_html__('Call to Action Button Color', 'blueprint'),
                'subtitle' => '',
                'desc' => '',
                'options' => array(
                    'accent-color' => esc_html__('Accent Color', 'blueprint'),
                    'extra-color-1' => esc_html__('Extra Color 1', 'blueprint'),
                    'extra-color-2' => esc_html__('Extra Color 2', 'blueprint'),
                    'extra-color-3' => esc_html__('Extra Color 3', 'blueprint'),
                    'see-through' => esc_html__('See Through', 'blueprint')
                ),
                'default' => 'accent-color'
            )


        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Portfolio', 'redux-framework-demo' ),
        'id'               => 'portfolio',
        'desc'             => esc_html__( 'All portfolio options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'   => 'el el-th',
        'fields' => array(




        )
    ) );


Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Styling', 'redux-framework-demo' ),
        'id'               => 'portfolio-style',
        'subsection'       => true,
        'fields'           => array(
                array(
                'id' => 'main_portfolio_layout',
                'type' => 'image_select',
                'title' => esc_html__('Main Layout', 'blueprint'),
                'subtitle' => esc_html__('Please select the number of columns you would like for your portfolio.', 'blueprint'),
                'desc' => '',
                'options' => array(
                                '2' => array('title' => '2 Columns', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/2col.png'),
                                '3' => array('title' => '3 Columns', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/3col.png'),
                                '4' => array('title' => '4 Columns', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/4col.png'),
                                'fullwidth' => array('title' => 'Full Width', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/fullwidth.png')
                            ),
                'default' => '3'
            ),
            array(
                'id' => 'main_portfolio_project_style',
                'type' => 'radio',
                'title' => esc_html__('Project Style', 'blueprint'),
                'subtitle' => esc_html__('Please select the style you would like your projects to display in on your portfolio pages.', 'blueprint'),
                'desc' => '',
                'options' => array(
                                '1' => esc_html__('Meta below thumb w/ links on hover', 'blueprint'),
                                '2' => esc_html__('Meta on hover + entire thumb link', 'blueprint'),
                                '7' => esc_html__('Meta on hover w/ zoom + entire thumb link', 'blueprint'),
                                '8' => esc_html__('Meta overlaid - bottom left aligned', 'blueprint'),
                                '3' => esc_html__("Title overlaid w/ zoom effect on hover", 'blueprint'),
                                '5' => esc_html__("Title overlaid w/ zoom effect on hover alt", 'blueprint'),
                                '4' => esc_html__("Meta from bottom on hover + entire thumb link", 'blueprint'),
                                '6' => esc_html__("Meta + 3D Parallax on hover", 'blueprint') ,
                                '9' => esc_html__('Meta below thumb w/ shadow hover', 'blueprint')
                            ),
                'default' => '1'
            ),

            array(
                'id' => 'main_portfolio_item_spacing',
                'type' => 'select',
                'title' => esc_html__('Project Item Spacing', 'blueprint'),
                'subtitle' => esc_html__('Please select the spacing you would like between your items', 'blueprint'),
                'desc' => '',
                'options' => array(
                                "default" => "Default",
                                "1px" => "1px",
                                "2px" => "2px",
                                "3px" => "3px",
                                "4px" => "4px",
                                "5px" => "5px",
                                "6px" => "6px",
                                "7px" => "7px",
                                "8px" => "8px",
                                "9px" => "9px",
                                "10px" => "10px",
                                "15px" => "15px",
                                "20px" => "20px"
                            ),
                'default' => 'default'
            ),

            array(
                'id' => 'portfolio_use_masonry',
                'type' => 'switch',
                'title' => esc_html__('Masonry Style?', 'blueprint'),
                'subtitle' => esc_html__('This will allow your portfolio items to display in a masonry layout as opposed to a fixed grid. You can define your masonry sizes in each project. If using the full width layout, will only be active with the alternative project style.', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),
            array(
                'id' => 'portfolio_masonry_grid_sizing',
                'type' => 'select',
                'title' => esc_html__('Masonry Grid Sizing', 'blueprint'),
                'subtitle' => esc_html__('Please select the grid layout for your masonry portfolio. This will change the dimensions of the "Masonry Item Sizing" field you choose for your projects in the project configuration metabox. After changing this, you will need to run the','blueprint') . ' <a target="_blank" rel="nofollow" href="https://wordpress.org/plugins/regenerate-thumbnails/">'. esc_html__('regenerate thumbnails','blueprint') . '</a> ' . esc_html__('plugin to recrop any featured images that are already uploaded. You must upload your images at a minimum of these dimensions or larger - uploading smaller than the size chosen will result in an incorrect layout.','blueprint') . '<br/> <strong class="top-margin">'. esc_html__('Square Based Grid','blueprint') . '</strong><br/><table class="masonry_table"><tr><th>' . esc_html__('Masonry Size','blueprint') . '</th><th>'. esc_html__('Dimensions','blueprint') . '</th></tr><tr><td>' . esc_html__('Regular','blueprint') . '</td><td>500x500</td></tr><tr><td>' . esc_html__('Wide','blueprint'). '</td><td>1000x500</td></tr><tr><td>' . esc_html__('Tall','blueprint') . '</td><td>1000x500</td></tr><tr><td>' . esc_html__('Wide & Tall','blueprint') . '</td><td>1000x1000</td></tr></table>    <strong>'. esc_html__('Photography Based','blueprint') . '</strong><br/><table class="masonry_table"><tr><th>' . esc_html__('Masonry Size','blueprint') . '</th><th>' . esc_html__('Dimensions','blueprint') . '</th></tr><tr><td>'. esc_html__('Regular','blueprint') . '</td><td>450x600</td></tr><tr><td>' . esc_html__('Wide','blueprint'). '</td><td>900x600</td></tr><tr><td>' . esc_html__('Wide & Tall','blueprint') . '</td><td>900x1200</td></tr></table>',
                'desc' => '',
                'options' => array(
                                "default" => "Square Grid Based (Default)",
                                "photography" => "Photography Based"
                            ),
                'default' => 'default'
            ),
             array(
                'id' => 'portfolio_inline_filters',
                'type' => 'switch',
                'title' => esc_html__('Display Filters Horizontally?', 'blueprint'),
                'subtitle' => esc_html__('This will allow your filters to display horizontally instead of in a dropdown.', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),
              array(
                'id' => 'portfolio_single_nav',
                'type' => 'radio',
                'title' => esc_html__('Single Project Page Navigation', 'blueprint'),
                'subtitle' => esc_html__('Please select the navigation you would like your projects to use.', 'blueprint'),
                'desc' => '',
                'options' => array(
                                'in_header' => esc_html__('In Project Header', 'blueprint'),
                                'after_project' => esc_html__('At Bottom Of Project', 'blueprint'),
                                'after_project_2' => esc_html__('At Bottom W/ Featured Image', 'blueprint')
                            ),
                'default' => 'after_project'
            ),
             array(
                'id' => 'portfolio_loading_animation',
                'type' => 'select',
                'title' => esc_html__('Load In Animation', 'blueprint'),
                'subtitle' => esc_html__('Please select the loading animation you would like', 'blueprint'),
                'desc' => '',
                'options' => array(
                                "none" => esc_html__("None", 'blueprint'),
                                "fade_in" => esc_html__("Fade In", 'blueprint'),
                                "fade_in_from_bottom" => esc_html__("Fade In From Bottom", 'blueprint'),
                                "perspective" => esc_html__("Perspective Fade In", 'blueprint')
                            ),
                'default' => 'fade_in_from_bottom'
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Functionality', 'redux-framework-demo' ),
        'id'               => 'portfolio-functionality',
        'subsection'       => true,
        'fields'           => array(
                array(
                'id' => 'portfolio_sidebar_follow',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Sidebar Follow on Scroll', 'blueprint'),
                'subtitle' => esc_html__('When supplying extra content, a sidebar enabled page can get quite tall and feel empty on the right side. Enable this option to have your sidebar follow you down the page.', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),
            array(
                'id' => 'portfolio_social',
                'type' => 'switch',
                'title' => esc_html__('Social Media Sharing Buttons', 'blueprint'),
                'subtitle' => esc_html__('Activate this to enable social sharing buttons on your portfolio items.', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
             array(
                'id' => 'portfolio_social_style',
                'type' => 'select',
                'title' => esc_html__('Social Sharing Style', 'blueprint'),
                'subtitle' => esc_html__('Please select the style you would like your portfolio sharing buttons to display in. Note: If using the default style, only non full width projects will be able to show them.', 'blueprint'),
                'desc' => '',
                'required' => array( 'portfolio_social', '=', '1' ),
                'options' => array(
                                "default" => esc_html__("In Sidebar", 'blueprint'),
                                "fixed_bottom_right" => esc_html__("Fixed To Bottom Right Of Screen", 'blueprint')
                            ),
                'default' => 'fixed_bottom_right'
            ),
             array(
                'id' => 'portfolio-facebook-sharing',
                'type' => 'checkbox',
                'title' => esc_html__('Facebook', 'blueprint'),
                'subtitle' => esc_html__('Share it.', 'blueprint'),
                'default' => '1',
                'required' => array( 'portfolio_social', '=', '1' ),
                'desc' => '',
            ),
            array(
                'id' => 'portfolio-twitter-sharing',
                'type' => 'checkbox',
                'title' => esc_html__('Twitter', 'blueprint'),
                'subtitle' => esc_html__('Tweet it.', 'blueprint'),
                  'required' => array( 'portfolio_social', '=', '1' ),
                'default' => '1',
                'desc' => '',
            ),
             array(
                'id' => 'portfolio-google-plus-sharing',
                'type' => 'checkbox',
                  'required' => array( 'portfolio_social', '=', '1' ),
                'title' => esc_html__('Google+', 'blueprint'),
                'subtitle' => esc_html__('Share it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'portfolio-pinterest-sharing',
                'type' => 'checkbox',
                  'required' => array( 'portfolio_social', '=', '1' ),
                'title' => esc_html__('Pinterest', 'blueprint'),
                'subtitle' => esc_html__('Pin it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'portfolio-linkedin-sharing',
                'type' => 'checkbox',
                  'required' => array( 'portfolio_social', '=', '1' ),
                'title' => esc_html__('LinkedIn', 'blueprint'),
                'subtitle' => esc_html__('Share it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),

            array(
                'id' => 'portfolio_date',
                'type' => 'checkbox',
                'title' => esc_html__('Display Dates on Projects?', 'blueprint'),
                'subtitle' => esc_html__('Toggle whether or not to show the date on your projects.', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '1'
            ),
            array(
                'id' => 'portfolio_pagination',
                'type' => 'switch',
                'title' => esc_html__('Portfolio Pagination', 'blueprint'),
                'subtitle' => esc_html__('Would you like your portfolio items to be paginated?', 'blueprint'),
                'desc' => '',
                'default' => '0',
            ),
             array(
                'id' => 'portfolio_pagination_type',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'blueprint'),
                'subtitle' => esc_html__('Please select your pagination type here.', 'blueprint'),
                'desc' => '',
                  'required' => array( 'portfolio_pagination', '=', '1' ),
                'options' => array(
                    'default' => esc_html__('Default', 'blueprint'),
                    'infinite_scroll' => esc_html__('Infinite Scroll', 'blueprint')
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'portfolio_extra_pagination',
                'type' => 'switch',
                 'required' => array( 'portfolio_pagination', '=', '1' ),
                'title' => esc_html__('Display Pagination Numbers', 'blueprint'),
                'subtitle' => esc_html__('Do you want the page numbers to be visible in your portfolio pagination?', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
            array(
                'id' => 'portfolio_pagination_number',
                'type' => 'text',
                 'required' => array( 'portfolio_pagination', '=', '1' ),
                'title' => esc_html__('Items Per page', 'blueprint'),
                'subtitle' => esc_html__('How many of your portfolio items would you like to display per page?', 'blueprint'),
                'desc' => '',
                'validate' => 'numeric'
            ),
            array(
                'id' => 'portfolio_remove_comments',
                'type' => 'switch',
                'title' => esc_html__('Remove Comment Functionality On Projects', 'blueprint'),
                'subtitle' => esc_html__('Enable this to globally disable commenting on your single project layout', 'blueprint'),
                'desc' => '',
                'default' => '0',
            ),
             array(
                'id' => 'portfolio_rewrite_slug',
                'type' => 'text',
                'title' => esc_html__('Custom Slug', 'blueprint'),
                'subtitle' => esc_html__('If you want your portfolio post type to have a custom slug in the url, please enter it here. You will still have to refresh your permalinks after saving this! This is done by going to Settings > Permalinks and clicking save.', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'carousel-title',
                'type' => 'text',
                'title' => esc_html__('Custom Recent Projects Title', 'blueprint'),
                'subtitle' => esc_html__('This is be used anywhere you place the recent work shortcode and on the "Recent Work" home layout. e.g. Recent Work', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'carousel-link',
                'type' => 'text',
                'title' => esc_html__('Custom Recent Projects Link Text', 'blueprint'),
                'subtitle' => esc_html__('This is be used anywhere you place the recent work shortcode and on the "Recent Work" home layout. e.g. View All Work', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'portfolio-sortable-text',
                'type' => 'text',
                'title' => esc_html__('Custom Portfolio Page Sortable Text', 'blueprint'),
                'subtitle' => esc_html__('e.g. Sort Portfolio', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'main-portfolio-link',
                'type' => 'text',
                'title' => esc_html__('Main Portfolio Page URL', 'blueprint'),
                'subtitle' => esc_html__('This will be used to link back to your main portfolio from the more details page and for the recent projects link. i.e. The portfolio page that you are displaying all project categories on.', 'blueprint'),
                'desc' => ''
            ),
             array(
                'id' => 'portfolio_same_category_single_nav',
                'type' => 'switch',
                'title' => esc_html__('Single Project Nav Arrows Limited To Same Category', 'blueprint'),
                'subtitle' => esc_html__('This will cause your single project page next/prev arrows to lead only to projects that exist in the same category as the current.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            )

        )
    ) );



 Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog', 'redux-framework-demo' ),
        'id'               => 'blog',
        'desc'             => esc_html__( 'All blog options are listed here.', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-list',
        'fields' => array(




        )
    ) );



 Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Styling', 'redux-framework-demo' ),
        'id'               => 'Blog-style',
        'subsection'       => true,
        'fields'           => array(
             array(
                'id' => 'blog_type',
                'type' => 'select',
                'title' => esc_html__('Blog Type', 'blueprint'),
                'subtitle' => esc_html__('Please select your blog format here.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'std-blog-sidebar' => esc_html__('Standard Blog W/ Sidebar', 'blueprint'),
                    'std-blog-fullwidth' => esc_html__('Standard Blog No Sidebar', 'blueprint'),
                    'masonry-blog-sidebar' => esc_html__('Masonry Blog W/ Sidebar', 'blueprint'),
                    'masonry-blog-fullwidth' => esc_html__('Masonry Blog No Sidebar', 'blueprint'),
                    'masonry-blog-full-screen-width' => esc_html__('Masonry Blog Fullwidth', 'blueprint')
                ),
                'default' => 'masonry-blog-fullwidth'
            ),
             array(
                'id' => 'blog_standard_type',
                'type' => 'radio',
                'title' => esc_html__('Standard Blog Style', 'blueprint'),
                'subtitle' => esc_html__('Please select the style you would like your posts to use when the standard layout is displayed', 'blueprint'),
                'desc' => '',
                'options' => array(
                                'classic' => esc_html__('Classic', 'blueprint'),
                                'minimal' => esc_html__('Minimal', 'blueprint'),
                                'featured_img_left' => esc_html__('Featured Image Left', 'blueprint')
                            ),
                'default' => 'featured_img_left',
                'required' => array( 'blog_type', 'contains', 'std-blog' )
            ),
            array(
                'id' => 'blog_masonry_type',
                'type' => 'radio',
                'title' => esc_html__('Masonry Style', 'blueprint'),
                'subtitle' => esc_html__('Please select the style you would like your posts to use when the masonry layout is displayed', 'blueprint'),
                'desc' => '',
                'hint' => array('content' => 'Hint: Auto Masonry based layouts load the fastest. This is because the layouts are calculated with pure CSS and do not rely on any scripting.', 'title' => ''),
                'options' => array(
                                'classic' => esc_html__('Classic', 'blueprint'),
                                'classic_enhanced' => esc_html__('Classic Enhanced', 'blueprint'),
                                'material' =>  esc_html__('Material', 'blueprint'),
                                'meta_overlaid' => esc_html__('Meta Overlaid', 'blueprint'),
                                'auto_meta_overlaid_spaced' => esc_html__('Auto Masonry: Meta Overlaid Spaced', 'blueprint')
                            ),
                'default' => 'auto_meta_overlaid_spaced'
            ),

            array(
                'id' => 'blog_auto_masonry_spacing',
                'type' => 'select',
                'title' => esc_html__('Auto Masonry Spacing', 'blueprint'),
                'subtitle' => esc_html__('Please select the amount of spacing you would like for your auto masonry layout', 'blueprint'),
                'desc' => '',
                'options' => array(
                     '4px' => '4px',
                     '8px' => '8px',
                     '12px' => '12px',
                     '16px' => '16px',
                     '20px' => '20px',
                            ),
                'default' => '8px',
                'required' => array( 'blog_masonry_type', '=', 'auto_meta_overlaid_spaced' )
            ),

            array(
                'id' => 'blog_loading_animation',
                'type' => 'select',
                'title' => esc_html__('Load In Animation', 'blueprint'),
                'subtitle' => esc_html__('Please select the loading animation you would like', 'blueprint'),
                'desc' => '',
                'options' => array(
                                "none" => esc_html__("None", 'blueprint'),
                                "fade_in" => esc_html__("Fade In", 'blueprint'),
                                "fade_in_from_bottom" => esc_html__("Fade In From Bottom", 'blueprint'),
                                "perspective" => esc_html__("Perspective Fade In", 'blueprint')
                            ),
                'default' => 'fade_in_from_bottom'
            ),

            array(
                'id' => 'blog_header_type',
                'type' => 'select',
                'title' => esc_html__('Blog Header Type', 'blueprint'),
                'subtitle' => esc_html__('Please select your blog header format here.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'default' => esc_html__('Variable height & meta overlaid', 'blueprint'),
                    'default_minimal' => esc_html__('Variable height minimal', 'blueprint'),
                    'fullscreen' => esc_html__('Fullscreen with meta under', 'blueprint')
                ),
                'default' => 'default_minimal'
            ),
             array(
                'id' => 'blog_hide_sidebar',
                'type' => 'switch',
                'title' => esc_html__('Hide Sidebar on Single Post', 'blueprint'),
                'subtitle' => esc_html__('Using this will remove the sidebar from appearing on your single post page.', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
            array(
                'id' => 'blog_enable_ss',
                'type' => 'switch',
                'title' => esc_html__('Enable Sticky Sidebar', 'blueprint'),
                'subtitle' => esc_html__('Would you like to have your sidebar follow down as your scroll in a sticky manner?', 'blueprint'),
                'desc' => '',
                'default' => '0',
            ),
            array(
                'id' => 'blog_hide_featured_image',
                'type' => 'switch',
                'title' => esc_html__('Hide Featured Media on Single Post', 'blueprint'),
                'subtitle' => esc_html__('Using this will remove the featured image/video/audio from appearing in the top of your single post page.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
             array(
                'id' => 'blog_archive_bg_image',
                'type' => 'media',
                'title' => esc_html__('Archive Header Background Image', 'blueprint'),
                'subtitle' => esc_html__('Upload an optional background that will be used on all blog archive pages.', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'blog_post_header_inherit_featured_image',
                'type' => 'switch',
                'title' => esc_html__('Single Post Header Inherits Featured Image', 'blueprint'),
                'subtitle' => esc_html__('Using this will cause the default background of your post header to use your featured image when no other post header image is supplied.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),

        )
    ) );



Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Functionality', 'redux-framework-demo' ),
        'id'               => 'blog-functionality',
        'subsection'       => true,
        'fields'           => array(

             array(
                'id' => 'author_bio',
                'type' => 'switch',
                'title' => esc_html__('Author\'s Bio', 'blueprint'),
                'subtitle' => esc_html__('Display the author\'s bio at the bottom of posts?', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
            array(
                'id' => 'blog_auto_excerpt',
                'type' => 'switch',
                'title' => esc_html__('Automatic Post Excerpts', 'blueprint'),
                'subtitle' => esc_html__('Using this will create automatic excerpts for your posts, placing a read more button after.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
             array(
                'id' => 'blog_excerpt_length',
                'type' => 'text',
                'required' => array( 'blog_auto_excerpt', '=', '1' ),
                'title' => esc_html__('Excerpt Length', 'blueprint'),
                'subtitle' => esc_html__('How many words would you like to display for your post excerpts? The default is 30.', 'blueprint'),
                'desc' => ''
            ),
           array(
                'id' => 'blog_next_post_link',
                'type' => 'switch',
                'title' => esc_html__('Post Navigation Links On Single Post Page', 'blueprint'),
                'subtitle' => esc_html__('Using this will add navigation link(s) at the bottom of every post page.', 'blueprint'),
                'desc' => '',
                'type' => 'switch',
                'default' => '1'
            ),
            array(
                'id' => 'blog_next_post_link_style',
                'type' => 'select',
                'title' => esc_html__('Post Navigation Style', 'blueprint'),
                'subtitle' => esc_html__('Please select the style you would like your post navigation to display in."', 'blueprint'),
                'desc' => '',
                'required' => array( 'blog_next_post_link', '=', '1' ),
                'options' => array(
                                "fullwidth_next_only" => esc_html__("Fullwidth Next Link Only", 'blueprint'),
                                "fullwidth_next_prev" => esc_html__("Fullwidth Next & Prev Links", 'blueprint'),
                                "contained_next_prev" => esc_html__("Contained Next & Prev Links", 'blueprint')
                            ),
                'default' => 'fullwidth_next_prev'
            ),

            array(
                 'id' => 'blog_related_posts',
                 'type' => 'switch',
                 'title' => esc_html__('Related Posts On Single Post Page', 'blueprint'),
                 'subtitle' => esc_html__('Using this will add related post links at the bottom of every post page.', 'blueprint'),
                 'desc' => '',
                 'type' => 'switch',
                 'default' => '0'
             ),

             array(
                 'id' => 'blog_related_posts_style',
                 'type' => 'select',
                 'title' => esc_html__('Related Posts Style', 'blueprint'),
                 'subtitle' => esc_html__('Please select the style you would like for the related posts"', 'blueprint'),
                 'desc' => '',
                 'required' => array( 'blog_related_posts', '=', '1' ),
                 'options' => array(
                          "material" => esc_html__("Material", 'blueprint'),
                          "classic_enhanced" => esc_html__("Classic Enhanced", 'blueprint'),
                  ),
                 'default' => 'material'
             ),

             array(
                 'id' => 'blog_related_posts_title_text',
                 'type' => 'select',
                 'title' => esc_html__('Related Posts Title Text', 'blueprint'),
                 'subtitle' => esc_html__('Please select the header text you would like above the related posts"', 'blueprint'),
                 'desc' => '',
                 'required' => array( 'blog_related_posts', '=', '1' ),
                 'options' => array(
                                 "related_posts" => esc_html__("Related Posts", 'blueprint'),
                                 "similar_posts" => esc_html__("Similar Posts", 'blueprint'),
                                 "you_may_also_like" => esc_html__("You May Also Like", 'blueprint'),
                                 "recommended_for_you" => esc_html__("Recommended For You", 'blueprint'),
                                 "hidden" => esc_html__("None (Hidden)", 'blueprint')
                             ),
                 'default' => 'related_posts'
             ),


           array(
                'id' => 'blog_social',
                'type' => 'switch',
                'title' => esc_html__('Social Media Sharing Buttons', 'blueprint'),
                'subtitle' => esc_html__('Activate this to enable social sharing buttons on your blog posts.', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
            array(
                'id' => 'blog_social_style',
                'type' => 'select',
                'title' => esc_html__('Social Sharing Style', 'blueprint'),
                'subtitle' => esc_html__('Please select the style you would like your blog sharing buttons to display in."', 'blueprint'),
                'desc' => '',
                'required' => array( 'blog_social', '=', '1' ),
                'options' => array(
                      "default" => esc_html__("Default (Determined by Blog Header Type)", 'blueprint'),
                      "fixed_bottom_right" => esc_html__("Fixed To Bottom Right Of Screen", 'blueprint')
                  ),
                'default' => 'fixed_bottom_right'
            ),
             array(
                'id' => 'blog-facebook-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => esc_html__('Facebook', 'blueprint'),
                'subtitle' =>  esc_html__('Share it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-twitter-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => esc_html__('Twitter', 'blueprint'),
                'subtitle' =>  esc_html__('Tweet it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-google-plus-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => esc_html__('Google+', 'blueprint'),
                'subtitle' =>  esc_html__('Share it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-pinterest-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => esc_html__('Pinterest', 'blueprint'),
                'subtitle' =>  esc_html__('Pin it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),
            array(
                'id' => 'blog-linkedin-sharing',
                'type' => 'checkbox',
                'required' => array( 'blog_social', '=', '1' ),
                'title' => esc_html__('LinkedIn', 'blueprint'),
                'subtitle' =>  esc_html__('Share it.', 'blueprint'),
                'default' => '1',
                'desc' => '',
            ),

            array(
                'id' => 'display_tags',
                'type' => 'switch',
                'title' => esc_html__('Display Tags', 'blueprint'),
                'subtitle' => esc_html__('Display tags at the bottom of posts?', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),

            array(
                'id' => 'display_full_date',
                'type' => 'switch',
                'title' => esc_html__('Display Full Date', 'blueprint'),
                'subtitle' => esc_html__('This will add the year to the date post meta on all blog pages.', 'blueprint'),
                'desc' => '',
                'default' => '0'
            ),
            array(
                'id' => 'blog_pagination_type',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'blueprint'),
                'subtitle' => esc_html__('Please select your pagination type here.', 'blueprint'),
                'desc' => '',
                'options' => array(
                    'default' => esc_html__('Default', 'blueprint'),
                    'infinite_scroll' => esc_html__('Infinite Scroll', 'blueprint')
                ),
                'default' => 'default'
            ),
            array(
                'id' => 'extra_pagination',
                'type' => 'switch',
                'title' => esc_html__('Display Pagination Numbers', 'blueprint'),
                'subtitle' => esc_html__('Do you want the page numbers to be visible in your pagination? (will only activate if using default pagination type)', 'blueprint'),
                'desc' => '',
                'switch' => true,
                'default' => '0'
            ),
            array(
                'id' => 'recent-posts-title',
                'type' => 'text',
                'title' => esc_html__('Custom Recent Posts Title', 'blueprint'),
                'subtitle' => esc_html__('This is be used anywhere you place the recent posts shortcode and on the "Recent Posts" home layout. e.g. Recent Posts', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'recent-posts-link',
                'type' => 'text',
                'title' => esc_html__('Custom Recent Posts Link Text', 'blueprint'),
                'subtitle' => esc_html__('This is be used anywhere you place the recent posts shortcode and on the "Recent Posts" home layout. e.g. View All Posts', 'blueprint'),
                'desc' => ''
            ),

        )
    ) );


    Redux::setSection( $opt_name, array(
            'title'            => esc_html__( 'Post Meta', 'redux-framework-demo' ),
            'id'               => 'blog-meta',
            'subsection'       => true,
            'fields'           => array(
                array(
                    'id'    => 'blog_single_meta_info',
                    'type'  => 'info',
                    'style' => 'success',
                    'title' => esc_html__('Single Post Template', 'redux-framework-demo'),
                    'icon'  => 'el-icon-info-sign',
                    'desc'  => esc_html__( 'Use the following options to control what meta information will be shown on your single post template.', 'blueprint')
                ),
                array(
                   'id' => 'blog_remove_single_date',
                   'type' => 'switch',
                   'title' => esc_html__('Remove Single Post Date', 'blueprint'),
                   'subtitle' => esc_html__('Enable this to remove the date from displaying on your single post template', 'blueprint'),
                   'desc' => '',
                   'default' => ''
               ),
              array(
                 'id' => 'blog_remove_single_author',
                 'type' => 'switch',
                 'title' => esc_html__('Remove Single Post Author', 'blueprint'),
                 'subtitle' => esc_html__('Enable this to remove the author name from displaying on your single post template', 'blueprint'),
                 'desc' => '',
                 'default' => ''
             ),
             array(
                'id' => 'blog_remove_single_comment_number',
                'type' => 'switch',
                'title' => esc_html__('Remove Single Post Comment Number', 'blueprint'),
                'subtitle' => esc_html__('Enable this to remove the comment count from displaying on your single post template', 'blueprint'),
                'desc' => '',
                'default' => ''
            ),
            array(
               'id' => 'blog_remove_single_republicpg_love',
               'type' => 'switch',
               'title' => esc_html__('Remove Single Post Republicpg Love Button', 'blueprint'),
               'subtitle' => esc_html__('Enable this to remove the republicpg love button from displaying on your single post template', 'blueprint'),
               'desc' => '',
               'default' => ''
           ),
            array(
                'id'    => 'blog_archive_meta_info',
                'type'  => 'info',
                'style' => 'success',
                'title' => esc_html__('Blog Archive (Post Grid/List) Template', 'redux-framework-demo'),
                'icon'  => 'el-icon-info-sign',
                'desc'  => esc_html__( 'Use the following options to control what meta information will be shown on your posts in the main post query.', 'blueprint')
            ),
            array(
               'id' => 'blog_remove_post_date',
               'type' => 'switch',
               'title' => esc_html__('Remove Post Date', 'blueprint'),
               'subtitle' => esc_html__('Enable this to remove the date from displaying on your blog archive layout', 'blueprint'),
               'desc' => '',
               'default' => ''
           ),
          array(
             'id' => 'blog_remove_post_author',
             'type' => 'switch',
             'title' => esc_html__('Remove Post Author', 'blueprint'),
             'subtitle' => esc_html__('Enable this to remove the author name from displaying on your blog archive layout', 'blueprint'),
             'desc' => '',
             'default' => ''
         ),
         array(
            'id' => 'blog_remove_post_comment_number',
            'type' => 'switch',
            'title' => esc_html__('Remove Comment Number', 'blueprint'),
            'subtitle' => esc_html__('Enable this to remove the comment count from displaying on your blog archive layout', 'blueprint'),
            'desc' => '',
            'default' => ''
        ),
        array(
           'id' => 'blog_remove_post_republicpg_love',
           'type' => 'switch',
           'title' => esc_html__('Remove Republicpg Love Button', 'blueprint'),
           'subtitle' => esc_html__('Enable this to remove the republicpg love button from displaying on your blog archive layout in post styles that use it', 'blueprint'),
           'desc' => '',
           'default' => ''
       ),

        )
    ) );


    global $woocommerce;
    if ($woocommerce) {

         Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'WooCommerce', 'redux-framework-demo' ),
        'id'               => 'woocommerce',
        'desc'             => esc_html__( 'All WooCommerce related options are listed here', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-shopping-cart',
        'fields' => array(

                    array(
                        'id' => 'enable-cart',
                        'type' => 'switch',
                        'title' => esc_html__('Enable WooCommerce Cart In Nav', 'blueprint'),
                        'sub_desc' => esc_html__('This will add a cart item to your main navigation.', 'blueprint'),
                        'desc' => '',
                        'default' => '1'
                    ),
                    array(
                        'id' => 'ajax-cart-style',
                        'type' => 'select',
                        'title' => esc_html__('Cart In Nav Style', 'blueprint'),
                        'subtitle' => esc_html__('Please select the style you would like for your AJAX cart', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        "dropdown" => "Dropdown",
                                        "slide_in" => "Slide In Full Page Height"
                                    ),
                        'default' => 'dropdown',
                         'required' => array( 'enable-cart', '=', '1' ),
                    ),
                    array(
                        'id' => 'main_shop_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Main Shop Layout', 'blueprint'),
                        'sub_desc' => esc_html__('Please select layout you would like to use on your main shop page.', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        'fullwidth' => array('title' => 'Fullwidth', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/no-sidebar.png'),
                                        'no-sidebar' => array('title' => 'No Sidebar', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/no-sidebar.png'),
                                        'right-sidebar' => array('title' => 'Right Sidebar', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/right-sidebar.png'),
                                        'left-sidebar' => array('title' => 'Left Sidebar', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/left-sidebar.png')
                                    ),
                        'default' => 'no-sidebar'
                    ),
                    array(
                        'id' => 'single_product_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Single Product Layout', 'blueprint'),
                        'sub_desc' => esc_html__('Please select layout you would like to use on your single product page.', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        'no-sidebar' => array('title' => 'No Sidebar', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/no-sidebar.png'),
                                        'right-sidebar' => array('title' => 'Right Sidebar', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/right-sidebar.png'),
                                        'left-sidebar' => array('title' => 'Left Sidebar', 'img' => REPUBLICPG_FRAMEWORK_DIRECTORY.'options/img/left-sidebar.png')
                                    ),
                        'default' => 'no-sidebar'
                    ),
                    array(
                        'id' => 'product_style',
                        'type' => 'radio',
                        'title' => esc_html__('Product Style', 'blueprint'),
                        'sub_desc' => esc_html__('Please select the style you would like your products to display in (single product page styling will also vary slightly with each)', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        'classic' => esc_html__('Classic', 'blueprint'),
                                        'text_on_hover' => esc_html__('Price/Star Ratings on Hover', 'blueprint'),
                                        'material' => esc_html__('Material Design', 'blueprint'),
                                        'minimal' => esc_html__('Minimal Design', 'blueprint')
                                    ),
                        'default' => 'classic'
                    ),
                    array(
                        'id' => 'product_desktop_cols',
                        'type' => 'select',
                        'title' => esc_html__('Archive Page Columns (Desktop)', 'blueprint'),
                        'subtitle' => esc_html__('The column number to be displayed on product archive pages when viewed on a desktop monitor ( > 1300px)', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        "default" => "Default",
                                        "6" => "6",
                                        "5" => "5",
                                        "4" => "4",
                                        "3" => "3",
                                        "2" => "2"
                                    ),
                        'default' => 'default',
                    ),
                    array(
                        'id' => 'product_desktop_small_cols',
                        'type' => 'select',
                        'title' => esc_html__('Archive Page Columns (Small Desktop)', 'blueprint'),
                        'subtitle' => esc_html__('The column number to be displayed on product archive pages when viewed on a small desktop monitor (1000px - 1300px)', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        "default" => "Default",
                                        "6" => "6",
                                        "5" => "5",
                                        "4" => "4",
                                        "3" => "3",
                                        "2" => "2"
                                    ),
                        'default' => 'default',
                    ),

                    array(
                        'id' => 'product_tablet_cols',
                        'type' => 'select',
                        'title' => esc_html__('Archive Page Columns (Tablet)', 'blueprint'),
                        'subtitle' => esc_html__('The column number to be displayed on product archive pages when viewed on a tablet (690px - 1000px)', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        "default" => "Default",
                                        "4" => "4",
                                        "3" => "3",
                                        "2" => "2"
                                    ),
                        'default' => 'default',
                    ),

                    array(
                        'id' => 'product_phone_cols',
                        'type' => 'select',
                        'title' => esc_html__('Archive Page Columns (Phone)', 'blueprint'),
                        'subtitle' => esc_html__('The column number to be displayed on product archive pages when viewed on a phone ( < 690px)', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        "default" => "Default",
                                        "4" => "4",
                                        "3" => "3",
                                        "2" => "2",
                                        "1" => "1"
                                    ),
                        'default' => 'default',
                    ),

                    array(
                        'id' => 'product_quick_view',
                        'type' => 'switch',
                        'title' => esc_html__('Enable WooCommerce Product Quick View', 'blueprint'),
                        'subtitle' => esc_html__('This will add a "quick view" button to your products which will load key single product page info without having to navigate to the page itself.', 'blueprint'),
                        'desc' => '',
                        'default' => ''
                    ),

                     array(
                        'id' => 'product_bg_color',
                        'type' => 'color',
                        'transparent' => false,
                        'title' => esc_html__('Material Design Product Item BG Color', 'blueprint'),
                        'subtitle' => esc_html__('Set this to match the BG color of your product images.', 'blueprint'),
                        'desc' => '',
                        'required' => array( 'product_style', '=', 'material' ),
                        'default' => '#ffffff'
                    ),
                    array(
                       'id' => 'product_minimal_bg_color',
                       'type' => 'color',
                       'transparent' => false,
                       'title' => esc_html__('Minimal Design Product Item BG Color', 'blueprint'),
                       'subtitle' => esc_html__('Set this to match the BG color of your product images.', 'blueprint'),
                       'desc' => '',
                       'required' => array( 'product_style', '=', 'minimal' ),
                       'default' => '#ffffff'
                   ),
                     array(
                        'id' => 'product_archive_bg_color',
                        'type' => 'color',
                         'transparent' => false,
                        'title' => esc_html__('Product Archive Page BG Color', 'blueprint'),
                        'subtitle' => esc_html__('Allows to you set the BG color for all product archive pages', 'blueprint'),
                        'desc' => '',
                        'default' => '#f6f6f6'
                    ),
                     array(
                        'id' => 'product_hover_alt_image',
                        'type' => 'switch',
                        'title' => esc_html__('Show first gallery image on Product hover', 'blueprint'),
                        'sub_desc' => '',
                        'desc' => esc_html__("Using this will cause your products to show the first gallery image (if supplied) on hover", 'blueprint'),
                        'default' => '0'
                    ),
                     array(
                        'id' => 'single_product_gallery_type',
                        'type' => 'radio',
                        'title' => esc_html__('Single Product Gallery Type', 'blueprint'),
                        'sub_desc' => esc_html__('Please select what gallery type you would like on your single product page', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                            'default' => esc_html__('Bottom Aligned Thumbnails', 'blueprint'),
                            'ios_slider' => esc_html__('Bottom Aligned Thumbnails Alt', 'blueprint'),
                            'left_thumb_sticky' => esc_html__('Left Aligned Thumbnails + Sticky Product Info', 'blueprint'),
                        ),
                        'default' => 'ios_slider'
                    ),
                     array(
                        'id' => 'product_tab_position',
                        'type' => 'radio',
                        'title' => esc_html__('Product Tab Position', 'blueprint'),
                        'sub_desc' => esc_html__('Please select what area you would like your tabs to display in on the single product page', 'blueprint'),
                        'desc' => '',
                        'options' => array(
                                        'in_sidebar' => esc_html__('In Side Area', 'blueprint'),
                                        'fullwidth' => esc_html__('Fullwidth Under Images', 'blueprint')
                                    ),
                        'default' => 'fullwidth'
                    ),
                     array(
                        'id' => 'woo-products-per-page',
                        'type' => 'text',
                        'title' => esc_html__('Products Per Page', 'blueprint'),
                        'subtitle' => esc_html__('Please enter your desired your products per page (default is 12)', 'blueprint'),
                        'desc' => '',
                        'validate' => 'numeric'
                    ),
                    array(
                        'id' => 'woo_hide_product_sku',
                        'type' => 'switch',
                        'title' => esc_html__('Hide SKU From Product Page', 'blueprint'),
                        'sub_desc' => '',
                        'desc' => '',
                        'default' => '0'
                    ),
                    array(
                        'id' => 'woo_social',
                        'type' => 'switch',
                        'title' => esc_html__('Social Media Sharing Buttons', 'blueprint'),
                        'sub_desc' => esc_html__('Activate this to enable social sharing buttons on your product page.', 'blueprint'),
                        'desc' => '',
                        'default' => '1'
                    ),
                    array(
                       'id' => 'woo_social_style',
                       'type' => 'select',
                       'title' => esc_html__('Social Sharing Style', 'blueprint'),
                       'subtitle' => esc_html__('Please select the style you would like your WooCommerce product sharing buttons to display in.', 'blueprint'),
                       'desc' => '',
                       'required' => array( 'woo_social', '=', '1' ),
                       'options' => array(
                           "default" => esc_html__("In Sidebar", 'blueprint'),
                           "fixed_bottom_right" => esc_html__("Fixed To Bottom Right Of Screen", 'blueprint')
                       ),
                       'default' => 'fixed_bottom_right'
                   ),
                    array(
                        'id' => 'woo-facebook-sharing',
                        'type' => 'checkbox',
                        'title' => esc_html__('Facebook', 'blueprint'),
                        'sub_desc' =>  esc_html__('Share it.', 'blueprint'),
                        'default' => '1',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                    array(
                        'id' => 'woo-twitter-sharing',
                        'type' => 'checkbox',
                        'title' => esc_html__('Twitter', 'blueprint'),
                        'sub_desc' =>  esc_html__('Tweet it.', 'blueprint'),
                        'default' => '1',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                     array(
                        'id' => 'woo-google-plus-sharing',
                        'type' => 'checkbox',
                        'title' => esc_html__('Google+', 'blueprint'),
                        'sub_desc' =>  esc_html__('Share it.', 'blueprint'),
                        'default' => '1',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                    array(
                        'id' => 'woo-pinterest-sharing',
                        'type' => 'checkbox',
                        'title' => esc_html__('Pinterest', 'blueprint'),
                        'sub_desc' =>  esc_html__('Pin it.', 'blueprint'),
                        'default' => '1',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    ),
                    array(
                        'id' => 'woo-linkedin-sharing',
                        'type' => 'checkbox',
                        'title' => esc_html__('LinkedIn', 'blueprint'),
                        'sub_desc' =>  esc_html__('Share it.', 'blueprint'),
                        'default' => '0',
                        'required' => array( 'woo_social', '=', '1' ),
                        'desc' => '',
                    )

        )
    ) );
}









Redux::setSection( $opt_name, array(
   'title'            => esc_html__( 'General WordPress Pages', 'blueprint' ),
   'id'               => 'general-wordpress-pages',
   'customizer_width' => '450px',
   'desc'             => esc_html__('Here you can find options related to general WordPress templates such as the search results template, 404 template etc.', 'blueprint'),
   'fields'           => array(

   )
) );


Redux::setSection( $opt_name, array(
   'title'            => esc_html__( 'Search Results Template', 'redux-framework-demo' ),
   'id'               => 'general-wordpress-pages-search-results',
   'subsection'       => true,
   'fields'           => array(
      array(
           'id' => 'search-results-layout',
           'type' => 'select',
           'title' => esc_html__('Layout', 'blueprint'),
           'subtitle' => esc_html__('This will alter the overall styling of various theme elements', 'blueprint'),
           'options' => array(
               "default" => esc_html__("Masonry Grid & Sidebar", 'blueprint'),
               "masonry-no-sidebar" => esc_html__("Masonry Grid No Sidebar", 'blueprint'),
               "list-no-sidebar" => esc_html__("List No Sidebar", 'blueprint')
           ),
           'default' => 'default'
       ),
       array(
          'id' => 'search-results-header-bg-color',
          'type' => 'color',
          'title' => esc_html__('Header Background Color', 'blueprint'),
          'subtitle' => 'Default is #f4f4f4',
          'transparent' => false,
          'desc' => '',
          'default' => ''
      ),
      array(
           'id' => 'search-results-header-font-color',
           'type' => 'color',
           'title' => esc_html__('Header Font Color', 'blueprint'),
           'subtitle' => 'Default is #000000',
           'transparent' => false,
           'desc' => '',
           'default' => ''
       ),
       array(
          'id' => 'search-results-header-bg-image',
          'type' => 'media',
          'title' => esc_html__('Header Background Image', 'blueprint'),
          'subtitle' => esc_html__('Upload an optional background that will be used on your search results page', 'blueprint'),
          'desc' => ''
      )
   )
) );

Redux::setSection( $opt_name, array(
   'title'            => esc_html__( '404 Not Found Template', 'redux-framework-demo' ),
   'id'               => 'general-wordpress-pages-404',
   'subsection'       => true,
   'fields'           => array(

     array(
        'id' => 'page-404-bg-color',
        'type' => 'color',
        'title' => esc_html__('Background Color', 'blueprint'),
        'subtitle' => '',
        'transparent' => false,
        'desc' => '',
        'default' => ''
    ),
    array(
         'id' => 'page-404-font-color',
         'type' => 'color',
         'title' => esc_html__('Font Color', 'blueprint'),
         'subtitle' => '',
         'transparent' => false,
         'desc' => '',
         'default' => ''
     ),
     array(
        'id' => 'page-404-bg-image',
        'type' => 'media',
        'title' => esc_html__('Background Image', 'blueprint'),
        'subtitle' => esc_html__('Upload an optional background that will be used on the 404 page', 'blueprint'),
        'desc' => ''
    ),
    array(
       'id' => 'page-404-bg-image-overlay-color',
       'type' => 'color',
       'title' => esc_html__('Background Overlay Color', 'blueprint'),
       'subtitle' => 'If you would like a color to overlay your background image, select it here.',
       'transparent' => false,
       'desc' => '',
       'default' => ''
    ),
    array(
        'id' => 'page-404-home-button',
        'type' => 'switch',
        'title' => esc_html__('Add Button To Direct User Home', 'blueprint'),
        'sub_desc' => esc_html__('This will add a button onto your 404 template which links back to your home page.', 'blueprint'),
        'desc' => '',
        'default' => '1'
    )
   )
));











Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social Media', 'redux-framework-demo' ),
        'id'               => 'social_media',
        'desc'             => esc_html__( 'Enter in your social media locations here and then activate which ones you would like to display in your footer options & header options tabs. Remember to include the "http://" in all URLs!', 'redux-framework-demo' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-share',
        'fields' => array(


            array(
                'id' => 'sharing_btn_accent_color',
                'type' => 'switch',
                'title' => esc_html__('Sharing Button Accent Color?', 'blueprint'),
                'subtitle' => esc_html__('This will allow your sharing buttons (the ones in posts/projects & social shortcode) to use the accent color rather than the actual branding color.', 'blueprint'),
                'desc' => '',
                'default' => '1'
            ),
            array(
                'id' => 'facebook-url',
                'type' => 'text',
                'title' => esc_html__('Facebook URL', 'blueprint'),
                'subtitle' => esc_html__('Please enter in your Facebook URL.', 'blueprint'),
                'desc' => ''
            ),
            array(
                'id' => 'twitter-url',
                'type' => 'text',
                'title' => esc_html__('Twitter URL', 'blueprint'),
                'subtitle' => esc_html__('Please enter in your Twitter URL.', 'blueprint'),
                'desc' => ''
            ),
            // array(
            //     'id' => 'google-plus-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Google+ URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Google+ URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            array(
                'id' => 'vimeo-url',
                'type' => 'text',
                'title' => esc_html__('Vimeo URL', 'blueprint'),
                'subtitle' => esc_html__('Please enter in your Vimeo URL.', 'blueprint'),
                'desc' => ''
            ),
            // array(
            //     'id' => 'dribbble-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Dribbble URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Dribbble URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            array(
                'id' => 'pinterest-url',
                'type' => 'text',
                'title' => esc_html__('Pinterest URL', 'blueprint'),
                'subtitle' => esc_html__('Please enter in your Pinterest URL.', 'blueprint'),
                'desc' => ''
            ),
            // array(
            //     'id' => 'youtube-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Youtube URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Youtube URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'tumblr-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Tumblr URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Tumblr URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'linkedin-url',
            //     'type' => 'text',
            //     'title' => esc_html__('LinkedIn URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your LinkedIn URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'rss-url',
            //     'type' => 'text',
            //     'title' => esc_html__('RSS URL', 'blueprint'),
            //     'subtitle' => esc_html__('If you have an external RSS feed such as Feedburner, please enter it here. Will use built in Wordpress feed if left blank.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'behance-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Behance URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Behance URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'flickr-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Flickr URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Flickr URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'spotify-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Spotify URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Spotify URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            array(
                'id' => 'instagram-url',
                'type' => 'text',
                'title' => esc_html__('Instagram URL', 'blueprint'),
                'subtitle' => esc_html__('Please enter in your Instagram URL.', 'blueprint'),
                'desc' => ''
            ),
            // array(
            //     'id' => 'github-url',
            //     'type' => 'text',
            //     'title' => esc_html__('GitHub URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your GitHub URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'stackexchange-url',
            //     'type' => 'text',
            //     'title' => esc_html__('StackExchange URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your StackExchange URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'soundcloud-url',
            //     'type' => 'text',
            //     'title' => esc_html__('SoundCloud URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your SoundCloud URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'vk-url',
            //     'type' => 'text',
            //     'title' => esc_html__('VK URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your VK URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'vine-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Vine URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Vine URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'vine-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Vine URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Vine URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'houzz-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Houzz URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Houzz URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'yelp-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Yelp URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Yelp URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'snapchat-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Snapchat URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Snapchat URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'mixcloud-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Mixcloud URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Mixcloud URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'bandcamp-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Bandcamp URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Mixcloud URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'tripadvisor-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Tripadvisor URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Tripadvisor URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'telegram-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Telegram URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Telegram URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'slack-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Slack URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Slack URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'medium-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Medium URL', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your Medium URL.', 'blueprint'),
            //     'desc' => ''
            // ),
            // array(
            //     'id' => 'email-url',
            //     'type' => 'text',
            //     'title' => esc_html__('Email link', 'blueprint'),
            //     'subtitle' => esc_html__('Please enter in your URL link.', 'blueprint'),
            //     'desc' => ''
            // ),
            array(
                'id' => 'phone-url',
                'type' => 'text',
                'title' => esc_html__('Phone Link', 'blueprint'),
                'subtitle' => esc_html__('Please enter in your Phone link.', 'blueprint'),
                'desc' => ''
            )


        )
    ) );







Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Contact', 'redux-framework-demo' ),
    'id'               => 'contact',
    'desc'             => esc_html__( 'These settings only relate to the "Contact" page template.', 'redux-framework-demo' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-phone',
    'fields' => array(


         array(
            'id' => 'zoom-level',
            'type' => 'text',
            'title' => esc_html__('Default Map Zoom Level', 'blueprint'),
            'subtitle' => esc_html__('Value should be between 1-18, 1 being the entire earth and 18 being right at street level.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'enable-map-zoom',
            'type' => 'checkbox',
            'title' => esc_html__('Enable Map Zoom In/Out', 'blueprint'),
            'subtitle' => esc_html__('Do you want users to be able to zoom in/out on the map?', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
        array(
            'id' => 'center-lat',
            'type' => 'text',
            'title' => esc_html__('Map Center Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for the maps center point.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'center-lng',
            'type' => 'text',
            'title' => esc_html__('Map Center Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for the maps center point.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'use-marker-img',
            'type' => 'switch',
            'title' => esc_html__('Use Image for Markers', 'blueprint'),
            'subtitle' => esc_html__('Do you want a custom image to be used for the map markers?', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
        array(
            'id' => 'marker-img',
            'type' => 'media',
            'required' => array( 'use-marker-img', '=', '1' ),
            'title' => esc_html__('Marker Icon Upload', 'blueprint'),
            'subtitle' => esc_html__('Please upload an image that will be used for all the markers on your map.', 'blueprint'),
            'desc' => ''
        ),
        array(
            'id' => 'enable-map-animation',
            'type' => 'checkbox',
            'title' => esc_html__('Enable Marker Animation', 'blueprint'),
            'subtitle' => esc_html__('This will cause your markers to do a quick bounce as they load in.', 'blueprint'),
            'desc' => '',
            'default' => '1'
        ),
        array(
            'id' => 'map-point-1',
           'type' => 'switch',
            'title' => esc_html__('Location #1', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #1', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude1',
            'type' => 'text',
            'required' => array( 'map-point-1', '=', '1' ),
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your first location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude1',
            'type' => 'text',
            'required' => array( 'map-point-1', '=', '1' ),
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your first location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info1',
            'type' => 'textarea',
            'required' => array( 'map-point-1', '=', '1' ),
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your first location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),


        array(
            'id' => 'map-point-2',
           'type' => 'switch',
            'title' => esc_html__('Location #2', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #2', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude2',
            'type' => 'text',
            'required' => array( 'map-point-2', '=', '1' ),
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your second location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude2',
            'required' => array( 'map-point-2', '=', '1' ),
            'type' => 'text',
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your second location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info2',
            'type' => 'textarea',
            'required' => array( 'map-point-2', '=', '1' ),
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your second location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),


        array(
            'id' => 'map-point-3',
           'type' => 'switch',
            'title' => esc_html__('Location #3', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #3', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude3',
            'type' => 'text',
            'required' => array( 'map-point-3', '=', '1' ),
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your third location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude3',
            'required' => array( 'map-point-3', '=', '1' ),
            'type' => 'text',
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your third location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info3',
            'type' => 'textarea',
            'required' => array( 'map-point-3', '=', '1' ),
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your third location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),


        array(
            'id' => 'map-point-4',
            'type' => 'switch',
            'title' => esc_html__('Location #4', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #4', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude4',
            'type' => 'text',
            'required' => array( 'map-point-4', '=', '1' ),
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your fourth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude4',
            'type' => 'text',
            'required' => array( 'map-point-4', '=', '1' ),
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your fourth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info4',
            'required' => array( 'map-point-4', '=', '1' ),
            'type' => 'textarea',
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your fourth location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),



        array(
            'id' => 'map-point-5',
            'type' => 'switch',
            'title' => esc_html__('Location #5', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #5', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude5',
            'type' => 'text',
            'required' => array( 'map-point-5', '=', '1' ),
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your fifth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude5',
            'type' => 'text',
            'required' => array( 'map-point-5', '=', '1' ),
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your fifth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info5',
            'required' => array( 'map-point-5', '=', '1' ),
            'type' => 'textarea',
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your fifth location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),


        array(
            'id' => 'map-point-6',
            'type' => 'switch',
            'title' => esc_html__('Location #6', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #6', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude6',
            'type' => 'text',
            'required' => array( 'map-point-6', '=', '1' ),
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your sixth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude6',
            'required' => array( 'map-point-6', '=', '1' ),
            'type' => 'text',
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your sixth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info6',
            'required' => array( 'map-point-6', '=', '1' ),
            'type' => 'textarea',
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your sixth location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),



        array(
            'id' => 'map-point-7',
            'type' => 'switch',
            'title' => esc_html__('Location #7', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #7', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude7',
            'required' => array( 'map-point-7', '=', '1' ),
            'type' => 'text',
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your seventh location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude7',
            'type' => 'text',
            'required' => array( 'map-point-7', '=', '1' ),
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your seventh location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info7',
            'type' => 'textarea',
             'required' => array( 'map-point-7', '=', '1' ),
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your seventh location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),



        array(
            'id' => 'map-point-8',
            'type' => 'switch',
            'title' => esc_html__('Location #8', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #8', 'blueprint'),
            'desc' => '',
            'next_to_hide' => '3',
            'switch' => true,
            'default' => '0'
        ),
         array(
            'id' => 'latitude8',
             'required' => array( 'map-point-8', '=', '1' ),
            'type' => 'text',
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your eighth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude8',
            'type' => 'text',
             'required' => array( 'map-point-8', '=', '1' ),
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your eighth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info8',
            'type' => 'textarea',
            'required' => array( 'map-point-8', '=', '1' ),
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your eighth location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),



        array(
            'id' => 'map-point-9',
           'type' => 'switch',
            'title' => esc_html__('Location #9', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #9', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude9',
            'type' => 'text',
            'required' => array( 'map-point-9', '=', '1' ),
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your ninth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude9',
            'type' => 'text',
            'required' => array( 'map-point-9', '=', '1' ),
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your ninth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info9',
            'type' => 'textarea',
            'required' => array( 'map-point-9', '=', '1' ),
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your ninth location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),


        array(
            'id' => 'map-point-10',
            'type' => 'switch',
            'title' => esc_html__('Location #10', 'blueprint'),
            'subtitle' => esc_html__('Toggle location #10', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
         array(
            'id' => 'latitude10',
            'type' => 'text',
            'title' => esc_html__('Latitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the latitude for your tenth location.', 'blueprint'),
            'desc' => '',
             'required' => array( 'map-point-10', '=', '1' ),
            'validate' => 'numeric'
        ),
         array(
            'id' => 'longitude10',
            'type' => 'text',
            'required' => array( 'map-point-10', '=', '1' ),
            'title' => esc_html__('Longitude', 'blueprint'),
            'subtitle' => esc_html__('Please enter the longitude for your tenth location.', 'blueprint'),
            'desc' => '',
            'validate' => 'numeric'
        ),
        array(
            'id' => 'map-info10',
            'required' => array( 'map-point-10', '=', '1' ),
            'type' => 'textarea',
            'title' => esc_html__('Map Infowindow Text', 'blueprint'),
            'subtitle' => esc_html__('If you would like to display any text in an info window for your tenth location, please enter it here.', 'blueprint'),
            'desc' => ''
        ),


        array(
            'id' => 'add-remove-locations',
            'type' => 'add_remove',
            'title' => esc_html__('Show More or Less Locations', 'blueprint'),
            'desc' => '',
            'grouping' => 'map-point'
        ),

        array(
            'id' => 'map-greyscale',
            'type' => 'switch',
            'title' => esc_html__('Greyscale Color', 'blueprint'),
            'subtitle' => esc_html__('Toggle a greyscale color scheme (will also unlock a custom color option)', 'blueprint'),
            'desc' => '',
            'default' => '0'
        ),
        array(
            'id' => 'map-color',
            'type' => 'color',
            'required' => array( 'map-greyscale', '=', '1' ),
            'transparent' => false,
            'title' => esc_html__('Map Extra Color', 'blueprint'),
            'subtitle' =>  esc_html__('Use this to define a main color that will be used in combination with the greyscale option for your map', 'blueprint'),
            'desc' => '',
            'default' => ''
        ),
        array(
            'id' => 'map-ultra-flat',
            'type' => 'checkbox',
            'required' => array( 'map-greyscale', '=', '1' ),
            'title' => esc_html__('Ultra Flat Map', 'blueprint'),
            'subtitle' =>  esc_html__('This removes street/landmark text & some extra details for a clean look', 'blueprint'),
            'desc' => '',
            'default' => ''
        ),
        array(
            'id' => 'map-dark-color-scheme',
            'type' => 'checkbox',
            'required' => array( 'map-greyscale', '=', '1' ),
            'title' => esc_html__('Dark Color Scheme', 'blueprint'),
            'subtitle' =>  esc_html__('Enable this option for a dark colored map (This will override the extra color choice) ', 'blueprint'),
            'desc' => '',
            'default' => ''
        )


    )
) );




Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Home Slider', 'redux-framework-demo' ),
    'id'               => 'home_slider',
    'desc'             => esc_html__( 'All home page related options are listed here.', 'redux-framework-demo' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-home',
    'fields' => array(


         array(
            'id' => 'slider-caption-animation',
            'type' => 'switch',
            'title' => esc_html__('Slider Caption Animations', 'blueprint'),
            'subtitle' => esc_html__('This will add transition animations to your captions.', 'blueprint'),
            'desc' => '',
            'default' => '1'
        ),
        array(
            'id' => 'slider-background-cover',
            'type' => 'switch',
            'title' => esc_html__('Slider Image Resize', 'blueprint'),
            'subtitle' => esc_html__('This will automatically resize your slide images to fit the users screen size by using the background-size cover css property.', 'blueprint'),
            'desc' => '',
            'switch' => true,
            'default' => '1'
        ),
        array(
            'id' => 'slider-autoplay',
            'type' => 'switch',
            'title' => esc_html__('Autoplay Slider?', 'blueprint'),
            'subtitle' => esc_html__('This will cause the automatic advance of slides until the user begins interaction.', 'blueprint'),
            'desc' => '',
            'switch' => true,
            'default' => '1'
        ),
        array(
            'id' => 'slider-advance-speed',
            'type' => 'text',
            'title' => esc_html__('Slider Advance Speed', 'blueprint'),
            'subtitle' => esc_html__('This is how long it takes before automatically switching to the next slide.', 'blueprint'),
            'desc' => esc_html__('enter in milliseconds (default is 5500)', 'blueprint'),
            'validate' => 'numeric'
        ),
         array(
            'id' => 'slider-animation-speed',
            'type' => 'text',
            'title' => esc_html__('Slider Animation Speed', 'blueprint'),
            'subtitle' => esc_html__('This is how long it takes to animate when switching between slides.', 'blueprint'),
            'desc' => esc_html__('enter in milliseconds (default is 800)', 'blueprint'),
            'validate' => 'numeric'
        ),
        array(
            'id' => 'slider-height',
            'type' => 'text',
            'title' => esc_html__('Slider Height', 'blueprint'),
            'subtitle' => esc_html__('Please enter your desired height for the home slider. The safe minimum height is 400. The theme demo uses 650.', 'blueprint'),
            'desc' => esc_html__('Don\'t include "px" in the string. e.g. 650', 'blueprint'),
            'validate' => 'numeric'
        ),
         array(
            'id' => 'slider-bg-color',
            'type' => 'color',
            'title' => esc_html__('Slider Background Color', 'blueprint'),
            'subtitle' => esc_html__('This color will only be seen if your slides aren\'t wide enough to accomidate large resolutions. ', 'blueprint'),
            'desc' => '',
            'transparent' => false,
            'default' => '#000000'
        ),


    )
) );





    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => esc_html__( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }
