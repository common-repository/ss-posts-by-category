<?php
/*
Plugin Name: SS Posts By Category
Plugin URI: http://sazysoft.com/ss_calendar
Description: Listing Posts By Category for page
Version: 1.0.0
Author: stk2k
Author URI: http://sazysoft.com/wordpress-plugins/ss-posts-by-category/
License: GPLv2 or Later
*/

define('SSPBC_VERSION', '1.0.0');

define('SSPBC_WP_CONTENT_DIR', ABSPATH . 'wp-content');
define('SSPBC_WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
define('SSPBC_WP_PLUGIN_DIR', SSPBC_WP_CONTENT_DIR . '/plugins');
define('SSPBC_WP_PLUGIN_URL', SSPBC_WP_CONTENT_URL . '/plugins');

define('SSPBC_PLUGIN_DIR', SSPBC_WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)));
define('SSPBC_PLUGIN_URL', SSPBC_WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)));
define('SSPBC_PLUGIN_FOLDER', dirname(plugin_basename(__FILE__)));
define('SSPBC_PLUGIN_BASENAME', plugin_basename(__FILE__));

load_plugin_textdomain('sspbc', false, SSPBC_PLUGIN_DIR.'/languages');

require_once(SSPBC_PLUGIN_DIR."/functions/functions.php");
