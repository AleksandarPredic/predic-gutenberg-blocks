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
     * @param array $data
     *
     * @return string
     */
    public function getFiltersHtml(array $data)
    {
        $sports = $this->mapSportsData($data);
        $sportsSelectOptions = implode(
            '',
            array_map(
                /**
                 * @param Sport $sport
                 */
                function ($sport) {
                    return sprintf(
                        '<option value="%s">%s</option>',
                        sanitize_text_field($sport->getId()), // %1$s
                        wp_strip_all_tags($sport->getName()) // %2$s
                    );
                },
                $sports
            )
        );

        $regionOptions = implode(
            '',
            array_map(
                function ($region) {
                    return sprintf(
                        '<option value="%s">%s</option>',
                        sanitize_text_field($region['id']), // %1$s
                        wp_strip_all_tags($region['name']) // %2$s
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

        $marketOptions = implode(
            '',
            array_map(
                function ($market) {
                    return sprintf(
                        '<option value="%s">%s</option>',
                        sanitize_text_field($market['id']), // %1$s
                        wp_strip_all_tags($market['name']) // %2$s
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
                    <button type="submit" class="button">%7$s</button>
                </div>
            </form>',
            esc_html__('Sport', 'predic-blocks'), // %1$s
            $sportsSelectOptions, // %2$s
            esc_html__('Region', 'predic-blocks'), // %3$s
            $regionOptions, // %4$s
            esc_html__('Market', 'predic-blocks'), // %5$s
            $marketOptions, // %6$s
            esc_html__('Filter', 'predic-blocks') // %7$s
        );
    }

    /**
     * Creates matches array with html
     * @param array $data
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
                            $odds = [];
                            foreach ($bookmaker->getOdds() as $key => $odd) {
                                $odds[] = sprintf(
                                    '<li><small>%s</small><span>%s</span></li>',
                                    intval($key) + 1, // %1$s
                                    wp_strip_all_tags($odd) // %2$s
                                );
                            }

                            return sprintf(
                                '<div class="prblocks-odds-table__bookmaker">
                                    <h6>%1$s</h6>
                                    <ul>%2$s</ul>
                                </div>',
                                wp_strip_all_tags($bookmaker->getName()), // %1$s
                                implode('', $odds) // %2$s
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
                if (! isset($site['odds']) || ! isset($site['odds']['h2h']) || empty($site['odds']['h2h'])) {
                    continue;
                }

                $matchData['bookmakers'][] = new Bookmaker(
                    $site['site_nice'],
                    $site['odds']['h2h']
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
