<?php

namespace PredicApiBase\Services;

use PredicApiBase\Contracts\ApiServiceInterface;
use PredicApiBase\ValueObjects\ApiResponse;

/**
 * Class RapidApiService
 * @package PredicApiBase\Services
 * @link https://rapidapi.com/theoddsapi/api/live-sports-odds
 */
class RapidApiService implements ApiServiceInterface
{

    // TODO: Change this to half a day
    protected const CACHE_DURATION = MONTH_IN_SECONDS;

    /**
     * Production API endpoint
     * @var string
     */
    protected $productionUrl;

    protected $xRapidApiKey;
    protected $xRapidApiHost;

    public function __construct()
    {
        $this->productionUrl = 'https://odds.p.rapidapi.com/v1/';
        $this->xRapidApiKey = 'e88082ebe2msh9de52b60a6407afp18ee44jsnbbcadc104a4c';
        $this->xRapidApiHost = 'odds.p.rapidapi.com';
    }

    /**
     * Preform GET request and return data or throw an Exception
     * @param array $queryParams
     * @param string $endpoint Choice: odds or sports
     * @throws \Exception
     * @return APIResponse
     */
    public function get(array $queryParams, $endpoint)
    {
        // Set cache key
        $transientKey = '';
        if (! empty($queryParams)) {
            foreach ($queryParams as $key => $value) {
                $transientKey .= sprintf('%s_%s-', $key, $value);
            }
        }
        $transientKey .= $endpoint;

        $cachedData = get_transient($transientKey);

        // Return cache
        if ($cachedData) {
            return new ApiResponse($cachedData);
        }

        $url = add_query_arg(
            array_map(
                'urlencode',
                $queryParams
            ),
            $this->productionUrl . $endpoint
        );

        $response = wp_remote_get(
            $url,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-rapidapi-key' => $this->xRapidApiKey,
                    'x-rapidapi-host' => $this->xRapidApiHost,
                    'useQueryString' => true
                ]
            ]
        );

        if (is_wp_error($response)) {
            throw new \Exception(
                $response->get_error_message(),
                // Prevent string returned on curl error instead of code
                is_int($response->get_error_code()) ? $response->get_error_code() : 500
            );
        }

        $code = wp_remote_retrieve_response_code($response);

        if (200 !== $code) {
            throw new \Exception(
                esc_html__('Something went wrong. Please try again later!', 'predic-api-base'),
                $code
            );
        }

        $response = json_decode($response['body'], true);

        if (null === $response || ! is_array($response)) {
            throw new \Exception(
                esc_html__('Response json error!', 'predic-api-base'),
                400
            );
        }

        // Set new cache data
        set_transient($transientKey, $response, self::CACHE_DURATION);

        return new ApiResponse($response);
    }
}
