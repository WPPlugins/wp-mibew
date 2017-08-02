<?php

// look up for the path
require_once(dirname(__FILE__) . '/wp-mibew.bootstrap.php');

$msg = '';
$status = 0;
$perm_error = 0; // access error

// check for rights
if (!is_user_logged_in() || !current_user_can('edit_posts')) {
    $perm_error = 1;
    $msg = __("You are not allowed to be here");
}

if (empty($perm_error) && isset($_REQUEST['dismiss'])) {
    $status = 1;
    
	$webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();
    $opts['newsletter_popup_dismissed'] = (int) $_REQUEST['dismiss'];

    // we'll remind in 24h
    if (!empty($_REQUEST['remind_later'])) {
        $opts['newsletter_popup_dismissed_time'] = time();
    } else {
        $opts['newsletter_popup_dismissed_time'] = 0;
    }
    
    $webweb_wp_mibew_obj->set_options($opts);
}

$struct['status'] = $status;
$struct['message'] = $msg;

header('Cache-Control: no-cache');
header('Content-type: application/json');

echo json_encode($struct);
