<?php

namespace PredicApiBase;

use PredicApiBase\Admin\AdminSettingsPage;
use PredicApiBase\Helpers\ApiNotWorkingNotice;
use PredicApiBase\I18n\I18n;
use PredicApiBase\Services\ApiOddsService;
use PredicApiBase\Services\ApiSportsService;
use PredicApiBase\Services\RapidApiService;
use PredicApiBase\Services\RemoteGetRequest;
use PredicApiBase\Traits\SingletonTrait;

class PredicApiBase
{
    use SingletonTrait;

    /**
     * PredicApiBase constructor.
     */
    private function __construct()
    {
    }

    /**
     * Set plugin required functionality
     */
    public function setInstances()
    {
        // Global

        /**
         * Load textdomain.
         */
        I18n::getInstance();

        // Global filters for other plugins to use

        $apiService = new RapidApiService(
            new RemoteGetRequest()
        );

        /**
         * Odds API service for other plugins or themes
         */
        add_filter('predic_api_base_get_odds', [new ApiOddsService($apiService), 'getAll'], 1, 3);

        /**
         * Sports API service for other plugins or themes
         */
        add_filter('predic_api_base_get_sports', [new ApiSportsService($apiService), 'getAll'], 1, 1);

        // Admin only
        if (! is_admin()) {
            return;
        }

        /**
         * Display admin notice if the settings are empty
         */
        add_action('admin_init', function () {
            $notice = new ApiNotWorkingNotice();
            $notice->show();
        });

        /**
         * Add API settings page under Settings -> Predic API settings
         */
        AdminSettingsPage::getInstance()->create();
    }
}
