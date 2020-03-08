<?php
/**
 * BBC class
 *
 * @package  Shaharia\NewsAggregator\NewsProvider\BBC
 */


namespace Shaharia\NewsAggregator\NewsProvider\BBC;

use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;

class BBC implements NewsProviderInterface
{

    protected $name = "BBC";
    protected $description = null;
    protected $logo = "https://upload.wikimedia.org/wikipedia/commons/thumb/1/17/BBC_logo_new.svg/1200px-BBC_logo_new.svg.png";
    protected $url = "https://www.bbc.com/news";

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @inheritDoc
     */
    public function getPrimaryLanguage()
    {
        return "en-GB";
    }

    /**
     * @inheritDoc
     */
    public function getHomepageUrl()
    {
        return "https://www.bbc.com/";
    }

    /**
     * @inheritDoc
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }
}
