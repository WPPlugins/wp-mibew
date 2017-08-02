<style>
    .zzz_app_social_stuff_container {
      
    }
</style>
<div class="zzz_app_social_stuff_container">
        <?php
            $app_link = $webweb_wp_mibew_obj->get('plugin_home_page');
            $app_title = $webweb_wp_mibew_obj->get('app_title');
            $app_descr = $webweb_wp_mibew_obj->get('plugin_description');
		?>
		<h3>Love this plugin? Share it with your friends!</h3>
		<p>
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
			<a class="addthis_button_facebook" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_twitter" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_google_plusone" g:plusone:count="false" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_linkedin" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_email" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_myspace" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_google" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_digg" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_delicious" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_stumbleupon" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_tumblr" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_favorites" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
			<a class="addthis_button_compact"></a>
			</div>
			<!-- The JS code is in the footer -->
		</p>

		<script type="text/javascript">
		var addthis_config = {"data_track_clickback":true};
		var addthis_share = {
		  templates: { twitter: 'Check out {{title}} @ {{lurl}} (from @webwebsoft)' }
		}
		</script>
		<!-- AddThis Button START part2 -->
		<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=lordspace"></script>
		<!-- AddThis Button END part2 -->

		<h3>Facebook Share</h3>
		<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=163116837104802&amp;xfbml=1"></script><fb:like href="<?php echo $webweb_wp_mibew_obj->get('plugin_home_page');?>" send="true" width="450" show_faces="true" font="arial"></fb:like>

		<h3>Comment</h3>
		<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="<?php echo $webweb_wp_mibew_obj->get('plugin_home_page');?>" num_posts="5" width="500"></fb:comments>	
</div>