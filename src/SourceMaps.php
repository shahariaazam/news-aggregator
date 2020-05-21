<?php
/**
 * SourceMaps class
 *
 * @package  ShahariaAzam\NewsAggregator\Cli
 */


namespace Shaharia\NewsAggregator;

use Shaharia\NewsAggregator\Interfaces\NewsProviderInterface;
use Shaharia\NewsAggregator\NewsProvider\BBC\BBC;
use Shaharia\NewsAggregator\NewsProvider\BBC\HomepageParser;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\NorthAmericaCategory;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserList;
use Shaharia\NewsAggregator\NewsProvider\ProthomAlo\ParserSingle;

class SourceMaps
{
    const PARSE_TYPE_HEADLINE = "headline";
    const PARSE_TYPE_DETAILS = "details";

    /**
     * @var array
     */
    private $lists;

    public function __construct()
    {
        $this->lists = $this->getMappings();
    }

    public function getLists()
    {
        return $this->lists;
    }

    private function getMappings()
    {
        return [
            [
                'provider_slug' => 'prothomalo-nortamerica-category',
                'provider_class' => NorthAmericaCategory::class,
                'provider_parser' => ParserList::class,
                'parse_type' => self::PARSE_TYPE_HEADLINE
            ],[
                'provider_slug' => 'prothomalo-nortamerica-category',
                'provider_class' => NorthAmericaCategory::class,
                'provider_parser' => ParserSingle::class,
                'parse_type' => self::PARSE_TYPE_DETAILS
            ],[
                'provider_slug' => 'bbc-home',
                'provider_class' => BBC::class,
                'provider_parser' => HomepageParser::class,
                'parse_type' => self::PARSE_TYPE_HEADLINE
            ]
        ];
    }

    /**
     * @param $slug
     * @return array
     */
    public function getNewsTypesBySlug($slug)
    {

        $sources = array_filter($this->lists, function ($source) use ($slug) {
            return $slug === $source['provider_slug'];
        });

        $types = array_map(function ($s) {
            return $s['parse_type'];
        }, $sources);

        return array_unique($types);
    }

    /**
     * @param $slug
     * @return array|\string[]
     */
    public function getHeadLineProviderBySlug($slug)
    {

        $pr = array_filter($this->lists, function ($source) use ($slug) {
            return $slug === $source['provider_slug'] && $source['parse_type'] === self::PARSE_TYPE_HEADLINE;
        });

        if (count($pr) < 1) {
            return null;
        }

        return array_values($pr)[0];
    }

    /**
     * @param $slug
     * @return NewsProviderInterface|null
     */
    public function getProviderBySlug($slug)
    {

        $sources = array_filter($this->lists, function ($source) use ($slug) {
            return $slug === $source['provider_slug'];
        });

        if (count($sources) < 1) {
            return null;
        }

        /**
         * @var $provider NewsProviderInterface
         */
        $provider = new $sources[0]['provider_class'];
        return $provider;
    }
}
