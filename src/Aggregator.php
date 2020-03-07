<?php
/**
 * Aggregator class
 *
 * @package  Shaharia\NewsAggregator
 */


namespace Shaharia\NewsAggregator;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Shaharia\NewsAggregator\Interfaces\NewsProvidersInterface;
use Shaharia\NewsAggregator\Interfaces\ParserInterface;

class Aggregator
{
    /**
     * @var NewsProvidersInterface
     */
    protected $provider;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * Aggregator constructor.
     * @param NewsProvidersInterface $newsProviders
     */
    public function __construct(NewsProvidersInterface $newsProviders)
    {
        $this->provider = $newsProviders;
        $this->httpClient = HttpClientDiscovery::find();
        $this->messageFactory = MessageFactoryDiscovery::find();
    }

    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    /**
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function makeRequest($url)
    {
        return $this->httpClient->sendRequest(
            $this->messageFactory->createRequest('GET', $url)
        );
    }

    /**
     * @param ParserInterface|null $parser
     * @return Entity\Headline[]
     * @throws ClientExceptionInterface
     */
    public function getHeadlines(ParserInterface $parser = null)
    {
        if (!$parser) {
            $parserClass = $this->provider->getListParser();
            $parser = new $parserClass();
        }

        $response = $this->makeRequest($this->provider->getUrl());

        /**
         * @var $parser ParserInterface
         */
        $parser->setContent($response->getBody()->getContents());
        $parser->setNewsProvider($this->provider);
        return $parser->getHeadlines();
    }

    /**
     * @param UriInterface $url
     * @param ParserInterface|null $parser
     * @return Entity\News[]|null
     * @throws ClientExceptionInterface
     */
    public function getNews(UriInterface $url, ParserInterface $parser = null)
    {
        if (!$parser) {
            $parser = $this->provider->getDetailsParser();
            /**
             * @var $parser ParserInterface
             */
            $parser = new $parser();
        }

        $response = $this->makeRequest($url);
        $parser->setContent($response->getBody()->getContents());
        $parser->setNewsProvider($this->provider);
        return $parser->getNews();
    }
}
