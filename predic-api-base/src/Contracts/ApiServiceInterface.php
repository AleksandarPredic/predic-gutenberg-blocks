<?php

namespace PredicApiBase\Contracts;

use PredicApiBase\ValueObjects\ApiResponse;

/**
 * Class APIServiceInterface
 * @package PredicApiBase\Contracts
 */
interface ApiServiceInterface
{

    /**
     * Preform GET request and return data or throw an Exception
     * @param array $queryParams
     * @param string $endpoint Choice: odds or sports
     * @throws \Exception
     * @return APIResponse
     */
    public function get(array $queryParams, $endpoint);
}
