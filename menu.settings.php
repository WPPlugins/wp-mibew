<?php
$settings_key = $webweb_wp_mibew_obj->get('plugin_settings_key');
$opts = $webweb_wp_mibew_obj->get_options();
?>

<div class="webweb_wp_mibew">
    <div id="orbisius_simple_notice_admin_wrapper" class="wrap orbisius_simple_notice_admin_wrapper">
            <h2>WP Mibew</h2>
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
                                    <?php if (!empty($_REQUEST['settings-updated'])) : ?>
                                        <div class="updated"><p>
                                            <strong>Settings saved.</strong>
                                        </p></div>
                                    <?php endif; ?>

                                    <form method="post" action="options.php">
                                        <?php settings_fields($webweb_wp_mibew_obj->get('plugin_dir_name')); ?>
                                        <table class="form-table">
                                            <tr valign="top">
                                                <th scope="row">Status</th>
                                                <td>
                                                    <label for="radio1">
                                                        <input type="radio" id="radio1" name="<?php echo $settings_key; ?>[status]"
                                                               value="1" <?php echo empty($opts['status']) ? '' : 'checked="checked"'; ?> /> Enabled
                                                    </label>
                                                    <br/>
                                                    <label for="radio2">
                                                        <input type="radio" name="<?php echo $settings_key; ?>[status]"  id="radio2"
                                                               value="0" <?php echo!empty($opts['status']) ? '' : 'checked="checked"'; ?> /> Disabled
                                                    </label>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row">URL where your chat is installed</th>
                                                <td><input type="text" name="<?php echo $settings_key; ?>[chat_url]" value="<?php echo $opts['chat_url']; ?>" class="webweb_wp_mibew_input widefat" />
                                                    <br/>
                                                    Example: http://yourdomain.com/chat
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row">Chat window style</th>
                                                <td>
                                                    <?php
                                                    $styles = array(
                                                        "default" => "Default",
                                                        "original" => "Original",
                                                        "simplicity" => "Simplicity",
                                                        "silver" => "Silver (Since v1.6.9)",
                                                    );
                                                    echo WebWeb_WP_MibewUtil::html_select($settings_key . '[chat_window_style]', $opts['chat_window_style'], $styles, 'class="webweb_wp_mibew_input"');
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row">Choose Image</th>
                                                <td>
                                                    <?php
                                                    $styles = array(
                                                        "mblue" => "mblue",
                                                        "mgreen" => "mgreen",
                                                        "simple" => "simple",
                                                        "webim" => "webim",
                                                    );

                                                    echo WebWeb_WP_MibewUtil::html_select($settings_key . '[chat_image]', $opts['chat_image'], $styles, 'class="webweb_wp_mibew_input" ');
                                                    ?>
                                                    <a href="javascript:void(0)" onclick="jQuery('.webweb_wp_mibew_support_images').toggle(); return false;">(show/hide image styles)</a>
                                                    <span class="app_hide webweb_wp_mibew_support_images">
                                                    <br/>
                                                    <table>
                                                        <?php  foreach (array_keys($styles) as $value) : ?>
                                                        <tr>
                                                            <td><?php echo $value; ?></td>
                                                            <td><img src="<?php echo $webweb_wp_mibew_obj->get('plugin_url') . 'images/chat_buttons/'.$value.'_on.gif';?>" alt="mblue" title="mblue" /></td>
                                                            <td><img src="<?php echo $webweb_wp_mibew_obj->get('plugin_url') . 'images/chat_buttons/'.$value.'_off.gif';?>" alt="mblue" title="mblue" /></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row">Chat Locale (optional but be careful)</th>
                                                <td><input type="text" name="<?php echo $settings_key; ?>[chat_locale]" value="<?php echo $opts['chat_locale']; ?>" class="webweb_wp_mibew_input" />
                                                    <br/>
                                                    Example: en
                                                    <p>Language packages: <a href="http://mibew.org/download.php" target="_blank">Download</a></p>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <th scope="row">Global Defaults (optional)</th>
                                                <td>
                                                    <?php if (WebWeb_WP_MibewUtil::has_global_data()) :?>
                                                        <label for="remove_defaults_checkbox" style="color: red;">
                                                            <input type="checkbox" name="<?php echo $settings_key; ?>[remove_defaults]"  id="remove_defaults_checkbox"
                                                                value="1" <?php echo empty($opts['remove_defaults']) ? '' : 'checked="checked"'; ?> />
                                                            Remove the global defaults.
                                                        </label>
                                                    <?php else : ?>
                                                        <label for="set_as_defaults_checkbox">
                                                            <input type="checkbox" name="<?php echo $settings_key; ?>[set_as_defaults]"  id="set_as_defaults_checkbox"
                                                                value="1" <?php echo empty($opts['set_as_defaults']) || 1 ? '' : 'checked="checked"'; ?> />
                                                            Make current chat settings global defaults.
                                                        </label>
                                                    <?php endif; ?>

                                                    <p>Global defaults are settings that will be used when the plugin is not configured for a site.
                                                        <br/>This is applicable when you have WordPress Multisite enabled and have one or more sites.
                                                        <br/>That way you won't have to configure the plugin for every single site you have.</p>
                                                </td>
                                            </tr>
                                        </table>

                                        <p class="submit">
                                            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                                        </p>
                                    </form>
                                    <div>
                                        <table width="75%" style="border:1px solid #eee;">
                                            <thead>
                                                <tr>
                                                    <td><h3>Preview</h3></td>
                                                    <td><h3>Current Settings
                                                        <?php
                                                            $local_opts = array();
                                                            $chat_snippet_ready = $webweb_wp_mibew_obj->get('chat_snippet');

                                                            if (empty($opts['status'])) {
                                                                if (WebWeb_WP_MibewUtil::has_global_data()) {
                                                                    echo "<small>(using global defaults)</small>";
                                                                    $local_opts = WebWeb_WP_MibewUtil::has_global_data(true);
                                                                } else {
                                                                    $chat_snippet_ready = WebWeb_WP_MibewUtil::msg('The preview is not available because the plugin is currently disabled.');
                                                                }
                                                            } else {
                                                                $local_opts = $opts;
                                                            }

                                                            if (!empty($local_opts)) {
                                                                $chat_snippet_ready = WebWeb_WP_MibewUtil::replace_vars($chat_snippet_ready, array(
                                                                    'CHAT_URL' => $local_opts['chat_url'],
                                                                    'CHAT_WINDOW_STYLE' => $local_opts['chat_window_style'],
                                                                    'CHAT_IMAGE' => $local_opts['chat_image'],
                                                                    'CHAT_LOCALE' => $local_opts['chat_locale'],
                                                                ));
                                                            }
                                                        ?>
                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php echo $chat_snippet_ready; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($local_opts)) : ?>
                                                        <table width="100%">
                                                            <tr>
                                                                <td>Chat URL</td>
                                                                <td><?php echo $local_opts['chat_url'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Chat Style</td>
                                                                <td><?php echo $local_opts['chat_window_style'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Chat Image</td>
                                                                <td><?php echo $local_opts['chat_image'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Locale</td>
                                                                <td><?php echo $local_opts['chat_locale'];?></td>
                                                            </tr>
                                                            <?php if (!empty($local_opts['created_on'])) : ?>
                                                            <tr>
                                                                <td>Host</td>
                                                                <td><?php echo $local_opts['host'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Last Updated on</td>
                                                                <td><?php echo date('r', $local_opts['created_on']);?></td>
                                                            </tr>
                                                            <?php endif; ?>
                                                        </table>
                                                        <?php else : ?>
                                                        N/A
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
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