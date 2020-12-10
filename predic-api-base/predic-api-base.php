<?php
/**
 * Plugin Name: Predic API Base
 * Description: Plugin to serve as API fetching and serving base for all other themes and plugins
 * Version: 1.0.0
 * Author: Aleksandar Predic
 * Author URI: https://acapredic.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.5
 * Requires PHP: 7.2
 * Text Domain: predic-api-base
 * Domain Path: /languages
 */

//  Exit if accessed directly.
use PredicApiBase\PredicApiBase;

defined( 'ABSPATH') || exit;

define('PREDIC_API_BASE_DIR', plugin_dir_path(__FILE__));

require PREDIC_API_BASE_DIR . 'vendor/autoload.php';

add_action('plugins_loaded', function () {
    PredicApiBase::getInstance()->setInstances();
}, 20);
