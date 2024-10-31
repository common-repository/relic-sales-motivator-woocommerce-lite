<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://reliccommerce.com
 * @since      1.0.0
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/includes
 * @author     RelicCommerce <reliccommerce@gmail.com>
 */
class Sales_Motivator_Woocommerce_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sales-motivator-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
