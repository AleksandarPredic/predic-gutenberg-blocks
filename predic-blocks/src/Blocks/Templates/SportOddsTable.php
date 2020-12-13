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

        return 'sports odds table.'
            . '<br>REST odds success: ' . intval(isset($apiOddsData['success']))
            . '<br>REST sports success: ' . intval(isset($apiSportsData['success']));
    }
}
