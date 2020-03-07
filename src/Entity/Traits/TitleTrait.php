<?php


namespace Shaharia\NewsAggregator\Entity\Traits;

trait TitleTrait
{
    /**
     * @var null|string
     */
    protected $title = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return TitleTrait
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
        return $this;
    }
}
