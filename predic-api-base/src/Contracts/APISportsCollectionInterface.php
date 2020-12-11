<?php

namespace PredicApiBase\Contracts;

/**
 * Interface APISportsCollectionInterface
 */
interface APISportsCollectionInterface
{
    /**
     * Get all sports from API
     *
     * @return array|\WP_Error Array with data from API response or \WP_Error
     */
    public function getAll();
}
