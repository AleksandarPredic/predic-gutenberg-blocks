<?php

namespace PredicApiBase\Data\Models;

/**
 * Class SettingsModelSchema
 * @package PredicApiBase\Data\Models
 */
abstract class SettingsModelSchema
{
    /**
     * Options table key
     * @var string
     */
    protected const OPTION_KEY = 'predic_api_base_settings';

    /**
     * API key
     * @var string;
     */
    protected $key;

    /**
     * API host
     * @var string;
     */
    protected $host;
}
