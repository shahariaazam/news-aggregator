<?php
/**
 * Parser class
 *
 * @package  Shaharia\NewsAggregator\NewsProviders\Local\BD\ProthomAlo
 */


namespace Shaharia\NewsAggregator\NewsProvider\ProthomAlo;

use DateTime;
use Laminas\Diactoros\Uri;
use Psr\Http\Message\ResponseInterface;
use Shaharia\NewsAggregator\Entity\Headline;
use Shaharia\NewsAggregator\Entity\Image;
use Shaharia\NewsAggregator\Entity\News;
use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;
use Shaharia\NewsAggregator\Interfaces\ParserInterface;
use Shaharia\NewsAggregator\Utility\Common;
use Symfony\Component\DomCrawler\Crawler;

class ParserList implements ParserInterface
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var NewsProviderInterface
     */
    protected $newsProvider;

    /**
     * @var string|null
     */
    protected $content;

    /**
     * @var News[]|null
     */
    protected $news;

    /**
     * @var Headline[]|null
     */
    protected $headlines;

    /**
     * @inheritDoc
     */
    public function setContent(string $content): ParserInterface
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNewsProvider(NewsProviderInterface $newsProvider = null): ParserInterface
    {
        $this->newsProvider = $newsProvider;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @inheritDoc
     */
    public function getHeadlines()
    {
        $this->extractHeadlines();

        return $this->headlines;
    }

    /**
     * @inheritDoc
     */
    public function getNews()
    {
        return $this->news;
    }

    protected function extractHeadlines()
    {
        $hrefs = [];

        $dom = new Crawler($this->content);

        $dom->filter('div > .each')->each(function (Crawler $h) use ($hrefs) {
            $linkDom = $h->filter("a.link_overlay")->eq(0);
            $imgDom = $h->filter('.image img');

            $headlineTitleDom = $h->filter('.title_holder > .title')->eq(0);

            if (!in_array($linkDom->attr("href"), $hrefs)) {
                $headline = new Headline();
                $headline->setTitle($headlineTitleDom->text());
                $headline->setSourceUrl(new Uri($this->newsProvider->getUrl()));
                $headline->setUrl($this->getAbsoluteUrl($linkDom->attr("href")));

                if ($imgDom->count() > 0) {
                    $image = new Image();
                    $image->setSource($this->getAbsoluteUrl($imgDom->attr("src")));
                    $image->setAlt($imgDom->attr("alt"));
                    $image->setTitle($imgDom->attr("title"));
                    $headline->setFeaturedImage($image);
                }

                $headline->setExtractedAt(new DateTime());

                $this->headlines[] = $headline;
            }
        });

        return $this;
    }

    /**
     * @param $url
     * @return Uri
     */
    protected function getAbsoluteUrl($url)
    {
        $absoluteUrl = Common::getAbsoluteUrl($this->newsProvider->getUrl(), urldecode($url));
        return new Uri($absoluteUrl);
    }
}
