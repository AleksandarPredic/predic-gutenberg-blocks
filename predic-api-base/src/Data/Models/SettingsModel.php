<?php

namespace PredicApiBase\Data\Models;

use PredicApiBase\Traits\SingletonTrait;

/**
 * Class SettingsModel
 * @package PredicApiBase\Data\Models
 */
class SettingsModel extends SettingsModelSchema
{

    use SingletonTrait;

    /**
     * ProductModel constructor.
     */
    public function __construct()
    {
        $data = get_option($this->getOptionName());
        $this->key = isset($data['key']) ? $data['key'] : '';
        $this->host = isset($data['host']) ? $data['host'] : '';
    }

    /**
     * Return API key from database
     * @return string
     */
    public function getApiKey()
    {
        return $this->key;
    }

    /**
     * Return API host from database
     * @return string
     */
    public function getApiHost()
    {
        return $this->host;
    }

    /**
     * Return database option key
     * @return string
     */
    public function getOptionName()
    {
        return self::OPTION_KEY;
    }
}
