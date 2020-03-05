<?php
/**
 * MockClient class
 *
 * @package  Shaharia\NewsAggregator\Tests
 */


namespace Shaharia\NewsAggregator\Tests;


use GuzzleHttp\Psr7\Response;
use Http\Mock\Client;
use Zend\Diactoros\StreamFactory;

class MockClient
{
    public static function createClient($content = null, $statusCode = 200)
    {
        $body = (new StreamFactory())->createStream($content);
        $response = new Response($statusCode, [], $body);
        $client = new Client();
        $client->addResponse($response);
        return $client;
    }
}