<?php

/**
 * Class SampleTest
 *
 * @package Predic_Api_Base
 */

use PredicApiBase\Data\Models\SettingsModel;
use PredicApiBase\Data\Models\SettingsModelSchema;

/**
 * Test SampleModel class
 *
 * src/Data/Models/SettingsModel.php
 */
class SettingsModelTest extends WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();

        // First get option name and set db values for the class instance
        $model = new SettingsModel();
        add_option(
            $model->getOptionName(),
            [
                'key' => 'example-api-key',
                'host' => 'example-api-host',
            ]
        );

        $this->model = new SettingsModel();
    }

    /**
     * Test if the model inherits the abstract class
     */
    public function testModelInheritAtstractClass()
    {
        $this->assertInstanceOf(SettingsModelSchema::class, $this->model);
    }

    /**
     * Test if the model has right attributes
     */
    public function testModelHaProperties()
    {
        $this->assertObjectHasAttribute('key', $this->model);
        $this->assertObjectHasAttribute('host', $this->model);
    }

    /**
     * Test that model returns correct values
     */
    public function testConstructSetsUpPropertiesCorrectly()
    {
        $model = $this->model;
        $optionName = $model->getOptionName();

        $values = get_option($optionName);
        $this->assertArrayHasKey('key', $values);
        $this->assertArrayHasKey('host', $values);

        $this->assertEquals('example-api-key', $model->getApiKey());
        $this->assertEquals('example-api-host', $model->getApiHost());
    }
}
