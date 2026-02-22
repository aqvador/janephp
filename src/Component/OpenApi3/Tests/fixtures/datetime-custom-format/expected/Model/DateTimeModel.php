<?php

namespace Jane\Component\OpenApi3\Tests\DateTimeCustomFormat\Model;

class DateTimeModel extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Uses default RFC3339 format
     *
     * @var \DateTime
     */
    protected $defaultDateTime;
    /**
     * Uses custom Y-m-d H:i:s format
     *
     * @var \DateTime
     */
    protected $customDateTime;
    /**
     * Uses custom d/m/Y format
     *
     * @var \DateTime
     */
    protected $customDate;
    /**
     * Nullable property with custom format
     *
     * @var \DateTime|null
     */
    protected $nullableCustomDateTime;
    /**
     * Uses default RFC3339 format
     *
     * @return \DateTime
     */
    public function getDefaultDateTime(): \DateTime
    {
        return $this->defaultDateTime;
    }
    /**
     * Uses default RFC3339 format
     *
     * @param \DateTime $defaultDateTime
     *
     * @return self
     */
    public function setDefaultDateTime(\DateTime $defaultDateTime): self
    {
        $this->initialized['defaultDateTime'] = true;
        $this->defaultDateTime = $defaultDateTime;
        return $this;
    }
    /**
     * Uses custom Y-m-d H:i:s format
     *
     * @return \DateTime
     */
    public function getCustomDateTime(): \DateTime
    {
        return $this->customDateTime;
    }
    /**
     * Uses custom Y-m-d H:i:s format
     *
     * @param \DateTime $customDateTime
     *
     * @return self
     */
    public function setCustomDateTime(\DateTime $customDateTime): self
    {
        $this->initialized['customDateTime'] = true;
        $this->customDateTime = $customDateTime;
        return $this;
    }
    /**
     * Uses custom d/m/Y format
     *
     * @return \DateTime
     */
    public function getCustomDate(): \DateTime
    {
        return $this->customDate;
    }
    /**
     * Uses custom d/m/Y format
     *
     * @param \DateTime $customDate
     *
     * @return self
     */
    public function setCustomDate(\DateTime $customDate): self
    {
        $this->initialized['customDate'] = true;
        $this->customDate = $customDate;
        return $this;
    }
    /**
     * Nullable property with custom format
     *
     * @return \DateTime|null
     */
    public function getNullableCustomDateTime(): ?\DateTime
    {
        return $this->nullableCustomDateTime;
    }
    /**
     * Nullable property with custom format
     *
     * @param \DateTime|null $nullableCustomDateTime
     *
     * @return self
     */
    public function setNullableCustomDateTime(?\DateTime $nullableCustomDateTime): self
    {
        $this->initialized['nullableCustomDateTime'] = true;
        $this->nullableCustomDateTime = $nullableCustomDateTime;
        return $this;
    }
}