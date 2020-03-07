<?php

namespace Shaharia\NewsAggregator\Tests\NewsProvider\ProthomAlo;

use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;
use Shaharia\NewsAggregator\Interfaces\ParserInterface;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserList;
use PHPUnit\Framework\TestCase;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserSingle;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ProthomAlo;

class ParserTest extends TestCase
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @var NewsProviderInterface
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
