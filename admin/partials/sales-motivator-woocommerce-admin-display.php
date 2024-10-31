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
	$option_group = $this->plugin_name."_settings" ;
	$relic_sm_free_shipping = get_option( $this->plugin_name."_settings" );
?>

<div class="wrap">
    <div class="relic-add-set-wrapper clearfix">
        <div class="relic-panel">
            <?php do_action("relic_smw_panel_header") ; ?>
            <?php if(isset($_SESSION['sales_motivator_message'])){?><div class="relic-success-message"><p><?php echo $_SESSION['sales_motivator_message']; unset($_SESSION['sales_motivator_message']);?></p></div><?php }?>

            <div class="relic-boards-wrapper">
                <ul class="relic-settings-tabs">
                    <li><a href="javascript:void(0)" id="display-settings" class="relic-tabs-trigger relic-active-tab"><?php _e('Settings', $this->plugin_name) ?></a></li> 
                    <li><a href="javascript:void(0)" id="how_to_use-settings" class="relic-tabs-trigger"><?php _e('How to use', $this->plugin_name); ?></a></li>

                    <li><a href="javascript:void(0)" id="about-settings" class="relic-tabs-trigger"><?php _e('About Us', $this->plugin_name); ?></a></li>

                </ul>
                <div class="metabox-holder">
                    <div id="buzz" class="postbox">
                    	<form class="relic-settings-form" method="post" action="options.php">
                    		<?php settings_fields( $this->plugin_name."_settings"  ); ?>
                    		<?php
                                include_once('pages/settings.php');
                                include_once('pages/how-to-use.php');
                                include_once('pages/about.php');
                                wp_nonce_field('ibuzzf_settings_action', 'ibuzzf_settings_nonce');
                            ?>
                            <div id="relic-submit" class="relic-settings-submit">
                                <input type="submit" class="button button-primary" value="Save all changes" name="buzz_settings_submit"/>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div><!--div class wrap-->
