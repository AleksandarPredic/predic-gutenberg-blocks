<?php

namespace PredicBlocks\Blocks\Templates;

use PredicBlocks\Contracts\Blocks\DynamicBlockTemplateInterface;
use PredicBlocks\Traits\SingletonTrait;

/**
 * Class SportOddsTable
 *
 * Server rendering for /blocks/examples/sports-odds-table
 *
 * @package PredicBlocks\Blocks\Templates
 */
class BetCalculator implements DynamicBlockTemplateInterface
{
    use SingletonTrait;

    /**
     * PredicBlocks constructor.
     */
    private function __construct()
    {
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
            'predicblocks/bet-calculator',
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

        $oddsFormat = [
          'american' => esc_html__('American', 'predic-blocks'),
          'fractal' => esc_html__('Fractal', 'predic-blocks'),
          'Decimal' => esc_html__('Decimal', 'predic-blocks'),
        ];

        $options = [];
        foreach ($oddsFormat as $value => $name) {
            $options[] = sprintf(
                '<option value="%s">%s</option>',
                $value,
                $name
            );
        }

        $html = sprintf(
        '<section class="prblocks-bet-calc%12$s" data-messages="%13$s">
                <header>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5.97 4.06L14.1 6l1.4 1.4L16.9 6l1.06 1.06-1.4 1.4 1.4 1.4-1.06 1.06-1.4-1.4-1.4 1.4-1.06-1.06 1.4-1.4-1.4-1.42zm-6.78.66h5v1.5h-5v-1.5zM11.5 16h-2v2H8v-2H6v-1.5h2v-2h1.5v2h2V16zm6.5 1.25h-5v-1.5h5v1.5zm0-2.5h-5v-1.5h5v1.5z"/></svg>
                    <h4>%1$s</h4>
                </header>
                <div class="prblocks-bet-calc__content">
                    <div class="prblocks-bet-calc__odds-format">
                        <label>%2$s</label>
                        <select>
                            %3$s
                        </select>
                    </div>
                    <div class="prblocks-bet-calc__odds-form">
                        <div class="prblocks-bet-calc__odds-form-msg"></div>
                        <div class="prblocks-bet-calc__odds-form-groups-wrapper">
                            <div class="prblocks-bet-calc__odds-form-group">
                                <div class="prblocks-bet-calc__odds-form-field">
                                    <label class="prblocks-bet-calc__odds-form-label-stake">%4$s</label>
                                    <input type="text" placeholder="%5$s" class="prblocks-bet-calc__odds-form-stake">
                                </div>
                                <div class="prblocks-bet-calc__odds-form-field">
                                    <label class="prblocks-bet-calc__odds-form-label-odd">%6$s</label>
                                    <input type="text" placeholder="%7$s" class="prblocks-bet-calc__odds-form-odd">
                                </div>
                            </div>
                        </div>
                        <div class="prblocks-bet-calc__odds-form-buttons">
                            <div class="prblocks-bet-calc__odds-form-field">
                                <button type="button" class="prblocks-bet-calc__odds-form-add">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
                                    %8$s
                                </button>
                            </div>
                            <div class="prblocks-bet-calc__odds-form-field">
                                <button type="button" class="prblocks-bet-calc__odds-form-clear">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px""><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11H7v-2h10v2z"/></svg>
                                    %9$s
                                </button>
                            </div>
                        </div>
                        <div class="prblocks-bet-calc__odds-form-result">
                            <span>%10$s</span>
                            <div><span class="prblocks-bet-calc__odds-form-currency">%11$s</span><span class="prblocks-bet-calc__odds-form-payout">0.00</span></div>
                        </div>
                    </div>
                </div>
            </section>',
            esc_html__(
                'Enter the Stake and Odds for your bet and the Bet Calculator will automatically calculate the Payout. Add odds for Multiples.',
                'predic-blocks'
            ), // %1$s
            esc_html__('Selected Odds Format', 'predic-blocks'), // %2$s
            implode('', $options), // %3$s
            esc_html__('Stake', 'predic-blocks'), // %4$s
            esc_html__('Enter stake', 'predic-blocks'), // %5$s
            esc_html__('Odds', 'predic-blocks'), // %6$s
            esc_html__('Enter odds', 'predic-blocks'), // %7$s
            esc_html__('Add odds', 'predic-blocks'), // %8$s
            esc_html__('Clear', 'predic-blocks'), // %9$s
            esc_html__('Payout', 'predic-blocks'), // %10$s
            apply_filters('predicblocks/bet-calculator_currency_sign', '$'), // %11$s
            ! empty($class) ? ' ' . $class : '', // %12$s
            esc_js(
                wp_json_encode(
                    [
                        'stake' => esc_html__('Incorrect or empty stake value!', 'predic-blocks'),
                        'odd' => esc_html__('Incorrect or empty odd value!', 'predic-blocks'),
                    ]
                )
            )//%13$s
        );

        // Add recent bets table
        $html .= sprintf(
            '<section class="prblocks-bet-calc-bets">
                <header>
                    <h4>%1$s</h4>
                </header>
                <div class="prblocks-bet-calc-bets__table">
                    <div></div>
                </div>
            </section>',
            esc_html__('Recent bets', 'predic-blocks') // %1$s
        );

        return $html;
    }
}
