<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://daryamazanenko.com
 * @since      1.0.0
 *
 * @package    Iwigi_Complete_Wc_Order
 * @subpackage Iwigi_Complete_Wc_Order/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Iwigi_Complete_Wc_Order
 * @subpackage Iwigi_Complete_Wc_Order/includes
 * @author     Darya Mazanenka <darya.mazanenko@gmail.com>
 */
class Iwigi_Complete_Wc_Order_i18n 
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'iwigi-complete-wc-order',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
