<?php

namespace PredicBlocks\Blocks\Templates;

use PredicBlocks\Contracts\Blocks\DynamicBlockTemplateInterface;
use PredicBlocks\Helpers\LoggerHelper;
use PredicBlocks\Traits\SingletonTrait;

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

        // Parse sports data
        if (! isset($apiSportsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'No data key in the response array form Sports API!.',
                    'predic-blocks'
                ),
                400
            );

            return $errorMessage;
        }

        if (empty($apiSportsData['data'])) {
            $this->logger->log(
                esc_html__(
                    'There are not sports to display filter!.',
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

        $html = sprintf(
            '<section class="prblocks-odds-table%1$s">
                <div class="prblocks-odds-table__filters">%3$s</div>
                <div class="prblocks-odds-table__table">%2$s</div>
            </section>',
            ! empty($class) ? ' ' . $class : '', // %1$s
            implode('', $this->helper->getMatchesHtml($apiOddsData['data'], 10)), // %2$s
            $this->helper->getFiltersHtml($apiSportsData['data']) // %3$s
        );

        return $html;
    }
}
