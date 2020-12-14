<?php

namespace PredicApiBase\Services;

use PredicApiBase\Contracts\ApiRemoteGetRequestInterface;
use PredicApiBase\Contracts\ApiServiceInterface;
use PredicApiBase\Data\Models\SettingsModel;
use PredicApiBase\ValueObjects\ApiResponse;

/**
 * Class RapidApiService
 * @package PredicApiBase\Services
 * @link https://rapidapi.com/theoddsapi/api/live-sports-odds
 */
class RapidApiService implements ApiServiceInterface
{
    
    private const CACHE_DURATION = HOUR_IN_SECONDS;

    /**
     * Production API endpoint
     * @var string
     */
    private $productionUrl;

    /**
     * API key
     * @var string
     */
    private $xRapidApiKey;

    /**
     * API host
     * @var string
     */
    private $xRapidApiHost;

    /**
     * Preform remote Get request
     * @var ApiRemoteGetRequestInterface
     */
    private $remoteGetRequest;

    /**
     * RapidApiService constructor.
     *
     * @param ApiRemoteGetRequestInterface $remoteGetRequest
     */
    public function __construct(ApiRemoteGetRequestInterface $remoteGetRequest)
    {
        $this->remoteGetRequest = $remoteGetRequest;

        $model = SettingsModel::getInstance();
        $this->productionUrl = 'https://odds.p.rapidapi.com/v1/';
        $this->xRapidApiKey = $model->getApiKey();
        $this->xRapidApiHost = $model->getApiHost();
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
        $transientKey = 'predic_api_base';
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

        $response = $this->remoteGetRequest->get(
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
