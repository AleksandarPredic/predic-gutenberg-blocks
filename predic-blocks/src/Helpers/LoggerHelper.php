<?php

namespace PredicBlocks\Helpers;

use PredicBlocks\Contracts\LoggerInterface;

/**
 * Class LoggerHelper
 * @package PredicBlocks\Helpers
 */
class LoggerHelper implements LoggerInterface
{
    /**
     * If WP_DEBUG_LOG enabled
     * @var bool
     */
    private $debugLog;

    /**
     * LoggerHelper constructor.
     */
    public function __construct()
    {
        $this->debugLog = PREDIC_BLOCKS_DEBUG_LOG_ON;
    }

    /**
     * @inheritDoc
     */
    public function log($message, $code)
    {
        if (! $this->debugLog) {
            return;
        }

        error_log(
            sprintf(
                'Message: %s. Code: %s.',
                $message,
                $code
            )
        );
    }
}
