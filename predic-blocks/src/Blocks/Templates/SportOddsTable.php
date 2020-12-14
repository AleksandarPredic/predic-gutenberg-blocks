<?php

namespace PredicBlocks\Blocks\Templates;

use PredicBlocks\Contracts\Blocks\DynamicBlockAjaxTemplateInterface;
use PredicBlocks\Contracts\Blocks\DynamicBlockTemplateInterface;
use PredicBlocks\Helpers\LoggerHelper;
use PredicBlocks\Traits\SingletonTrait;
use PredicBlocks\ValueObjects\Team;

/**
 * Class SportOddsTable
 *
 * Server rendering for /blocks/examples/sports-odds-table
 *
 * @package PredicBlocks\Blocks\Templates
 */
class SportOddsTable implements DynamicBlockTemplateInterface, DynamicBlockAjaxTemplateInterface
{
    use SingletonTrait;

    private const AJAX_ACTION = 'predic_blocks_render_action';
    private const NUMBER_OF_MATCHES_TO_DISPLAY = 10;
    public const DEFAULT_REGION = 'uk';
    public const DEFAULT_SPORT = 'soccer_epl';
    public const DEFAULT_MARKET = 'h2h';
    public const DEFAULT_TEAM = 'all';

    /**
     * Logger
     *
     * @var LoggerHelper
     */
    private $logger;

    /**
     * Helper to make a class shorter
     * @var SportsOddsTableHelper
     */
    private $helper;

    /**
     * PredicBlocks constructor.
     */
    private function __construct()
    {
        $this->logger = new LoggerHelper();
        $this->helper = new SportsOddsTableHelper();
    }

    /**
     * @inheritDoc
     */
    public function initAjaxHooks()
    {
        add_action(sprintf('wp_ajax_%s', self::AJAX_ACTION), [ $this, 'ajaxRender' ]);
        add_action(sprintf('wp_ajax_nopriv_%s', self::AJAX_ACTION), [ $this, 'ajaxRender' ]);

        add_action('wp_enqueue_scripts', [ $this, 'scripts' ]);
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

        $apiOddsData = $this->getApiOdds(
            self::DEFAULT_REGION,
            self::DEFAULT_SPORT,
            self::DEFAULT_MARKET
        );

        if (is_wp_error($apiOddsData)) {
            $this->logger->log(
                $apiOddsData->get_error_message(),
                $apiOddsData->get_error_code()
            );

            return $errorMessage;
        }

        $apiSportsData = $this->getApiSports();
        if (is_wp_error($apiSportsData)) {
            $this->logger->log(
                $apiSportsData->get_error_message(),
                $apiSportsData->get_error_code()
            );

            return $errorMessage;
        }

        // Parse sports data
        if (! isset($apiSportsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'No data key in the response array form Sports API.',
                    'predic-blocks'
                ),
                400
            );

            return $errorMessage;
        }

        if (empty($apiSportsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'There are not sports to display filter.',
                    'predic-blocks'
                ),
                204
            );

            return $errorMessage;
        }

        // Parse odds data
        if (! isset($apiOddsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'No data key in the response array form Odds API.',
                    'predic-blocks'
                ),
                400
            );

            return $errorMessage;
        }

        if (empty($apiOddsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'There are not matches to display.',
                    'predic-blocks'
                ),
                204
            );

            return $errorMessage;
        }

        return sprintf(
            '<section class="prblocks-odds-table%1$s">
                <div class="prblocks-odds-table__filters">%3$s</div>
                <div class="prblocks-odds-table__message"></div>
                <div class="prblocks-odds-table__table">
                    <div class="prblocks-odds-table__loader">
                        <div class="predic-blocks-loader"></div>
                    </div>
                    <div class="prblocks-odds-table__matches">
                        %2$s
                    </div>
                </div>
            </section>',
            ! empty($class) ? ' ' . $class : '', // %1$s
            $this->renderMatches($apiOddsData['data']), // %2$s
            $this->helper->getFiltersHtml(
                $apiSportsData['data'],
                $apiOddsData['data'],
                self::DEFAULT_REGION,
                self::DEFAULT_SPORT,
                self::DEFAULT_MARKET,
                self::DEFAULT_TEAM
            ) // %3$s
        );
    }

    /**
     * @inheritDoc
     */
    public function ajaxRender()
    {
        check_ajax_referer(self::AJAX_ACTION, 'check');

        if (
            (! isset($_POST['sport']) || empty($_POST['sport']))
            || (! isset($_POST['region']) || empty($_POST['region']))
            || (! isset($_POST['market']) || empty($_POST['market']))
            || (! isset($_POST['team']) || empty($_POST['team']))
        ) {
            wp_send_json_error(
                [ 'message' => esc_html__('Error. Missing data!', 'predic-blocks') ],
                400
            );
        }

        $errorMessage = esc_html__(
            'There was an error and we can not display matches!',
            'predic-blocks'
        );

        // Parse odds data to return matches
        $region = sanitize_text_field($_POST['region']);
        $sport = sanitize_text_field($_POST['sport']);
        $market = sanitize_text_field($_POST['market']);

        $apiOddsData = $this->getApiOdds(
            $region,
            $sport,
            $market
        );

        if (is_wp_error($apiOddsData)) {
            $this->logger->log(
                $apiOddsData->get_error_message(),
                $apiOddsData->get_error_code()
            );

            wp_send_json_error(
                [ 'message' => $errorMessage ],
                500
            );
        }

        if (! isset($apiOddsData['data'])) {
            $errorMessage = esc_html__(
                'No data key in the response array form Odds API.',
                'predic-blocks'
            );

            $this->logger->log(
                $errorMessage,
                400
            );

            wp_send_json_error(
                [ 'message' => $errorMessage ],
                500
            );
        }

        if (empty($apiOddsData['data'])) {
            $errorMessage = esc_html__(
                'There are not matches to display.',
                'predic-blocks'
            );

            $this->logger->log(
                $errorMessage,
                204
            );

            wp_send_json_error(
                [ 'message' => $errorMessage ],
                204
            );
        }

        $apiOddsData = $apiOddsData['data'];
        $maybeFilteredApisOddsData = $apiOddsData;

        // Check if we need to filter by the team
        $team = sanitize_text_field($_POST['team']);
        if ('all' !== $team) {
            $maybeFilteredApisOddsData = array_filter(
                $apiOddsData,
                function ($match) use ($team) {
                    return in_array($team, array_map([Team::class, 'generateId'], $match['teams']));
                }
            );
        }

        // Parse sports data to return filter
        $apiSportsData = $this->getApiSports();

        if (is_wp_error($apiSportsData)) {
            $this->logger->log(
                $apiSportsData->get_error_message(),
                $apiSportsData->get_error_code()
            );

            wp_send_json_error(
                [ 'message' => $errorMessage ],
                500
            );
        }

        if (! isset($apiSportsData['data'])) {
            $errorMessage = esc_html__(
                'No data key in the response array form Sports API.',
                'predic-blocks'
            );

            $this->logger->log(
                $errorMessage,
                400
            );

            wp_send_json_error(
                [ 'message' => $errorMessage ],
                400
            );
        }

        if (empty($apiSportsData['data'])) {
            $errorMessage = esc_html__(
                'There are not sports to display filter.',
                'predic-blocks'
            );

            $this->logger->log(
                $errorMessage,
                204
            );

            return $errorMessage;
        }

        // Case we have nothing filtered form API response by selected team
        $matchesRender = ! empty($maybeFilteredApisOddsData)
            ? $this->renderMatches($maybeFilteredApisOddsData)
            : esc_html__(
                'There are no matches to display. Try another filter.',
                'predic-blocks'
            );

        wp_send_json_success(
            [
                'matches' => $matchesRender,
                'form' => $this->helper->getFiltersHtml(
                    $apiSportsData['data'],
                    $apiOddsData,
                    $region,
                    $sport,
                    $market,
                    $team
                )
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function scripts()
    {
        wp_localize_script(
            'predic-blocks-frontend',
            '_sportsOddsTableData',
            [
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'submitAction' => self::AJAX_ACTION,
                'submitCheck' => wp_create_nonce(self::AJAX_ACTION),
            ]
        );
    }

    /**
     * Render the table matches from the API data
     * @param array $apiOddsData
     *
     * @return string
     */
    private function renderMatches($apiOddsData)
    {
        return implode('', $this->helper->getMatchesHtml($apiOddsData, self::NUMBER_OF_MATCHES_TO_DISPLAY));
    }

    /**
     * Get odds from RapidApi
     *
     * @param string $region
     * @param string $sport
     * @param string $market
     *
     * @return array
     */
    private function getApiOdds($region, $sport, $market)
    {
        return $apiOddsData = apply_filters('predic_api_base_get_odds', $region, $sport, $market);
    }

    /**
     * Get sports from RapidApi
     *
     * @return array
     */
    private function getApiSports()
    {
        return $apiSportsData = apply_filters('predic_api_base_get_sports', null);
    }
}
