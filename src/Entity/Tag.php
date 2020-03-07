<?php
/**
 * Tag class
 *
 * @package  Shaharia\NewsAggregator\Entity
 */


namespace Shaharia\NewsAggregator\Entity;

class Tag
{
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function toArray()
    {
        return [
            'name' => $this->getName()
        ];
    }
}
