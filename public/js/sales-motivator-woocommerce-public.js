(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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
	$( window ).load(function() {

		jQuery('#NoteClose').click(function(){
			if( jQuery('#smw-notice').hasClass("open")){
				jQuery(this).text("+");
				jQuery('#smw-notice').addClass("close").removeClass("open");
		    }else{
				jQuery('#smw-notice').addClass("open").removeClass("close");
				jQuery(this).text("x");
		    }
		});

		// if sales notifcaiton enable
		if( RSMW.enableSalesNotification == 'yes') {
			var count = 1; 
			RSMW.items.forEach(function(item){
				$.notify.addStyle('foo-'+count, { html: item });
				count = count + 1;
			});
			var loadedCount = 1;
			sales_motivator_notification( loadedCount );
			loadedCount = loadedCount + 1;

			//add a new style 'foo'
			setInterval(function(){
				sales_motivator_notification( loadedCount );
				loadedCount = loadedCount + 1;
				if(loadedCount == RSMW.items.length + 1){
					loadedCount = 1;
				}
				
			}, (parseInt(RSMW.autoHideDelay) || 100000) + 1000)
			
			//listen for click events from this style
			$(document).on('click', '.dismiss.wc_feed_close_btn', function() {
			  //programmatically trigger propogating hide event
			  $(this).trigger('notify-hide');
			});
		}// end enable sales notifcation


		//if freequently bought toger enable
		if( RSMW.enableFreequentlyBought == 'yes') {
			//move to another file for bought together
			calculateRecentBoughtProduct();
			jQuery('.relic-frequently-bought-selector-list input').click(function(){
				var id = jQuery(this).attr('id');
			    var ele = jQuery('.relic-frequently-bought-products').find("[data-productId="+id+"]");
				ele.toggle();
				//update price
				calculateRecentBoughtProduct();
			})
		} // end freequenlt boguht together

		function calculateRecentBoughtProduct(){
			var price = 0;
			jQuery('.relic-frequently-bought-selector-list input').each(function(){
				if(jQuery(this).is(':checked')){
					price = parseFloat(price) + parseFloat(jQuery(this).data('productprice'));
			    }
			});

			jQuery('.relic-frequently-bought-total-price-price .amount').text(price);
		}


		// now add to cart
		jQuery('.relic-frequently-bought-add-button').click(function(){
			jQuery('.relic-frequently-bought-error').hide();
			var that = jQuery(this);
			var ids = [];
			jQuery('.relic-frequently-bought-selector-list input:checked').each(function(){
				ids.push(jQuery(this).attr('id'));
		    });
			that.attr('disabled','disabled');
			if( ids.length == 0 ){
				alert("Select Product first!")
				return;
			}

			jQuery.ajax({
		        type:"POST",
		        url: RSMW.ajax_url,
		        data: {
		            action: "relic_frequently_bought_product_add_to_cart",
		            products: ids.toString()
		        },
		        success:function(data){
		        	if( data.url ){
		        		window.location = data.url;
		        	}
		        	if(data.error){
		        		jQuery('.relic-frequently-bought-error').html(data.error);
		        		jQuery('.relic-frequently-bought-error').show();
		        	}
		        	that.removeAttr('disabled');
		        },
		        error: function(errorThrown){
		            jQuery('.relic-frequently-bought-error').html(errorThrown);
		            jQuery('.relic-frequently-bought-error').show();
		            that.removeAttr('disabled');
		        } 
		    
		    });
		});


	});

	function sales_motivator_notification( loadedCount ){
		$.notify(
		  "I'm to the right of this box", 
		  { 
		  	style:"foo-"+ loadedCount,
		  	position: RSMW.position || "top right",
		  	className: 'info',
		  	clickToHide: false,
		  	
			// whether to auto-hide the notification
			autoHide: parseInt(RSMW.autoHide) || true,
			// if autoHide, hide after milliseconds
			autoHideDelay: parseInt(RSMW.autoHideDelay) || 8000,
			// show the arrow pointing at the element
			arrowShow: false,
			// show animation
			showAnimation: RSMW.showAnimation || 'slideDown',
			// show animation duration
			showDuration: parseInt(RSMW.showDuration) || 400,
			// hide animation
			hideAnimation: RSMW.hideAnimation || 'slideUp',
			// hide animation duration
			hideDuration: parseInt(RSMW.hideDuration) || 200,
			  
		  }
		);
	}

})( jQuery );
