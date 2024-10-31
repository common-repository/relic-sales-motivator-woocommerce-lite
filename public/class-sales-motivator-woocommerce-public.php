<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://reliccommerce.com
 * @since      1.0.0
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/public
 * @author     RelicCommerce <reliccommerce@gmail.com>
 */
class Sales_Motivator_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;
	public $plugin_display_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	private $resentSettings;
	private $productCount;
	private $pluginSettings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $display_name ) {
		$this->pluginSettings = get_option( $plugin_name."_settings" );;
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->plugin_display_name = $display_name;


		add_action( 'init', array($this,'init'), 20 );
	}

	function init(){
		if ( ! function_exists( 'is_plugin_active' ) )
    		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
    		
		if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			return;
		}
		
		$option_group = $this->plugin_name."_recent_sales" ;
		$this->resentSettings = get_option( $this->plugin_name."_recent_sales" );
		$this->productCount = 2;


		if( $this->pluginSettings['efree'] == 'yes'){
			add_action( 'wp_footer', array($this, 'top_bar_html_notification' ));
			add_filter('woocommerce_add_to_cart_fragments', array($this, 'relic_add_to_cart_fragment'));
			// add_action( 'woocommerce_remove_cart_item', array($this, 'relic_add_to_cart_fragment'), 10, 2 );
		}

		if( $this->pluginSettings['rsale'] == 'yes'){
			add_action( 'wp_footer', array($this, 'enable_product_sales_notification' ));
		}

		
	}
	//add to cart
	public function relic_frequently_bought_product_add_to_cart(){
		$products = explode(",", $_POST['products']);
		if( count($products) == 0 ){
			return wp_send_json( array('error' => "Select prodcuts first!", $status_code = 200 ));
		}
		// return wp_send_json( array('error' => "Select prodcuts first!", $status_code = 200 ));
		global $woocommerce;
		// $woocommerce->cart->add_to_cart(93, 1);
		try{
			foreach ($products as $value) {
				// $woocommerce->cart->add_to_cart($value, 1);
				$woocommerce->cart->add_to_cart( $value, $quantity = 1, $variation_id = '', $variation = array(), $cart_item_data = array('_relic_freequently_bought' => "1")  );
			}
		}catch(Exception $e){
			
		}
		
		return wp_send_json( array('url' => $woocommerce->cart->get_cart_url(), $status_code = 200 ));
	}

	function relic_add_to_cart_fragment($fragments) {
	    ob_start();
	    $this->top_bar_html_notification();
	    
	    $fragments['#smw-notice'] = ob_get_clean();

	    return $fragments;
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sales-motivator-woocommerce-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		
		// Enqueued script with localized data.
		wp_enqueue_script( "notify", plugin_dir_url( __FILE__ ) . 'js/notify.min.js', array('jquery'), $this->version, true );
		
		// Register the script
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sales-motivator-woocommerce-public.js', array( 'jquery' ), $this->version, true );
		$items = array();
		if( $this->pluginSettings['rsale'] == 'yes'){
			$items = $this->get_product_sales_notification();
		}

		$rsmw = array(
				'items' 			=> $items ,
				'position' 			=> $this->resentSettings['position'],
				'autoHide' 			=> $this->resentSettings['autohide'],
				'autoHideDelay' 	=> $this->resentSettings['autohidedelay'],
				'showAnimation' 	=> $this->resentSettings['showAnimation'],
				'hideAnimation' 	=> $this->resentSettings['hideAnimation'],
				'hideDuration' 		=> $this->resentSettings['hideDuration'],
				'showDuration' 		=> $this->resentSettings['showDuration'],

				'enableSalesNotification' 	=> $this->pluginSettings['rsale'],
				'enableFreequentlyBought'	=> $this->pluginSettings['fbsale'],

				'ajax_url' 			=> admin_url('admin-ajax.php'),
				
			);
		wp_localize_script( $this->plugin_name, 'RSMW', $rsmw);
		// Enqueued script with localized data.
		wp_enqueue_script( $this->plugin_name );

	}
	
	private function format_customer($customer){
		$time = strtotime($customer->date_created->date);
		$time = human_time_diff( $time, current_time('timestamp') ) . ' ago';
		
		$info = $customer->billing;
		return array(
			'first_name' 	=> $info->first_name,
			'last_name'		=> $info->last_name,
			'address_1'		=> $info->address_1,
			'email'			=> $info->email,
			'city'			=> $info->city,

			'total'			=> get_woocommerce_currency_symbol(). " " .$customer->total,
			'time'			=> $time
		);
	}

	private function format_item($item){
		// print_r( $item->get_product_id()); exit;
		$product = wc_get_product( $item->get_product_id());

		return array(
			"item_name"		=> $product->get_name(),
			"item_id"		=> $product->get_id(),
			"item_link"		=> get_permalink( $product->get_id() ),
			"item_desc"		=> get_the_excerpt( $product->get_id() ),
			"item_image" 	=> get_the_post_thumbnail_url( $product->get_id(), 'thumbnail' ),
			"item_price"	=> get_woocommerce_currency_symbol(). " " .$product->get_price()
		);
	}

	private function get_item_info($customer, $items){

		$all_product = array();
		$customer = $this->format_customer($customer);
		foreach($items as $item){
			$fItem = $this->format_item($item);
			$fItem["item_count"] = count($items);
			$all_product[] = array_merge($customer, $fItem);
		}

		return $all_product;
	}

	public function prepare_product_html($query){
		$product_html = array();
        if($query->have_posts()) { 
        	while($query->have_posts()) { $query->the_post();
    			ob_start();
			?>
				<div>
					<div class="live-sale-notify notification-1" style="background-color: <?php echo $this->resentSettings['bgcolor']; ?>; color:<?php echo $this->resentSettings['textcolor']; ?>; font-size:<?php echo $this->resentSettings['fontsize']; ?>px;">
			   			<div class="illustration">
			   				<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID())); ?>
					        <?php if($featured_image) { ?>
					        <a href="<?php echo get_the_permalink(); ?>">
			   					<img width="114" height="130" src="<?php echo $featured_image[0]; ?>">
			   				</a>
					        <?php } ?>
			   				
			   		</div>
			    
				      
				      <?php 
				      	$names = $this->resentSettings["vname"];
				      	$cities = $this->resentSettings["vcity"];
				      	$vcountry = $this->resentSettings["vcountry"];
				      	$vtime = $this->resentSettings["vtime"];

				      	$names = explode(",", $names);
				      	$cities = explode(",", $cities);
				      	$vcountry = explode(",", $vcountry);
				      	$vtime = explode(",", $vtime);
				      	
				      ?>
				      <div class="text">
				      	<?php echo esc_attr($names[rand(0, count($names)-1)]); ?> from <?php echo esc_attr($cities[rand(0, count($cities) -1 )]);?>, <?php echo esc_attr($vcountry[rand(0, count($vcountry)-1)]);?> purchased
				      </div>
				      
				      <div class="text" style="font-size: <?php echo $this->resentSettings['pfontsize']; ?>px;">
				      	<a href="<?php echo get_the_permalink(); ?>" style="color:<?php echo $this->resentSettings['linkcolor']; ?>"><?php echo get_the_title() ?></a>&nbsp;+&nbsp;<?php echo rand(1, 15);?> Other Items   
				      </div>

				      <div class="text">
				      	Total order for <?php echo get_woocommerce_currency_symbol(). " " .rand(100, 500) ?>
				  	  </div>
				       
				      <div class="text" style="font-size: <?php echo $this->resentSettings['tfontsize']; ?>px">
				      	about <?php echo esc_attr($vtime[rand(0, count($vtime) -1 )]);?> hours ago.
				  	  </div>
				      <div class="dismiss wc_feed_close_btn">&nbsp;</div>
					</div>
				</div>

				<?php
				$product_html[] = ob_get_contents();
				ob_end_clean();
    		               
        	} 
    	}

    	return $product_html;
	}

	public function get_featured_products(){
		 
		wp_reset_postdata();
		$meta_query   = WC()->query->get_meta_query();
        $meta_query[] = array(
            'key'   => '_featured',
            'value' => 'yes'
        );
        $args = array(
            'post_type'   =>  'product',
            'stock'       =>  1,
            'showposts'   =>  $this->productCount,
            'orderby'     =>  'date',
            'order'       =>  'DESC',
            'meta_query'  =>  $meta_query
        );

        $query = new WP_Query($args);
        $product_html = $this->prepare_product_html($query);
        wp_reset_postdata();

        return $product_html; 
	}

	public function get_latest_products(){
		wp_reset_postdata();
		$product_args = array(
            'post_type' => 'product',
            'posts_per_page' => $this->productCount
        );
        $query = new WP_Query($product_args);
        $product_html = $this->prepare_product_html($query);

        wp_reset_postdata();
        return $product_html;
	}
	public function get_onsale_products(){
		$on_sale = array(
            'post_type'      => 'product',
            'posts_per_page' => $this->productCount,
            'meta_query'     => array(
              'relation' => 'OR',
                array( // Simple products type
                  'key'           => '_sale_price',
                  'value'         => 0,
                  'compare'       => '>',
                  'type'          => 'numeric'
                  ),
                array( // Variable products type
                  'key'           => '_min_variation_sale_price',
                  'value'         => 0,
                  'compare'       => '>',
                  'type'          => 'numeric'
                  )
                )
          );
		wp_reset_postdata();

        $query = new WP_Query($on_sale);
        $product_html = $this->prepare_product_html($query);

        wp_reset_postdata();
        return $product_html;
	}

	public function get_upsale_products(){
		$upsell_product = array(
            'post_type'         => 'product',
            'meta_key'          => 'total_sales',
            'orderby'           => 'meta_value_num',
            'posts_per_page'    => $this->productCount
        );

        wp_reset_postdata();

        $query = new WP_Query($upsell_product);
        $product_html = $this->prepare_product_html($query);

        wp_reset_postdata();
        return $product_html;
	}

	/**
	 * Top/ bottom general /shipping notification
	 * @return html
	 */
	// Add scripts to wp_footer()
	public function top_bar_html_notification() {
		$option_group = $this->plugin_name."_free_shipping" ;
		$relic_sm_free_shipping = get_option( $this->plugin_name."_free_shipping" );
		$type = $relic_sm_free_shipping['type'];
		$message = $relic_sm_free_shipping['message'];

		if( $type == "dynamic"){
			$free_shipping_value = $relic_sm_free_shipping['prise'] ? $relic_sm_free_shipping['prise']: 0;
			

			$cart_price = 0;

			if ( ! WC()->cart->prices_include_tax ) {
			    $cart_price = WC()->cart->cart_contents_total;
			} else {
			    $cart_price = WC()->cart->cart_contents_total + WC()->cart->tax_total;
			}

			$near_price = $free_shipping_value - $cart_price;

			$format_price = get_woocommerce_currency_symbol(). " " . $near_price;

			if($near_price > 0) {
				$message = str_replace("{remaining_price}", $format_price ,$message);
				$message = $message.'<a id="NoteClose" class="open">x</a>';
			}else{
				$message = $relic_sm_free_shipping['cmessage'].'<a id="NoteClose">x</a>';
			}
		}else{
			$message = $message.'<a id="NoteClose">x</a>';
		}

		if( $relic_sm_free_shipping['position'] == 'top'){
			$t = "top:0";
			$close = "top:5px";
		}else{
			$t = "bottom:0";
			$close = "bottom:5px";
		}
		?>
		<style type="text/css">
			#smw-notice{
				background-color: <?php echo $relic_sm_free_shipping['bgcolor']; ?>;
				color: <?php echo $relic_sm_free_shipping['textcolor']; ?>;
				font-size: <?php echo $relic_sm_free_shipping['fontsize'] ; ?>px;
				<?php echo $t; ?>;
			}
			a#NoteClose{
				<?php echo $close; ?>;
			}
		</style>
		<div id="smw-notice">
			<?php echo wp_kses_post($message); ?>
		</div>
		<?php
	}

	public function enable_product_sales_notification(){
		// function move to enque script
		// bcz of javascript
	}

	/**
	 * Sales Notificaton HTML
	 * @return html
	 */
	public function get_product_sales_notification(){
		switch( $type = $this->resentSettings['type']){
			case 'feature_product':
				$product_html = $this->get_featured_products();
				break;
			case 'latest_product':
				$product_html = $this->get_latest_products();
				break;
			case 'onsale_product':
				$product_html = $this->get_onsale_products();
				break;
			
			case 'upsale_product':
				$product_html = $this->get_upsale_products();
				break;

			default:
				$product_html = array(); 
		}
		
		

		return $product_html;
	}

}