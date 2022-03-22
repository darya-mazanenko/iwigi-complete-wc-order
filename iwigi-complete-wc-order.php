<?php
/**
 * Plugin Name:       IWIGI Complete WC Order
 * Plugin URI:        https://daryamazanenko.com
 * Description:       The plugin allows you to change order status 'Processing' to 'Completed' from an email notification.
 * Version:           1.0.0
 * Author:            Darya Mazanenka
 * Author URI:        https://daryamazanenko.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       iwigi-complete-wc-order
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin version.
 */
define( 'IWIGI_COMPLETE_WC_ORDER_VERSION', '1.0.0' );

/**
 * Check if WooCommerce is activated
 */
function iwigi_woocommerce_active_check() {
    if( ! class_exists( 'WooCommerce' ) ) {
        add_action( 'admin_notices', 'iwigi_print_notice' );
    }
}
add_action( 'plugins_loaded', 'iwigi_woocommerce_active_check' );

/**
 * Print admin notice if WooCommerce is not activated
 */
function iwigi_print_notice() {
    $class   = "notice notice-error";
    $message = "WooCommerce is not active. The IWIGI Complete Order From Email plugin requires WooCommerce to be installed and activated.";
    
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-iwigi-complete-wc-order.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_iwigi_complete_wc_order() {
	$plugin = new Iwigi_Complete_Wc_Order();
	$plugin->run();
}
run_iwigi_complete_wc_order();
