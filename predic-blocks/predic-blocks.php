<?php
/**
 * Plugin Name: Gutenberg custom blocks
 * Description: Plugin to extend Gutenberg blocks
 * Version: 1.0.0
 * Author: Aleksandar Predic
 * Author URI: https://acapredic.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.5
 * Requires PHP: 7.2
 * Text Domain: predic-blocks
 * Domain Path: /languages
 */

use PredicBlocks\PredicBlocks;

//  Exit if accessed directly.
defined('ABSPATH') || exit;

define('PREDIC_BLOCKS_SLUG', 'predic-api-base');
define('PREDIC_BLOCKS_DIR', plugin_dir_path(__FILE__));
define('PREDIC_BLOCKS_URL', plugin_dir_url(__FILE__));
define('PREDIC_BLOCKS_DEBUG_LOG_ON', defined('WP_DEBUG_LOG') && WP_DEBUG_LOG);

require PREDIC_BLOCKS_DIR . 'vendor/autoload.php';

add_action('plugins_loaded', function () {
    PredicBlocks::getInstance()->setInstances();
}, 20);
