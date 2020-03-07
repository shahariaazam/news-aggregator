<?php
/**
 * AggregatorTest class
 *
 * @package  Shaharia\NewsAggregator\Tests
 */


namespace Shaharia\NewsAggregator\Tests;


use Http\Discovery\Psr17FactoryDiscovery;
use Laminas\Diactoros\Uri;
use Monolog\Handler\NullHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Shaharia\NewsAggregator\Aggregator;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserList;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserSingle;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ProthomAlo;
use Symfony\Component\Cache\Adapter\NullAdapter;

class AggregatorTest extends TestCase
{
    public function testAggregatorConstruct()
    {
        $aggregator = new Aggregator();
        $this->assertTrue(method_exists($aggregator, "init"));
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testAggregatorCanMakeHttpRequest()
    {
        $aggregator = new Aggregator();
        $mockClient = MockClient::createClient("Hello World");

        $aggregator->setHttpClient($mockClient);
        $aggregator->setRequestFactory(Psr17FactoryDiscovery::findRequestFactory());
        $aggregator->setStreamFactory(Psr17FactoryDiscovery::findStreamFactory());
        $aggregator->setCache(new NullAdapter());
        $aggregator->setLogger((new Logger("NULL"))->pushHandler(new NullHandler()));

        $response = $aggregator->makeRequest("http://localhost", "GET");

        $this->assertEquals("Hello World", $response->getBody()->getContents());
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetHeadlines()
    {
        $aggregator = new Aggregator();
        $mockClient = MockClient::createClient("Hello World");
        $aggregator->setHttpClient($mockClient);
        $this->assertNull($aggregator->getHeadlines(ProthomAlo::class, ParserList::class));
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetHeadlinesInBatches()
    {
        $aggregator = new Aggregator();
        $mockClient = MockClient::createClient("Hello World");
        $aggregator->setHttpClient($mockClient);
        $this->assertEmpty($aggregator->getHeadlinesInBatches([
            ProthomAlo::class => ParserList::class
        ]));
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function testGetNews()
    {
        $aggregator = new Aggregator();
        $mockClient = MockClient::createClient("Hello World");
        $aggregator->setHttpClient($mockClient);
        $this->assertEmpty($aggregator->getNews(new Uri("http://localhost"), ParserSingle::class));
    }
}