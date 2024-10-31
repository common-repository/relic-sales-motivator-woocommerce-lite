<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://reliccommerce.com
 * @since      1.0.0
 *
 * @package    Sales_Motivator_Woocommerce
 * @subpackage Sales_Motivator_Woocommerce/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php
	$option_group = $this->plugin_name."_free_shipping" ;
	$relic_sm_free_shipping = get_option( $this->plugin_name."_free_shipping" );
?>

<div class="wrap">
    <div class="relic-add-set-wrapper clearfix">
        <div class="relic-panel">
            <?php do_action("relic_smw_panel_header") ; ?>
            <?php if(isset($_SESSION['sales_motivator_message'])){?><div class="relic-success-message"><p><?php echo $_SESSION['sales_motivator_message']; unset($_SESSION['sales_motivator_message']);?></p></div><?php }?>

            <div class="relic-boards-wrapper">
                 <div class="relic-sub-title"><?php _e('Free Shipping Notification Display Settings', $this->plugin_name); ?></div>
                <div class="metabox-holder">
                    <div id="relic" class="postbox" style="float: left;">
                    	<form class="relic-settings-form relic-tab-wrapper" method="post" action="options.php">
                    		<?php settings_fields( $this->plugin_name."_free_shipping"  ); ?>
                    		<div class="relic-option-inner-wrapper">
                    			<table class="form-table">
					                <tbody>                    
					                    <tr class="form-field">
					                        <th><label for="display_insta_blog_feeds"><?php _e('Notification Type:', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<select name="<?php echo $option_group; ?>[type]" id='notification_type'>
					                               
					                                <option value='static' <?php selected( $relic_sm_free_shipping['type'], 'static' ); ?> ><?php _e('General Notice',$this->plugin_name); ?></option>
					                                <option value='dynamic' <?php selected( $relic_sm_free_shipping['type'], 'dynamic' ); ?> ><?php _e('Free Shipping Notice',$this->plugin_name); ?></option>

					                            </select>
					                        </td>
					                    </tr>

					                    <tr class="shipping">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Free Shiping Price', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" name="<?php echo $option_group; ?>[prise]" value="<?php echo $relic_sm_free_shipping['prise'] ? $relic_sm_free_shipping['prise']: 100 ?>" />
					                        </td>
					                    </tr>

					                    <tr>
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Message', $this->plugin_name); ?></label></th>
					                        <td>
					                        	
					                        	<textarea rows="6" cols="40" name="<?php echo $option_group; ?>[message]"><?php echo $relic_sm_free_shipping['message']; ?></textarea>
					                        	<p class="shipping">Note: For remaining amount use this shortcode. {remaining_price}  </p>
					                        </td>
					                    </tr>

					                    <tr class="shipping">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Free Shiping Complete', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="text" name="<?php echo $option_group; ?>[cmessage]" value="<?php echo $relic_sm_free_shipping['cmessage'] ? $relic_sm_free_shipping['cmessage']: 'Congratulation! Now you got free shipping' ?>" />
					                        	<p>Note: Message after complete the freeshipping rule. </p>
					                        </td>
					                    </tr>

					                    
					                </tbody>
					            </table>

					            <div class="relic-sub-title"><?php _e('Notification Position', $this->plugin_name); ?></div>
					            <div class="relic-option-field">
					                <label>
					                    <input type="radio" name="<?php echo $option_group; ?>[position]" value="top" <?php if($relic_sm_free_shipping['position']=='top'){?>checked="checked"<?php }?>/><?php _e('Top', $this->plugin_name); ?>
					                    <div class="relic-theme-image"><img src="<?php echo $this->images_dir.'position_top.png';?>"/></div>
					                </label>
					                <label>
					                    <input type="radio" name="<?php echo $option_group; ?>[position]" value="bottom" <?php if($relic_sm_free_shipping['position']=='bottom'){?>checked="checked"<?php }?>/><?php _e('Bottom', $this->plugin_name); ?>
					                    <div class="relic-theme-image"><img src="<?php echo $this->images_dir.'position_buttom.png';?>"/></div>
					                </label>
					                
					                
					            </div>

					            <div class="relic-sub-title"><?php _e('Design', $this->plugin_name); ?></div>
					            <table class="form-table">
					                <tbody>                    
					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Background Color', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input class="dynamicColor" type="text" name="<?php echo $option_group; ?>[bgcolor]" value="<?php echo $relic_sm_free_shipping['bgcolor']; ?>" />
					                        </td>
					                    </tr>

					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Text Color', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input class="dynamicColor wp-color-picker" type="text" name="<?php echo $option_group; ?>[textcolor]" value="<?php echo $relic_sm_free_shipping['textcolor']; ?>"/>
					                        </td>
					                    </tr>

					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Font Size', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" min="12" max="25" name="<?php echo $option_group; ?>[fontsize]"  value="<?php echo $relic_sm_free_shipping['fontsize']; ?>"/>
					                        </td>
					                    </tr>

					                </tbody>
					            </table>

					        </div>
                            
                            <div id="relic-submit" class="relic-settings-submit">
                                <input type="submit" class="button button-primary" value="<?php _e('Save all changes', $this->plugin_name); ?>" name="settings_submit"/>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--div class wrap-->