<?php

/**
 * Fired during plugin activation
 *
 * @link       http://reliccommerce.com
 * @since      1.0.0
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/includes
 * @author     RelicCommerce <reliccommerce@gmail.com>
 */
class Sales_Motivator_Woocommerce_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$plugin_name = 'sales-motivator-woocommerce-lite';
		$key = $plugin_name."_recent_sales";
		// $relic_sm_recent_sales = get_option( $key );
		$default_value = array(
				'type'			=> 'feature_product',
				'product_count'	=> 9,
				'days'			=>20,
				'message'		=> '{first_name} {last_name} from {address_1}, {city} bought',
				'vname'			=> 'Oliver, Jack, Harry, Jacob, Charle, Thomas, Jeems',
				'vcity'			=> 'New York City, Los Angeles, Chicago, Dallas-Fort Worth, Houston, Philadelphia, Washington, D.C.',
				'vcountry'		=> 'United States',
				'vtime'			=> 9,
				'position'		=> 'right bottom',
				'autohide'		=> 1,
				'autohidedelay'	=> 9000,
				'hideDuration'	=> 400,
				'showDuration'	=> 500,
				'showAnimation'	=> 'slideDown',
				'hideAnimation'	=> 'slideUp',
				'bgcolor'		=> "#ffffff",
				'textcolor'		=> '#000000',
				'linkcolor'		=> '#e832f2',
				'fontsize'		=> 14,
				'pfontsize'		=> 19,
				'tfontsize'		=> 10
			);
		update_option( $key, $default_value, $autoload=true );

		// free shipping
		$key = $plugin_name."_free_shipping";
		$default = array(
				'type' => 'dynamic',
				"prise"	=> 1000,
				'message' => 'You are <strong>{remaining_price}</strong> away from free shipping!',
				'cmessage' => "Congratulation! You've got free shipping!",
				'position'	=> 'top',
				'bgcolor' 	=> '#1a0070',
				'textcolor'	=> '#ffffff',
				'fontsize'	=> 20
		);
		update_option( $key, $default, $autoload = true );

		//freequently bought together
		$key = $plugin_name."_bought_together";
		// print_r(get_option( $key, true )); exit;

		$default = array(
				'title' => 'Frequently Bought Together',
				"type"	=> 'real',
				'showthumb' => 'yes',
				'showdesc'	=> 'yes',
				'product_count' => 4
		);
		update_option( $key, $default, $autoload = true );


		// main settings page
		//freequently bought together
		$key = $plugin_name."_settings";
		// print_r(get_option( $key, true )); exit;
		// Array ( [efree] => yes [rsale] => yes [fbsale] => yes [relic_sales_motivator] => )
		$default = array(
				'efree' => 'yes',
				"rsale"	=> 'yes',
				'fbsale' => 'yes'
		);
		update_option( $key, $default, $autoload = true );
		
	}

}
