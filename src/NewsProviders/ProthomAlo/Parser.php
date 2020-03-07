<?php
/**
 * Parser class
 *
 * @package  Shaharia\NewsAggregator\NewsProviders\Local\BD\ProthomAlo
 */


namespace Shaharia\NewsAggregator\NewsProviders\ProthomAlo;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Shaharia\NewsAggregator\Entity\Image;
use Shaharia\NewsAggregator\Entity\News;
use Shaharia\NewsAggregator\Interfaces\NewsProvidersInterface;
use Shaharia\NewsAggregator\Interfaces\ParserInterface;
use Shaharia\NewsAggregator\Utility\Common;
use Symfony\Component\DomCrawler\Crawler;

class Parser implements ParserInterface
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var NewsProvidersInterface
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
    public function setNewsProvider(NewsProvidersInterface $newsProviders): ParserInterface
    {
        $this->newsProvider = $newsProviders;
        return $this;
    }

    /**
     * @return $this|ParserInterface
     */
    public function parse()
    {
        $this->extractNewsLists();
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
    public function getNews()
    {
        return $this->news;
    }

    protected function extractNewsLists()
    {
        $dom = new Crawler($this->content);

        $dom->filter('div > .each')->each(function (Crawler $h) {
            $linkDom = $h->filter("a.link_overlay")->eq(0);
            $imgDom = $h->filter('.image img');

            $headlineTitleDom = $h->filter('.title_holder > .title')->eq(0);

            $news = new News();
            $news->setTitle($headlineTitleDom->text());
            $news->setSourceUrl(new Uri($this->newsProvider->getUrl()));
            $news->setUrl($this->getAbsoluteUrl($linkDom->attr("href")));

            if ($imgDom->count() > 0) {
                $image = new Image();
                $image->setSource($this->getAbsoluteUrl($imgDom->attr("src")));
                $image->setAlt($imgDom->attr("alt"));
                $image->setTitle($imgDom->attr("title"));

                $news->addImage($image);
                $news->setFeaturedImage($image);
            }

            $news->setExtractedAt(new \DateTime());

            $this->news[] = $news;
        });

        return $this;
    }

    /**
     * @param $url
     * @return Uri
     */
    protected function getAbsoluteUrl($url)
    {
        $aurl = Common::getAbsoluteUrl($this->newsProvider->getUrl(), urldecode($url));
        return new Uri($aurl);
    }
}
