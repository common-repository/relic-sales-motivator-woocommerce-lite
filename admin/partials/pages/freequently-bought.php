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
	$option_group = $this->plugin_name."_bought_together" ;
	$relic_sm_bought_together = get_option( $option_group );
?>

<div class="wrap">
    <div class="relic-add-set-wrapper clearfix">
        <div class="relic-panel">
            <?php do_action("relic_smw_panel_header") ; ?>
           
            <div class="relic-boards-wrapper">
                 <div class="relic-sub-title"><?php _e('Frequently Bought', $this->plugin_name); ?></div>
                
                <div style="color:red">
                	Buy pro version for full feature.
                	<div class="relic-theme-image"><img src="<?php echo $this->images_dir.'bought-together.png';?>"/></div>
                </div>
            </div>
        </div>
    </div>
</div><!--div class wrap-->