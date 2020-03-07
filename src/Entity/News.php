<?php
/**
 * News class
 *
 * @package  Shaharia\NewsAggregator\Entity
 */


namespace Shaharia\NewsAggregator\Entity;

use DateTime;
use Shaharia\NewsAggregator\Entity\Traits\ExtractedAtTrait;
use Shaharia\NewsAggregator\Entity\Traits\FeaturedImageTrait;
use Shaharia\NewsAggregator\Entity\Traits\ImagesTrait;
use Shaharia\NewsAggregator\Entity\Traits\TitleTrait;
use Shaharia\NewsAggregator\Entity\Traits\UrlTrait;

class News
{

    use TitleTrait, ImagesTrait, UrlTrait, FeaturedImageTrait, ExtractedAtTrait;

    /**
     * @var string|null
     */
    private $summeryText = null;

    /**
     * @var string|null
     */
    private $newsText = null;

    /**
     * @var DateTime
     */
    private $publishedAt = null;

    /**
     * @var string|null
     */
    private $author = null;

    /**
     * @var Category[]
     */
    private $categories = null;

    /**
     * @var Tag[]
     */
    private $tags = null;

    /**
     * @var DateTime
     */
    private $modifiedAt = null;

    /**
     * @return string|null
     */
    public function getSummeryText(): ?string
    {
        return $this->summeryText;
    }

    /**
     * @param string|null $summeryText
     * @return News
     */
    public function setSummeryText(?string $summeryText): News
    {
        $this->summeryText = $summeryText;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNewsText(): ?string
    {
        return $this->newsText;
    }

    /**
     * @param string|null $newsText
     * @return News
     */
    public function setNewsText(?string $newsText): News
    {
        $this->newsText = $newsText;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param DateTime $publishedAt
     * @return News
     */
    public function setPublishedAt(DateTime $publishedAt): News
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     * @return News
     */
    public function setAuthor(?string $author): News
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Category[]|null
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category[] $categories
     * @return News
     */
    public function setCategories(array $categories): News
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return Tag[]|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     * @return News
     */
    public function setTags(array $tags): News
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @param DateTime $modifiedAt
     * @return News
     */
    public function setModifiedAt(DateTime $modifiedAt): News
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExtractedAt(): DateTime
    {
        return $this->extractedAt;
    }

    /**
     * @param DateTime $extractedAt
     * @return News
     */
    public function setExtractedAt(DateTime $extractedAt): News
    {
        $this->extractedAt = $extractedAt;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'source_url' => (string) $this->getSourceUrl(),
            'url' => (string) $this->getUrl(),
            'title' => $this->getTitle(),
            'summery_text' => $this->getSummeryText(),
            'featured_image' => $this->getFeaturedImage() ? $this->getFeaturedImage()->toArray() : null,
            'images' => $this->getImages() ? array_map(function (Image $image) {
                return $image->toArray();
            }, $this->getImages()) : null,
            'news_text' => $this->getNewsText(),
            'published_at' => $this->getPublishedAt() ? $this->getPublishedAt()->format("Y-m-d H:i:s") : null,
            'author' => $this->getAuthor(),
            'categories' => $this->getCategories() ? array_map(function (Category $tag) {
                return $tag->toArray();
            }, $this->getCategories()) : null,
            'tags' => $this->getTags() ? array_map(function (Tag $tag) {
                return $tag->toArray();
            }, $this->getTags()) : null,
            'modified_at' => $this->getModifiedAt() ? $this->getModifiedAt()->format("Y-m-d H:i:s") : null,
            'extracted_at' => $this->getExtractedAt() ? $this->getExtractedAt()->format("Y-m-d H:i:s") : null
        ];
    }
}
