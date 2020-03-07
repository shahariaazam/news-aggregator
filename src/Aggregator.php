<?php
/**
 * Aggregator class
 *
 * @package  Shaharia\NewsAggregator
 */


namespace Shaharia\NewsAggregator;

use Http\Client\Common\Plugin\CachePlugin;
use Http\Client\Common\Plugin\HeaderSetPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\MessageFactory;
use Http\Message\RequestFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;
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
     * @var array
     */
    protected $httpClientHeaders = [];

    /**
     * @var MessageFactory
     */
    protected $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    protected $streamFactory;

    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Aggregator constructor.
     * @param NewsProvidersInterface $newsProviders
     */
    public function __construct(NewsProvidersInterface $newsProviders)
    {
        $this->provider = $newsProviders;
        $this->httpClient = HttpClientDiscovery::find();
        $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
    }

    /**
     * @param HttpClient $httpClient
     * @return Aggregator
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @param array $headers
     * @return Aggregator
     */
    public function addHttpClientHeaders(array $headers)
    {
        $this->httpClientHeaders = array_merge($headers, $this->httpClientHeaders);
        return $this;
    }

    /**
     * @param RequestFactoryInterface $requestFactory
     * @return Aggregator
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    /**
     * @param StreamFactoryInterface $streamFactory
     * @return Aggregator
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory)
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    /**
     * @param CacheItemPoolInterface $pool
     * @return Aggregator
     */
    public function setCache(CacheItemPoolInterface $pool)
    {
        $this->cache = $pool;
        return $this;
    }

    /**
     * @param LoggerInterface $logger
     * @return Aggregator
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param $url
     * @param string $method
     * @param array $headers
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function makeRequest($url, $method = "GET", array $headers = [])
    {
        $this->addHttpClientHeaders($headers);

        $httpClientPlugins = [
            new HeaderSetPlugin($this->httpClientHeaders)
        ];

        if ($this->cache instanceof CacheItemPoolInterface) {
            $httpClientPlugins[] = new CachePlugin($this->cache, $this->streamFactory, []);
        }

        if ($this->logger instanceof LoggerInterface) {
            $httpClientPlugins[] = new LoggerPlugin($this->logger);
        }

        $pluginClient = new PluginClient(
            $this->httpClient,
            $httpClientPlugins
        );

        return $pluginClient->sendRequest(
            $this->requestFactory->createRequest($method, $url)
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
     * @return Entity\News
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
