<?php
/**
 * Common class
 *
 * @package  Shaharia\NewsAggregator\Utility
 */


namespace Shaharia\NewsAggregator\Utility;

class Common
{
    /**
     * @param $url
     * @param $href
     * @return string|null
     */
    public static function getAbsoluteUrl($url, $href)
    {
        try {
            $base = new \Net_URL2($url);
            return $base->resolve($href)->getNormalizedURL();
        } catch (\Exception $e) {
            return null;
        }
    }
}
