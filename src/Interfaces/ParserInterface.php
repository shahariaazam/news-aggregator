<?php


namespace Shaharia\NewsAggregator\Interfaces;

use Psr\Http\Message\ResponseInterface;
use Shaharia\NewsAggregator\Entity\Headline;
use Shaharia\NewsAggregator\Entity\News;

interface ParserInterface
{
    /**
     * @param string $content
     * @return ParserInterface
     */
    public function setContent(string $content): ParserInterface;

    /**
     * @param NewsProvidersInterface $newsProviders
     * @return ParserInterface
     */
    public function setNewsProvider(NewsProvidersInterface $newsProviders): ParserInterface;

    /**
     * @return string|null
     */
    public function getContent();

    /**
     * @return Headline[]|null
     */
    public function getHeadlines();

    /**
     * @return News|null
     */
    public function getNews();
}
