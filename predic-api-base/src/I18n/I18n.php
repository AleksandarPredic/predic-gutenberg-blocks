<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */

namespace PredicApiBase\I18n;

use PredicApiBase\Traits\SingletonTrait;

defined('ABSPATH') || exit;

/**
 * Class I18n
 * @package BCLinks\I18n
 */
class I18n
{
    use SingletonTrait;

    /**
     * Plugin text domain specified for this plugin.
     * @var string
     */
    private $text_domain;

    /**
     * Plugin basename.
     * @var string
     */
    private $plugin_basename;

    /**
     * Localization constructor.
     */
    private function __construct()
    {
        $this->text_domain = 'predic-api-base';
        $this->plugin_basename = basename(PREDIC_API_BASE_DIR);
        add_action('init', [ $this, 'load_plugin_textdomain' ]);
    }

    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain(
            $this->text_domain,
            $this->plugin_basename . '/languages',
            $this->plugin_basename . '/languages'
        );
    }
}
