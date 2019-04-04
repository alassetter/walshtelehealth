<?php
// Remove Header items
//Remove WORDPRESS version.
//<meta name="generator" content="WordPress __WP_VERSION__" />
remove_action('wp_head', 'wp_generator');

//-Feeds--------------------------------------------------------//
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed

//-Links--------------------------------------------------------//
//Link to adjacent posts.
//<link rel="prev" title="adjacent_posts_rel_link" href="__SITE_URL__" />
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
//Link to blog index.
//<link rel="index" title="__SITE_NAME__" href="__SITE_URL__" />
remove_action('wp_head', 'index_rel_link');
//Really Simple Discovery support.
//<link rel="EditURI" type="application/rsd+xml" title="RSD" href="__SITE_URL__" />
remove_action('wp_head', 'rsd_link');
//Remove Shortlink Link Rel Hook
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
//Windows Live Writter support.
//<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="__SITE_URL__" />
remove_action('wp_head', 'wlwmanifest_link');
//Others
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);

add_action('init', '_cw_disable_wp_emojicons');
function _cw_disable_wp_emojicons()
{
    //All actions related to emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
}

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove All Yoast HTML Comments
// https://gist.github.com/paulcollett/4c81c4f6eb85334ba076
if (defined('WPSEO_VERSION')){
  add_action('get_header',function (){ ob_start(function ($o){
  return preg_replace('/^<!--.*?[Y]oast.*?-->$/mi','',$o); }); });
  add_action('wp_head',function (){ ob_end_flush(); }, 999);
}

add_action( 'loop_start', 'before_single_post_content' );
function before_single_post_content() {
if ( is_singular( 'post') ) {
$cf = get_post_meta( get_the_ID(), 'custom_field_name', true );
if( ! empty( $cf ) ) {
echo '<div class="before-content">'. $cf .'</div>';
    }
  }
}

?>
