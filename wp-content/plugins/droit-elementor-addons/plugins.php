<?php
/**
 * @package droitelementoraddons
 * @developer DroitLab Team
 */
/*
Plugin Name: Droit Elementor Addons
Plugin URI: https://demos.droitthemes.com/droit-elementor-addons/
Description: Droit Elementor Addons is a bundle of super useful widgets. Build a beautiful website using this addon without any hassle. Just plug and play.
Version: 1.0.8
Author: DroitThemes
Author URI: https://droitthemes.com/
License: GPLv3
Text Domain: droit-elementor-addons
 */

// If this file is called firectly, abort!!!
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

/**
 * Constant
 * Feature added by : DroitLab Team
 * @since 1.0.0
 */
if (!defined("DROIT_ELEMENTOR_PLUGIN_NAME")) {
    define("DROIT_ELEMENTOR_PLUGIN_NAME", 'Droit Elementor Addons');
}

if (!defined("DROIT_EL_ADDONS_VERSION")) {
    define("DROIT_EL_ADDONS_VERSION", '1.0.8');
}

if (!defined("DROIT_EL_ADDONS_WP_VERSION")) {
    define("DROIT_EL_ADDONS_WP_VERSION", '4.9');
}

if (!defined("DROIT_EL_ADDONS_PHP_VERSION")) {
    define("DROIT_EL_ADDONS_PHP_VERSION", '5.6.0');
}

if (!defined("DROIT_EL_ADDONS_FILE")) {
    define("DROIT_EL_ADDONS_FILE", __FILE__);
}

if (!defined("DROIT_EL_ADDONS_BASE")) {
    define("DROIT_EL_ADDONS_BASE", plugin_basename(DROIT_EL_ADDONS_FILE));
}

if (!defined("DROIT_EL_ADDONS_DIR_PATH")) {
    define("DROIT_EL_ADDONS_DIR_PATH", plugin_dir_path(DROIT_EL_ADDONS_FILE));
}

if (!defined("DROIT_EL_ADDONS_DIR_URL")) {
    define("DROIT_EL_ADDONS_DIR_URL", plugin_dir_url(DROIT_EL_ADDONS_FILE));
}

if (!defined("DROIT_EL_ADDONS_IMAGE")) {
    define("DROIT_EL_ADDONS_IMAGE", DROIT_EL_ADDONS_DIR_URL . '_images/');
}

if (!defined("DROIT_EL_ADDONS_ASSETS_URL")) {
    define("DROIT_EL_ADDONS_ASSETS_URL", DROIT_EL_ADDONS_DIR_URL . 'assets/');
}

if (!defined("DROIT_MINIMUM_EL_VERSION")) {
    define("DROIT_MINIMUM_EL_VERSION", '2.0.0');
}

if (!defined("DROIT_EL_PRO_LINK")) {
    define("DROIT_EL_PRO_LINK", 'https://droitthemes.com/');
}

if (!defined("DROIT_EL_DEMO_LINK")) {
    define("DROIT_EL_DEMO_LINK", 'https://droitthemes.com/');
}

require_once DROIT_EL_ADDONS_DIR_PATH . 'core.php';
require_once DROIT_EL_ADDONS_DIR_PATH . 'includes/helpers.php';