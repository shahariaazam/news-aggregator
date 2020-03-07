<?php
/**
 * ImageTrait class
 *
 * @package  Shaharia\NewsAggregator\Entity\Traits
 */


namespace Shaharia\NewsAggregator\Entity\Traits;

use Shaharia\NewsAggregator\Entity\Image;
use Shaharia\NewsAggregator\Entity\News;

trait ImagesTrait
{
    /**
     * @var Image[]
     */
    private $images = null;

    /**
     * @return Image[]|null
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image[] $images
     * @return ImagesTrait
     */
    public function setImages(array $images): ImagesTrait
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @param Image $image
     * @return ImagesTrait
     */
    public function addImage($image): ImagesTrait
    {
        $this->images[] = $image;
        return $this;
    }
}
