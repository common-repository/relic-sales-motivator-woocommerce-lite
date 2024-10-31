<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://reliccommerce.com
 * @since      1.0.0
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/admin
 * @author     RelicCommerce <reliccommerce@gmail.com>
 */
class Sales_Motivator_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	private $plugin_display_name;
	private $iamges_dir;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	private $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $display_name ) {
		

		$this->settings = get_option( $plugin_name."_settings" );
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_display_name = $display_name;
		$this->images_dir = plugin_dir_url( __FILE__ )."images/";
		
		add_action( 'init', array($this,'init'), 20 );
	}

	function init(){
		if ( ! function_exists( 'is_plugin_active' ) )
    		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
     
		if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			return;
		}

		$this->admin_menu();
		$this->relic_add_action();

		add_action( 'admin_init', array($this,'relic_sales_motivator_register_settings') );

		// recent bought tab for wocommerce tab
		add_filter( 'woocommerce_product_data_tabs', array($this, 'sales_motivator_recent_bought_tab' ));
		// functions you can call to output text boxes, select boxes, etc.
		add_action('woocommerce_product_data_panels', array($this, 'relic_sales_volume_recent_bought_product_field'));

		add_action( 'woocommerce_process_product_meta', array( $this, 'save_relic_motivator_recent_bought_data' ));
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sales_Motivator_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sales_Motivator_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sales-motivator-woocommerce-admin.css', array("wp-color-picker"), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sales_Motivator_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sales_Motivator_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// wp_enqueue_script( 'select2', plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array('jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sales-motivator-woocommerce-admin.js', array('wp-color-picker', 'jquery' ), $this->version, false );


	}

	public function relic_add_action(){
    	add_action( "relic_smw_panel_header", array($this,"relic_sales_motivator_panel_header"), 10, 0 );
    }

	private function admin_menu(){
		add_action( 'admin_menu', array($this,'plugin_menu' ));
	}

	public function plugin_menu() {
		add_menu_page( 'Sales Motivator', 'Sales Motivator', 'manage_options', 'relic-sales-motivator', array($this,'relic_sales_motivator_main_menu' ), '', 25);
		
		if( $this->settings['efree'] == 'yes'){
			add_submenu_page(
				'relic-sales-motivator',
				'Free Shipping',
				'Free Shipping Notification',
				'manage_options',
				'relic-free-shipping-notification',
				array($this, 'relic_sales_motivator_free_shipping_menu' )
			);
		}

		if( $this->settings['rsale'] == 'yes'){
			add_submenu_page(
				'relic-sales-motivator',
				'Recent Sale Notification',
				'Recent Sale Notification',
				'manage_options',
				'relic-recent-sales-notification',
				array($this, 'relic_sales_motivator_recent_sales_menu' )
			);
		}

		if( $this->settings['fbsale'] == 'yes'){
			add_submenu_page(
				'relic-sales-motivator',
				'Frequently Bought Together',
				'Frequently Bought Together',
				'manage_options',
				'relic-freequently-bought-together',
				array($this, 'relic_sales_motivator_freequently_bought_together_menu' )
			);
		}
	}

	public function relic_sales_motivator_main_menu() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		require_once (plugin_dir_path( __FILE__ )."partials/sales-motivator-woocommerce-admin-display.php");
	}

	public function relic_sales_motivator_free_shipping_menu(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		require_once (plugin_dir_path( __FILE__ )."partials/pages/free-shipping.php");
	}

	public function relic_sales_motivator_recent_sales_menu(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		require_once (plugin_dir_path( __FILE__ )."partials/pages/recent-sales.php");
	}
	public function relic_sales_motivator_freequently_bought_together_menu(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		require_once (plugin_dir_path( __FILE__ )."partials/pages/freequently-bought.php");
	}
	


	
	/**
    * Register settings for plugin
    **/
    public function relic_sales_motivator_register_settings() {
		register_setting( 
        	$this->plugin_name."_settings", // option group name
        	$this->plugin_name."_settings", // option name
        	array($this, 'relic_sales_motivator_sanatize_setting') // callback
        );
        register_setting( 
        	$this->plugin_name."_free_shipping", // option group name
        	$this->plugin_name."_free_shipping", // option name
        	array($this, 'relic_sales_motivator_sanatize_setting') // callback
        );

        register_setting( 
        	$this->plugin_name."_recent_sales", // option group name
        	$this->plugin_name."_recent_sales", // option name
        	array($this, 'relic_sales_motivator_sanatize_setting') // callback
        );

        register_setting( 
        	$this->plugin_name."_bought_together", // option group name
        	$this->plugin_name."_bought_together", // option name
        	array($this, 'relic_sales_motivator_sanatize_setting') // callback
        );
    }

    /**
    * Sanitizing the submitted text
    **/
    public function relic_sales_motivator_sanatize_setting( $settings ) {
        $settings['relic_sales_motivator'] = trim( strip_tags( $settings['relic_sales_motivator'] ) );
        return $settings;
    }

    public function relic_sales_motivator_panel_header(){
    	?>
    	<div class="relic-settings-header">
            <div class="relic-logo">
                <img src="<?php echo $this->images_dir; ?>/reliccommerce.png" alt="<?php esc_attr_e($this->plugin_display_name, $this->plugin_name); ?>" />
            </div>               
            <div class="relic-title"><?php _e($this->plugin_display_name, $this->plugin_name); ?></div>
        </div>
       	<?php
    }


    //new tab for wocommerce product data
    // First Register the Tab by hooking into the 'woocommerce_product_data_tabs' filter 
    public function sales_motivator_recent_bought_tab( $product_data_tabs ) { 
    	$product_data_tabs['sales_recent_bought'] = array( 
    		'label' => __( 'Recently Bought Together', $this->plugin_name ), 
    		'target' => 'relic_recent_bought', 
    		'class' => array(  ), 
    		); 
    	return $product_data_tabs; 
    }


    

	function relic_sales_volume_recent_bought_product_field() {
	    global $post;

	    // Note the 'id' attribute needs to match the 'target' parameter set above
	    ?> 
	    <div id = 'relic_recent_bought' class = 'panel woocommerce_options_panel' > 
	    	<div class = 'options_group' > 
	    <?php
	    woocommerce_wp_radio(array(
	    	'id'=> "_relic_sales_recently_bought_type", 
	    	'name' => '_relic_sales_recently_bought_type',
	    	'label' => __('Data source', $this->plugin_name),
	    	'class' => 'relic_type',
	    	'options' => array(
	    		'real' => "Real",
	    		'manual' => 'Manual'
	    	)
	    ));
		// Select
		$this->woocommerce_wp_select_multiple(array());
	    ?> </div>

	    </div><?php
	}

	/** Hook callback function to save custom fields information */
	function save_relic_motivator_recent_bought_data($post_id) {
	    $text_field = $_POST['_relic_sales_recently_bought'];

	    if (!empty($text_field)) {
	        update_post_meta($post_id, '_relic_sales_recently_bought', wp_unslash($text_field));

	    }

	    $text_field = $_POST['_relic_sales_recently_bought_type'];
	    if (!empty($text_field)) {
	        update_post_meta($post_id, '_relic_sales_recently_bought_type', esc_attr($text_field));
	    }
	    
	}

	function woocommerce_wp_select_multiple( $field ) {
		global $post;
	    $relic_sales_recently_bought = get_post_meta( $post->ID, '_relic_sales_recently_bought', true );
	    if( !is_array($relic_sales_recently_bought)){
	    	$relic_sales_recently_bought = array();
	    }
	    
	    $args = array(
	        'post_type'      => 'product',
	        'posts_per_page' => -1
	    );

	    $loop = new WP_Query( $args );

	    

		?><p class='form-field _relic_sales_recently_bought'>
			<label for='_relic_sales_recently_bought'><?php _e( 'Select Products', $this->plugin_name ); ?></label>

			<select name='_relic_sales_recently_bought[]' class='wc-enhanced-select' multiple='multiple' style='width: 80%;' placeholder="Select Products">
			<?php 
				while ( $loop->have_posts() ) : $loop->the_post();
			        global $product;
			        ?>
			        	<option <?php selected( in_array( get_the_ID(), $relic_sales_recently_bought ) ); ?> value='<?php echo get_the_ID(); ?>'><?php echo get_the_title() ?></option>
			       	<?php
			    endwhile;

			    wp_reset_query();
			?>
				
			</select>
			
		</p>
		<?php
	}
}
