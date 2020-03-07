<?php
/**
 * Headline class
 *
 * @package  Shaharia\NewsAggregator\Entity
 */


namespace Shaharia\NewsAggregator\Entity;

use Shaharia\NewsAggregator\Entity\Traits\ExtractedAtTrait;
use Shaharia\NewsAggregator\Entity\Traits\FeaturedImageTrait;
use Shaharia\NewsAggregator\Entity\Traits\TitleTrait;
use Shaharia\NewsAggregator\Entity\Traits\UrlTrait;

class Headline
{
    use TitleTrait, FeaturedImageTrait, UrlTrait, ExtractedAtTrait;
}
