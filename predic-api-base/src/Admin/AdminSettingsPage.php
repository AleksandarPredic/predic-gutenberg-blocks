<?php

namespace PredicApiBase\Admin;

use PredicApiBase\Data\Models\SettingsModel;
use PredicApiBase\Traits\SingletonTrait;

/**
 * Class AdminSettingsPage
 *
 * Add API settings page under Settings -> Predic API settings
 *
 * @package PredicApiBase\Admin
 */
class AdminSettingsPage
{
    use SingletonTrait;

    /**
     * PLugin slug
     * @var string
     */
    private $pluginSlug;

    /**
     * Page slug
     * @var string
     */
    private $pageSlug;

    /**
     * Settings option group
     * @var string
     */
    private $optionGroup;

    /**
     * Settings option section
     * @var string
     */
    private $optionSection;

    /**
     * Settings option name
     * @var string
     */
    private $optionName;

    /**
     * Settings model instance
     * @var SettingsModel
     */
    private $model;

    /**
     * AdminSettingsPage constructor.
     */
    private function __construct()
    {
        $this->pluginSlug = PREDIC_API_BASE_SLUG;
        $this->pageSlug = sprintf('%s-import', $this->pluginSlug);
        $this->optionGroup = sprintf('%s-api-settings', $this->pluginSlug);
        $this->optionSection = sprintf('%s-api-settings-section', $this->pluginSlug);

        $this->model = SettingsModel::getInstance();
        $this->optionName = $this->model->getOptionName();
    }

    /**
     * Add submenu settings page
     */
    public function create()
    {
        // Add submenu page
        add_action('admin_menu', [$this, 'addPage']);

        // Register settings and fields
        add_action('admin_init', [$this, 'settingsInit']);
    }

    /**
     * Add submenu page
     */
    public function addPage()
    {
        add_submenu_page(
            'options-general.php',
            esc_html__('API settings', 'predic-api-base'),
            esc_html__('Predic API settings', 'predic-api-base'),
            'manage_options',
            $this->pageSlug,
            [$this, 'render'],
            null
        );
    }

    /**
     * Register settings fields
     */
    public function settingsInit()
    {
        // register a new setting
        register_setting($this->optionGroup, $this->optionName);

        // register a new section
        add_settings_section(
            $this->optionSection,
            esc_html__('API key and host settings', 'predic-api-base'),
            null,
            $this->pageSlug
        );

        // register a new fields
        add_settings_field(
            'x_rapidapi_key',
            esc_html__('x-rapidapi-key', 'predic-api-base'),
            function () {
                $this->inputField('key');
            },
            $this->pageSlug,
            $this->optionSection
        );

        add_settings_field(
            'x_rapidapi_host',
            esc_html__('x-rapidapi-host', 'predic-api-base'),
            function () {
                $this->inputField('host');
            },
            $this->pageSlug,
            $this->optionSection
        );
    }

    /**
     * Render the page content
     */
    public function render()
    {
        printf('<h1>%s</h1>', esc_html(get_admin_page_title())); ?>
        <form method="POST" action="options.php">
        <?php

        settings_fields($this->optionGroup);
        do_settings_sections($this->pageSlug);

        submit_button(); ?>
        </form>
        <?php
    }

    /**
     * Render input field
     * @param string $name
     */
    private function inputField($name)
    {
        $value = '';
        switch ($name) {
            case 'key':
                $value = $this->model->getApiKey();

                break;

            case 'host':
                $value = $this->model->getApiHost();

                break;
        }

        printf(
            '<input type="text" name="%1$s" value="%2$s">',
            sprintf('%s[%s]', $this->optionName, $name),
            sanitize_text_field($value)
        );
    }
}
