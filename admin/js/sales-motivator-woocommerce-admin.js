(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function() {
		 $('.relic-tabs-trigger').click(function(){
	        $('.relic-tabs-trigger').removeClass('relic-active-tab');
	        $(this).addClass('relic-active-tab');
	        var board_id = 'relic-board-'+$(this).attr('id');
	        $('.relic-boards-tabs').hide();
	        $('#'+board_id).show();
	    });

		jQuery(".dynamicColor").wpColorPicker();

		jQuery("#relic_product_from").trigger("change");

		jQuery("#relic_product_from").change(function(){
			if(jQuery(this).val() == 'real'){
				jQuery("tr.real").show();
				jQuery("tr.fake").hide();
		    } else{
				jQuery("tr.real").hide();
				jQuery("tr.fake").show();
		    }
		});

		jQuery("#relic_product_from").trigger("change");

		jQuery("#notification_type").change(function(){
			if( jQuery(this).val() == 'static') {
				jQuery("tr.shipping, p.shipping").hide();
			}else{
				jQuery("tr.shipping, p.shipping").show();
			}
		});
		jQuery("#notification_type").trigger("change");

		// recently bought together
		function recent_bought_tab_hide_show(){
			var val = jQuery("._relic_sales_recently_bought_type_field input:checked").val();
			if( val == "manual") 
				jQuery('._relic_sales_recently_bought').show();
			else{
				jQuery('._relic_sales_recently_bought').hide();
			}
		}
		jQuery('._relic_sales_recently_bought_type_field input').click(function(){
			recent_bought_tab_hide_show();
		});
		recent_bought_tab_hide_show();
	});
})( jQuery );
