<?php

namespace PredicApiBase;

use PredicApiBase\I18n\I18n;
use PredicApiBase\Services\ApiSportsService;
use PredicApiBase\Services\RapidApiService;
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

        /**
         * Sports API service
         */
        $apiSports = new ApiSportsService(new RapidApiService());
        add_filter('predic_api_base_get_odds', [$apiSports, 'getAll'], 1, 3);
    }
}
