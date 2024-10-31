<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://reliccommerce.com
 * @since             1.0.0
 * @package           Sales_Motivator_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Relic Sales Motivator WooCommerce Lite
 * Plugin URI:        http://reliccommerce.com/
 * Description:       Do you want to increase your per order value? We have very powerful sales motivator features bundled in a single plugin. This plugin helps you  increase conversions and maximize order value with a customizable free shipping notification bar, recent sales notification and frequently bought together widgets.

 * Version:           1.0.0
 * Author:            cyberkishor
 * Author URI:        http://reliccommerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sales-motivator-woocommerce-lite
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_SMW_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sales-motivator-woocommerce-activator.php
 */
function activate_sales_motivator_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sales-motivator-woocommerce-activator.php';
	Sales_Motivator_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sales-motivator-woocommerce-deactivator.php
 */
function deactivate_sales_motivator_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sales-motivator-woocommerce-deactivator.php';
	Sales_Motivator_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sales_motivator_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_sales_motivator_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sales-motivator-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sales_motivator_woocommerce() {

	$plugin = new Sales_Motivator_Woocommerce();
	$plugin->run();

}
run_sales_motivator_woocommerce();
//end