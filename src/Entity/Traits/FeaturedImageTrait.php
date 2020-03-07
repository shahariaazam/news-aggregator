<?php


namespace Shaharia\NewsAggregator\Entity\Traits;

use Shaharia\NewsAggregator\Entity\Image;
use Shaharia\NewsAggregator\Entity\News;

trait FeaturedImageTrait
{
    /**
     * @var Image
     */
    private $featuredImage = null;



    /**
     * @return Image|null
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * @param Image $featuredImage|null
     * @return FeaturedImageTrait
     */
    public function setFeaturedImage(Image $featuredImage)
    {
        $this->featuredImage = $featuredImage;
        return $this;
    }
}
