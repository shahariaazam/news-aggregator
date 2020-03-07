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

    /**
     * @param $bengaliDateTime
     * @return \DateTime
     * @throws \Exception
     */
    public static function createDateTime($bengaliDateTime)
    {
        $banglaDate = $bengaliDateTime;

        $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "জানুয়ারী", "ফেব্রুয়ারী", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগষ্ট", "সেপ্টেম্বার", "অক্টোবার", "নভেম্বার", "ডিসেম্বার", ":", ",");

        $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ":", ",");

        // convert all bangle char to English char
        $en_number = str_replace($search_array, $replace_array, $banglaDate);

        // remove unwanted char
        $end_date =  preg_replace('/[^A-Za-z0-9:\-]/', ' ', $en_number);

        // convert date
        $bangla_date = date("Y-m-d H:i ", strtotime($end_date));

        return new \DateTime($bangla_date, new \DateTimeZone("Asia/Dhaka"));
    }
}
