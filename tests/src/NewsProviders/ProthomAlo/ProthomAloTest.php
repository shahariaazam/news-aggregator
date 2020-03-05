<?php

namespace NewsProviders\ProthomAlo;

use PHPUnit\Framework\TestCase;
use Shaharia\NewsAggregator\Interfaces\NewsProvidersInterface;
use Shaharia\NewsAggregator\NewsProviders\ProthomAlo\ProthomAlo;

class ProthomAloTest extends TestCase
{
    /**
     * @var NewsProvidersInterface
     */
    protected $palo;

    public function setUp(): void
    {
        $this->palo = new ProthomAlo();
        parent::setUp();
    }

    public function testGetDescription()
    {
        $this->assertNotEmpty($this->palo->getDescription());
    }

    public function testGetLogo()
    {
        $this->assertNotEmpty($this->palo->getLogo());
    }

    public function testGetUrl()
    {
        $this->assertNotEmpty($this->palo->getUrl());
    }

    public function testGetParserClass()
    {
        $this->assertTrue(class_exists($this->palo->getParserClass()));
    }

    public function testGetPrimaryLanguage()
    {
        $this->assertNotEmpty($this->palo->getPrimaryLanguage());
    }

    public function testGetName()
    {
        $this->assertNotEmpty($this->palo->getName());
    }
}
