<?php
/*
Plugin Name: My Blogs Info
Plugin URI: http://premium.wpmudev.org/project/
Description: Replacement for the WordPress Right Now dashboard widget. This dashboard widget offer information in controlled section which can be hidden or ordered to you needs. 
Version: 0.1
Text Domain: embi
Author: Paul Menard (Incsub)
Author URI: http://premium.wpmudev.org
Network: true
WDP ID: XXX

Copyright 2009-2011 Incsub (http://incsub.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 - GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

///////////////////////////////////////////////////////////////////////////
/* -------------------- Update Notifications Notice -------------------- */
if ( !function_exists( 'wdp_un_check' ) ) {
	add_action( 'admin_notices', 'wdp_un_check', 5 );
	add_action( 'network_admin_notices', 'wdp_un_check', 5 );
	function wdp_un_check() {
		if ( !class_exists( 'WPMUDEV_Update_Notifications' ) && current_user_can( 'install_plugins' ) )
			echo '<div class="error fade"><p>' . __('Please install the latest version of <a href="http://premium.wpmudev.org/project/update-notifications/" title="Download Now &raquo;">our free Update Notifications plugin</a> which helps you stay up-to-date with the most stable, secure versions of WPMU DEV themes and plugins. <a href="http://premium.wpmudev.org/wpmu-dev/update-notifications-plugin-information/">More information &raquo;</a>', 'wpmudev') . '</a></p></div>';
	}
}
/* --------------------------------------------------------------------- */

define ('EMBI_PLUGIN_SELF_DIRNAME', basename(dirname(__FILE__)), true);

//Setup proper paths/URLs and load text domains
if (is_multisite() && defined('WPMU_PLUGIN_URL') && defined('WPMU_PLUGIN_DIR') && file_exists(WPMU_PLUGIN_DIR . '/' . basename(__FILE__))) {
	define ('EMBI_PLUGIN_LOCATION', 'mu-plugins', true);
	define ('EMBI_PLUGIN_BASE_DIR', WPMU_PLUGIN_DIR, true);
	define ('EMBI_PLUGIN_URL', WPMU_PLUGIN_URL, true);
	$textdomain_handler = 'load_muplugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . EMBI_PLUGIN_SELF_DIRNAME . '/' . basename(__FILE__))) {
	define ('EMBI_PLUGIN_LOCATION', 'subfolder-plugins', true);
	define ('EMBI_PLUGIN_BASE_DIR', WP_PLUGIN_DIR . '/' . EMBI_PLUGIN_SELF_DIRNAME, true);
	define ('EMBI_PLUGIN_URL', WP_PLUGIN_URL . '/' . EMBI_PLUGIN_SELF_DIRNAME, true);
	$textdomain_handler = 'load_plugin_textdomain';
} else if (defined('WP_PLUGIN_URL') && defined('WP_PLUGIN_DIR') && file_exists(WP_PLUGIN_DIR . '/' . basename(__FILE__))) {
	define ('EMBI_PLUGIN_LOCATION', 'plugins', true);
	define ('EMBI_PLUGIN_BASE_DIR', WP_PLUGIN_DIR, true);
	define ('EMBI_PLUGIN_URL', WP_PLUGIN_URL, true);
	$textdomain_handler = 'load_plugin_textdomain';
} else {
	// No textdomain is loaded because we can't determine the plugin location.
	// No point in trying to add textdomain to string and/or localizing it.
	wp_die(__('There was an issue determining where Post Voting plugin is installed. Please reinstall.'));
}
$textdomain_handler('embi', false, EMBI_PLUGIN_SELF_DIRNAME . '/languages/');


require_once EMBI_PLUGIN_BASE_DIR . '/lib/class_embi_installer.php';
Embi_Installer::check();

require_once EMBI_PLUGIN_BASE_DIR . '/lib/template_tags.php';

// Widgets
//require_once EMBI_PLUGIN_BASE_DIR . '/lib/class_embi_widget_name.php';
//add_action('widgets_init', create_function('', "register_widget('Embi_WidgetName');"));
// ...


if (is_admin()) {
	require_once EMBI_PLUGIN_BASE_DIR . '/lib/class_embi_admin_pages.php';
	Embi_AdminPages::serve();
}

/*
if (!function_exists('is_supporter')) {
	function is_supporter () {
		return true;
	}
}
*/