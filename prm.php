<?php
/**
 * @package PRM
 */
/*
Plugin Name: PRM
Plugin URI: https://wordpress.org/plugins/orghunter
Description: PRM: The Patrão Relationship Management!
Version: 1.0
Author: Danillo Nunes
Author URI: http://danillonunes.com
License: GPLv2 or later
Text Domain: prm
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Define plugin version.
define('PRM_VERSION', '1.0');

// Define plugin filename.
define('PRM_PLUGIN_FILE', __FILE__);

// Define directory where the plugin is installed.
define('PRM_PLUGIN_DIR', realpath(dirname(PRM_PLUGIN_FILE)));

// Define URL where the plugin is installed.
define('PRM_PLUGIN_DIR_URL', plugin_dir_url(PRM_PLUGIN_FILE));

// Include stylesheets and scripts.
require_once(PRM_PLUGIN_DIR . '/includes/prm.assets.php');

// Include donation form file.
require_once(PRM_PLUGIN_DIR . '/includes/prm.donation-form.php');

// Include install file.
require_once(PRM_PLUGIN_DIR . '/includes/prm.install.php');

// Include options file.
require_once(PRM_PLUGIN_DIR . '/includes/prm.options.php');

// Include shortcodes file.
require_once(PRM_PLUGIN_DIR . '/includes/prm.shortcodes.php');
