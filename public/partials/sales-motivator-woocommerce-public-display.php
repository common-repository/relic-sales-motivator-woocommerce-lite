<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://reliccommerce.com
 * @since      1.0.0
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/public/partials
 */
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="relic-frequently-bought-container">
   <h1 class="relic-frequently-bought-title"><?php echo wp_kses_post($frequentlyBoughtSettings['title']); ?></h1>

   <?php
   		$_pf = new WC_Product_Factory();
   		
   	if( $frequentlyBoughtSettings['showthumb'] == 'yes') { ?>
	   <ul class="relic-frequently-bought-products">
	   		<?php
	   		$product_count = 0;
	   		$totalAmount = 0;
	   		foreach($product_items as $item){
	   			if( $product_id == $item) continue; // ingore current product item
	   			
	   			$product_count++;
				$p = $_pf->get_product($item);
				if( $p->has_child()) continue; // ignore varible product for now

				$img_url = esc_url(get_the_post_thumbnail_url( $p->get_id(), 'thumbnail' ));
				$totalAmount = $totalAmount + $p->get_price();
				?>

		      <li data-productId='<?php echo $p->get_id();?>' class="relic-frequently-bought-product" style="<?php if( $product_count < count($product_items) ) { ?>background: url(&quot;../images/plus.png&quot;) <?php } ?> right center no-repeat;">
		         <a href="<?php echo esc_url( get_permalink( $p->get_id() ) ); ?>">
		            <div class="relic-frequently-bought-product-image" style="background-image: url(&quot;<?php echo $img_url; ?>&quot;);">
		            	
		            </div>
		         </a>
		      </li>

		    <?php } ?>
	   </ul>
   <?php } ?>

   <div class="relic-frequently-bought-form">
      	<div class="relic-frequently-bought-total-price-box">
	      	<span class="relic-frequently-bought-total-price-text"><?php _e('Total price:', $this->plugin_name); ?></span> 
	      	<span class="relic-frequently-bought-total-price-price">
	      		<span class="money">
	      			<span><?php echo get_woocommerce_currency_symbol(); ?></span>
	      			<span class="amount"><?php echo $totalAmount; ?></span>
	      		</span>
	      	</span>
      	</div>

      <div class="relic-frequently-bought-error"></div>

      <button class="relic-frequently-bought-add-button btn addtocart cartbutton"><span><?php _e('Add selected to cart', $this->plugin_name ); ?></span></button>
   </div>


   <ul class="relic-frequently-bought-selector-list">
   		<?php
   		foreach($product_items as $item){
			
			if( $product_id == $item) continue; // ingore current product item
			$p = $_pf->get_product($item);
   			if( $p->has_child()) continue; // ignore varible product for now
			?>
			<li style="list-style-type: none;">
				<input type="checkbox" class="relic-frequently-bought-selector-input" id="<?php echo $p->get_id(); ?>" name="<?php echo $p->get_id(); ?>" checked="checked" data-productPrice=<?php echo $p->get_price(); ?>>

				<span class="relic-frequently-bought-selector-label" for="<?php echo $p->get_id(); ?>">
					<span class="relic-frequently-bought-selector-label-name"><?php echo $p->get_name(); ?></span>
					<?php if( $frequentlyBoughtSettings['showdesc'] == 'yes') { ?>
					<span class="relic-frequently-bought-selector-label-description">
						<?php echo wp_kses_post(wp_trim_words( $p->get_short_description(), 20, '...' )); ?>
					</span>
					<?php } ?>
				</span>

				<span class="relic-frequently-bought-selector-label-price">
					<span class="money"> <?php echo $p->get_price_html(); ?> </span>
				</span>
				
			</li>

		<?php } ?>
   </ul>
</div>