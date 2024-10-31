<?php defined( 'ABSPATH' ) or die( "No script kiddies please!" ); ?>
<div class="relic-boards-tabs" id="relic-board-display-settings">
    <!-- <div class="relic-sub-title"><?php //_e('Settings', $this->plugin_name); ?></div> -->
    
    <div class="relic-tab-wrapper">
        <table class="form-table">
            <tbody>                    
                <tr class="form-field">
                    <th><label for="display_insta_blog_feeds"><?php _e('Enable Free Shipping', $this->plugin_name); ?></label></th>
                    <td>
                        <select name="<?php echo $option_group; ?>[efree]" id='notification_type'>
                            <option value='yes' <?php selected( $relic_sm_free_shipping['efree'], 'yes' ); ?> ><?php _e('Yes',$this->plugin_name); ?></option>
                            <option value='no' <?php selected( $relic_sm_free_shipping['efree'], 'no' ); ?> ><?php _e('No',$this->plugin_name); ?></option>
                        </select>
                    </td>
                </tr>

                <tr class="form-field">
                    <th><label for="display_insta_blog_feeds"><?php _e('Enable Recent Sales', $this->plugin_name); ?></label></th>
                    <td>
                        <select name="<?php echo $option_group; ?>[rsale]" id='notification_type'>
                            <option value='yes' <?php selected( $relic_sm_free_shipping['rsale'], 'yes' ); ?> ><?php _e('Yes',$this->plugin_name); ?></option>
                            <option value='no' <?php selected( $relic_sm_free_shipping['rsale'], 'no' ); ?> ><?php _e('No',$this->plugin_name); ?></option>
                        </select>
                    </td>
                </tr>
                <tr class="form-field">
                    <th><label for="display_insta_blog_feeds"><?php _e('Enable Frequently Bought', $this->plugin_name); ?></label></th>
                    <td>
                        <select name="<?php echo $option_group; ?>[fbsale]" id='notification_type'>
                            <option value='yes' <?php selected( $relic_sm_free_shipping['fbsale'], 'yes' ); ?> ><?php _e('Yes',$this->plugin_name); ?></option>
                            <option value='no' <?php selected( $relic_sm_free_shipping['fbsale'], 'no' ); ?> ><?php _e('No',$this->plugin_name); ?></option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>
