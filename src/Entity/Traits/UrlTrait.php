<?php
/**
 * UrlTrait class
 *
 * @package  Shaharia\NewsAggregator\Entity\Traits
 */


namespace Shaharia\NewsAggregator\Entity\Traits;

use Psr\Http\Message\UriInterface;

trait UrlTrait
{
    /**
     * @var UriInterface
     */
    private $sourceUrl = null;

    /**
     * @var UriInterface
     */
    private $url = null;

    /**
     * @return UriInterface
     */
    public function getSourceUrl(): UriInterface
    {
        return $this->sourceUrl;
    }

    /**
     * @param UriInterface $sourceUrl
     * @return UrlTrait
     */
    public function setSourceUrl(UriInterface $sourceUrl)
    {
        $this->sourceUrl = $sourceUrl;
        return $this;
    }

    /**
     * @return UriInterface
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param UriInterface $url
     * @return UrlTrait
     */
    public function setUrl(UriInterface $url)
    {
        $this->url = $url;
        return $this;
    }
}
