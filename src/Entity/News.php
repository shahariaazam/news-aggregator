<?php
/**
 * News class
 *
 * @package  Shaharia\NewsAggregator\Entity
 */


namespace Shaharia\NewsAggregator\Entity;


use Psr\Http\Message\UriInterface;

class News
{

    /**
     * @var UriInterface
     */
    private $sourceUrl;

    /**
     * @var UriInterface
     */
    private $url;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string|null
     */
    private $summeryText;

    /**
     * @var Image
     */
    private $featuredImage;

    /**
     * @var Image[]
     */
    private $images;

    /**
     * @var string|null
     */
    private $newsText;

    /**
     * @var \DateTime
     */
    private $publishedAt;

    /**
     * @var string|null
     */
    private $author;

    /**
     * @var Category[]
     */
    private $categories;

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * @var \DateTime
     */
    private $modifiedAt;

    /**
     * @var \DateTime
     */
    private $extractedAt;

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
     * @return Image
     */
    public function getFeaturedImage(): Image
    {
        return $this->featuredImage;
    }

    /**
     * @param Image $featuredImage
     * @return News
     */
    public function setFeaturedImage(Image $featuredImage): News
    {
        $this->featuredImage = $featuredImage;
        return $this;
    }

    /**
     * @return Image[]
     */
    public function getImages(): array
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
     * @return \DateTime
     */
    public function getPublishedAt(): \DateTime
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
     * @return Category[]
     */
    public function getCategories(): array
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
     * @return Tag[]
     */
    public function getTags(): array
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
     * @return \DateTime
     */
    public function getModifiedAt(): \DateTime
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
}