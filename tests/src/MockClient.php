<?php
/**
 * MockClient class
 *
 * @package  Shaharia\NewsAggregator\Tests
 */


namespace Shaharia\NewsAggregator\Tests;


use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;

class MockClient
{
    public static function createClient($content = null, $statusCode = 200)
    {
        $body = Psr17FactoryDiscovery::findStreamFactory()->createStream($content);
        $response = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse($statusCode, 'OK')
            ->withBody($body);

        $client = new Client();
        $client->addResponse($response);
        return $client;
    }
}