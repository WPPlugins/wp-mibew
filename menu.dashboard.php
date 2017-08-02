<?php 
$opts = $webweb_wp_mibew_obj->get_options();
?>

<div class="webweb_wp_mibew">
    <div class="wrap">
        <h2><?php echo __('Dashboard', $webweb_wp_mibew_obj->plugin_id_str) ?></h2>

        <p>Please check the <a href="<?php echo $webweb_wp_mibew_obj->get('plugin_admin_url_prefix');?>/menu.support.php">Help</a> section if you need instructions how to use this plugin.</p>

		<?php include_once(dirname(__FILE__) . '/zzz_contact_form.php'); ?>
		
        <table class="app_table">
            <tr>
                <td>Plugin Status</td>
                <td><?php echo empty($opts['status']) ? WebWeb_WP_MibewUtil::msg('Disabled') : WebWeb_WP_MibewUtil::msg('Enabled', 1);?></td>
            </tr>            
        </table>

        <br class="clear_both"/>
        
		<?php echo $webweb_wp_mibew_common_obj->generate_newsletter_box(array('SRC2' => 'dashboard', )); ?>
        
        <?php echo $webweb_wp_mibew_common_obj->generate_donate_box(); ?>

        <?php include_once(dirname(__FILE__) . '/zzz_social_stuff.php'); ?>
    </div>
</div>
