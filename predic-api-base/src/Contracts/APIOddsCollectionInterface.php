<?php

namespace PredicApiBase\Contracts;

/**
 * Interface APICollectionInterface
 */
interface APIOddsCollectionInterface
{
    /**
     * Get all odds from API
     *
     * @param string $region Choices: us, uk, eu, au
     * @param string $sport All from https://odds.p.rapidapi.com/v1/sports
     * @param string $market Choices: h2h, spreads, totals
     *
     * @return array|\WP_Error Array with data from API response or \WP_Error
     */
    public function getAll(
        $region,
        $sport,
        $market
    );
}
