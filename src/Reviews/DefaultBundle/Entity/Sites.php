<?php

namespace Reviews\DefaultBundle\Entity;

/**
 * Sites
 */
class Sites
{
    /**
     * @var integer
     */
    private $siteId;

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
     */
    private $name;


    /**
     * Get siteId
     *
     * @return integer
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * Set baseUrl
     *
     * @param string $baseUrl
     *
     * @return Sites
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Get baseUrl
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Sites
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

