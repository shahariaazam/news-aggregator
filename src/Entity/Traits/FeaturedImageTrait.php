<?php


namespace Shaharia\NewsAggregator\Entity\Traits;

use Shaharia\NewsAggregator\Entity\Image;

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
