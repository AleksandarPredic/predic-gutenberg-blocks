<?php

namespace PredicBlocks\Blocks\Templates;

use PredicBlocks\ValueObjects\Bookmaker;
use PredicBlocks\ValueObjects\Sport;
use PredicBlocks\ValueObjects\Team;

/**
 * Class SportsOddsTableHelper
 * @package PredicBlocks\Blocks\Templates
 */
class SportsOddsTableHelper
{

    /**
     * Creates form filter html
     *
     * @param array $sportsData
     * @param array $allOddsData Add odds data from the API just mapped, not filtered
     * @param string $selectedRegion Selected region value
     * @param string $selectedSport Selected sport value
     * @param string $selectedMarket Selected market value
     * @param string $selectedTeam Selected team value
     *
     * @return string
     */
    public function getFiltersHtml(
        array $sportsData,
        array $allOddsData,
        $selectedRegion,
        $selectedSport,
        $selectedMarket,
        $selectedTeam
    )
    {
        // Team select options
        $teamsOptions = [
            sprintf(
                '<option value="all">%s</option>',
                esc_html__('All', 'predic-blocks')
            )
        ];
        foreach ($this->mapMatchesData($allOddsData) as $match) {
            foreach ($match['teams'] as $team) {
                /**
                 * @var Team $team
                 */
                $teamsOptions[] = sprintf(
                    '<option value="%1$s"%3$s>%2$s</option>',
                    sanitize_text_field($team->getId()), // %1$s
                    wp_strip_all_tags($team->getName()), // %2$s
                    selected($selectedTeam, $team->getId(), false) // %3$s
                );
            }
        }
        $teamsSelectOptions = implode('', $teamsOptions);

        // Sports select options
        $sports = $this->mapSportsData($sportsData);
        $sportsSelectOptions = implode(
            '',
            array_map(
                /**
                 * @param Sport $sport
                 */
                function ($sport) use ($selectedSport) {
                    return sprintf(
                        '<option value="%1$s"%3$s>%2$s</option>',
                        sanitize_text_field($sport->getId()), // %1$s
                        wp_strip_all_tags($sport->getName()), // %2$s
                        selected($selectedSport, $sport->getId(), false) // %3$s
                    );
                },
                $sports
            )
        );

        // Region select options
        $regionSelectOptions = implode(
            '',
            array_map(
                function ($region) use ($selectedRegion) {
                    return sprintf(
                        '<option value="%1$s"%3$s>%2$s</option>',
                        sanitize_text_field($region['id']), // %1$s
                        wp_strip_all_tags($region['name']), // %2$s
                        selected($selectedRegion, $region['id'], false) // %3$s
                    );
                },
                [
                    [
                        'name' => esc_html__('United Kingdom', 'predic-blocks'),
                        'id' => 'uk'
                    ],
                    [
                        'name' => esc_html__('USA', 'predic-blocks'),
                        'id' => 'us'
                    ],
                    [
                        'name' => esc_html__('Europe', 'predic-blocks'),
                        'id' => 'eu'
                    ],
                    [
                        'name' => esc_html__('Australia', 'predic-blocks'),
                        'id' => 'au'
                    ],
                ]
            )
        );

        // Market select options
        $marketSelectOptions = implode(
            '',
            array_map(
                function ($market) use ($selectedMarket) {
                    return sprintf(
                        '<option value="%1$s"%3$s>%2$s</option>',
                        sanitize_text_field($market['id']), // %1$s
                        wp_strip_all_tags($market['name']), // %2$s
                        selected($selectedMarket, $market['id'], false) // %3$s
                    );
                },
                [
                    [
                        'name' => esc_html__('Head to head', 'predic-blocks'),
                        'id' => 'h2h'
                    ],
                    [
                        'name' => esc_html__('Points spreads ', 'predic-blocks'),
                        'id' => 'spreads'
                    ],
                    [
                        'name' => esc_html__('Totals', 'predic-blocks'),
                        'id' => 'totals'
                    ],
                ]
            )
        );

        return sprintf(
            '<form>
                <div>
                    <label>%1$s</label>
                    <select name="sport">%2$s</select>
                </div>
                <div>
                    <label>%3$s</label>
                    <select name="region">%4$s</select>
                </div>
                <div>
                    <label>%5$s</label>
                    <select name="market">%6$s</select>
                </div>
                <div>
                    <label>%7$s</label>
                    <select name="team">%8$s</select>
                </div>
                <div>
                    <button type="submit" class="button">%9$s</button>
                </div>
            </form>',
            esc_html__('Sport', 'predic-blocks'), // %1$s
            $sportsSelectOptions, // %2$s
            esc_html__('Region', 'predic-blocks'), // %3$s
            $regionSelectOptions, // %4$s
            esc_html__('Market', 'predic-blocks'), // %5$s
            $marketSelectOptions, // %6$s
            esc_html__('Team', 'predic-blocks'), // %7$s
            $teamsSelectOptions, // %8$s
            esc_html__('Filter', 'predic-blocks') // %9$s
        );
    }

    /**
     * Creates matches array with html
     * @param array $data Data from odds API
     * @param int $noOfMatches
     *
     * @return array
     */
    public function getMatchesHtml(array $data, $noOfMatches)
    {
        $matches = $this->filterMatchesData($data, $noOfMatches);

        $dateFormat = get_option('date_format');
        $timeFormat = get_option('time_format');
        $matchesHtml = [];
        foreach ($matches as $match) {
            try {
                $dateTime = new \DateTime($match['time']);

                $time = $dateTime->format(
                    sprintf('%s - %s', $dateFormat, $timeFormat)
                );
            } catch (\Exception $e) {
                $time = '';
            }

            $matchesHtml[] = sprintf(
                '<div class="prblocks-odds-table__match">
                    <div class="prblocks-odds-table__team">
                        <div>%1$s</div>
                        <time>%2$s</time>
                    </div>
                    <div class="prblocks-odds-table__odds">%3$s</div>
                </div>',
                implode(
                    '',
                    array_map(
                        /**
                         * @param Team $team
                         */
                        function ($team) {
                            return sprintf(
                                '<h5%2$s>%1$s</h5>',
                                wp_strip_all_tags($team->getName()),
                                $team->isHome() ? ' class="prblocks-odds-table__team--home"' : ''
                            );
                        },
                        $match['teams']
                    )
                ), // %1$s
                $time, // %2$s
                implode(
                    '',
                    array_map(
                        /**
                         * @param Bookmaker $bookmaker
                         */
                        function ($bookmaker) {
                            $oddsHtml = [];
                            $odds = $bookmaker->getOdds();

                            // h2h
                            if (isset($odds['h2h'])) {
                                foreach ($odds['h2h'] as $key => $odd) {
                                    $oddsHtml[] = sprintf(
                                        '<li class="prblocks-odds-table__odd-h2h"><small>%1$s</small><span>%2$s</span></li>',
                                        intval($key) + 1, // %1$s
                                        wp_strip_all_tags($odd) // %2$s
                                    );
                                }
                            }

                            // spreads
                            if (isset($odds['spreads'])) {
                                foreach ($odds['spreads']['odds'] as $key => $odd) {
                                    $oddsHtml[] = sprintf(
                                        '<li class="prblocks-odds-table__odd-spreads"><small>%1$s</small><span>%2$s</span></li>',
                                        wp_strip_all_tags($odds['spreads']['points'][$key]), // %1$s
                                        wp_strip_all_tags($odd) // %2$s
                                    );
                                }
                            }

                            // totals
                            if (isset($odds['totals'])) {
                                foreach ($odds['totals']['odds'] as $key => $odd) {
                                    $oddsHtml[] = sprintf(
                                        '<li class="prblocks-odds-table__odd-totals"><small><span>%3$s</span>%1$s</small><span>%2$s</span></li>',
                                        wp_strip_all_tags($odds['totals']['points'][$key]), // %1$s
                                        wp_strip_all_tags($odd), // %2$s
                                        wp_strip_all_tags($odds['totals']['position'][$key]) // %3$s
                                    );
                                }
                            }

                            return sprintf(
                                '<div class="prblocks-odds-table__bookmaker">
                                    <h6>%1$s</h6>
                                    <ul>%2$s</ul>
                                </div>',
                                wp_strip_all_tags($bookmaker->getName()), // %1$s
                                implode('', $oddsHtml) // %2$s
                            );
                        },
                        $match['bookmakers']
                    )
                )
            );
        }

        return $matchesHtml;
    }

    /**
     * Apply the form filters to the API response
     * @param array $data
     * @param int $noOfMatches
     *
     * @return array
     */
    private function filterMatchesData(array $data, $noOfMatches)
    {
        $mappedData = $this->mapMatchesData($data);

        return array_slice($mappedData, 0, $noOfMatches);
    }

    /**
     * Map odds API response data to our value objects
     * @param array $data
     *
     * @return array
     */
    private function mapMatchesData(array $data)
    {
        $mappedData = [];
        foreach ($data as $match) {
            $matchData = [
                'teams' => [
                    new Team(
                        $match['teams'][0],
                        $match['teams'][0] === $match['home_team']
                    ),
                    new Team(
                        $match['teams'][1],
                        $match['teams'][1] === $match['home_team']
                    )
                ],
                'time' => $match['commence_time'],
                'bookmakers' => []
            ];

            foreach ($match['sites'] as $site) {
                if (! isset($site['odds']) || ! isset($site['odds']) || empty($site['odds'])) {
                    continue;
                }

                $matchData['bookmakers'][] = new Bookmaker(
                    $site['site_nice'],
                    $site['odds']
                );
            }

            $mappedData[] = $matchData;
        }

        return $mappedData;
    }

    /**
     * Map Sports API response data to our value objects
     * @param array $data
     *
     * @return Sport[]
     */
    private function mapSportsData(array $data)
    {
        return array_map(
            function ($sport) {
                return new Sport(
                    $sport['title'],
                    $sport['key']
                );
            },
            $data
        );
    }
}
