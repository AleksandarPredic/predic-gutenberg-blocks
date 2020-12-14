<?php

use PredicApiBase\Contracts\ApiServiceInterface;
use PredicApiBase\Services\RapidApiService;
use PredicApiBase\Services\RemoteGetRequest;
use PredicApiBase\ValueObjects\ApiResponse;

/**
 * Test RapidApiService class
 *
 * src/Services/RapidApiService.php
 */
class RapidApiServiceTest extends WP_UnitTestCase
{
    /**
     * Test if the model implements the interface
     */
    public function testModelImplementsInterfaceTest()
    {
        $mock = $this->createMock(RemoteGetRequest::class);
        $api = new RapidApiService(
            $mock
        );

        $this->assertInstanceOf(ApiServiceInterface::class, $api);
    }

    /**
     * Test if the model has right attributes
     */
    public function testModelHaProperties()
    {
        $mock = $this->createMock(RemoteGetRequest::class);
        $api = new RapidApiService(
            $mock
        );

        $this->assertObjectHasAttribute('productionUrl', $api);
        $this->assertObjectHasAttribute('xRapidApiKey', $api);
        $this->assertObjectHasAttribute('xRapidApiHost', $api);
    }

    /**
     * Test case when API response is \WP_Error class instance
     */
    public function testApiThrowsExceptionsWhenWpErrorReturned()
    {
        $mock = $this->createMock(RemoteGetRequest::class);
        $mock->method('get')
             ->willReturn(
                 new WP_Error(
                     'message',
                     'code'
                 )
             );

        $api = new RapidApiService(
            $mock
        );

        $this->expectException(\Exception::class);

        $api->get([], 'test-endpoint');
    }

    /**
     * Test case when API response is not 200 ok
     */
    public function testApiThrowsExceptionsWhenNotStatusOk()
    {
        $mock = $this->createMock(RemoteGetRequest::class);
        $mock->method('get')
             ->willReturn(
                 [
                     'body' => '',
                     'response' => [
                         'code' => 500,
                         'message' => false,
                     ],
                 ]
             );

        $api = new RapidApiService(
            $mock
        );

        $this->expectException(\Exception::class);

        $api->get([], 'test-endpoint');
    }

    /**
     * Test case when API response is bad json response
     */
    public function testApiThrowsExceptionsBadJsonResponse()
    {
        $mock = $this->createMock(RemoteGetRequest::class);
        $mock->method('get')
             ->willReturn(
                 [
                     'body' => null,
                     'response' => [
                         'code' => 200,
                         'message' => false,
                     ],
                 ]
             );

        $api = new RapidApiService(
            $mock
        );

        $this->expectException(\Exception::class);

        $api->get([], 'test-endpoint');
    }

    /**
     * Test case when API response is valid and it need to return correct VO
     */
    public function testApiReturnsValueObject()
    {
        $mock = $this->createMock(RemoteGetRequest::class);
        $mock->method('get')
             ->willReturn(
                 [
                     'body' => '{"test":1}',
                     'response' => [
                         'code' => 200,
                         'message' => false,
                     ],
                 ]
             );

        $api = new RapidApiService(
            $mock
        );

        $this->assertInstanceOf(
            ApiResponse::class,
            $api->get([], 'test-endpoint')
        );
    }
}
