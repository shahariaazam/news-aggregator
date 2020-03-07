<?php


namespace Shaharia\NewsAggregator\Interfaces;

use Psr\Http\Message\ResponseInterface;
use Shaharia\NewsAggregator\Entity\News;

interface ParserInterface
{
    /**
     * @param string $content
     * @return ParserInterface
     */
    public function setContent(string $content): ParserInterface;

    /**
     * @param NewsProvidersInterface $response
     * @return ParserInterface
     */
    public function setNewsProvider(NewsProvidersInterface $response): ParserInterface;

    /**
     * @return string|null
     */
    public function getContent();

    /**
     * @return ParserInterface
     */
    public function parse();

    /**
     * @return News[]|null
     */
    public function getNews();
}
