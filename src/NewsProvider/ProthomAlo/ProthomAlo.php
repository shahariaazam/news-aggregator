<?php
/**
 * ProthomAlo class
 *
 * @package  Shaharia\NewsAggregator\NewsProviders\Local\BD\ProthomAlo
 */


namespace Shaharia\NewsAggregator\NewsProvider\ProthomAlo;

use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;

class ProthomAlo implements NewsProviderInterface
{
    protected $name = "The Daily ProthomAlo";
    protected $description = "Most popular news paper in Bangladesh";
    protected $logo = "https://paloimages.prothom-alo.com/contents/themes/public/style/images/Prothom-Alo.png";
    protected $homepageUrl = "https://www.prothomalo.com/";
    protected $url = "https://www.prothomalo.com/";

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
        return 'bn_BD';
    }

    /**
     * @inheritDoc
     */
    public function getHomepageUrl()
    {
        return $this->homepageUrl;
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
        return $this;
    }
}
