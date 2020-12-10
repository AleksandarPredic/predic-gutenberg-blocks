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

        $apiData = apply_filters('predic_api_base_get_odds', 'uk', 'soccer_epl', 'h2h');

        if (is_wp_error($apiData)) {
            $this->logger->log(
                $apiData->get_error_message(),
                $apiData->get_error_code()
            );
            // TODO: What to do in case of error.
        }

        return 'sports odds table. REST success: ' . intval(isset($apiData['success']));
    }
}
