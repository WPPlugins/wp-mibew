<?php
// look up for the path
require_once(dirname(dirname(__FILE__)) . '/wp-mibew.bootstrap.php');

global $wpdb;

// check for rights
if (!is_user_logged_in() || !current_user_can('edit_posts')) {
    wp_die(__("You are not allowed to be here"));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Mibew</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>

        <script language="javascript" type="text/javascript">
            function init() {
                tinyMCEPopup.resizeToInnerSize();
            }

            function insert_wwwpmibew_content() {
                var extra = '';
                var content;
                var template = '<p>[mibew]<br/>Please replace this text with the content (images, download links etc) '
                        + 'that will be shown to users after they like your article.<br/>[/mibew]</p><br/>';
		
                var wpmibew = document.getElementById('wpmibew_panel');
				
                // who is active ?
                if (wpmibew.className.indexOf('current') != -1) {
                    content = template;
                }
            
                if (window.tinyMCE) {
                    window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, content);
                    //Peforms a clean up of the current editor HTML.
                    //tinyMCEPopup.editor.execCommand('mceCleanup');
                    //Repaints the editor. Sometimes the browser has graphic glitches.
                    tinyMCEPopup.editor.execCommand('mceRepaint');
                    tinyMCEPopup.close();
                }
		
                return;
            }
        </script>
        <base target="_self" />
    </head>
    <body id="advimage" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('wpmibew_product_name').focus();" style="display: none">
        <form name="wpmibew_form" action="#">
            <div class="tabs">
                <ul>
                    <li id="wpmibew_tab" class="current"><span><a href="javascript:mcTabs.displayTab('wpmibew_tab','wpmibew_panel');" onmousedown="return false;">
                        <?php _e("Mibew", 'WWWPLIKEGATE'); ?></a></span></li>
                </ul>
            </div>

            <div class="panel_wrapper">
                <!-- panel -->
                <div id="wpmibew_panel" class="panel current">
                    <table border="0" cellpadding="4" cellspacing="0">
                        <!--<tr>
                            <td nowrap="nowrap">
                                <label for="wpmibew_product_name"><?php //_e("Product Name", 'WWWPLIKEGATE'); ?></label>
                            </td>
                            <td>
                                <input type="text" id="wpmibew_product_name" name="wpmibew_product_name" value="" />
                            </td>
                            <td>
                                Example: My Great Product
                            </td>
                        </tr>-->
                        <tr>
                            <td nowrap="nowrap" colspan="3">
                                <p>
                                    Please click <strong>Insert</strong> and the following tags will be inserted for you. <br /><br/>
                                    [mibew] <br/>
                                    ...			<br/>
                                    [/mibew] <br/>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- end panel -->
            </div>

            <div class="mceActionPanel">
                <div style="float: left">
                    <input type="submit" id="insert" name="insert" value="<?php _e("Insert", 'WWWPLIKEGATE'); ?>" onclick="insert_wwwpmibew_content();return false;" />
                </div>

                <div style="float: right">
                    <input type="button" id="cancel" name="cancel" value="<?php _e("Cancel", 'WWWPLIKEGATE'); ?>" onclick="tinyMCEPopup.close();" />
                </div>
            </div>
        </form>
    </body>
</html>
<?php
?>