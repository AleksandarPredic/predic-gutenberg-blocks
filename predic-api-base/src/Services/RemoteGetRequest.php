<?php

namespace PredicApiBase\Services;

use PredicApiBase\Contracts\ApiRemoteGetRequestInterface;

/**
 * Class RemoteGetRequest
 * @package PredicApiBase\Services
 */
class RemoteGetRequest implements ApiRemoteGetRequestInterface
{
    /**
     * @inheritDoc
     */
    public function get($url, array $headers)
    {
        return wp_remote_get($url, $headers);
    }
}
