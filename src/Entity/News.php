<?php
/**
 * News class
 *
 * @package  Shaharia\NewsAggregator\Entity
 */


namespace Shaharia\NewsAggregator\Entity;

use Psr\Http\Message\UriInterface;
use Shaharia\NewsAggregator\Utility\Common;

class News
{

    /**
     * @var UriInterface
     */
    private $sourceUrl = null;

    /**
     * @var UriInterface
     */
    private $url = null;

    /**
     * @var string
     */
    private $title = null;

    /**
     * @var string|null
     */
    private $summeryText = null;

    /**
     * @var Image
     */
    private $featuredImage = null;

    /**
     * @var Image[]
     */
    private $images = null;

    /**
     * @var string|null
     */
    private $newsText = null;

    /**
     * @var \DateTime
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
     * @var \DateTime
     */
    private $modifiedAt = null;

    /**
     * @var \DateTime
     */
    private $extractedAt = null;

    /**
     * @return UriInterface
     */
    public function getSourceUrl(): UriInterface
    {
        return $this->sourceUrl;
    }

    /**
     * @param UriInterface $sourceUrl
     * @return News
     */
    public function setSourceUrl(UriInterface $sourceUrl): News
    {
        $this->sourceUrl = $sourceUrl;
        return $this;
    }

    /**
     * @return UriInterface
     */
    public function getUrl(): UriInterface
    {
        return $this->url;
    }

    /**
     * @param UriInterface $url
     * @return News
     */
    public function setUrl(UriInterface $url): News
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return News
     */
    public function setTitle(string $title): News
    {
        $this->title = $title;
        return $this;
    }

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
     * @return Image|null
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * @param Image $featuredImage|null
     * @return News
     */
    public function setFeaturedImage(Image $featuredImage)
    {
        $this->featuredImage = $featuredImage;
        return $this;
    }

    /**
     * @return Image[]|null
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image[] $images
     * @return News
     */
    public function setImages(array $images): News
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @param Image $image
     * @return News
     */
    public function addImage($image): News
    {
        $this->images[] = $image;
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
     * @return \DateTime|null
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTime $publishedAt
     * @return News
     */
    public function setPublishedAt(\DateTime $publishedAt): News
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
     * @return \DateTime|null
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @param \DateTime $modifiedAt
     * @return News
     */
    public function setModifiedAt(\DateTime $modifiedAt): News
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExtractedAt(): \DateTime
    {
        return $this->extractedAt;
    }

    /**
     * @param \DateTime $extractedAt
     * @return News
     */
    public function setExtractedAt(\DateTime $extractedAt): News
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
