<?php

namespace PredicApiBase\Services;

use PredicApiBase\Contracts\ApiServiceInterface;
use PredicApiBase\Contracts\APISportsCollectionInterface;

/**
 * Class ApiSportsService
 * @package PredicApiBase\Services
 */
class ApiSportsService implements APISportsCollectionInterface
{
    private const ENDPOINT = 'sports';

    /**
     * API service object
     * @var APIServiceInterface
     */
    private $api;

    /**
     * ApiSportsService constructor.
     * @param APIServiceInterface $api
     */
    public function __construct(APIServiceInterface $api)
    {
        $this->api = $api;
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        try {
            $result = $this->api->get(
                [],
                self::ENDPOINT
            )->getData();
        } catch (\Exception $e) {
            $result = new \WP_Error(
                $e->getCode(),
                $e->getMessage()
            );
        }

        return $result;
    }
}
