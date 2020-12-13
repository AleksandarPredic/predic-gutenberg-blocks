<?php

namespace PredicBlocks\Contracts\Blocks;

/**
 * Interface DynamicBlockAjaxTemplateInterface
 * @package PredicBlocks\Contracts\Blocks
 */
interface DynamicBlockAjaxTemplateInterface
{
    /**
     * Init ajax hooks and localize scripts
     */
    public function initAjaxHooks();

    /**
     * Handle ajax requests
     *
     * return void
     */
    public function ajaxRender();

    /**
     * Localize scripts
     */
    public function scripts();
}
