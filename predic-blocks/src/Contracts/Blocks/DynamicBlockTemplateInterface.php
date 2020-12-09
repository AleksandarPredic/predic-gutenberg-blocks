<?php

namespace PredicBlocks\Contracts\Blocks;

/**
 * Interface DynamicBlockTemplateInterface for the PHP block templates
 * @package PredicBlocks\Contracts\Blocks
 */
interface DynamicBlockTemplateInterface
{

    /**
     * Register the dynamic block.
     *
     * @since 1.0.0
     *
     */
    public function registerDynamicBlock();

    /**
     * Server rendering for block template
     *
     * @param array
     *
     * @return string
     */
    public function renderDynamicBlock($attributes);
}
