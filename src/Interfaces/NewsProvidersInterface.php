<?php


namespace Shaharia\NewsAggregator\Interfaces;

use DateTime;
use Shaharia\NewsAggregator\Entity\News;

interface NewsProvidersInterface
{
    /**
     * Get the news provider name. i.e: BBC, CNN
     *
     * @return string
     */
    public function getName();

    /**
     * Description about news provider
     *
     * @return string
     */
    public function getDescription();

    /**
     * Official logo source
     *
     * @return string|null
     */
    public function getLogo();

    /**
     * Language of the news paper. If there is multiple language, create
     * separate provider for each one. i.e: en_US, bn_BD
     *
     * @return string
     */
    public function getPrimaryLanguage();

    /**
     * @return string
     */
    public function getHomepageUrl();

    /**
     * Get URL
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set URL
     *
     * @return NewsProvidersInterface
     */
    public function setUrl(string $url);

    /**
     * @return string
     */
    public function getListParser();

    /**
     * @return string
     */
    public function getDetailsParser();
}
