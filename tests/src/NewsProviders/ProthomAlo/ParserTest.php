<?php

namespace Shaharia\NewsAggregator\Tests\NewsProviders\ProthomAlo;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use http\Message\Body;
use Http\Mock\Client;
use Shaharia\NewsAggregator\Aggregator;
use Shaharia\NewsAggregator\Interfaces\NewsProvidersInterface;
use Shaharia\NewsAggregator\Interfaces\ParserInterface;
use Shaharia\NewsAggregator\NewsProviders\ProthomAlo\ParserList;
use PHPUnit\Framework\TestCase;
use Shaharia\NewsAggregator\NewsProviders\ProthomAlo\ParserSingle;
use Shaharia\NewsAggregator\NewsProviders\ProthomAlo\ProthomAlo;
use Shaharia\NewsAggregator\Tests\MockClient;
use Zend\Diactoros\StreamFactory;

class ParserTest extends TestCase
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @var NewsProvidersInterface
     */
    private $newsProvider;

    public function setUp(): void
    {
        $this->parser = new ParserList();
        $this->parser->setContent(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "ProthomAlo.txt"));
        $this->parser->setNewsProvider(new ProthomAlo());

        parent::setUp();
    }

    public function testGetHeadlines()
    {
        $this->assertIsArray($this->parser->getHeadlines());
    }

    public function testGetNews()
    {
        $this->parser = new ParserSingle();
        $this->parser->setContent(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "ProthomAloNewsDetails.txt"));
        $this->parser->setNewsProvider(new ProthomAlo());

        $this->assertIsObject($this->parser->getNews());
    }

    public function testGetContent()
    {
        $this->assertNotEmpty($this->parser->getContent());
    }
}
