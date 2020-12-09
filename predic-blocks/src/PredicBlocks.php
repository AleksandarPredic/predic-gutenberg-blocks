<?php

namespace PredicBlocks;

use PredicBlocks\Scripts\ScriptsGutenberg;
use PredicBlocks\Traits\SingletonTrait;

class PredicBlocks
{
    use SingletonTrait;

    private const PLUGIN_DIR = PREDIC_BLOCKS_DIR;

    /**
     * PredicBlocks constructor.
     */
    private function __construct()
    {
    }

    /**
     * Set plugin required functionality
     */
    public function setInstances()
    {
        // Load scripts
        ScriptsGutenberg::getInstance();

        // Dynamic Blocks PHP templates
        add_action('init', [$this, 'blocksDynamicFiles']);
    }

    /**
     * Auto detect and inlude all block dynamic files.
     * For the dynamic block we follow the convention to have a index.php in the block folder
     */
    public function blocksDynamicFiles()
    {
        $files = glob(self::PLUGIN_DIR . '/blocks/**/index.php');
        if (! is_array($files) || empty($files)) {
            return;
        }

        foreach ($files as $file) {
            include $file;
        }
    }
}
