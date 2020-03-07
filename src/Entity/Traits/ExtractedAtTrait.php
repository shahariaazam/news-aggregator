<?php


namespace Shaharia\NewsAggregator\Entity\Traits;

use DateTime;

trait ExtractedAtTrait
{
    /**
     * @var DateTime
     */
    private $extractedAt = null;

    /**
     * @return DateTime
     */
    public function getExtractedAt(): DateTime
    {
        return $this->extractedAt;
    }

    /**
     * @param DateTime $extractedAt
     * @return ExtractedAtTrait
     */
    public function setExtractedAt(DateTime $extractedAt)
    {
        $this->extractedAt = $extractedAt;
        return $this;
    }
}
