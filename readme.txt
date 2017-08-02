=== WP Mibew ===
Contributors: lordspace,orbisius
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7APYDVPBCSY9A
Tags: wordpress,wp,plugins,chat,online chat,chat software,business chat,sales chat,support chat,online support,tech support,technical support,support,live person,live support,live chat,free,free chat,free support chat
Requires at least: 2.6
Tested up to: 4.1
Stable tag: 1.0.1

WP Mibew generates the javascript chat snippet for the mibew.org open source chat software

== Description ==

WP Mibew is a WordPress plugin that generates the Mibew chat JavaScript code on your site.
The will NOT install the Mibew chat software for you. WP Mibew and Mibew are different software.
After you have installed the Mibew chat e.g. /chat/ paste [wp-mibew] short code in the post/page and it will be replaced.
Additionally, you can include HTML comments around [wp-mibew] they will be replaced too.

If you want a quicker way to install Mibew chat check our Mibew Chat Installer ($) plugin
http://club.orbisius.com/products/wordpress-plugins/orbisius-mibew-chat-installer/

= Benefits / Features =

* Mibew is a great open source chat software
* Get in touch with your customer
* You can specify the locale (language) you want the chat to be in
* Easy to use

= Required Software =

* The WP Mibew plugin requires that you to have downloaded, installed and configured the Mibew chat software from http://mibew.org/download.php

> We have just released <a href="http://club.orbisius.com/products/wordpress-plugins/orbisius-mibew-chat-installer/" target="_blank">Orbisius Mibew Chat Installer</a>
> The plugin will install mibew, create databases, configure it & create users for you automatically.
> The only thing you need to do is to enter the name of the folder that you want the chat to be installed in.


Svetoslav Marinov (Slavi) | <a href="http://orbisius.com" title="Custom Web Programming, Web Design, e-commerce, e-store, Wordpress Plugin Development, Facebook App Development in Niagara Falls, St. Catharines, Ontario, Canada" target="_blank">Custom Web Programming and Design by Orbisius.com</a>

= Demo =

http://www.youtube.com/watch?v=OSKTfnUlg6g

= Do you need a custom WordPress plugin or other services? =
Please check http://orbisius.com/ for the full list of the services we offer.

= Author =

Svetoslav Marinov (Slavi) | <a href="http://orbisius.com" title="Custom Web Programming, Web Design, e-commerce, e-store, Wordpress Plugin Development, Facebook App Development in Niagara Falls, St. Catharines, Ontario, Canada" target="_blank">Custom Web Programming and Design by orbisius.com</a>

= Support =
> Support is handled on our site: <a href="http://club.orbisius.com/support/" target="_blank" title="[new window]">http://club.orbisius.com/support/</a>
> Please do NOT use the WordPress forums or other places to seek support.

== Installation ==

= Automatic Install =
Please go to Wordpress Admin &gt; Plugins &gt; Add New Plugin &gt; Search for: WP Mibew and then press install

= Manual Installation =
1. Upload wp-mibew.zip into to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How to use this plugin? =
* Download Mibew chat software from http://mibew.org/download.php
* Unzip the archive and follow the instructions from README file.
**Note:** The previous step requires some technical knowledge or a tech savvy friend because it will require setting up a database, fixing file permissions etc.

If you find Mibew chat installation process challenging take a look at <a href="http://club.orbisius.com/products/wordpress-plugins/orbisius-mibew-chat-installer/" target="_blank">Orbisius Mibew Chat Installer</a>.
The plugin will install mibew messenger, create databases, configure it & create users for you automatically.
The only thing you need to do is to enter the name of the folder that you want the chat to be installed in.

* Then install WP Mibew plugin, configure it by setting the chat url.
* Next paste the short code within your posts, sidebar or theme files.

Check this demo:
http://www.youtube.com/watch?v=OSKTfnUlg6g

= Do you need a custom WordPress plugin or other services? =
Please check http://orbisius.com/services/ for the full list of the services we offer.

= Want to help development of the plugin? =
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7APYDVPBCSY9A" target="_blank">Donate</a>

Run into issues or have questions/suggestions? 

> Support is handled on our site: <a href="http://club.orbisius.com/support/" target="_blank" title="[new window]">http://club.orbisius.com/support/</a>
> Please do NOT use the WordPress forums or other places to seek support.

== Screenshots ==
1. Short code of the plugin in editing post/page
2. Short code of the plugin inserted in the header in comments (comments will be replaced too)
3. The result of including the short code in the header.

== Upgrade Notice ==
n/a

== Changelog ==

= 1.0.1 =
* Fixed called to some calls to functions from other plugins of ours.
* Tested with WP 4.1

= 1.0.0 =
* Cleaned up UI
* Tested with WP 4.0.1
* Set the version to 1.0.0
* Improved UI

= 0.1.1 =
* Added a new style chat option available in Mibew 1.6.9+
* Made chat url to be a wider input box

= 0.1.0 =
* Added Saved Settings message
* Tested with WP 3.8.1

= 0.0.9 =
* Fixes: removed some deprecated function calls
* cleaned up code
* added parsing of the shortcode (WP way)
* Tested with wp 3.6

= 0.0.8 =
* fixes
* added links to installer.

= 0.0.7 =
* added links to the club support forums
* added more information about the required software (Mibew Chat Software itself).

= 0.0.6 =
* added functionality to allow the to set the chat locale

= 0.0.5 =
* can't remember what I've done ;)

= 0.0.4 =
* fix: defaults weren't picked up when the plugin wasn't configured.

= 0.0.3 =
* Added global defaults. This is very useful if you have setup WordPress Multi Site enabled so you don't have to configure every site which chat code to use.
* Checks if we are on a page that belongs to our plugin. It is really annoying to see a notice in every section of WordPress. That way the notice will be shown only on the plugin's page.
* Added preview of the tech support images (settings)

= 0.0.2 =
* Added widget functionality so the chat can appear in the sidebar
* Rewrote some of the functionality and separated it into more OOP
* Added a popup to ask users if they want to signup for the newsletter

= 0.0.1 =
* Initial Release
