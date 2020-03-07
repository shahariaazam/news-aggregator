<?php
/**
 * HomepageParser class
 *
 * @package  Shaharia\NewsAggregator\NewsProvider\BBC
 */


namespace Shaharia\NewsAggregator\NewsProvider\BBC;


use Laminas\Diactoros\Uri;
use Shaharia\NewsAggregator\Entity\Headline;
use Shaharia\NewsAggregator\Entity\Image;
use Shaharia\NewsAggregator\Entity\News;
use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;
use Shaharia\NewsAggregator\Interfaces\ParserInterface;
use Shaharia\NewsAggregator\Utility\Common;
use Symfony\Component\DomCrawler\Crawler;
use function Clue\StreamFilter\fun;

class HomepageParser implements ParserInterface
{

    protected $newsProvider = null;
    protected $content;

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
        $crawler = new Crawler($this->content);
        $headlines = $crawler->filter(".nw-c-promo")->each(function (Crawler $c){
           $headLine = new Headline();
           $headLine->setTitle($c->filter(".gs-c-promo-body h3")->eq(0)->text());
           $url = $c->filter(".gs-c-promo-body a")->first()->attr("href");
           $headLine->setUrl($this->getAbsoluteUrl($url));

           $totalImage = $c->filter(".gs-c-promo-image img")->count();
           if($totalImage > 0){
               try{
                   $featuredImage = new Image();
                   $featuredImage->setSource($this->getAbsoluteUrl($c->filter("img")->first()->attr("src")));
                   $headLine->setFeaturedImage($featuredImage);
               }catch (\Exception $exception){

               }
           }

           return $headLine;
        });

        return $headlines;
    }

    /**
     * @inheritDoc
     */
    public function getNews()
    {
        // TODO: Implement getNews() method.
    }

    protected function getAbsoluteUrl($url)
    {
        $absoluteUrl = Common::getAbsoluteUrl((new BBC())->getHomepageUrl(), urldecode($url));
        return new Uri($absoluteUrl);
    }
}