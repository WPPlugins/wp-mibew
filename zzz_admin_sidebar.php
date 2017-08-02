<style>
    .zzz_app_admin_sidebar {
      
    }

    .zzz_app_admin_sidebar .more_plugins_list li a {
        background: url("<?php echo $webweb_wp_mibew_obj->get('plugin_url')?>/zzz_media/star.png") no-repeat scroll 0 0 transparent;
        padding: 0 0 3px 20px;
    }
</style>
<div class="zzz_app_admin_sidebar">
        <?php echo $webweb_wp_mibew_common_obj->generate_newsletter_box(array('form_only' => 1, 'src2' => 'admin_sidebar')); ?>
        <br class="clear_both" />

        <div class="remote_content">
        </div>

		<div>
            <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Ffacebook.com%2FOrbisius&amp;width=292&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=true&amp;appId=142797889159780" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:590px;" allowTransparency="true"></iframe>
		</div>
</div>