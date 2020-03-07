<?php
/**
 * Image class
 *
 * @package  Shaharia\NewsAggregator\Entity
 */


namespace Shaharia\NewsAggregator\Entity;

use Psr\Http\Message\UriInterface;

class Image
{
    protected $source;
    protected $caption;
    protected $width;
    protected $height;
    protected $title;
    protected $alt;

    /**
     * @return UriInterface
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param UriInterface $source
     *
     * @return Image
     */
    public function setSource(UriInterface $source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param mixed $caption
     *
     * @return Image
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     *
     * @return Image
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     *
     * @return Image
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return Image
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @param mixed $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
        return $this;
    }

    public function toArray()
    {
        return [
            'src' => (string) $this->getSource(),
            'caption' => $this->getCaption(),
            'width' => $this->getWidth() ? intval($this->getWidth()) : null,
            'height' => $this->getHeight() ? intval($this->getHeight()) : null,
            'title' => $this->getTitle(),
            'alt' => $this->getAlt()
        ];
    }
}
