<?php 

if (!defined('WP_UNINSTALL_PLUGIN')) {
	exit();
}

require_once(dirname(__FILE__) . '/zzzz_common.php');
require_once(dirname(__FILE__) . '/plugin.php');

$webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();
$webweb_wp_mibew_obj->on_uninstall();

