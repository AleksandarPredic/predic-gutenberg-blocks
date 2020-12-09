<?php

namespace PredicBlocks\Scripts;

use PredicBlocks\Traits\SingletonTrait;

/**
 * Class ScriptsGutenberg
 * @package PredicBlocks\Scripts
 */
class ScriptsGutenberg
{
    use SingletonTrait;

    private const PLUGIN_URL = PREDIC_BLOCKS_URL;
    private const PLUGIN_DIR = PREDIC_BLOCKS_DIR;

    /**
     * PredicBlocks constructor.
     */
    private function __construct()
    {
        add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorAssets']);
        add_action('enqueue_block_assets', [$this, 'enqueueAssets']);
        add_action('enqueue_block_assets', [$this, 'enqueueFrontendAssets']);
    }

    /**
     * Enqueue block editor only JavaScript and CSS.
     */
    public function enqueueBlockEditorAssets()
    {
        // Make paths variables so we don't write em twice ;)
        $block_path = '/assets/js/editor.blocks.js';
        $style_path = '/assets/css/blocks.editor.css';

        // Enqueue the bundled block JS file
        wp_enqueue_script(
            'predic-blocks-js',
            self::PLUGIN_URL . $block_path,
            [ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor' ],
            filemtime(self::PLUGIN_DIR . $block_path)
        );

        // Enqueue optional editor only styles
        wp_enqueue_style(
            'predic-blocks-editor-css',
            self::PLUGIN_URL . $style_path,
            [ ],
            filemtime(self::PLUGIN_DIR . $style_path)
        );
    }

    /**
     * Enqueue front end and editor JavaScript and CSS assets.
     */
    public function enqueueAssets()
    {
        $style_path = '/assets/css/blocks.style.css';
        wp_enqueue_style(
            'predic-blocks',
            self::PLUGIN_URL . $style_path,
            null,
            filemtime(self::PLUGIN_DIR . $style_path)
        );
    }

    /**
     * Enqueue frontend JavaScript and CSS assets.
     */
    public function enqueueFrontendAssets()
    {
        // If in the backend, bail out.
        if (is_admin()) {
            return;
        }

        $block_path = '/assets/js/frontend.blocks.js';
        wp_enqueue_script(
            'predic-blocks-frontend',
            self::PLUGIN_URL . $block_path,
            [],
            filemtime(self::PLUGIN_DIR . $block_path)
        );
    }
}
