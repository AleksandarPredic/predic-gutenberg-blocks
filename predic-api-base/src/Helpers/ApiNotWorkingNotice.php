<?php

namespace PredicApiBase\Helpers;

use PredicApiBase\Data\Models\SettingsModel;

/**
 * Class ApiNotWorkingNotice
 */
class ApiNotWorkingNotice
{
    /**
     * Display admin notice if the settings are not filled
     */
    public function show()
    {
        $model = SettingsModel::getInstance();
        $apiKey = $model->getApiKey();
        $apiHost = $model->getApiHost();

        if (! empty($apiKey) && ! empty($apiHost)) {
            return;
        }

        add_action('admin_notices', function () {
            printf(
                '<div class="notice notice-warning"><p>%s</p><p><strong>%s</strong></p></div>',
                esc_html__('API settings empty. The Gutenberg blocks will not work.', 'predic-api-base'),
                esc_html__('Visit admin Settings -> Predic API settings page to finish setup', 'predic-api-base')
            );
        });
    }
}
