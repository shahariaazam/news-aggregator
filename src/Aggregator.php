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
    public function makeRequest()
    {
        return $this->httpClient->sendRequest(
            $this->messageFactory->createRequest('GET', $this->provider->getUrl())
        );
    }

    /**
     * @return Entity\News[]|null
     * @throws ClientExceptionInterface
     */
    public function getNews()
    {
        $parserClass = $this->provider->getParserClass();

        $response = $this->makeRequest();

        /**
         * @var $parser ParserInterface
         */
        $parser = new $parserClass();
        $parser->setContent($response->getBody()->getContents());
        $parser->setNewsProvider($this->provider);
        $parser->parse();
        return $parser->getNews();
    }
}
