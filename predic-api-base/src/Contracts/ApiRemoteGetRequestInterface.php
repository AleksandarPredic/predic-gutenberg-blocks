<?php

namespace PredicApiBase\Contracts;

/**
 * Interface ApiRemoteGetRequestInterface
 * @package PredicApiBase\Contracts
 */
interface ApiRemoteGetRequestInterface
{
    /**
     * Preform remote Get request
     * @param string $url
     * @param array $headers
     *
     * @return array|\WP_Error
     */
    public function get($url, array $headers);
}
