<?php
/**
 * ParserSingleNews class
 *
 * @package  Shaharia\NewsAggregator\NewsProviders\ProthomAlo
 */


namespace Shaharia\NewsAggregator\NewsProvider\ProthomAlo;

use DateTime;
use DateTimeZone;
use Exception;
use Laminas\Diactoros\Uri;
use Shaharia\NewsAggregator\Entity\Category;
use Shaharia\NewsAggregator\Entity\Headline;
use Shaharia\NewsAggregator\Entity\Image;
use Shaharia\NewsAggregator\Entity\News;
use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;
use Shaharia\NewsAggregator\Interfaces\ParserInterface;
use Shaharia\NewsAggregator\Utility\Common;
use Symfony\Component\DomCrawler\Crawler;

class ParserSingle implements ParserInterface
{
    protected $content;
    /**
     * @var NewsProviderInterface
     */
    protected $newsProvider;

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
    public function setNewsProvider(NewsProviderInterface $newsProviders): ParserInterface
    {
        $this->newsProvider = $newsProviders;
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
     * @throws Exception
     */
    public function getNews()
    {
        $dom = new Crawler($this->content);

        $news = new News();
        $title = $dom->filter("title")->eq(0)->text();

        // Summery text from meta description
        $summeryText = $dom->filter('meta[property="og:description"]')->eq(0)->attr('content');

        // News URL
        $url = $dom->filter('meta[property="og:url"]')->eq(0)->attr('content');

        // News URL
        $featuredImageUrl = $dom->filter('meta[property="og:image"]')->eq(0)->attr('content');
        $featuredImage = new Image();
        $featuredImage->setSource(new Uri($featuredImageUrl));

        // Published time
        $publishedTime = $dom->filter("span[itemprop=datePublished]")->eq(0)->text();
        $publishedAt = Common::createDateTime($publishedTime)->setTimezone(new DateTimeZone("UTC"));

        // Author
        $author = $dom->filter("span[class=author]")->eq(0)->text("");

        $categories = $dom->filter("div[class=breadcrumb] ul li")->each(function (Crawler $crawler) {
            $c = new Category();
            $c->setName($crawler->text());
        });

        $newsText = $dom->filter("div[itemprop=articleBody]")->eq(0)->outerHtml();

        $news->setTitle($title);
        $news->setSummeryText($summeryText);
        $news->setUrl(new Uri($url));
        $news->setFeaturedImage($featuredImage);
        $news->setPublishedAt($publishedAt);
        $news->setAuthor($author);
        $news->setCategories($categories);
        $news->setExtractedAt(new DateTime());
        $news->setNewsText(trim(strip_tags($newsText, '<p><br>')));

        return $news;
    }

    /**
     * @inheritDoc
     */
    public function getHeadlines()
    {
        return new Headline();
    }
}
