<?php
/*
  Plugin Name: WP Mibew
  Plugin URI: http://club.orbisius.com/products/wordpress-plugins/wp-mibew/
  Description: WP Mibew generate the javascript chat snippet for the mibew.org open source chat.
  Version: 1.0.1
  Author: Svetoslav Marinov (Slavi)
  Author URI: http://orbisius.com
  License: GPL v2
 */

/*
  Copyright 2011-2020 Svetoslav Marinov (slavi@slavi.biz)

  This program ais free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; version 2 of the License.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

require_once(dirname(__FILE__) . '/zzzz_common.php');
require_once(dirname(__FILE__) . '/plugin.php');

define('WP_MIBEW_MAIN_PLUGIN_FILE', __FILE__);

// we can be called from the test script
if (empty($_ENV['WEBWEB_WP_MIBEW_TEST'])) {
    // Make sure we don't expose any info if called directly
    if (!function_exists('add_action')) {
        echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
        exit;
    }

	$webweb_wp_mibew_obj = WebWeb_WP_Mibew::get_instance();
	$webweb_wp_mibew_common_obj = WebWeb_WP_MibewCommon::get_instance();

    add_action('init', array($webweb_wp_mibew_obj, 'init'));
    add_action('widgets_init', create_function( '', 'register_widget("WebWeb_WP_MibewWidget");' ) );

    register_activation_hook(__FILE__, array($webweb_wp_mibew_obj, 'on_activate'));
    register_deactivation_hook(__FILE__, array($webweb_wp_mibew_obj, 'on_deactivate'));

    // uninstall is handled by uninstall.php
    //register_uninstall_hook(__FILE__, array($webweb_wp_mibew_obj, 'on_uninstall'));
}
