<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class RepublicpgLove {

	function __construct() {
		add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_scripts' ) );
		add_action( 'wp_ajax_republicpg-love', array( &$this, 'ajax' ) );
		add_action( 'wp_ajax_nopriv_republicpg-love', array( &$this, 'ajax' ) );
	}

	function enqueue_scripts() {

		wp_enqueue_script( 'jquery' );

		$plugin_pages = array();

		// woocommerce
		global $woocommerce;
		if ( $woocommerce ) {

			if ( version_compare( $woocommerce->version, '3.0', '>=' ) ) {
				array_push( $plugin_pages, get_permalink( wc_get_page_id( 'shop' ) ) );
				$shop_sidebar = get_permalink( wc_get_page_id( 'shop' ) );
				array_push( $plugin_pages, $shop_sidebar . '?sidebar=true' );
			} else {
				array_push( $plugin_pages, get_permalink( woocommerce_get_page_id( 'shop' ) ) );
				$shop_sidebar = get_permalink( woocommerce_get_page_id( 'shop' ) );
				array_push( $plugin_pages, $shop_sidebar . '?sidebar=true' );
			}
		}

		// disqus
		$disqus_comments = ( function_exists( 'dsq_is_installed' ) ) ? 'true' : 'false';

		$options = get_republicpg_theme_options();
		global $post;

		wp_localize_script(
			'republicpgFrontend',
			'republicpgLove',
			array(
				'ajaxurl'        => esc_url( admin_url( 'admin-ajax.php' ) ),
				'postID'         => $post->ID,
				'rooturl'        => esc_url( home_url() ),
				'pluginPages'    => $plugin_pages,
				'disqusComments' => $disqus_comments,
				'loveNonce'      => wp_create_nonce( 'republicpg-love-nonce' ),
				'mapApiKey'      => ( ! empty( $options['google-maps-api-key'] ) ) ? $options['google-maps-api-key'] : '',
			)
		);
	}

	function ajax( $post_id ) {

		// update
		if ( isset( $_POST['loves_id'] ) ) {
			$loves_id = sanitize_text_field( $_POST['loves_id'] );
			$post_id  = str_replace( 'republicpg-love-', '', $loves_id );
			echo $this->love_post( $post_id, 'update' ); // WPCS: XSS ok.
		}

		// get
		else {
			$loves_id = sanitize_text_field( $_POST['loves_id'] );
			$post_id  = str_replace( 'republicpg-love-', '', $loves_id );
			echo $this->love_post( $post_id, 'get' ); // WPCS: XSS ok.
		}

		exit;
	}


	function love_post( $post_id, $action = 'get' ) {
		if ( ! is_numeric( $post_id ) ) {
			return;
		}

		switch ( $action ) {

			case 'get':
				$love_count = get_post_meta( $post_id, '_republicpg_love', true );
				if ( ! $love_count ) {
					$love_count = 0;
					add_post_meta( $post_id, '_republicpg_love', $love_count, true );
				}

				return '<span class="republicpg-love-count">' . esc_html( $love_count ) . '</span>';
			break;

			case 'update':
				if ( ! isset( $_POST['love_nonce'] ) ) {
					return;
				}

				$love_count = get_post_meta( $post_id, '_republicpg_love', true );
				if ( isset( $_COOKIE[ 'republicpg_love_' . $post_id ] ) ) {
					return esc_html( $love_count );
				}

				$love_count++;
				update_post_meta( $post_id, '_republicpg_love', $love_count );
				setcookie( 'republicpg_love_' . $post_id, $post_id, time() * 20, '/' );

				return '<span class="republicpg-love-count">' . esc_html( $love_count ) . '</span>';
			break;

		}
	}


	function add_love() {
		global $post;

		$output = $this->love_post( $post->ID );

		$class = 'republicpg-love';
		$title = esc_html__( 'Love this', 'blueprint' );
		if ( isset( $_COOKIE[ 'republicpg_love_' . $post->ID ] ) ) {
			$class = 'republicpg-love loved';
			$title = esc_html__( 'You already love this!', 'blueprint' );
		}

		$options           = get_republicpg_theme_options();
		$post_header_style = ( ! empty( $options['blog_header_type'] ) ) ? $options['blog_header_type'] : 'default';

		$masonry_type = ( ! empty( $options['blog_masonry_type'] ) ) ? $options['blog_masonry_type'] : 'classic';
		$heart_icon   = ( ! empty( $options['theme-skin'] ) && $options['theme-skin'] == 'ascend' ) ? '<div class="heart-wrap"><i class="icon-blueprint-heart-2"></i></div>' : '<i class="icon-blueprint-heart-2"></i>';

		if ( isset( $_COOKIE[ 'republicpg_love_' . $post->ID ] ) ) {
			$heart_icon = '<i class="icon-blueprint-heart-2 loved"></i>';
		}

		if ( ( $post->post_type == 'post' && is_single() ) && $post_header_style == 'default_minimal' ) {
			return '<a href="#" class="' . $class . '" id="republicpg-love-' . $post->ID . '" title="' . $title . '"> ' . $heart_icon . esc_html__( 'Love', 'blueprint' ) . '<span class="total_loves">' . $output . '</span></a>';
		} elseif ( ( $post->post_type == 'post' && is_single() ) && $post_header_style == 'fullscreen' ) {
			return '<a href="#" class="' . $class . '" id="republicpg-love-' . $post->ID . '" title="' . $title . '"> ' . $heart_icon . $output . ' <span class="love-txt plural">' . __( 'Loves', 'blueprint' ) . '</span><span class="love-txt single">' . __( 'Love', 'blueprint' ) . '</span></a>';
		} else {
			return '<a href="#" class="' . $class . '" id="republicpg-love-' . $post->ID . '" title="' . $title . '"> ' . $heart_icon . $output . '</a>';
		}

	}

}


global $republicpg_love;
$republicpg_love = new RepublicpgLove();

// get the ball rollin'
function republicpg_love( $return = '' ) {

	global $republicpg_love;

	if ( $return == 'return' ) {
		return $republicpg_love->add_love();
	} else {
		echo $republicpg_love->add_love(); // WPCS: XSS ok.
	}

}


