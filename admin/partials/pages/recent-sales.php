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
	$option_group = $this->plugin_name."_recent_sales" ;
	$relic_sm_recent_sales = get_option( $this->plugin_name."_recent_sales" );
?>

<div class="wrap">
    <div class="relic-add-set-wrapper clearfix">
        <div class="relic-panel">
            <?php do_action("relic_smw_panel_header") ; ?>
            <?php if(isset($_SESSION['sales_motivator_message'])){?><div class="relic-success-message"><p><?php echo $_SESSION['sales_motivator_message']; unset($_SESSION['sales_motivator_message']);?></p></div><?php }?>

            <div class="relic-boards-wrapper">
                <div class="relic-sub-title"><?php _e('Recent Sales Notification Display Settings', $this->plugin_name); ?></div>
                <div class="metabox-holder">
                    <div id="relic" class="postbox" style="float: left;">
                    	<form class="relic-settings-form relic-tab-wrapper" method="post" action="options.php">
                    		<?php settings_fields( $this->plugin_name."_recent_sales"  ); ?>
                    		<div class="relic-option-inner-wrapper">
                    			<table class="form-table">
					                <tbody>                    
					                    <tr class="form-field">
					                        <th><label for="display_insta_blog_feeds"><?php _e('Products From', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<select name="<?php echo $option_group; ?>[type]" id='relic_product_from'>
					                               
					                                <option value='feature_product' <?php selected( $relic_sm_recent_sales['type'], 'feature_product' ); ?> ><?php _e('Feature Product',$this->plugin_name); ?></option>
					                                <option value='latest_product' <?php selected( $relic_sm_recent_sales['type'], 'latest_product' ); ?> ><?php _e('Latest Product',$this->plugin_name); ?></option>

					                                 <option value='onsale_product' <?php selected( $relic_sm_recent_sales['type'], 'onsale_product' ); ?> ><?php _e('Onsale Product',$this->plugin_name); ?></option>
					                                 <option value='upsale_product' <?php selected( $relic_sm_recent_sales['type'], 'upsale_product' ); ?> ><?php _e('Upsale Product',$this->plugin_name); ?></option>

					                            </select>
					                            <p style="color:red">Pro Version: product from real order, and unlimited products</p>Now it shows only 3 products.
					                        </td>
					                    </tr>
					                    <tr class="numberofproduct fake">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Number of product', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" name="<?php echo $option_group; ?>[product_count]" value="<?php echo $relic_sm_recent_sales['product_count']; ?>" min ="1" />
					                        	
					                        </td>
					                    </tr> 

					                    <tr class="real">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Orders Within', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" name="<?php echo $option_group; ?>[days]" value="<?php echo $relic_sm_recent_sales['days']; ?>" min ="1" /> Days
					                        	
					                        </td>
					                    </tr> 

					                    <tr class="real">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Message', $this->plugin_name); ?></label></th>
					                        <td>
					                        	
					                        	<textarea rows="6" cols="40" name="<?php echo $option_group; ?>[message]"><?php echo $relic_sm_recent_sales['message']; ?></textarea>
					                        	<p>
					                        		{first_name} - Customer first name <br/>
					                        		{last_name} - Customer last name <br/>
													{city} - Customer city <br/>
													{address_1} - Customer country <br/>
													
												</p>
					                        </td>
					                    </tr>
					                    <!-- for fake -->
					                    <tr class="fake">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Virtual First Name', $this->plugin_name); ?></label></th>
					                        <td>
					                        	
					                        	<textarea rows="6" cols="40" name="<?php echo $option_group; ?>[vname]"><?php echo $relic_sm_recent_sales['vname']; ?></textarea>
					                        	<p style="color:red">For real name you can use pro version</p>
					                        </td>
					                    </tr>

					                    <tr class="fake">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Virtual City', $this->plugin_name); ?></label></th>
					                        <td>
					                        	
					                        	<textarea rows="6" cols="40" name="<?php echo $option_group; ?>[vcity]"><?php echo $relic_sm_recent_sales['vcity']; ?></textarea>
					                        	<p style="color:red">For real city you can use pro version</p>
					                        </td>
					                    </tr>
					                    <tr class="fake">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Virtual Country', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="text" name="<?php echo $option_group; ?>[vcountry]" value="<?php echo $relic_sm_recent_sales['vcountry']; ?>" min ="1" />
					                        	<p style="color:red">For real country you can use pro version</p>
					                        </td>
					                    </tr>
					                    <tr class="fake">
					                    	<th><label for="display_insta_blog_feeds"><?php _e('Virtual Time', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="text" name="<?php echo $option_group; ?>[vtime]" value="<?php echo $relic_sm_recent_sales['vtime']; ?>" min ="1" /> Hours
					                        	
					                        </td>
					                    </tr>
					                    




					                    
					                </tbody>
					            </table>

					            <div class="relic-sub-title"><?php _e('Notification Position', $this->plugin_name); ?></div>
					            <div class="relic-option-field">
					                <label>
					                    <input type="radio" name="<?php echo $option_group; ?>[position]" value="left bottom" <?php if($relic_sm_recent_sales['position']=='left bottom'){?>checked="checked"<?php }?>/><?php _e('Bottom Left', $this->plugin_name); ?>
					                    <div class="relic-theme-image"><img src="<?php echo $this->images_dir.'position_1.jpg';?>"/></div>
					                </label>
					                <label>
					                    <input type="radio" name="<?php echo $option_group; ?>[position]" value="right bottom" <?php if($relic_sm_recent_sales['position']=='right bottom'){?>checked="checked"<?php }?>/><?php _e('Bottom Right', $this->plugin_name); ?>
					                    <div class="relic-theme-image"><img src="<?php echo $this->images_dir.'position_2.jpg';?>"/></div>
					                </label>
					                
					                <label>
					                    <input type="radio" name="<?php echo $option_group; ?>[position]" value="top left" <?php if($relic_sm_recent_sales['position']=='top left'){?>checked="checked"<?php }?>/><?php _e('Top Left', $this->plugin_name); ?>
					                    <div class="relic-theme-image"><img src="<?php echo $this->images_dir.'position_4.jpg';?>"/></div>
					                </label>
					                <label>
					                    <input type="radio" name="<?php echo $option_group; ?>[position]" value="top right" <?php if($relic_sm_recent_sales['position']=='top right'){?>checked="checked"<?php }?>/><?php _e('Top Right', $this->plugin_name); ?>
					                    <div class="relic-theme-image"><img src="<?php echo $this->images_dir.'position_3.jpg';?>"/></div>
					                </label>

					            </div>
					            <table class="form-table">
					                <tbody>
					                	<tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Auto Hide', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="radio" name="<?php echo $option_group; ?>[autohide]" value="1" <?php checked( $relic_sm_recent_sales['autohide'], '1'); ?>/>  Yes
					                        	<input type="radio" name="<?php echo $option_group; ?>[autohide]" value="0" <?php checked( $relic_sm_recent_sales['autohide'], '0'); ?>/>  No
					                        </td>
					                    </tr>
					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Auto Hide Delay', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" name="<?php echo $option_group; ?>[autohidedelay]" value="<?php echo $relic_sm_recent_sales['autohidedelay']; ?>" min ="8000" />
					                        </td>
					                    </tr>
					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Hide Duration', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" name="<?php echo $option_group; ?>[hideDuration]" value="<?php echo $relic_sm_recent_sales['hideDuration']; ?>" min ="200" />
					                        </td>
					                    </tr>
					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Show Duration', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" name="<?php echo $option_group; ?>[showDuration]" value="<?php echo $relic_sm_recent_sales['showDuration']; ?>" min ="400" />
					                        </td>
					                    </tr>

					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Show Animation', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<select name="<?php echo $option_group; ?>[showAnimation]">
					                               
					                                <option value='slideDown' <?php selected( $relic_sm_recent_sales['showAnimation'], 'slideDown' ); ?> ><?php _e('Slide Down',$this->plugin_name); ?></option>
					                                <option value='slideUp' <?php selected( $relic_sm_recent_sales['showAnimation'], 'slideUp' ); ?> ><?php _e('Slide Up',$this->plugin_name); ?></option>


					                            </select>
					                        </td>
					                    </tr>

					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Hide Animation', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<select name="<?php echo $option_group; ?>[hideAnimation]">
					                               
					                                <option value='slideDown' <?php selected( $relic_sm_recent_sales['hideAnimation'], 'slideDown' ); ?> ><?php _e('Slide Down',$this->plugin_name); ?></option>
					                                <option value='slideUp' <?php selected( $relic_sm_recent_sales['hideAnimation'], 'slideUp' ); ?> ><?php _e('Slide Up',$this->plugin_name); ?></option>


					                            </select>
					                        </td>
					                    </tr>
					                    

					                </tbody>
					            </table>


					            <div class="relic-sub-title"><?php _e('Design', $this->plugin_name); ?></div>
					            <table class="form-table">
					                <tbody>                    
					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Background Color', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input class="dynamicColor" type="text" name="<?php echo $option_group; ?>[bgcolor]" value="<?php echo $relic_sm_recent_sales['bgcolor']; ?>" />
					                        </td>
					                    </tr>

					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Text Color', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input class="dynamicColor wp-color-picker" type="text" name="<?php echo $option_group; ?>[textcolor]" value="<?php echo $relic_sm_recent_sales['textcolor']; ?>"/>
					                        </td>
					                    </tr>
					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Link Color', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input class="dynamicColor wp-color-picker" type="text" name="<?php echo $option_group; ?>[linkcolor]" value="<?php echo $relic_sm_recent_sales['linkcolor']; ?>"/>
					                        </td>
					                    </tr>

					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Font Size', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" min="12" max="25" name="<?php echo $option_group; ?>[fontsize]"  value="<?php echo $relic_sm_recent_sales['fontsize']; ?>"/>
					                        </td>
					                    </tr>

					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Product Title Font Size', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" min="12" max="25" name="<?php echo $option_group; ?>[pfontsize]"  value="<?php echo $relic_sm_recent_sales['pfontsize']; ?>"/>
					                        </td>
					                    </tr>

					                    
					                    <tr class="form-field">
					                        <th>
					                        	<label for="display_insta_blog_feeds"><?php _e('Time Line Font Size', $this->plugin_name); ?></label></th>
					                        <td>
					                        	<input type="number" min="6" max="25" name="<?php echo $option_group; ?>[tfontsize]"  value="<?php echo $relic_sm_recent_sales['tfontsize']; ?>"/>
					                        </td>
					                    </tr>

					                </tbody>
					            </table>

					        </div>
                            <h3 style="color:red"> Pro Version </h3>
                            <div class="relic-theme-image"><img src="<?php echo $this->images_dir.'recent-sales-setting.png';?>"/></div>

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