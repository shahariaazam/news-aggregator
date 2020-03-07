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
use Shaharia\NewsAggregator\NewsProviders\ProthomAlo\Parser;
use PHPUnit\Framework\TestCase;
use Shaharia\NewsAggregator\NewsProviders\ProthomAlo\ProthomAloHomepage;
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
        $this->parser = new Parser();
        $this->parser->setContent(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "ProthomAlo.txt"));
        $this->parser->setNewsProvider(new ProthomAloHomepage());

        parent::setUp();
    }

    public function testGetNews()
    {
        $this->parser->parse();
        $this->assertIsArray($this->parser->getNews());
    }

    public function testGetContent()
    {
        $this->assertNotEmpty($this->parser->getContent());
    }
}
