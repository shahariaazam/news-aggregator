<?php

namespace NewsProviders\ProthomAlo;

use PHPUnit\Framework\TestCase;
use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ProthomAlo;

class ProthomAloHomepageTest extends TestCase
{
    /**
     * @var NewsProviderInterface
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

    public function testGetPrimaryLanguage()
    {
        $this->assertNotEmpty($this->palo->getPrimaryLanguage());
    }

    public function testGetName()
    {
        $this->assertNotEmpty($this->palo->getName());
    }
}
