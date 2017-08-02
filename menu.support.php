<?php
$settings_key = $webweb_wp_mibew_obj->get('plugin_settings_key');
$opts = $webweb_wp_mibew_obj->get_options();
?>

<div class="webweb_wp_mibew">
    <div id="orbisius_simple_notice_admin_wrapper" class="wrap orbisius_simple_notice_admin_wrapper">
            <h2>WP Mibew : Help</h2>
            <p>
                This plugin allows you to show a simple notice to alert your users about server maintenance, new product launches etc.
            </p>

            <div id="poststuff">

                <div id="post-body" class="metabox-holder columns-2">

                    <!-- main content -->
                    <div id="post-body-content">

                        <div class="meta-box-sortables ui-sortable">

                            <div class="postbox">
                                <div class="inside">
                                    <p>
            <h3>How to use this plugin?</h3>
<pre>
1) Download Download Mibew chat software from <a href="http://mibew.org/download.php" target="_blank">http://mibew.org/download.php</a>
Unzip the archive and follow the instructions from the README file.

<strong>Note:</strong> This requires some technical knowledge or a tech savvy friend because
	it will require setting up a database, fixing file permissions etc.

OR

2) <strong>New:</strong> Buy <a href="http://club.orbisius.com/products/wordpress-plugins/orbisius-mibew-chat-installer/?utm_source=wp_mibew" target="_blank">Orbisius Mibew Chat Installer</a>
which will install mibew, create databases, configure it & create users for you automatically.
The only thing you need to do is to enter the name of the folder that you want the chat to be installed in.

3) Then configure WP Mibew plugin by setting the chat url.

4) Paste the short code within your posts, sidebar or theme files.
</pre>

        <h3>Demo</h3>

        <?php if (1) : ?>
            <p>
                Link: <a href="http://www.youtube.com/watch?v=OSKTfnUlg6g" target="_blank" title="[opens in a new and bigger tab/window]">http://www.youtube.com/watch?v=OSKTfnUlg6g</a>
            <p>
                <iframe width="640" height="380" src="http://www.youtube.com/embed/OSKTfnUlg6g?hl=en&fs=1" frameborder="0" allowfullscreen></iframe>
            </p>

            <?php
            $app_link = 'http://www.youtube.com/embed/OSKTfnUlg6g?hl=en&fs=1';
            $app_title = $webweb_wp_mibew_obj->get('app_title');
            $app_descr = $webweb_wp_mibew_obj->get('plugin_description');
            ?>

            <p>Share this video:
                <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_16x16_style">
                <a class="addthis_button_facebook" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_twitter" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_google_plusone" g:plusone:count="false" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_linkedin" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_email" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_myspace" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_google" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_digg" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_delicious" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_stumbleupon" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_googlebuzz" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_tumblr" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_favorites" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
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
            </p>
        <?php endif; ?>

        </p>
                                    
                                    
                                </div> <!-- .inside -->
                            </div> <!-- .postbox -->

                        </div> <!-- .meta-box-sortables .ui-sortable -->

                    </div> <!-- post-body-content -->

                    <!-- sidebar -->
                    <div id="postbox-container-1" class="postbox-container">

                        <div class="meta-box-sortables">

                            <!-- Hire Us -->
                            <div class="postbox">
                                <h3><span>Hire Us</span></h3>
                                <div class="inside">
                                    Hire us to create a plugin/web/mobile app
                                    <br/><a href="http://orbisius.com/page/free-quote/?utm_source=<?php echo str_replace('.php', '', basename(WP_MIBEW_MAIN_PLUGIN_FILE));?>&utm_medium=plugin-settings&utm_campaign=product"
                                       title="If you want a custom web/mobile app/plugin developed contact us. This opens in a new window/tab"
                                        class="button-primary" target="_blank">Get a Free Quote</a>
                                </div> <!-- .inside -->
                            </div> <!-- .postbox -->
                            <!-- /Hire Us -->

                            <div class="postbox">
                                <h3><span>Newsletter</span></h3>
                                <div class="inside">
                                    <!-- Begin MailChimp Signup Form -->
                                    <div id="mc_embed_signup">
                                        <?php
                                            $current_user = wp_get_current_user();
                                            $email = empty($current_user->user_email) ? '' : $current_user->user_email;
                                        ?>

                                        <form action="http://WebWeb.us2.list-manage.com/subscribe/post?u=005070a78d0e52a7b567e96df&amp;id=1b83cd2093" method="post"
                                              id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                                            <input type="hidden" value="settings" name="SRC2" />
                                            <input type="hidden" value="orbisius-child-theme-creator" name="SRC" />

                                            <span>Get notified about cool plugins we release</span>
                                            <!--<div class="indicates-required"><span class="app_asterisk">*</span> indicates required
                                            </div>-->
                                            <div class="mc-field-group">
                                                <label for="mce-EMAIL">Email <span class="app_asterisk">*</span></label>
                                                <input type="email" value="<?php echo esc_attr($email); ?>" name="EMAIL" class="required email" id="mce-EMAIL">
                                            </div>
                                            <div id="mce-responses" class="clear">
                                                <div class="response" id="mce-error-response" style="display:none"></div>
                                                <div class="response" id="mce-success-response" style="display:none"></div>
                                            </div>	<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button-primary"></div>
                                        </form>
                                    </div>
                                    <!--End mc_embed_signup-->
                                </div> <!-- .inside -->
                            </div> <!-- .postbox -->

                            <?php WebWeb_WP_Mibew_Widget::output_widget(); ?>

                            <!-- Support options v2 -->
                                <div class="postbox">
                                    <h3>
                                        <?php
                                                $plugin_data = get_plugin_data(WP_MIBEW_MAIN_PLUGIN_FILE);
                                                $product_name = trim($plugin_data['Name']);
                                                $product_page = trim($plugin_data['PluginURI']);
                                                $product_descr = trim($plugin_data['Description']);
                                                $product_descr_short = substr($product_descr, 0, 50) . '...';

                                                $base_name_slug = basename(WP_MIBEW_MAIN_PLUGIN_FILE);
                                                $base_name_slug = str_replace('.php', '', $base_name_slug);
                                                $product_page .= (strpos($product_page, '?') === false) ? '?' : '&';
                                                $product_page .= "utm_source=$base_name_slug&utm_medium=plugin-settings&utm_campaign=product";

                                                $product_page_tweet_link = $product_page;
                                                $product_page_tweet_link = str_replace('plugin-settings', 'tweet', $product_page_tweet_link);
                                            ?>
                                        <!-- Twitter: code -->
                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                        <!-- /Twitter: code -->

                                        <!-- Twitter: Orbisius_Follow:js -->
                                            <a href="https://twitter.com/orbisius" class="twitter-follow-button"
                                               data-align="right" data-show-count="false">Follow @orbisius</a>
                                        <!-- /Twitter: Orbisius_Follow:js -->

                                        &nbsp;

                                        <!-- Twitter: Tweet:js -->
                                        <a href="https://twitter.com/share" class="twitter-share-button"
                                           data-lang="en" data-text="Checkout <?php echo $product_name;?> #WordPress #plugin.<?php echo $product_descr_short; ?>"
                                           data-count="none" data-via="orbisius" data-related="orbisius"
                                           data-url="<?php echo $product_page_tweet_link;?>">Tweet</a>
                                        <!-- /Twitter: Tweet:js -->

                                        <br/>
                                        <span>
                                            <a href="<?php echo $product_page; ?>" target="_blank" title="[new window]">Product Page</a>
                                            |
                                            <a href="http://club.orbisius.com/forums/forum/community-support-forum/wordpress-plugins/<?php echo $base_name_slug;?>/?utm_source=<?php echo $base_name_slug;?>&utm_medium=plugin-settings&utm_campaign=product"
                                            target="_blank" title="[new window]">Support Forums</a>

                                             <!-- |
                                             <a href="http://docs.google.com/viewer?url=https%3A%2F%2Fdl.dropboxusercontent.com%2Fs%2Fwz83vm9841lz3o9%2FOrbisius_LikeGate_Documentation.pdf" target="_blank">Documentation</a>-->
                                        </span>
                                    </h3>
                                </div> <!-- .postbox -->
                                <!-- /Support options -->


                            <div class="postbox"> <!-- quick-contact -->
                                <?php
                                $current_user = wp_get_current_user();
                                $email = empty($current_user->user_email) ? '' : $current_user->user_email;
                                $quick_form_action = is_ssl()
                                        ? 'https://ssl.orbisius.com/apps/quick-contact/'
                                        : 'http://apps.orbisius.com/quick-contact/';

                                if (!empty($_SERVER['DEV_ENV'])) {
                                    $quick_form_action = 'http://localhost/projects/quick-contact/';
                                }
                                ?>
                                <script>
                                    var octc_quick_contact = {
                                        validate_form : function () {
                                            try {
                                                var msg = jQuery('#octc_msg').val().trim();
                                                var email = jQuery('#octc_email').val().trim();

                                                email = email.replace(/\s+/, '');
                                                email = email.replace(/\.+/, '.');
                                                email = email.replace(/\@+/, '@');

                                                if ( msg == '' ) {
                                                    alert('Enter your message.');
                                                    jQuery('#octc_msg').focus().val(msg).css('border', '1px solid red');
                                                    return false;
                                                } else {
                                                    // all is good clear borders
                                                    jQuery('#octc_msg').css('border', '');
                                                }

                                                if ( email == '' || email.indexOf('@') <= 2 || email.indexOf('.') == -1) {
                                                    alert('Enter your email and make sure it is valid.');
                                                    jQuery('#octc_email').focus().val(email).css('border', '1px solid red');
                                                    return false;
                                                } else {
                                                    // all is good clear borders
                                                    jQuery('#octc_email').css('border', '');
                                                }

                                                return true;
                                            } catch(e) {};
                                        }
                                    };
                                </script>
                                <h3><span>Quick Question or Suggestion</span></h3>
                                <div class="inside">
                                    <div>
                                        <form method="post" action="<?php echo $quick_form_action; ?>" target="_blank">
                                            <?php
                                                global $wp_version;
                                                $plugin_data = get_plugin_data(WP_MIBEW_MAIN_PLUGIN_FILE);

                                                $hidden_data = array(
                                                    'site_url' => site_url(),
                                                    'wp_ver' => $wp_version,
                                                    'first_name' => $current_user->first_name,
                                                    'last_name' => $current_user->last_name,
                                                    'product_name' => $plugin_data['Name'],
                                                    'product_ver' => $plugin_data['Version'],
                                                    'woocommerce_ver' => defined('WOOCOMMERCE_VERSION') ? WOOCOMMERCE_VERSION : 'n/a',
                                                );
                                                $hid_data = http_build_query($hidden_data);
                                                echo "<input type='hidden' name='data[sys_info]' value='$hid_data' />\n";
                                            ?>
                                            <textarea class="widefat" id='octc_msg' name='data[msg]' required="required"></textarea>
                                            <br/>Your Email: <input type="text" class=""
                                                   id="octc_email" name='data[sender_email]' placeholder="Email" required="required"
                                                   value="<?php echo esc_attr($email); ?>"
                                                   />
                                            <br/><input type="submit" class="button-primary" value="<?php _e('Send Feedback') ?>"
                                                        onclick="return octc_quick_contact.validate_form();" />
                                            <br/>
                                            What data will be sent
                                            <a href='javascript:void(0);'
                                                onclick='jQuery(".octc_data_to_be_sent").toggle();'>(show/hide)</a>
                                            <div class="hide app_hide octc_data_to_be_sent">
                                                <textarea class="widefat" rows="4" readonly="readonly" disabled="disabled"><?php
                                                foreach ($hidden_data as $key => $val) {
                                                    if (is_array($val)) {
                                                        $val = var_export($val, 1);
                                                    }

                                                    echo "$key: $val\n";
                                                }
                                                ?></textarea>
                                            </div>
                                        </form>
                                    </div>
                                </div> <!-- .inside -->
                             </div> <!-- .postbox --> <!-- /quick-contact -->

                        </div> <!-- .meta-box-sortables -->

                    </div> <!-- #postbox-container-1 .postbox-container sidebar -->

                </div> <!-- #post-body .metabox-holder .columns-2 -->

                <br class="clear">
            </div> <!-- #poststuff -->

            <?php WebWeb_WP_Mibew_Widget::output_widget(); ?>

            <!-- share -->
            <?php
            $plugin_data = get_plugin_data(WP_MIBEW_MAIN_PLUGIN_FILE);

            $app_link = urlencode($plugin_data['PluginURI']);
            $app_title = urlencode($plugin_data['Name']);
            $app_descr = urlencode($plugin_data['Description']);
            ?>

            <h2>Share</h2>
            <p>
                <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                <a class="addthis_button_facebook" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_twitter" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_google_plusone" g:plusone:count="false" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_linkedin" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_email" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_myspace" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_google" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_digg" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_delicious" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_stumbleupon" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_tumblr" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_favorites" addthis:url="<?php echo $app_link ?>" addthis:title="<?php echo $app_title ?>" addthis:description="<?php echo $app_descr ?>"></a>
                <a class="addthis_button_compact"></a>
            </div>
            <!-- The JS code is in the footer -->

            <script type="text/javascript">
                var addthis_config = {"data_track_clickback": true};
                var addthis_share = {
                    templates: {twitter: 'Check out {{title}} @ {{lurl}} (from @orbisius)'}
                }
            </script>
            <!-- AddThis Button START part2 -->
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=lordspace"></script>
            <!-- AddThis Button END part2 -->
        </p>
        <!-- /share -->

        <?php WebWeb_WP_Mibew_Widget::output_widget('author'); ?>
</div>
