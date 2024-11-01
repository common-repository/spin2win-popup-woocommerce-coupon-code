<?php
/*
Plugin Name: Spin2Win PopUp (WooCommerce Coupon Code)
Plugin URI:  https://wordpress.org/plugins/spin2win-popup-woocommerce-coupon-code/
Description: Spin2Win is a WordPress Plugins to help WodPress lover. This plugin helps to get customer attraction by giving prizes. You can collect subscriber email through MailChimp Subscription. customisable, resolution independent spin wheel game whose outcomes you control. You Can use for WooCommerce Coupon Code For Customer discount While user exit from your site or after some time. There is settings to display.
Version:     20171019
Author:      spiderbuzz
Author URI:  http://spiderbuzz.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: spin2win-popup-plugin
Domain Path: /languages
*/
/**
* Restricting user to access this file directly (Security Purpose).
**/
if( ! defined( "ABSPATH" ) ) {
  die( "Sorry You Don't Have Permission To Access This Page." );
  exit;
}

/**
* Defining constant variable for plugin version, plugin path, plugin url and plugin domian name
**/

define( "SPIN2WINP_PLUGIN_VERSION", 1.0 );
define( "SPIN2WINP_PLUGIN_DIR", plugin_dir_path( __FILE__ ) );
define( "SPIN2WINP_PLUGIN_URL", plugins_url( '/', __FILE__ ) );
define( "SPIN2WINP_TEXT_DOMAIN", "spin2win-popup-plugin" );
require_once SPIN2WINP_PLUGIN_DIR.'spin2win-class.php';
if( is_admin() ) {
  new SPIN2WIN_AdminClass;
}
else {
  new SPIN2WIN_PublicClass;
}
register_activation_hook( __FILE__, array( 'SPIN2WIN_AdminClass', 'spin2win_setDefault_values' ) );
register_deactivation_hook( __FILE__, array( 'SPIN2WIN_AdminClass', 'spin2win_deleteDefault_values' ) );

//ajax setup for mailchimp
add_action( 'wp_ajax_mailchimp_subscription', array('SPIN2WIN_PublicClass','spin2win_mailchimp_subscription' ));
add_action( 'wp_ajax_nopriv_mailchimp_subscription', array('SPIN2WIN_PublicClass','spin2win_mailchimp_subscription' ));