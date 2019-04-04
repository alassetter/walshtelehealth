<?php
/**
 * Header related helper functions v
 *
 * @package Blueprint WordPress Theme
 * @subpackage helpers
 * @version 9.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 



/**
 * Return the variables needed for header/body
 *
 * @since 9.0.2
 */
function republicpg_get_header_variables() {

	$republicpg_options = get_republicpg_theme_options();

	global $post;
	global $woocommerce;

	$republicpg_using_VC_front_end_editor = (isset($_GET['vc_editable'])) ? sanitize_text_field($_GET['vc_editable']) : '';
	$republicpg_using_VC_front_end_editor = ($republicpg_using_VC_front_end_editor == 'true') ? true : false;

	$header_format = ( ! empty( $republicpg_options['header_format'] ) ) ? $republicpg_options['header_format'] : 'default';

	// check if parallax republicpg slider is being used (needed for raw shortcode outside page builder)
	$parallax_republicpg_slider = using_republicpg_slider();
	$force_effect           = get_post_meta( $post->ID, '_force_transparent_header', true );

	// header transparent option
	$transparency_markup              = null;
	$activate_transparency            = null;
	$republicpg_transparency_color_class  = '';
	$republicpg_transparency_color_forced = 'light';

	$using_page_header = using_page_header( $post->ID );
	$using_fw_slider   = $parallax_republicpg_slider;
	$using_fw_slider   = ( ! empty( $republicpg_options['transparent-header'] ) && $republicpg_options['transparent-header'] == '1' ) ? $using_fw_slider : 0;
	if ( $force_effect == 'on' ) {
		$using_fw_slider = '1';
	}
	$disable_effect                 = get_post_meta( $post->ID, '_disable_transparent_header', true );
	$force_transparent_header_color = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_force_transparent_header_color', true ) : '';

	$theme_skin = ( ! empty( $republicpg_options['theme-skin'] ) ) ? $republicpg_options['theme-skin'] : 'original';
	if ( $header_format == 'centered-menu-bottom-bar' ) {
		$theme_skin = 'material'; }

	if ( ! empty( $republicpg_options['transparent-header'] ) && $republicpg_options['transparent-header'] == '1' && $header_format != 'left-header' ) {

		$starting_color                  = ( empty( $republicpg_options['header-starting-color'] ) ) ? '#ffffff' : $republicpg_options['header-starting-color'];
		$activate_transparency           = $using_page_header;
		$remove_border                   = ( ! empty( $republicpg_options['header-remove-border'] ) && $republicpg_options['header-remove-border'] == '1' || $theme_skin == 'material' ) ? 'true' : 'false';
		$transparent_header_shadow       = ( ! empty( $republicpg_options['transparent-header-shadow-helper'] ) && $republicpg_options['transparent-header-shadow-helper'] == '1' ) ? 'true' : 'false';
		$republicpg_transparency_color_class = ( $force_transparent_header_color == 'dark' ) ? ' dark-slide' : '';
		if ( $force_transparent_header_color == 'dark' ) {
			$republicpg_transparency_color_forced = 'dark';
		}

		$transparency_markup = ( $activate_transparency == 'true' ) ? 'data-transparent-header="true" data-transparent-shadow-helper="' . esc_attr( $transparent_header_shadow ) . '" data-remove-border="' . esc_attr( $remove_border ) . '" class="transparent' . esc_attr( $republicpg_transparency_color_class ) . '"' : null;

	}

	// header vars
	$logo_class           = ( ! empty( $republicpg_options['use-logo'] ) && $republicpg_options['use-logo'] == '1' ) ? null : 'class="no-image"';
	$using_mobile_logo    = ( ! empty( $republicpg_options['use-logo'] ) && $republicpg_options['use-logo'] == '1' && ! empty( $republicpg_options['mobile-logo'] ) && ! empty( $republicpg_options['mobile-logo']['url'] ) ) ? 'true' : 'false';
	$side_widget_area     = ( ! empty( $republicpg_options['header-slide-out-widget-area'] ) && $header_format != 'left-header' ) ? $republicpg_options['header-slide-out-widget-area'] : 'off';
	$side_widget_class    = ( ! empty( $republicpg_options['header-slide-out-widget-area-style'] ) ) ? $republicpg_options['header-slide-out-widget-area-style'] : 'slide-out-from-right';
	$header_search        = ( ! empty( $republicpg_options['header-disable-search'] ) && $republicpg_options['header-disable-search'] == '1' ) ? 'false' : 'true';
	$user_account_btn     = ( ! empty( $republicpg_options['header-account-button'] ) && $republicpg_options['header-account-button'] == '1' ) ? 'true' : 'false';
	$user_account_btn_url = ( ! empty( $republicpg_options['header-account-button-url'] ) ) ? $republicpg_options['header-account-button-url'] : '';
	$mobile_fixed         = ( ! empty( $republicpg_options['header-mobile-fixed'] ) ) ? $republicpg_options['header-mobile-fixed'] : 'false';
	$mobile_breakpoint    = ( ! empty( $republicpg_options['header-menu-mobile-breakpoint'] ) ) ? $republicpg_options['header-menu-mobile-breakpoint'] : 1000;
	$full_width_header    = ( ! empty( $republicpg_options['header-fullwidth'] ) && $republicpg_options['header-fullwidth'] == '1' ) ? 'true' : 'false';
	$header_color_scheme  = ( ! empty( $republicpg_options['header-color'] ) ) ? $republicpg_options['header-color'] : 'light';
	$user_set_bg          = ( ! empty( $republicpg_options['header-background-color'] ) && $header_color_scheme == 'custom' ) ? $republicpg_options['header-background-color'] : '#ffffff';
	$trans_header         = ( ! empty( $republicpg_options['transparent-header'] ) && $republicpg_options['transparent-header'] == '1' ) ? $republicpg_options['transparent-header'] : 'false';
	if ( $header_format == 'left-header' ) {
		$trans_header = 'false';
	}
	$bg_header                 = ( ! empty( $post->ID ) && $post->ID != 0 ) ? $using_page_header : 0;
	$bg_header                 = ( $bg_header == 1 ) ? 'true' : 'false'; // convert to string for references in css
	$header_box_shadow         = ( ! empty( $republicpg_options['header-box-shadow'] ) ) ? $republicpg_options['header-box-shadow'] : 'small';
	$header_remove_stickiness  = ( ! empty( $republicpg_options['header-remove-fixed'] ) ) ? $republicpg_options['header-remove-fixed'] : '0';
	if( $republicpg_using_VC_front_end_editor ) {
		$header_remove_stickiness = '1';
	}

	$condense_header_on_scroll = ( ! empty( $republicpg_options['condense-header-on-scroll'] ) && $header_format == 'centered-menu-bottom-bar' && $header_remove_stickiness != '1' && $republicpg_options['condense-header-on-scroll'] == '1' ) ? 'true' : 'false';
	$perm_trans                = ( ! empty( $republicpg_options['header-permanent-transparent'] ) && $trans_header != 'false' && $bg_header == 'true' && $header_format != 'centered-menu-bottom-bar' ) ? $republicpg_options['header-permanent-transparent'] : 'false';
	$header_link_hover_effect  = ( ! empty( $republicpg_options['header-hover-effect'] ) ) ? $republicpg_options['header-hover-effect'] : 'default';
	$hide_header_until_needed  = ( ! empty( $republicpg_options['header-hide-until-needed'] ) && $header_format != 'centered-menu-bottom-bar' ) ? $republicpg_options['header-hide-until-needed'] : '0';
	if ( $header_format == 'centered-menu-bottom-bar' ) {
		$hide_header_until_needed = '0'; }
	if ( $header_format == 'left-header' ) {
		$hide_header_until_needed = '0';
		$header_remove_stickiness = '0'; }
	if ( $header_remove_stickiness == '1' ) {
		$hide_header_until_needed = '1';
	}
	$header_resize               = ( ! empty( $republicpg_options['header-resize-on-scroll'] ) && $perm_trans != '1' && $header_format != 'centered-menu-bottom-bar' ) ? $republicpg_options['header-resize-on-scroll'] : '0';
	$dropdown_style              = ( ! empty( $republicpg_options['header-dropdown-style'] ) && $perm_trans != '1' && $header_format != 'left-header' ) ? $republicpg_options['header-dropdown-style'] : 'classic';
	$page_transition_effect      = ( ! empty( $republicpg_options['transition-effect'] ) ) ? $republicpg_options['transition-effect'] : 'standard';
	$megamenuwidth               = ( ! empty( $republicpg_options['header-megamenu-width'] ) && $header_format != 'left-header' ) ? $republicpg_options['header-megamenu-width'] : 'contained';
	$megamenu_remove_transparent = ( ! empty( $republicpg_options['header-megamenu-remove-transparent'] ) && $header_format != 'left-header' ) ? $republicpg_options['header-megamenu-remove-transparent'] : '0';
	$body_border                 = ( ! empty( $republicpg_options['body-border'] ) ) ? $republicpg_options['body-border'] : 'off';
	if ( $hide_header_until_needed == '1' || $body_border == '1' || $header_format == 'left-header' || $header_remove_stickiness == '1' ) {
		$header_resize = '0';
	}
	$lightbox_script = ( ! empty( $republicpg_options['lightbox_script'] ) ) ? $republicpg_options['lightbox_script'] : 'pretty_photo';
	if ( $lightbox_script == 'pretty_photo' ) {
		$lightbox_script = 'magnific'; }
	$button_styling       = ( ! empty( $republicpg_options['button-styling'] ) ) ? $republicpg_options['button-styling'] : 'default';
	$form_style           = ( ! empty( $republicpg_options['form-style'] ) ) ? $republicpg_options['form-style'] : 'default';
	$fancy_rcs            = ( ! empty( $republicpg_options['form-fancy-select'] ) ) ? $republicpg_options['form-fancy-select'] : 'default';
	$footer_reveal        = ( ! empty( $republicpg_options['footer-reveal'] ) ) ? $republicpg_options['footer-reveal'] : 'false';
	$footer_reveal_shadow = ( ! empty( $republicpg_options['footer-reveal-shadow'] ) && $footer_reveal == '1' ) ? $republicpg_options['footer-reveal-shadow'] : 'none';

	$has_main_menu     = ( has_nav_menu( 'top_nav' ) ) ? 'true' : 'false';
	$animate_in_effect = ( ! empty( $republicpg_options['header-animate-in-effect'] ) ) ? $republicpg_options['header-animate-in-effect'] : 'none';
	if ( $header_color_scheme == 'dark' ) {
		$user_set_bg = '#1f1f1f'; }
	$user_set_side_widget_area = $side_widget_area;
	if ( $has_main_menu == 'true' && $mobile_fixed == '1' || $has_main_menu == 'true' && $theme_skin == 'material' ) {
		$side_widget_area = '1'; }
	if ( $header_format == 'centered-menu-under-logo' ) {
		if ( $side_widget_class == 'slide-out-from-right-hover' && $user_set_side_widget_area == '1' ) {
			$side_widget_class = 'slide-out-from-right';
		}
		$full_width_header = 'false';
	}
	if ( $side_widget_class == 'slide-out-from-right-hover' && $user_set_side_widget_area == '1' ) {
		$full_width_header = 'true';
	}
	$column_animation_easing   = ( ! empty( $republicpg_options['column_animation_easing'] ) ) ? $republicpg_options['column_animation_easing'] : 'linear';
	$column_animation_duration = ( ! empty( $republicpg_options['column_animation_timing'] ) ) ? $republicpg_options['column_animation_timing'] : '650';
	$prepend_top_nav_mobile    = ( ! empty( $republicpg_options['header-slide-out-widget-area-top-nav-in-mobile'] ) && $user_set_side_widget_area == '1' ) ? $republicpg_options['header-slide-out-widget-area-top-nav-in-mobile'] : 'false';
	$smooth_scrolling          = '0';
	if ( $body_border == '1' ) {
		$smooth_scrolling = '0';
	}
	$page_full_screen_rows = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_republicpg_full_screen_rows', true ) : '';
	if ( $page_full_screen_rows == 'on' ) {
		$smooth_scrolling = '0';
	}
	$form_submit_style         = ( ! empty( $republicpg_options['form-submit-btn-style'] ) ) ? $republicpg_options['form-submit-btn-style'] : 'default';
	$n_boxed_style             = ( ! empty( $republicpg_options['boxed_layout'] ) && $republicpg_options['boxed_layout'] == '1' && $header_format != 'left-header' ) ? true : false;
	$n_remove_mobile_parallax  = ( ! empty( $republicpg_options['disable-mobile-parallax'] ) && $republicpg_options['disable-mobile-parallax'] == '1' ) ? true : false;
	$n_remove_mobile_video_bgs = ( ! empty( $republicpg_options['disable-mobile-video-bgs'] ) && $republicpg_options['disable-mobile-video-bgs'] == '1' ) ? true : false;
	$using_secondary           = ( ! empty( $republicpg_options['header_layout'] ) && $header_format != 'left-header' ) ? $republicpg_options['header_layout'] : ' ';

	if ( $theme_skin == 'material' && $header_format != 'left-header' ) {
		$dropdown_style = 'minimal';
	}

	// using pr
	$using_pr_menu = 'false';
	if ( $header_format == 'menu-left-aligned' || $header_format == 'centered-menu' ) {
		if ( has_nav_menu( 'top_nav_pull_right' ) ) {
			$using_pr_menu = 'true';
		}
	}

	$using_header_buttons = republicpg_header_button_check();

	$header_transparency_bool = ( ! empty( $republicpg_options['transparent-header'] ) && $republicpg_options['transparent-header'] == '1' ) ? true : false;

	$republicpg_header_options = array(
		'options'                          => $republicpg_options,
		'theme_skin'                       => $theme_skin,
		'header_format'                    => $header_format,
		'disable_effect'                   => $disable_effect,
		'force_effect'                     => $force_effect,
		'using_fw_slider'                  => $using_fw_slider,
		'force_transparent_header_color'   => $force_transparent_header_color,
		'parallax_republicpg_slider'           => $parallax_republicpg_slider,
		'republicpg_transparency_color_class'  => $republicpg_transparency_color_class,
		'using_page_header'                => $using_page_header,
		'activate_transparency'            => $activate_transparency,
		'header_transparency_bool'         => $header_transparency_bool,
		'dropdown_style'                   => $dropdown_style,
		'n_remove_mobile_video_bgs'        => $n_remove_mobile_video_bgs,
		'n_remove_mobile_parallax'         => $n_remove_mobile_parallax,
		'n_boxed_style'                    => $n_boxed_style,
		'form_submit_style'                => $form_submit_style,
		'smooth_scrolling'                 => $smooth_scrolling,
		'prepend_top_nav_mobile'           => $prepend_top_nav_mobile,
		'column_animation_duration'        => $column_animation_duration,
		'column_animation_easing'          => $column_animation_easing,
		'full_width_header'                => $full_width_header,
		'side_widget_class'                => $side_widget_class,
		'side_widget_area'                 => $side_widget_area,
		'user_set_side_widget_area'        => $user_set_side_widget_area,
		'user_set_bg'                      => $user_set_bg,
		'animate_in_effect'                => $animate_in_effect,
		'has_main_menu'                    => $has_main_menu,
		'footer_reveal_shadow'             => $footer_reveal_shadow,
		'footer_reveal'                    => $footer_reveal,
		'fancy_rcs'                        => $fancy_rcs,
		'form_style'                       => $form_style,
		'button_styling'                   => $button_styling,
		'lightbox_script'                  => $lightbox_script,
		'header_resize'                    => $header_resize,
		'body_border'                      => $body_border,
		'megamenu_remove_transparent'      => $megamenu_remove_transparent,
		'megamenuwidth'                    => $megamenuwidth,
		'page_transition_effect'           => $page_transition_effect,
		'dropdown_style'                   => $dropdown_style,
		'hide_header_until_needed'         => $hide_header_until_needed,
		'header_remove_stickiness'         => $header_remove_stickiness,
		'header_link_hover_effect'         => $header_link_hover_effect,
		'perm_trans'                       => $perm_trans,
		'condense_header_on_scroll'        => $condense_header_on_scroll,
		'header_remove_stickiness'         => $header_remove_stickiness,
		'header_box_shadow'                => $header_box_shadow,
		'bg_header'                        => $bg_header,
		'trans_header'                     => $trans_header,
		'header_color_scheme'              => $header_color_scheme,
		'mobile_breakpoint'                => $mobile_breakpoint,
		'mobile_fixed'                     => $mobile_fixed,
		'user_account_btn_url'             => $user_account_btn_url,
		'user_account_btn'                 => $user_account_btn,
		'header_search'                    => $header_search,
		'using_mobile_logo'                => $using_mobile_logo,
		'logo_class'                       => $logo_class,
		'transparency_markup'              => $transparency_markup,
		'republicpg_transparency_color_forced' => $republicpg_transparency_color_forced,
		'using_pr_menu'                    => $using_pr_menu,
		'using_header_buttons'             => $using_header_buttons,
		'using_secondary'                  => $using_secondary,
		'page_full_screen_rows'            => $page_full_screen_rows,
	);

	return $republicpg_header_options;

} //republicpg_get_header_variables





/**
 * Echo the Blueprint specific body attributes
 *
 * @since 9.02
 */
function republicpg_body_attributes() {

	global $woocommerce;
	global $republicpg_options;

	$republicpg_header_options = republicpg_get_header_variables();
	extract( $republicpg_header_options );

	$body_attributes_escaped = ' ';

	$body_attributes_escaped .= 'data-footer-reveal="' . esc_attr( $footer_reveal ) . '" ';
	$body_attributes_escaped .= 'data-footer-reveal-shadow="' . esc_attr( $footer_reveal_shadow ) . '" ';
	$body_attributes_escaped .= 'data-header-format="' . esc_attr( $header_format ) . '" ';
	$body_attributes_escaped .= 'data-body-border="' . esc_attr( $body_border ) . '" ';
	$body_attributes_escaped .= 'data-boxed-style="' . esc_attr( $n_boxed_style ) . '" ';
	$body_attributes_escaped .= 'data-header-breakpoint="' . esc_attr( $mobile_breakpoint ) . '" ';

	$body_attributes_escaped .= 'data-dropdown-style="' . esc_attr( $dropdown_style ) . '" ';
	$body_attributes_escaped .= 'data-cae="' . esc_attr( $column_animation_easing ) . '" ';
	$body_attributes_escaped .= 'data-cad="' . esc_attr( $column_animation_duration ) . '" ';
	$body_attributes_escaped .= 'data-megamenu-width="' . esc_attr( $megamenuwidth ) . '" ';
	$body_attributes_escaped .= 'data-aie="' . esc_attr( $animate_in_effect ) . '" ';
	$body_attributes_escaped .= 'data-ls="' . esc_attr( $lightbox_script ) . '" ';
	$body_attributes_escaped .= 'data-apte="' . esc_attr( $page_transition_effect ) . '" ';
	$body_attributes_escaped .= 'data-hhun="' . esc_attr( $hide_header_until_needed ) . '" ';
	$body_attributes_escaped .= 'data-fancy-form-rcs="' . esc_attr( $fancy_rcs ) . '" ';
	$body_attributes_escaped .= 'data-form-style="' . esc_attr( $form_style ) . '" ';
	$body_attributes_escaped .= 'data-form-submit="' . esc_attr( $form_submit_style ) . '" ';
	$body_attributes_escaped .= 'data-is="minimal" ';
	$body_attributes_escaped .= 'data-button-style="' . esc_attr( $button_styling ) . '" ';

	if ( ! empty( $republicpg_options['header-inherit-row-color'] ) && $republicpg_options['header-inherit-row-color'] == '1' && $perm_trans != 1 && $condense_header_on_scroll != 'true' ) {
		$body_attributes_escaped .= 'data-header-inherit-rc="true" ';
	} else {
		$body_attributes_escaped .= 'data-header-inherit-rc="false" ';
	}

	$body_attributes_escaped .= 'data-header-search="' . esc_attr( $header_search ) . '" ';

	if ( ! empty( $republicpg_options['one-page-scrolling'] ) && $republicpg_options['one-page-scrolling'] == '1' ) {
		$body_attributes_escaped .= 'data-animated-anchors="true" ';
	} else {
		$body_attributes_escaped .= 'data-animated-anchors="false" ';
	}

	if ( ! empty( $republicpg_options['ajax-page-loading'] ) && $republicpg_options['ajax-page-loading'] == '1' ) {
		$body_attributes_escaped .= 'data-ajax-transitions="true" ';
	} else {
		$body_attributes_escaped .= 'data-ajax-transitions="false" ';
	}

	$body_attributes_escaped .= 'data-full-width-header="' . esc_attr( $full_width_header ) . '" ';
	if ( $side_widget_area == '1' ) {
		$body_attributes_escaped .= 'data-slide-out-widget-area="true" ';
	} else {
		$body_attributes_escaped .= 'data-slide-out-widget-area="false" ';
	}

	$body_attributes_escaped .= 'data-slide-out-widget-area-style="' . esc_attr( $side_widget_class ) . '" ';
	$body_attributes_escaped .= 'data-user-set-ocm="' . esc_attr( $user_set_side_widget_area ) . '" ';

	if ( ! empty( $republicpg_options['loading-image-animation'] ) ) {
		$body_attributes_escaped .= 'data-loading-animation="' . esc_attr( $republicpg_options['loading-image-animation'] ) . '" ';
	} else {
		$body_attributes_escaped .= 'data-loading-animation="none" ';
	}

	$body_attributes_escaped .= 'data-bg-header="' . esc_attr( $bg_header ) . '" ';

	if ( ! empty( $republicpg_options['responsive'] ) && $republicpg_options['responsive'] == 1 ) {
		$body_attributes_escaped .= 'data-responsive="1" ';
	} else {
		$body_attributes_escaped .= 'data-responsive="0" ';
	}

	if ( ! empty( $republicpg_options['responsive'] ) && $republicpg_options['responsive'] == 1 && ! empty( $republicpg_options['ext_responsive'] ) && $republicpg_options['ext_responsive'] == '1' ) {
		$body_attributes_escaped .= 'data-ext-responsive="true" ';
	} else {
		$body_attributes_escaped .= 'data-ext-responsive="false" ';
	}

	$body_attributes_escaped .= 'data-header-resize="' . esc_attr( $header_resize ) . '" ';

	if ( ! empty( $republicpg_options['header-color'] ) ) {
		$body_attributes_escaped .= 'data-header-color="' . esc_attr( $republicpg_options['header-color'] ) . '" ';
	} else {
		$body_attributes_escaped .= 'data-header-color="light" ';
	}

	if ( $header_transparency_bool == false ) {
		$body_attributes_escaped .= 'data-transparent-header="false" ';
	}

	if ( $woocommerce && ! empty( $republicpg_options['enable-cart'] ) && $republicpg_options['enable-cart'] == '1' ) {
		$body_attributes_escaped .= 'data-cart="true" ';
	} else {
		$body_attributes_escaped .= 'data-cart="false" ';
	}

	$body_attributes_escaped .= 'data-remove-m-parallax="' . esc_attr( $n_remove_mobile_parallax ) . '" ';
	$body_attributes_escaped .= 'data-remove-m-video-bgs="' . esc_attr( $n_remove_mobile_video_bgs ) . '" ';
	$body_attributes_escaped .= 'data-force-header-trans-color="' . esc_attr( $republicpg_transparency_color_forced ) . '" ';
	$body_attributes_escaped .= 'data-smooth-scrolling="0" ';
	$body_attributes_escaped .= 'data-permanent-transparent="' . esc_attr( $perm_trans ) . '" ';

	echo $body_attributes_escaped; // WPCS: XSS ok.

}



/**
 * Echo the Blueprint header navigation attributes
 *
 * @since 9.0.2
 */
function republicpg_header_nav_attributes() {

	global $woocommerce;
	global $republicpg_options;

	$republicpg_header_options = republicpg_get_header_variables();
	extract( $republicpg_header_options );

	$header_attributes_escaped = ' ';

	$header_attributes_escaped .= 'data-has-menu="' . esc_attr( $has_main_menu ) . '" ';
	$header_attributes_escaped .= 'data-has-buttons="' . esc_attr( $using_header_buttons ) . '" ';
	$header_attributes_escaped .= 'data-using-pr-menu="' . esc_attr( $using_pr_menu ) . '" ';
	$header_attributes_escaped .= 'data-mobile-fixed="' . esc_attr( $mobile_fixed ) . '" ';
	$header_attributes_escaped .= 'data-ptnm="' . esc_attr( $prepend_top_nav_mobile ) . '" ';
	$header_attributes_escaped .= 'data-lhe="' . esc_attr( $header_link_hover_effect ) . '" ';
	$header_attributes_escaped .= 'data-user-set-bg="' . esc_attr( $user_set_bg ) . '" ';
	$header_attributes_escaped .= 'data-format="' . esc_attr( $header_format ) . '" ';
	$header_attributes_escaped .= 'data-permanent-transparent="' . esc_attr( $perm_trans ) . '" ';
	$header_attributes_escaped .= 'data-megamenu-rt="' . esc_attr( $megamenu_remove_transparent ) . '" ';
	$header_attributes_escaped .= 'data-remove-fixed="' . esc_attr( $header_remove_stickiness ) . '" ';
	$header_attributes_escaped .= 'data-header-resize="' . esc_attr( $header_resize ) . '" ';

	if ( $woocommerce && ! empty( $republicpg_options['enable-cart'] ) && $republicpg_options['enable-cart'] == '1' ) {
		$header_attributes_escaped .= 'data-cart="true" ';
	} else {
		$header_attributes_escaped .= 'data-cart="false" ';
	}

	if ( $disable_effect == 'on' ) {
		$header_attributes_escaped .= 'data-transparency-option="0" ';
	} else {
		$header_attributes_escaped .= 'data-transparency-option="' . esc_attr( $using_fw_slider ) . '" ';
	}

	$header_attributes_escaped .= 'data-box-shadow="' . esc_attr( $header_box_shadow ) . '" ';

	if ( ! empty( $republicpg_options['header-resize-on-scroll-shrink-num'] ) ) {
		$header_attributes_escaped .= 'data-shrink-num="' . esc_attr( $republicpg_options['header-resize-on-scroll-shrink-num'] ) . '" ';
	} else {
		$header_attributes_escaped .= 'data-shrink-num="6" ';
	}

	$header_attributes_escaped .= 'data-full-width="' . esc_attr( $full_width_header ) . '" ';
	$header_attributes_escaped .= 'data-condense="' . esc_attr( $condense_header_on_scroll ) . '" ';

	if ( $using_secondary == 'header_with_secondary' ) {
		$header_attributes_escaped .= 'data-using-secondary="1" ';
	} else {
		$header_attributes_escaped .= 'data-using-secondary="0" ';
	}

	if ( ! empty( $republicpg_options['use-logo'] ) ) {
		$header_attributes_escaped .= 'data-using-logo="' . esc_attr( $republicpg_options['use-logo'] ) . '" ';
	} else {
		$header_attributes_escaped .= 'data-using-logo="0" ';
	}

	if ( ! empty( $republicpg_options['logo-height'] ) ) {
		$header_attributes_escaped .= 'data-logo-height="' . esc_attr( $republicpg_options['logo-height'] ) . '" ';
	} else {
		$header_attributes_escaped .= 'data-logo-height="30" ';
	}

	if ( ! empty( $republicpg_options['mobile-logo-height'] ) ) {
		$header_attributes_escaped .= 'data-m-logo-height="' . esc_attr( $republicpg_options['mobile-logo-height'] ) . '" ';
	} else {
		$header_attributes_escaped .= 'data-m-logo-height="24" ';
	}

	if ( ! empty( $republicpg_options['header-padding'] ) ) {
		$header_attributes_escaped .= 'data-padding="' . esc_attr( $republicpg_options['header-padding'] ) . '" ';
	} else {
		$header_attributes_escaped .= 'data-padding="28" ';
	}

	$header_attributes_escaped .= $transparency_markup;

	echo $header_attributes_escaped; // WPCS: XSS ok.

}





if ( ! function_exists( 'republicpg_logo_output' ) ) {
	function republicpg_logo_output( $activate_transparency = false, $off_canvas_style = 'slide-out-from-right', $using_mobile_logo = 'false' ) {

		global $republicpg_options;
		global $post;

		$force_transparent_header_color = ( isset( $post->ID ) ) ? get_post_meta( $post->ID, '_force_transparent_header_color', true ) : '';

		if ( ! empty( $republicpg_options['use-logo'] ) ) {

			$default_logo_class = ( ! empty( $republicpg_options['retina-logo']['id'] ) || ! empty( $republicpg_options['retina-logo']['url'] ) ) ? 'default-logo' : null;
			$dark_default_class = ( empty( $republicpg_options['header-starting-logo-dark']['id'] ) && empty( $republicpg_options['header-starting-logo-dark']['url'] ) ) ? ' dark-version' : null;

			$std_retina_srcset = null;
			if ( ! empty( $republicpg_options['retina-logo']['id'] ) || ! empty( $republicpg_options['retina-logo']['url'] ) ) {
				$std_retina_srcset = 'srcset="' . republicpg_options_img( $republicpg_options['logo'] ) . ' 1x, ' . republicpg_options_img( $republicpg_options['retina-logo'] ) . ' 2x"';
			}

			 echo '<img class="stnd ' . $default_logo_class . $dark_default_class . '" alt="' . get_bloginfo( 'name' ) . '" src="' . republicpg_options_img( $republicpg_options['logo'] ) . '" ' . $std_retina_srcset . ' />';

			 // mobile only logo
			if ( $using_mobile_logo == 'true' ) {
				 echo '<img class="mobile-only-logo" alt="' . get_bloginfo( 'name' ) . '" src="' . republicpg_options_img( $republicpg_options['mobile-logo'] ) . '" />';
			}

			 // starting logo
			if ( $activate_transparency == 'true' || $off_canvas_style == 'fullscreen-alt' || $force_transparent_header_color == 'dark' ) {

				$starting_retina_srcset = null;
				if ( ! empty( $republicpg_options['header-starting-retina-logo']['id'] ) || ! empty( $republicpg_options['header-starting-retina-logo']['url'] ) ) {
					$starting_retina_srcset = 'srcset="' . republicpg_options_img( $republicpg_options['header-starting-logo'] ) . ' 1x, ' . republicpg_options_img( $republicpg_options['header-starting-retina-logo'] ) . ' 2x"';
				}

				if ( ! empty( $republicpg_options['header-starting-logo']['id'] ) || ! empty( $republicpg_options['header-starting-logo']['url'] ) ) {
					echo '<img class="starting-logo ' . $default_logo_class . '"  alt="' . get_bloginfo( 'name' ) . '" src="' . republicpg_options_img( $republicpg_options['header-starting-logo'] ) . '" ' . $starting_retina_srcset . ' />';
				}

				$starting_dark_retina_srcset = null;
				if ( ! empty( $republicpg_options['header-starting-retina-logo-dark']['id'] ) || ! empty( $republicpg_options['header-starting-retina-logo-dark']['url'] ) ) {
					$starting_dark_retina_srcset = 'srcset="' . republicpg_options_img( $republicpg_options['header-starting-logo-dark'] ) . ' 1x, ' . republicpg_options_img( $republicpg_options['header-starting-retina-logo-dark'] ) . ' 2x"';
				}

				if ( ! empty( $republicpg_options['header-starting-logo-dark']['id'] ) || ! empty( $republicpg_options['header-starting-logo-dark']['url'] ) ) {
					echo '<img class="starting-logo dark-version ' . $default_logo_class . '"  alt="' . get_bloginfo( 'name' ) . '" src="' . republicpg_options_img( $republicpg_options['header-starting-logo-dark'] ) . '" ' . $starting_dark_retina_srcset . ' />';
				}
			}
		} else {
			echo get_bloginfo( 'name' ); }
	}
}




if ( ! function_exists( 'republicpg_logo_spacing' ) ) {
	function republicpg_logo_spacing() {

		global $republicpg_options;
		echo '<div class="logo-spacing">';
		if ( ! empty( $republicpg_options['use-logo'] ) ) {

			 echo '<img class="hidden-logo" alt="' . get_bloginfo( 'name' ) . '" src="' . republicpg_options_img( $republicpg_options['logo'] ) . '" />';

		} else {
			echo get_bloginfo( 'name' ); }

		 echo '</div>';
	}
}




/**
 * Check whether JS is enabled ASAP
 *
 * @since 9.0
 */
add_action( 'wp_head', 'republicpg_javascript_check' );
if ( ! function_exists( 'republicpg_javascript_check' ) ) {
	function republicpg_javascript_check() {
		 echo '<script type="text/javascript"> var root = document.getElementsByTagName( "html" )[0]; root.setAttribute( "class", "js" ); </script>';
	}
}


/**
 * Check whether user is on mobile device ASAP
 *
 * @since 9.0
 */
add_action( 'republicpg_hook_after_body_open', 'republicpg_mobile_browser_check', 1 );
if ( ! function_exists( 'republicpg_mobile_browser_check' ) ) {
	function republicpg_mobile_browser_check() {
		 echo '<script type="text/javascript"> if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|BlackBerry|IEMobile|Opera Mini)/)) { document.body.className += " using-mobile-browser "; } </script>';
	}
}




/**
 * Remove Open Sans from loading twice
 *
 * @since 7.0
 */
if ( ! function_exists( 'republicpg_remove_wp_open_sans' ) ) {
	function republicpg_remove_wp_open_sans() {
		wp_deregister_style( 'open-sans' );
		wp_register_style( 'open-sans', false );
	}
}
add_action( 'wp_enqueue_scripts', 'republicpg_remove_wp_open_sans' );








if ( ! function_exists( 'republicpg_page_trans_markup' ) ) {

	function republicpg_page_trans_markup() {

		global $republicpg_options;

		$republicpg_using_VC_front_end_editor = (isset($_GET['vc_editable'])) ? sanitize_text_field($_GET['vc_editable']) : '';
		$republicpg_using_VC_front_end_editor = ($republicpg_using_VC_front_end_editor == 'true') ? true : false;

		$ajax_page_loading = ( ! empty( $republicpg_options['ajax-page-loading'] ) && $republicpg_options['ajax-page-loading'] == '1' ) ? true : false;
		if ( $ajax_page_loading == false || $republicpg_using_VC_front_end_editor ) {
			return;
		}

		$page_transition_effect = ( ! empty( $republicpg_options['transition-effect'] ) ) ? $republicpg_options['transition-effect'] : 'standard';

		$republicpg_disable_fade_on_click         = ( ! empty( $republicpg_options['disable-transition-fade-on-click'] ) ) ? $republicpg_options['disable-transition-fade-on-click'] : '0';
		$republicpg_transition_method             = ( ! empty( $republicpg_options['transition-method'] ) ) ? $republicpg_options['transition-method'] : 'ajax';
		$republicpg_loading_image_animation_class = ( ! empty( $republicpg_options['loading-image-animation'] ) && ! empty( $republicpg_options['loading-image'] ) ) ? $republicpg_options['loading-image-animation'] : null;
		$republicpg_disable_transition_on_mobile  = ( ! empty( $republicpg_options['disable-transition-on-mobile'] ) ) ? $republicpg_options['disable-transition-on-mobile'] : '0';

		$republicpg_transition_markup = '';

		$republicpg_transition_markup .= '<div id="ajax-loading-screen" data-disable-mobile="' . esc_attr( $republicpg_disable_transition_on_mobile ) . '" data-disable-fade-on-click="' . esc_attr( $republicpg_disable_fade_on_click ) . '" data-effect="' . esc_attr( $page_transition_effect ) . '" data-method="' . esc_attr( $republicpg_transition_method ) . '">';

		if ( $page_transition_effect == 'horizontal_swipe' || $page_transition_effect == 'horizontal_swipe_basic' ) {

				$republicpg_transition_markup .= '<div class="reveal-1"></div>';
				$republicpg_transition_markup .= '<div class="reveal-2"></div>';

		} elseif ( $page_transition_effect == 'center_mask_reveal' ) {

			 $republicpg_transition_markup .= '<span class="mask-top"></span>';
			 $republicpg_transition_markup .= '<span class="mask-right"></span>';
			 $republicpg_transition_markup .= '<span class="mask-bottom"></span>';
			 $republicpg_transition_markup .= '<span class="mask-left"></span>';

		} else {

			 $republicpg_transition_markup .= '<div class="loading-icon ' . $republicpg_loading_image_animation_class . '">';

			 $loading_icon = ( isset( $republicpg_options['loading-icon'] ) ) ? $republicpg_options['loading-icon'] : 'default';
			 $loading_img  = ( isset( $republicpg_options['loading-image'] ) ) ? republicpg_options_img( $republicpg_options['loading-image'] ) : null;

			if ( empty( $loading_img ) ) {

				if ( $loading_icon == 'material' ) {

					$republicpg_transition_markup .= '<div class="material-icon">
									 <div class="spinner">
										 <div class="right-side"><div class="bar"></div></div>
										 <div class="left-side"><div class="bar"></div></div>
									 </div>
									 <div class="spinner color-2">
										 <div class="right-side"><div class="bar"></div></div>
										 <div class="left-side"><div class="bar"></div></div>
									 </div>
								 </div>';

				} else {

					if ( ! empty( $republicpg_options['theme-skin'] ) && $republicpg_options['theme-skin'] == 'ascend' ) {
							  $republicpg_transition_markup .= '<span class="default-loading-icon spin"></span>';
					} else {
									$republicpg_transition_markup .= '<span class="default-skin-loading-icon"></span>';
					}
				}
			} // empty loading img

				$republicpg_transition_markup .= '</div>';

		} // not swipe or mask reveal

		$republicpg_transition_markup .= '</div>';

		echo $republicpg_transition_markup; // WPCS: XSS ok.

	} // function end

}






global $republicpg_options;
$transition_method = ( ! empty( $republicpg_options['transition-method'] ) ) ? $republicpg_options['transition-method'] : 'ajax';

function republicpg_page_transition_bg_fix() {
	$page_transition_bg     = ( ! empty( $republicpg_options['transition-bg-color'] ) ) ? $republicpg_options['transition-bg-color'] : '#ffffff';
	$page_transition_bg_2   = ( ! empty( $republicpg_options['transition-bg-color-2'] ) ) ? $republicpg_options['transition-bg-color-2'] : $page_transition_bg;
	$page_transition_effect = ( ! empty( $republicpg_options['transition-effect'] ) ) ? $republicpg_options['transition-effect'] : 'standard';

	// set html bg color to match preloading screen to avoid white flash in chrome
	if ( $page_transition_effect == 'horizontal_swipe' ) {
		$css = 'html:not(.page-trans-loaded) { background-color: ' . $page_transition_bg_2 . '; }';
	} else {
		$css = 'html:not(.page-trans-loaded) { background-color: ' . $page_transition_bg . '; }';
	}

	wp_add_inline_style( 'main-styles', $css );

}

if ( ! empty( $republicpg_options['ajax-page-loading'] ) && $republicpg_options['ajax-page-loading'] == '1' && $transition_method == 'standard' ) {
	add_action( 'wp_enqueue_scripts', 'republicpg_page_transition_bg_fix' );
}






if ( ! function_exists( 'republicpg_header_social_icons' ) ) {

	function republicpg_header_social_icons( $location ) {
		global $republicpg_options;

		$social_networks    = array(
			'twitter'       => 'fa fa-twitter',
			'facebook'      => 'fa fa-facebook',
			'vimeo'         => 'fa fa-vimeo',
			'pinterest'     => 'fa fa-pinterest',
			'linkedin'      => 'fa fa-linkedin',
			'youtube'       => 'fa fa-youtube-play',
			'tumblr'        => 'fa fa-tumblr',
			'dribbble'      => 'fa fa-dribbble',
			'rss'           => 'fa fa-rss',
			'github'        => 'fa fa-github-alt',
			'google-plus'   => 'fa fa-google-plus',
			'instagram'     => 'fa fa-instagram',
			'stackexchange' => 'fa fa-stackexchange',
			'soundcloud'    => 'fa fa-soundcloud',
			'flickr'        => 'fa fa-flickr',
			'spotify'       => 'icon-blueprint-spotify',
			'vk'            => 'fa fa-vk',
			'vine'          => 'fa fa-vine',
			'behance'       => 'fa fa-behance',
			'houzz'         => 'fa fa-houzz',
			'yelp'          => 'fa fa-yelp',
			'snapchat'      => 'fa fa-snapchat',
			'mixcloud'      => 'fa fa-mixcloud',
			'bandcamp'      => 'fa fa-bandcamp',
			'tripadvisor'   => 'fa fa-tripadvisor',
			'telegram'      => 'fa fa-telegram',
			'slack'         => 'fa fa-slack',
			'medium'        => 'fa fa-medium',
			'phone'         => 'fa fa-phone',
			'email'         => 'fa fa-envelope',
		);
		$social_output_html = '';

		if ( $location == 'main-nav' ) {
			$social_link_before = '';
			$social_link_after  = '';
		} else {
			$social_link_before = '<li>';
			$social_link_after  = '</li>';
		}

		if ( $location == 'secondary-nav' ) {
			$social_output_html .= '<ul id="social">';
		}

		foreach ( $social_networks as $network_name => $icon_class ) {

			if ( $network_name == 'rss' ) {
				if ( ! empty( $republicpg_options[ 'use-' . $network_name . '-icon-header' ] ) && $republicpg_options[ 'use-' . $network_name . '-icon-header' ] == 1 ) {
					$republicpg_rss_url_link = ( ! empty( $republicpg_options['rss-url'] ) ) ? $republicpg_options['rss-url'] : get_bloginfo( 'rss_url' );
					$social_output_html .= $social_link_before . '<a target="_blank" href="' . esc_url( $republicpg_rss_url_link ) . '"><i class="' . $icon_class . '"></i> </a>' . $social_link_after;
				}
			} else {
				$target_attr = ($network_name != 'email' && $network_name != 'phone') ? 'target="_blank"' : '';
				if ( ! empty( $republicpg_options[ 'use-' . $network_name . '-icon-header' ] ) && $republicpg_options[ 'use-' . $network_name . '-icon-header' ] == 1 ) {
					$social_output_html .= $social_link_before . '<a '.$target_attr.' href="' . esc_url( $republicpg_options[ $network_name . '-url' ] ) . '"><i class="' . $icon_class . '"></i> </a>' . $social_link_after;
				}
			}
		}

		if ( $location == 'secondary-nav' ) {
			$social_output_html .= '</ul>';
		}

		echo $social_output_html; // WPCS: XSS ok.
	}
}









if ( ! function_exists( 'republicpg_header_button_items' ) ) {

	function republicpg_header_button_items() {
		global $republicpg_options;
		global $woocommerce;

		$headerSearch      = ( ! empty( $republicpg_options['header-disable-search'] ) && $republicpg_options['header-disable-search'] == '1' ) ? 'false' : 'true';
		$userAccountBtn    = ( ! empty( $republicpg_options['header-account-button'] ) && $republicpg_options['header-account-button'] == '1' ) ? 'true' : 'false';
		$userAccountBtnURL = ( ! empty( $republicpg_options['header-account-button-url'] ) ) ? $republicpg_options['header-account-button-url'] : '';
		$header_format     = ( ! empty( $republicpg_options['header_format'] ) ) ? $republicpg_options['header_format'] : 'default';

		$theme_skin = ( ! empty( $republicpg_options['theme-skin'] ) ) ? $republicpg_options['theme-skin'] : 'original';
		if ( $header_format == 'centered-menu-bottom-bar' ) {
			$theme_skin = 'material'; }

		$sideWidgetArea = ( ! empty( $republicpg_options['header-slide-out-widget-area'] ) && $header_format != 'left-header' ) ? $republicpg_options['header-slide-out-widget-area'] : 'off';

		if ( $headerSearch != 'false' ) {
			echo '<li id="search-btn"><div><a href="#searchbox"><span class="icon-blueprint-search" aria-hidden="true"></span></a></div> </li>';
		}

		if ( $userAccountBtn != 'false' ) {
			echo '<li id="republicpg-user-account"><div><a href="' . $userAccountBtnURL . '"><span class="icon-blueprint-m-user" aria-hidden="true"></span></a></div> </li>';
		}

		if ( ! empty( $republicpg_options['enable-cart'] ) && $republicpg_options['enable-cart'] == '1' && $theme_skin == 'material' ) {
			if ( $woocommerce ) {
				echo '<li class="republicpg-woo-cart">' . republicpg_header_cart_output() . '</li>';
			}
		}

		if ( $sideWidgetArea == '1' ) {
			echo '<li class="slide-out-widget-area-toggle" data-icon-animation="simple-transform">';
				echo '<div> <a href="#sidewidgetarea" class="closed"> <span> <i class="lines-button x2"> <i class="lines"></i> </i> </span> </a> </div>';
			echo '</li>';
		}

	}
}








if ( ! function_exists( 'republicpg_header_button_check' ) ) {
	function republicpg_header_button_check() {

		global $republicpg_options;
		global $woocommerce;

		$header_format     = ( ! empty( $republicpg_options['header_format'] ) ) ? $republicpg_options['header_format'] : 'default';
		$using_header_cart = ( $woocommerce && ! empty( $republicpg_options['enable-cart'] ) && $republicpg_options['enable-cart'] == '1' ) ? true : false;
		$user_account_btn  = ( ! empty( $republicpg_options['header-account-button'] ) && $republicpg_options['header-account-button'] == '1' ) ? true : false;
		$header_search     = ( ! empty( $republicpg_options['header-disable-search'] ) && $republicpg_options['header-disable-search'] == '1' ) ? false : true;
		$side_widget_area  = ( ! empty( $republicpg_options['header-slide-out-widget-area'] ) && $header_format != 'left-header' && $republicpg_options['header-slide-out-widget-area'] == '1' ) ? true : false;

		$header_buttons_active = ( $using_header_cart || $user_account_btn || $header_search || $side_widget_area ) ? 'yes' : 'no';

		return $header_buttons_active;
	}
}
