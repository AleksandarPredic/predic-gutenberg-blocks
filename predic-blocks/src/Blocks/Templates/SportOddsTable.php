<?php

namespace PredicBlocks\Blocks\Templates;

use PredicBlocks\Contracts\Blocks\DynamicBlockTemplateInterface;
use PredicBlocks\Helpers\LoggerHelper;
use PredicBlocks\Traits\SingletonTrait;
use PredicBlocks\ValueObjects\Bookmaker;
use PredicBlocks\ValueObjects\Team;

/**
 * Class SportOddsTable
 *
 * Server rendering for /blocks/examples/sports-odds-table
 *
 * @package PredicBlocks\Blocks\Templates
 */
class SportOddsTable implements DynamicBlockTemplateInterface
{
    use SingletonTrait;

    /**
     * Logger
     *
     * @var LoggerHelper
     */
    private $logger;

    /**
     * PredicBlocks constructor.
     */
    private function __construct()
    {
        $this->logger = new LoggerHelper();
    }

    /**
     * @inheritDoc
     */
    public function registerDynamicBlock()
    {

        // Only load if Gutenberg is available.
        if (! function_exists('register_block_type')) {
            return;
        }

        // Hook server side rendering into render callback
        register_block_type(
            'predicblocks/sports-odds-table',
            [
            'attributes' => [
                'className' => [
                    'type' => 'string',
                ],
            ],
            'render_callback' => [$this, 'renderDynamicBlock'],
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function renderDynamicBlock($attributes)
    {
        // Gutenberg custom class from advances block settings
        $class = isset($attributes['className']) ? $attributes['className'] : '';

        // Fetch sports data from our central plugin

        $errorMessage = esc_html__(
            'There was an error and the Sports odds table can not be displayed!.',
            'predic-blocks'
        );
        $apiOddsData = apply_filters('predic_api_base_get_odds', 'uk', 'soccer_epl', 'h2h');
        if (is_wp_error($apiOddsData)) {
            $this->logger->log(
                $apiOddsData->get_error_message(),
                $apiOddsData->get_error_code()
            );

            return $errorMessage;
            // TODO: What to do in case of error.
        }

        $apiSportsData = apply_filters('predic_api_base_get_sports', null);
        if (is_wp_error($apiSportsData)) {
            $this->logger->log(
                $apiSportsData->get_error_message(),
                $apiSportsData->get_error_code()
            );

            return $errorMessage;
            // TODO: What to do in case of error.
        }

        if (! isset($apiOddsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'No data key in the response array form Odds API!.',
                    'predic-blocks'
                ),
                400
            );

            return $errorMessage;
        }

        if (empty($apiOddsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'There are not matches to display!.',
                    'predic-blocks'
                ),
                204
            );

            return $errorMessage;
        }

        // Map response to our needs
        $matches = $this->filterData($apiOddsData['data'], 10);


        $html = sprintf(
            '<section class="prblocks-odds-table%1$s">
                <div>%2$s</div>
            </section>',
            ! empty($class) ? ' ' . $class : '', // %1$s
            implode('', $this->getMatchesHtml($matches)) // %2$s
        );

        return $html;
    }

    private function getMatchesHtml(array $matches) {
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

    private function filterData($data, $noOfMatches)
    {
        $mappedData = $this->mapData($data);

        return array_slice($mappedData, 0, $noOfMatches);
    }

    private function mapData($data)
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
}
