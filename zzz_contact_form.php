
<div class="updated">
    <strong>
    ** NOTE: ** Support is handled on our site: <a href="http://club.orbisius.com/support/" target="_blank" title="[new window]">http://club.orbisius.com/support/</a>
    <br/>Please do NOT use the WordPress forums or other places to seek support.
    </strong>

    <pre>
We have just released <a href="http://club.orbisius.com/products/wordpress-plugins/orbisius-mibew-chat-installer/" target="_blank">Orbisius Mibew Chat Installer</a>.
The plugin will install mibew, create databases, configure it & create users for you automatically.
The only thing you need to do is to enter the name of the folder that you want the chat to be installed in.
</pre>

</div>

<?php return ; ?>

<h2>Contact Us</h2>

<p>Please use this form to suggest new features, report bugs, or request a quote for a plugin customization or a new one.
    <br/>For the full list of offered services please go to: <a href="http://orbisius.com" target="_blank">http://orbisius.com</a>
</p>

<?php if (empty($_SERVER['OUR_APP_ENV']) && (preg_match('#win#si', PHP_OS) || $_SERVER['HTTP_HOST'] == 'localhost')) : ?>
    <p>
        <iframe src="<?php echo $webweb_wp_mibew_obj->get('plugin_support_link');?>"
                style="overflow: hidden; width: 100%; height: 910px;border: none;"
                marginheight="0" align="top" scrolling="No" frameborder="0" hspace="0"
                vspace="0">Cannot load frame. Please send us an email instead. The email is: info@use-the-same-domain</iframe>
    </p>
<?php else : ?>
<?php
$to = $webweb_wp_mibew_obj->get('plugin_support_email');

/**
 * Gets a variable from the request and prints the value, empty
 */
function app_contact_get_var($val = '', $default = '') {
    return !isset($_REQUEST[$val]) ? $default : trim($_REQUEST[$val], ' <>');
}

/**
 * if the var conains mail fields
 */
function app_contact_check_inj($val = '') {
    return preg_match('#(\r|\n)(?:to|from|b?cc)\s*:#si', $val);
}

wp_get_current_user();

$name = app_contact_get_var('name', $current_user->user_firstname . ' ' . $current_user->user_lastname);
$email = app_contact_get_var('email', $current_user->user_email);
$phone = app_contact_get_var('phone');
$subject = app_contact_get_var('subject');
$message = app_contact_get_var('message');
$site = app_contact_get_var('site', $webweb_wp_mibew_obj->get('site_url'));

$contact_msg = '';
$errors = array();

if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (app_contact_check_inj(app_contact_check_inj($value))) {
            $errors[] = "Invalid data in: $key";
        }
    }

    if (empty($name) || preg_match('#[^\w-\'\"\s]#si', $name)) {
        $errors[] = "Invalid/empty name";
    }

    // !preg_match('#^([0-9a-z]+[-._+&])*[\w-.]+@([-0-9a-z]+[.])+[a-z]{2,6}$#si', $email)
    if (empty($email) || !filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid/empty email";
    }

    if (!empty($phone) && preg_match('#[^\d-+.()\sext:,@]#si', $phone)) {
        $errors[] = "Invalid/empty phone";
    }

    if (empty($subject)) {
        $errors[] = "Invalid/empty reason";
    }

    if (empty($message)) {
        $errors[] = "Invalid/empty message";
    }

    if (empty($errors)) {
        $headers = "From: $name <$email>\r\n";
        $headers .= "Content-type: text\r\n";
        
        $email_subject = $webweb_wp_mibew_obj->plugin_name . ": Contact Form: " . $subject;
        $email_message = $message;

        if (!empty($phone)) {
            $email_message .= "\nPhone: $phone";
        }
        
        if (!empty($site)) {
            $email_message .= "\nSite: $site";
        }

        $status = wp_mail($to, $email_subject, $email_message, $headers);

        if ($status) {
            $contact_msg = WebWeb_WP_MibewUtil::message("Your message has been sent.", 1);
            // everything went fine let's clear the fields.
            $name = $phone = $email = $site = $subject = $message = '';
        } else {
            $contact_msg = WebWeb_WP_MibewUtil::message("Cannot send email. Please send your request directly to: $to");
        }
    } else {
        $contact_msg = WebWeb_WP_MibewUtil::message("<h3>Errors: </h3>" . join("<br/>\n", $errors));
    }
}

?>

<style>
    .zzz_contact_asterisk {
        color: red;
    }
</style>

<form name="contact_form" method="post">
    <?php echo $contact_msg ?>
            
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
            <td>Name: <span class="zzz_contact_asterisk">*</span></td>
            <td><input type="text" name="name" id="name" value="<?php echo $name ?>" size="50"></td>
        </tr>
        <tr>
            <td>Email: <span class="zzz_contact_asterisk">*</span></td>
            <td><input type="text" name="email" id="email" value="<?php echo $email ?>" size="50"></td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td><input type="text" name="phone" id="phone" value="<?php echo $phone ?>" size="50"></td>
        </tr>
        <tr>
            <td>Site:</td>
            <td><input type="text" name="site" id="site" value="<?php echo $site ?>" size="50"></td>
        </tr>
        <tr>
            <td width="16%">Reason: <span class="zzz_contact_asterisk">*</span></td>
            <td width="82%"><input type="text" name="subject" id="subject" value="<?php echo $subject ?>" size="50"></td>
        </tr>
        <tr>
            <td>Message: <span class="zzz_contact_asterisk">*</span></td>
            <td><textarea name="message" id="message" cols="50" rows="4"><?php echo $message ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="Submit" value="Submit"></td>
        </tr>
    </table>
</form>
<?php endif; ?>

<br/>
<p>If you want to reach us
    via email: <a href="mailto:<?php echo $webweb_wp_mibew_obj->get('plugin_support_email');?>?subject=<?php echo urlencode($webweb_wp_mibew_obj->get('plugin_id_str'));?>"><?php echo $webweb_wp_mibew_obj->get('plugin_support_email');?></a>
    or phone: US: <a href="tel:1-716-514-8880">1-716-514-8880</a>, Canada: <a href="tel:1-647-478-6512">1-647-478-6512</a>
    <br/>Plugin's page: <a href="<?php echo $webweb_wp_mibew_obj->get('plugin_home_page');?>" target="_blank"><?php echo $webweb_wp_mibew_obj->get('plugin_home_page');?></a>
<?php if (0) : ?>
or via skype:
<!--
Skype 'Skype Me™!' button
http://www.skype.com/go/skypebuttons
-->
<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>
<a href="skype:orbisius.com?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_green_transparent_70x23.png" style="border: none;" width="70" height="23" alt="Skype Me™!" /></a>
<?php endif; ?>

</p>