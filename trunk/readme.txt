=== Plugin Name ===
Contributors: Vitalie Ciubotaru
Donate link: 
Tags: diaspora, pod
Requires at least: 3.2.1
Tested up to: 4.1
Stable tag: 0.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin periodically retrieves a fresh list of active Diaspora* pods and 
makes it available for other plugins to use.

== Description ==
This is an auxiliary utility plugin. It periodically queries Podupti.me, a 
public service of Diaspora* community. It retrieves a fresh list of active 
Diaspora* servers (so called "pods"). The list is then stored and made 
available for other plugins (specifically 
[Share on Diaspora](http://wordpress.org/plugins/share-on-diaspora)).

= API =
To get the podlist from another plugin, use the following reference code:

`<?php $podlist = get_option('dpu-podlist'); ?>`

The result is an indexed array of Diaspora* server URLs.

== Installation ==
1. Unpack `share-on-diaspora.zip` and upload its contents to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enjoy

== Frequently Asked Questions ==
= What is Diaspora*? =
[About Diaspora*](https://diasporafoundation.org/).

= What does this plugin do? =
It retrieves a list of Diaspora pods from a community server 
(http://Podupti.Me). The list is useless for final users, but can be used by 
other plugins.

= I want to report a bug, request a feature or contribute code. What shall I do? =
Bug reports, feature requests and real code are always welcome. Check out
https://github.com/ciubotaru/diaspora-podlist-updater or drop a line to "vitalie at
ciubotaru dot tk".

= I maintain another plugin related to Diaspora social network. How can I use this? =
You can get the podlist from you plugin with the following code (example):

`<?php $podlist = get_option( 'dpu-podlist' ); ?>`

= How often does the list of servers update? =
Once a day. To force an update, deactivate the plugin and activate it again.

== Changelog ==
= 0.0.1 =
* First release
