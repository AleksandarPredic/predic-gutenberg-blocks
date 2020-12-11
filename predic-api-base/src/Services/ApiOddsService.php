<?php

namespace PredicApiBase\Services;

use PredicApiBase\Contracts\APIOddsCollectionInterface;
use PredicApiBase\Contracts\ApiServiceInterface;

/**
 * Class ApiOddsService
 * @package PredicApiBase\Services
 */
class ApiOddsService implements APIOddsCollectionInterface
{
    private const ENDPOINT = 'odds';

    /**
     * API service object
     * @var APIServiceInterface
     */
    private $api;

    /**
     * ApiOddsService constructor.
     * @param APIServiceInterface $api
     */
    public function __construct(APIServiceInterface $api)
    {
        $this->api = $api;
    }

    /**
     * @inheritDoc
     */
    public function getAll(
        $region,
        $sport,
        $market
    ) {
        $queryParams = [
            'region' => sanitize_text_field($region),
            'sport' => sanitize_text_field($sport),
            'oddsFormat' => 'decimal',
            'mkt' => sanitize_text_field($market),
            'dateFormat' => 'iso',
        ];

        try {
            $result = $this->api->get(
                $queryParams,
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
