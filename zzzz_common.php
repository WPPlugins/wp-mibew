<?php

/**
 * Provides a common base class for every plugin class developed by the http://orbisius.com team
 * @author Svetoslav Marinov <slavi@slavi.biz> | http://orbisius.com
 * @package WebWeb_WP_MibewBase
 */
class WebWeb_WP_MibewBase {

    protected $log = 0;
    protected static $instance = null; // singleton
    protected $site_url = null; // filled in later
    protected $plugin_url = null; // filled in later
    protected $plugin_settings_key = null; // filled in later
    protected $plugin_base_dir = null; // filled in later
    protected $plugin_dir_name = null; // filled in later
    protected $plugin_data_dir = null; // plugin data directory. for reports and data storing. filled in later
    protected $plugin_name = null;
    protected $plugin_id_str = null;
    protected $plugin_short_code = null;
    protected $plugin_support_link = null;
    protected $plugin_support_domain = 'Orbisius.com (former webweb.ca)'; //
    protected $plugin_support_domain_url = 'http://orbisius.com'; //
    protected $plugin_support_email = 'help@orbisius.com'; //
    protected $plugin_cron_hook = __CLASS__;
    protected $plugin_cron_freq = 'daily';
    // PayPal related
    protected $plugin_business_sandbox = false; // sandbox or live ???
    protected $plugin_business_email_sandbox = 'seller_1264288169_biz@slavi.biz'; // used for paypal payments
    protected $plugin_business_email = 'billing@orbisius.com'; // used for paypal payments
    protected $plugin_business_ipn = 'http://orbisius.com/wp/hosted/payment/ipn.php'; // used for paypal IPN payments
    //protected $plugin_business_status_url = 'http://localhost/wp/hosted/payment/status.php'; // used after paypal TXN to to avoid warning of non-ssl return urls
    protected $plugin_business_status_url = 'https://ssl.orbisius.com/gateway/?_auth&r=http://orbisius.com/wp/hosted/payment/status.php'; // used after paypal TXN to to avoid warning of non-ssl return urls
    protected $base_plugin_default_opts = array(
        'status' => 0,
        'newsletter_popup_dismissed' => -1,
        'newsletter_popup_dismissed_time' => 0,
        'service_call_time' => 0,
        'service_call_data' => array(),
    );
    protected $app_title = null;
    protected $plugin_description = null;

    /**
     * Holds relative peths to css, js files (if any)
     * Should be filled by child classes if necessary
     * @var array
     */
    protected $assets = array(
        'css' => array(),
        'js' => array(),
    );

    /**
     * Whether or not to register rich text editor button for this plugin. Must be set from the kid.
     * @var bool
     */
    protected $register_tinymce_button = false;

    /**
     * handles the singleton
     */
    static public function get_instance($inst = null) {
        if (is_null(self::$instance)) {
            $site_url = site_url();

            $inst->set('site_url', $site_url);
            $inst->set('plugin_base_dir', dirname(__FILE__)); // where the plugin is installed
            $inst->set('plugin_dir_name', basename(dirname(__FILE__))); // e.g. wp-command-center; this can change e.g. a 123 can be appended if such folder exist
            $inst->set('plugin_data_dir', $inst->get('plugin_base_dir') . '/data');
            $inst->set('plugin_url', $site_url . '/wp-content/plugins/' . $inst->get('plugin_dir_name') . '/');
            $inst->set('plugin_settings_key', $inst->get('plugin_id_str') . '_settings');
            $inst->set('plugin_support_link', $inst->get('plugin_support_link') . '&css_file=' . urlencode(get_bloginfo('stylesheet_url')));
            $inst->set('plugin_admin_url_prefix', $site_url . '/wp-admin/admin.php?page=' . $inst->get('plugin_dir_name'));

            // Use when develing to trigger cron sooner e.g. every 3 mins.
            //add_filter('cron_schedules', array($webweb_wp_mibew_obj, 'define_cron_frequencies'));
            //add_filter('cron_schedules', array($inst, 'define_cron_frequencies'));
            //$inst->plugin_cron_freq = $inst->plugin_id_str . '3min';
            // this is the kid's instance
            add_action('plugins_loaded', array($inst, 'init'), 100);

            self::$instance = $inst;
        }

        return self::$instance;
    }

    /**
     * handles the init
     */
    function init() {
        if (is_admin()) {
            // Administration menus
            add_action('admin_menu', array($this, 'administration_menu'));
            add_action('admin_init', array($this, 'register_settings'));
            add_action('admin_notices', array($this, 'notices'));

            if (!empty($this->register_tinymce_button)) {
                add_action('admin_init', array($this, 'add_buttons'));
            }
        } else {
			add_action('wp_head', array($this, 'add_meta_header'));            
        }
    }
    
    /**
     * Loads css, js files. Should be callled by the kid because the parent doesn't know what it needs
     */
    function load_assets() {
        $opts = $this->get_options();

        $load_popup = 0;

        // if it was never displayed (newsletter_popup_dismissed=-1) OR dismissed temporarily then show it again in 24h
        if ($opts['newsletter_popup_dismissed'] < 0 ||
                (!empty($opts['newsletter_popup_dismissed_time']) && (time() > $opts['newsletter_popup_dismissed_time'] + 86400))) {
            //$load_popup = 1;
        }

        if ($load_popup) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-dialog');
            //add_action('wp_enqueue_scripts', array($this, 'add_header_scripts'));

            $this->assets['css'][] = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css';

            add_action('admin_notices', array($this, 'add_dialog_scripts'), 1000); // be the last in the footer
        }

        if (!empty($this->assets['css'])) {
            // Load css files
            foreach ($this->assets['css'] as $idx => $css_rel_path) {
                if (stripos($css_rel_path, 'http://') === false) { // plugin resource
                    wp_register_style($this->plugin_id_str . "css$idx", $this->plugin_url . $css_rel_path, false, 0.2);
                } else { // ext res.
                    wp_register_style($this->plugin_id_str . "css$idx", $css_rel_path, false, 0.1);
                }

                wp_enqueue_style($this->plugin_id_str . "css$idx");
            }
        }

        // Load js files
        if (!empty($this->assets['js'])) {
            foreach ($this->assets['js'] as $idx => $js_rel_path) {
                if (stripos($js_rel_path, 'http://') === false) { // plugin resource
                    wp_register_script($this->plugin_id_str . "js$idx", $this->plugin_url . $js_rel_path, false, 0.1);
                } else { // ext res.
                    wp_register_script($this->plugin_id_str . "js$idx", $js_rel_path, false, 0.1);
                }

                wp_enqueue_script($this->plugin_id_str . "js$idx");
            }
        }
    }

    /**
     * This is what the plugin admins will see when they click on the main menu.
     * @var string
     */
    protected $plugin_landing_tab = '/menu.settings.php';
    protected $admin_menu_items = array();

    /**
     * Adds the settings in the admin menu
     */
    public function administration_menu() {
        $dir_name = $this->plugin_dir_name;

        // Settings > Plugin's name
        add_options_page(__($this->plugin_name, $dir_name), __($this->plugin_name, $this->plugin_id_str), 'manage_options', __FILE__, array($this, 'options'));

        // If we have admin menu links we'll add the section
        if (!empty($this->admin_menu_items)) {
            add_menu_page(__($this->plugin_name, $dir_name), __($this->plugin_name, $this->plugin_id_str), 'manage_options', $dir_name . '/menu.settings.php', null, $this->plugin_url . '/images/icon.png');

            foreach ($this->admin_menu_items as $label => $file) {
                add_submenu_page($dir_name . '/' . $this->plugin_landing_tab, __($label, $this->plugin_id_str), __($label, $this->plugin_id_str), 'manage_options', $dir_name . '/' . $file);
            }
        }

        // when plugins are show add a settings link near my plugin for a quick access to the settings page.
        add_filter('plugin_action_links', array($this, 'add_plugin_settings_link'), 10, 2);
    }

    /**
     * Outputs some options info. No save for now.
     */
    function options() {
        $webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();
        $opts = get_option('settings');

        include_once(dirname(__FILE__) . '/menu.settings.php');
    }

    // kept for future use if necessary

    /**
     * Adds buttons only for RichText mode
     * @return void
     */
    function add_buttons() {
        // Don't bother doing this stuff if the current user lacks permissions
        if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
            return;
        }

        // Add only in Rich Editor mode
        if (get_user_option('rich_editing') == 'true') {
            // add the button for wp2.5 in a new way
            add_filter("mce_external_plugins", array($this, "add_tinymce_plugin"), 5);
            add_filter('mce_buttons', array(&$this, 'register_button'), 5);
        }
    }

    // used to insert button in wordpress 2.5x editor
    function register_button($buttons) {
        array_push($buttons, "separator", $this->plugin_tinymce_name);

        return $buttons;
    }

    // Load the TinyMCE plugin : editor_plugin.js (wp2.5)
    function add_tinymce_plugin($plugin_array) {
        $plugin_array[$this->plugin_tinymce_name] = $this->plugin_url . 'tinymce/editor_plugin.min.js';

        return $plugin_array;
    }

    /**
     * Ads some header scripts and used for the newsletter popup
     */
    function add_dialog_scripts() {
        $title = $this->plugin_name;

        $dashboard_link = $this->get('plugin_admin_url_prefix') . $this->plugin_landing_tab;
        $ajax_link = $this->get('plugin_url') . 'zzz_ajax.php';

        $file = dirname(__FILE__) . '/zzz_popup_notice.html';

        $buff = WebWeb_WP_MibewUtil::read($file);

        $webweb_wp_mibew_common_obj = WebWeb_WP_MibewCommon::get_instance();
        $newsletter_form = $webweb_wp_mibew_common_obj->generate_newsletter_box(array('form_only' => 1, 'SRC2' => 'popup', ));

        // if we're in this method this means we've met the necessary contitions, so the window will auto open
        $auto_open = 1;

        $params = array(
            'AJAX_LINK' => $ajax_link,
            'PLUGIN_NAME' => $this->get('plugin_name'),
            'PLUGIN_SUPPORT_DOMAIN' => $this->plugin_support_domain,
            'AUTO_OPEN' => $auto_open,
            'DASHBOARD_LINK' => $dashboard_link,
            'newsletter_form' => $newsletter_form,
        );

        $buff = WebWeb_WP_MibewUtil::replace_vars($buff, $params);

        echo $buff;
    }

    function add_meta_header() {
        printf("\n" . '<meta name="generator" content="Powered by ' . $this->plugin_name . ' (' . $this->plugin_home_page . ') " />' . PHP_EOL);
    }

    /**
     * Sets the setting variables
     */
    function register_settings() { // whitelist options
        register_setting($this->plugin_dir_name, $this->plugin_settings_key, array($this, 'options_validator'));
    }

    /**
     * Add the ? settings link in Plugins page very good.
     * $file is wp-mibew/wp-mibew.php so we compare if the folders match. The current file is zzzz_common.php
     * @param string $links
     * @param stroing $file
     * @return void
     */
    function add_plugin_settings_link($links, $file) {
        // When the plugin
        if (dirname($file) == basename(dirname(__FILE__))) {
            //$dashboard_link = "<a href=\"{$this->plugin_admin_url_prefix}/menu.dashboard.php\">" . __("Dashboard", $this->plugin_dir_name) . '</a>';
            $settings_link = "<a href=\"{$this->plugin_admin_url_prefix}/menu.settings.php\">" . __("Settings", $this->plugin_dir_name) . '</a>';
            array_unshift($links, $settings_link);
            //array_unshift($links, $dashboard_link);
        }
        
        return $links;
    }

    /**
     * Checks if data folder exsts. If not tries to create it as well as .htaccess to restrict the access to it.
     */
    function checkAndCreateDataDir() {
        if (!is_dir($this->get('plugin_data_dir')) && mkdir($this->get('plugin_data_dir'), 0777, 1)) {
            $buffer = "deny from all\n";

            if (!file_exists($this->get('plugin_data_dir') . '/.htaccess')) {
               $status = WebWeb_WP_MibewUtil::write($this->get('plugin_data_dir') . '/.htaccess', $buffer);
            }
        }

        $status = file_exists($this->get('plugin_data_dir') . '/.htaccess');

        return $status;
    }

    /**
     * Informs the WP admin user of not enabled plugin
     */
    function notices() {
        $opts = $this->get_options();

        if (empty($opts['status']) && WebWeb_WP_MibewUtil::is_on_plugin_page()) {
            if (WebWeb_WP_MibewUtil::has_global_data()) {
                echo WebWeb_WP_MibewUtil::message($this->plugin_name . " is currently disabled however global defaults are found and will be used.", 1);
            } else {
                echo WebWeb_WP_MibewUtil::message($this->plugin_name . " is currently disabled. Please, enable it from "
                    . "<a href='{$this->plugin_admin_url_prefix}/menu.settings.php'> {$this->plugin_name} &gt; Settings</a>");
            }
        }

        if ($this->get('log')) {
            if ($this->checkAndCreateDataDir()) {
                ini_set('log_errors', 1);
                ini_set('error_log', $this->get('plugin_data_dir') . '/error.log');
            } else {
                echo WebWeb_WP_MibewUtil::message($this->plugin_name . " logging is enabled but I cannot write to data folder in " . $this->get('plugin_data_dir'));
            }
        }
    }

    /**
     * Handles the plugin activation. Setup cron and set default configs
     * This code was left from another plugin of mine and should not be here.
     * let's clean old cron stuff if any.
     */
    function on_activate() {
        $this->checkAndCreateDataDir();
    }

    /**
     * Handles the plugin deactivation. Remove cron and set default configs
     */
    function on_deactivate() {
        //$opts['status'] = 0;
        //$this->set_options($opts);
    }

    /**
     * Handles the plugin uninstallation. remove cron and set default configs
     */
    function on_uninstall() {
        delete_option($this->get('plugin_settings_key'));
    }

    /**
     * Allows access to some protected vars
     * @param str $var
     */
    public function get($var) {
        if (isset($this->$var) /* && (strpos($var, 'plugin') !== false) */) {
            return $this->$var;
        }
    }

    public function __get($var) {
        $this->get($var);
    }

    public function __set($key, $value) {
        $this->set($key, $value);
    }

    /**
     *
     * Proxies to the __get method
     * __isset() is triggered by calling isset() or empty() on inaccessible properties.
     * Info: http://www.php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.members
     * @param string $var
     */
    public function __isset($var) {
        return $this->__get($var);
    }

    /**
     * Sets a value of a protected variable. It must be defined within the class
     * @param str $var
     * @param mxed $val
     * @return mixed
     */
    public function set($var, $val = null) {
        $vars = get_object_vars($this);

        if (array_key_exists($var, $vars)) {
            $this->$var = $val;

            return $val;
        }

        throw new Exception('Invalid member variable: ' . $var);
    }

    /**
     * Validates the options on save. The method modifies the input.
     * Update: creates the global config or deletes it depending on the check box
     *
     * @param array
     * @return array
     */
    function options_validator($input) {
        $opts = $this->get_options();
        // esc_url_raw( trim( $input['url'] ) );

        $defaults_file = $this->get('plugin_data_dir') . '/global_defaults.ser.php';

        if (!empty($input['remove_defaults']) && file_exists($defaults_file)) {
            @unlink($defaults_file);
        } elseif (!empty($input['set_as_defaults'])) {
            $global_defaults = $input;

            $global_defaults['host'] = $_SERVER['HTTP_HOST'];
            $global_defaults['request_uri'] = $_SERVER['REQUEST_URI'];
            $global_defaults['created_on'] = time();

            // see: http://codex.wordpress.org/WPMU_Functions/get_current_site
            if (function_exists('get_current_site')) { // available in multi site setup
                $current_site = get_current_site();

                if (!empty($current_site)) {
                    $global_defaults['current_site_id'] = $current_site->id;
                    $global_defaults['current_site_domain'] = $current_site->domain ;
                    $global_defaults['current_site_path'] = $current_site->path;
                }
            } else {
                $global_defaults['current_site_id'] = 0;
            }

            $this->checkAndCreateDataDir();
            WebWeb_WP_MibewUtil::write($defaults_file, $global_defaults, WebWeb_WP_MibewUtil::SERIALIZE_DATA);
        }

        unset($input['set_as_defaults']);
        unset($input['remove_defaults']);

        $input = array_merge($opts, $input);
        
        return $input;
    }

    /**
     * gets current options and return the default ones if not exist
     * @param void
     * @return array
     */
    function get_options() {
        $opts = get_option($this->plugin_settings_key);
        $plugin_default_opts = $this->plugin_default_opts;
        $opts = empty($opts) ? $plugin_default_opts : (array) $opts;

        // could override cfg
        //$opts = array_merge($plugin_default_opts, $opts);
        // if we've introduced a new default key/value let's add it
        foreach ($plugin_default_opts as $setting_key => $default_value) {
            if (!isset($opts[$setting_key]) && isset($plugin_default_opts[$setting_key])) {
                $opts[$setting_key] = $default_value;
            }
        }

        return $opts;
    }

    /**
     * Updates options but it merges them unless $override is set to 1
     * that way we could just update one variable of the settings.
     */
    function set_options($opts = array(), $override = 0) {
        if (!$override) {
            $old_opts = $this->get_options();
            $opts = array_merge($old_opts, $opts);
        }

        update_option($this->plugin_settings_key, $opts);

        return $opts;
    }

    // can't be instantiated; just using get_instance
    protected function __construct() {
        if (!is_null(self::$instance)) { // one instance is OK but not more
            trigger_error('Instantiation is not allowed. Please use get_instance methods.', E_USER_ERROR);
        }
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }

}

/**
 * This class is a common class for every plugin developed by orbisius.com team.
 *
 * @author Svetoslav Marinov | http://orbisius.com
 * @package WebWeb_WP_MibewCommon
 */
class WebWeb_WP_MibewCommon {

    protected static $instance = null; // singleton
    protected $params = null;

    /**
     * handles the singleton
     */
    static public function get_instance() {
        if (is_null(self::$instance)) {
            $cls = __CLASS__;
            $inst = new $cls;

            self::$instance = $inst;
        }

        return self::$instance;
    }

    /**
     * Returns the list of plugins that have been developed by orbisius.com team.
     * It will call WW url and cache the result for 24h
     * @param void
     * @return array NAME => PRODUCT URL
     */
    public function get_plugins() {
        $plugins = array();
        
        // we could have ads or partners in the response array
        $default_plugins_array = array(
            'plugins' => array(
                array('label' => "DigiShop", 'home_page' => 'http://orbisius.com/site/products/digishop/'),
                array('label' => "Like Gate", 'home_page' => 'http://orbisius.com/site/products/like-gate/'),
                array('label' => "UI for WordPress Simple Paypal Shopping Cart", 'home_page' => 'http://orbisius.com/site/products/wordpress-simple-paypal-shopping-cart-ui/'),
                array('label' => "WP Member Status", 'home_page' => 'http://orbisius.com/site/products/wp-member-status/'),
                array('label' => "WP Partner Watcher", 'home_page' => 'http://orbisius.com/site/products/wp-partner-watcher/'),
                array('label' => "WP Mibew", 'home_page' => 'http://orbisius.com/site/products/wp-mibew/'),
            ),
        );

        $webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();
        $opts = $webweb_wp_mibew_obj->get_options();

        $service = new WebWeb_WP_MibewService('wp.plugins.get_all');

        // called within the last 4h so we'll reuse the list
        if (!empty($opts['service_call_time']) && (abs(time() - $opts['service_call_time']) <= 4 * 3600)) {
            if (!empty($opts['service_call_data'])) {
                $plugins = $opts['service_call_data']['plugins'];
            } else { // see final else
                $plugins = $default_plugins_array['plugins'];
            }
        } elseif ($service->call()) { // cache the result and save it in the db
            $data = $service->get_data();
            $plugins = $data['plugins'];
            
            $opts['service_call_time'] = time();
            $opts['service_call_data'] = $data;
            
            $webweb_wp_mibew_obj->set_options($opts);
        } else { // let's make sure that if http://orbisius.com is down that won't make calls all the time.
            $plugins = $default_plugins_array['plugins'];
            
            $opts['service_call_time'] = time();
            $opts['service_call_data'] = array();
            $webweb_wp_mibew_obj->set_options($opts);
        }

        return $plugins;
    }

    /**
     * Allows access to some private vars
     * @param str $var
     */
    public function generate_newsletter_box($params = array()) {
        $file = dirname(__FILE__) . '/zzz_newsletter_box.html';

        $buffer = WebWeb_WP_MibewUtil::read($file);

        $webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();

        wp_get_current_user();
        global $current_user;

        $user_email = $current_user->user_email;

        $replace_vars = array(
            '%%PLUGIN_URL%%' => $webweb_wp_mibew_obj->get('plugin_url'),
            '%%USER_EMAIL%%' => $user_email,
            '%%PLUGIN_ID_STR%%' => $webweb_wp_mibew_obj->get('plugin_id_str'),
        );

        if (!empty($params['form_only'])) {
            $replace_vars['NEWSLETTER_QR_EXTRA_CLASS'] = "app_hide";
        } else {
            $replace_vars['NEWSLETTER_QR_EXTRA_CLASS'] = "";
        }
        
        if (!empty($params['src2'])) {
            $replace_vars['SRC2'] = $params['src2'];
        } elseif (!empty($params['SRC2'])) {
            $replace_vars['SRC2'] = $params['SRC2'];
        }

        $buffer = WebWeb_WP_MibewUtil::replace_vars($buffer, $replace_vars);

        return $buffer;
    }

    /**
     * Allows access to some private vars
     * @param str $var
     */
    public function generate_donate_box() {
        $webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();

        $msg = '';
        $file = dirname(__FILE__) . '/zzz_donate_box.html';

        if (!empty($_REQUEST['error'])) {
            $msg = WebWeb_WP_MibewUtil::message('There was a problem with the payment.');
        }

        if (!empty($_REQUEST['ok'])) {
            $msg = WebWeb_WP_MibewUtil::message('Thank you so much!', 1);
        }

        $return_url = WebWeb_WP_MibewUtil::add_url_params($webweb_wp_mibew_obj->get('plugin_business_status_url'), array(
                    'r' => $webweb_wp_mibew_obj->get('plugin_admin_url_prefix') . '/menu.dashboard.php&ok=1', // paypal de/escapes
                    'status' => 1,
                ));

        $cancel_url = WebWeb_WP_MibewUtil::add_url_params($webweb_wp_mibew_obj->get('plugin_business_status_url'), array(
                    'r' => $webweb_wp_mibew_obj->get('plugin_admin_url_prefix') . '/menu.dashboard.php&error=1', //
                    'status' => 0,
                ));

        $replace_vars = array(
            '%%MSG%%' => $msg,
            '%%AMOUNT%%' => '10',
            '%%BUSINESS_EMAIL%%' => $webweb_wp_mibew_obj->get('plugin_business_email'),
            '%%ITEM_NAME%%' => $webweb_wp_mibew_obj->get('plugin_name') . ' Donation',
            '%%ITEM_NAME_REGULARLY%%' => $webweb_wp_mibew_obj->get('plugin_name') . ' Donation (regularly)',
            '%%PLUGIN_URL%%' => $webweb_wp_mibew_obj->get('plugin_url'),
            '%%CUSTOM%%' => http_build_query(array('site_url' => $webweb_wp_mibew_obj->get('site_url'), 'product_name' => $webweb_wp_mibew_obj->get('plugin_id_str'), 'cat' => 'wp')),
            '%%NOTIFY_URL%%' => $webweb_wp_mibew_obj->get('plugin_business_ipn'),
            '%%RETURN_URL%%' => $return_url,
            '%%CANCEL_URL%%' => $cancel_url,
        );

        // Let's switch the Sandbox settings.
        if ($webweb_wp_mibew_obj->get('plugin_business_sandbox')) {
            $replace_vars['paypal.com'] = 'sandbox.paypal.com';
            $replace_vars['%%BUSINESS_EMAIL%%'] = $webweb_wp_mibew_obj->get('plugin_business_email_sandbox');
        }

        $buffer = WebWeb_WP_MibewUtil::read($file);
        $buffer = WebWeb_WP_MibewUtil::replace_vars($buffer, $replace_vars);

        return $buffer;
    }

    // can't be instantiated; just using get_instance
    private function __construct() {
        if (!is_null(self::$instance)) { // one instance is OK but not more
            trigger_error('Instantiation is not allowed. Please use get_instance methods.', E_USER_ERROR);
        }
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }

}

/**
 * Provides util methods that are used by the plugin code but not plugin specific.
 * @author Svetoslav Marinov <slavi@slavi.biz> | http://orbisius.com
 * @version 1.0.0
 * @package WebWeb_WP_MibewUtil
 */
class WebWeb_WP_MibewUtil {
    // options for read/write methods.
    const FILE_APPEND = 1;
    const UNSERIALIZE_DATA = 2;
    const SERIALIZE_DATA = 3;

    /**
     * Replaces the template variables
     * @param string buffer to operate on
     * @param array the keys are uppercased and surrounded by %%KEY_NAME%% 
     * @return string modified data
     */
    public static function replace_vars($buffer, $params = array()) {
        foreach ($params as $key => $value) {
            $key = trim($key, '%');
            $key = strtoupper($key);
            $key = '%%' . $key . '%%';

            $buffer = str_ireplace($key, $value, $buffer);
        }
//        var_dump($params);
        // Let's check if there are unreplaced variables
        if (preg_match('#(%%[\w-]+%%)#si', $buffer, $matches)) {
//            trigger_error("Not all template variables were replaced. Please check the missing and add them to the input params." . join(",", $matches[1]), E_USER_WARNING);
            trigger_error("Not all template variables were replaced. Please check the missing and add them to the input params." . var_export($matches, 1), E_USER_WARNING);
        }

        return $buffer;
    }

    /**
     * Outputs a message (adds some paragraphs)
     */
    public static function message($msg, $status = 0) {
        $id = 'app-message-id';
        $cls = empty($status) ? 'error fade' : 'success updated';

        $str = <<<MSG_EOF
<div id='$id-notice' class='$cls'><p><strong>$msg</strong></p></div>
MSG_EOF;
        return $str;
    }

    /**
     * a simple status message, no formatting except color
     */
    public static function msg($msg, $status = 0) {
        $id = 'app-msg-id';
        $cls = empty($status) ? 'app_error' : 'app_success';

        $str = <<<MSG_EOF
<div id='$id-notice' class='$cls'><strong>$msg</strong></div>
MSG_EOF;
        return $str;
    }

    /**
     * a simple status message, no formatting except color, simpler than its brothers
     */
    public static function m($msg, $status = 0) {
        $cls = empty($status) ? 'app_error' : 'app_success';

        $str = <<<MSG_EOF
<span class='$cls'>$msg</span>
MSG_EOF;
        return $str;
    }

    /**
     * Gets the content from the body, removes the comments, scripts
     * Credits: http://php.net/manual/en/function.strip-tags.phpm /  http://networking.ringofsaturn.com/Web/removetags.php
     * @param string $buffer
     * @string string $buffer
     */
    public static function html2text($buffer = '') {
        // we care only about the body so it must be beautiful.
        $buffer = preg_replace('#.*<body[^>]*>(.*?)</body>.*#si', '\\1', $buffer);
        $buffer = preg_replace('#<script[^>]*>.*?</script>#si', '', $buffer);
        $buffer = preg_replace('#<style[^>]*>.*?</style>#siU', '', $buffer);
//        $buffer = preg_replace('@<style[^>]*>.*?</style>@siU', '', $buffer); // Strip style tags properly
        $buffer = preg_replace('#<[a-zA-Z\/][^>]*>#si', ' ', $buffer); // Strip out HTML tags  OR '@<[\/\!]*?[^<>]*\>@si',
        $buffer = preg_replace('@<![\s\S]*?--[ \t\n\r]*>@', '', $buffer); // Strip multi-line comments including CDATA
        $buffer = preg_replace('#[\t\ ]+#si', ' ', $buffer); // replace just one space
        $buffer = preg_replace('#[\n\r]+#si', "\n", $buffer); // replace just one space
        //$buffer = preg_replace('#(\s)+#si', '\\1', $buffer); // replace just one space
        $buffer = preg_replace('#^\s*|\s*$#si', '', $buffer);

        return $buffer;
    }

    /**
     * Gets the content from the body, removes the comments, scripts
     *
     * @param string $buffer
     * @param array $keywords
     * @return array - for now it returns hits; there could be some more complicated results in the future so it's better as an array
     */
    public static function match($buffer = '', $keywords = array()) {
        $status_arr['hits'] = 0;

        foreach ($keywords as $keyword) {
            $cnt = preg_match('#\b' . preg_quote($keyword) . '\b#si', $buffer);

            if ($cnt) {
                $status_arr['hits']++; // total hits
                $status_arr['matches'][$keyword] = array('keyword' => $keyword, 'hits' => $cnt,); // kwd hits
            }
        }

        return $status_arr;
    }

    /**
     * @desc write function using flock
     *
     * @param string $vars
     * @param string $buffer
     * @param int $append
     * @return bool
     */
    public static function write($file, $buffer = '', $option = null) {
        $handle = '';

        $write_mod = 'wb';

        if ($option == self::SERIALIZE_DATA) {
            $buffer = serialize($buffer);
        } elseif ($option == self::FILE_APPEND) {
            $write_mod = 'ab';
        }

        if (($handle = @fopen($file, $write_mod))
                && flock($handle, LOCK_EX)) {
            // lock obtained
            if (fwrite($handle, $buffer) !== false) {
                @fclose($handle);
                return true;
            }
        }

        return false;
    }

    /**
     * @desc read function using flock
     *
     * @param string $vars
     * @param string $buffer
     * @param int $option whether to unserialize the data
     * @return mixed : string/data struct
     */
    public static function read($file, $option = null) {
        $buff = false;
        $read_mod = "rb";
        $tries = 0;
        $handle = false;

        if (($handle = @fopen($file, $read_mod))
                && (flock($handle, LOCK_EX))) { //  | LOCK_NB - let's block; we want everything saved
            $buff = @fread($handle, filesize($file));
            @fclose($handle);
        }

        if ($option == self::UNSERIALIZE_DATA) {
            $buff = unserialize($buff);
        }

        return $buff;
    }

    /**
     *
     * Returns current request url
     *
     * @return string
     */
    public static function get_request_url() {
        $url = $_SERVER['REQUEST_URI'];

        return $url;
    }

    /**
     *
     * Appends a parameter to an url; uses '?' or '&'
     * It's the reverse of parse_str().
     *
     * @param string $url
     * @param array $params
     * @return string
     */
    public static function add_url_params($url, $params = array()) {
        $str = '';

        $params = (array) $params;

        if (empty($params)) {
            return $url;
        }

        $query_start = (strpos($url, '?') === false) ? '?' : '&';

        foreach ($params as $key => $value) {
            $str .= ( strlen($str) < 1) ? $query_start : '&';
            $str .= rawurlencode($key) . '=' . rawurlencode($value);
        }

        $str = $url . $str;

        return $str;
    }

    // generates HTML select
    public static function html_select($name = '', $sel = null, $options = array(), $attr = '') {
        $html = "\n" . '<select name="' . $name . '" ' . $attr . '>' . "\n";

        foreach ($options as $key => $label) {
            $selected = $sel == $key ? ' selected="selected"' : '';
            $html .= "\t<option value='$key' $selected>$label</option>\n";
        }

        $html .= '</select>';
        $html .= "\n";

        return $html;
    }

    /**
     * Adds missing namespaces because the like will not show up in IE 6,7,8 if they are not set
     * @param string $matched_str
     * @return string
     */
    public static function add_missing_namespaces($matched_str) {
        $og = 'xmlns:og="http://opengraphprotocol.org/schema/"';
        $fb = 'xmlns:fb="http://www.facebook.com/2008/fbml"';

        if (stripos($matched_str, 'xmlns:og') === false) {
            $matched_str .= ' ' . $og;
        }

        if (stripos($matched_str, 'xmlns:fb') === false) {
            $matched_str .= ' ' . $fb;
        }

        $matched_str = '<html' . stripslashes($matched_str) . '>';

        return $matched_str;
    }

    /**
     * Checks if there are globlal data. If a param is supplied it'll return the global data
     *
     * @param $return_data boolean (optional)
     * @return boolean/array
     */
    public static function has_global_data($return_data = false) {
        $new_defaults = array();
        
    	$webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();
        $f = $webweb_wp_mibew_obj->get('plugin_data_dir') . '/global_defaults.ser.php';

        $res = file_exists($f);

        if ($res && $return_data) {
            $new_defaults = WebWeb_WP_MibewUtil::read($f, WebWeb_WP_MibewUtil::UNSERIALIZE_DATA);
        }

        return $return_data ? $new_defaults : $res;
    }

    /**
     * Checks if we are on a page that belongs to our plugin.
     * It is really annoying to see a notice in every section of WordPress.
     * That way the notice will be shown only on the plugin's page.
     */
    public static function is_on_plugin_page() {
        $webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();

        $req_uri = $_SERVER['REQUEST_URI'];
        $id_str = $webweb_wp_mibew_obj->get('plugin_id_str');

        $req_uri = str_replace('_', '-', $req_uri);
        $id_str = str_replace('_', '-', $id_str);

        // because the plugin id str and uri can have dashes or underscore we'll make underscore dashes
        // for both req uri and plugin str id
        $stat = preg_match('#' . preg_quote($id_str) . '#si', $req_uri);

        return $stat;
    }
}

/**
 * Orbisius Widget
 */
class WebWeb_WP_Mibew_Widget {
    /**
     * Loads news from Club Orbsius Site.
     * <?php WebWeb_WP_Mibew_Widget::output_widget(); ?>
     * <?php WebWeb_WP_Mibew_Widget::output_widget('author'); ?>
     */
    public static function output_widget($obj = '', $return = 0) {
        $buff = '';
        ?>
        <!-- Orbisius JS Widget -->
            <?php
                $naked_domain = !empty($_SERVER['DEV_ENV']) ? 'orbclub.com.clients.com' : 'club.orbisius.com';

                if (!empty($_SERVER['DEV_ENV']) && is_ssl()) {
                    $naked_domain = 'ssl.orbisius.com/club';
                }

				// obj could be 'author'
                $obj = empty($obj) ? str_replace('.php', '', basename(__FILE__)) : sanitize_title($obj);
                $obj_id = 'orb_widget_' . sha1($obj);

                $params = '?' . http_build_query(array('p' => $obj, 't' => $obj_id, 'layout' => 'plugin', ));
                $buff .= "<div id='$obj_id' class='$obj_id orbisius_ext_content'></div>\n";
                $buff .= "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://$naked_domain/wpu/widget/$params';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'orbsius-js-$obj_id');</script>";
            ?>
            <!-- /Orbisius JS Widget -->
        <?php

        if ($return) {
            return $buff;
        } else {
            echo $buff;
        }
    }
}

