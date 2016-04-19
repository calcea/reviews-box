<?php

namespace Reviews\DefaultBundle\Entity;

/**
 * SitesManufacturers
 */
class SitesManufacturers
{
    /**
     * @var string
     */
    private $manufacturerId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Reviews\DefaultBundle\Entity\Sites
     */
    private $site;


    /**
     * Set manufacturerId
     *
     * @param string $manufacturerId
     *
     * @return SitesManufacturers
     */
    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturerId = $manufacturerId;

        return $this;
    }

    /**
     * Get manufacturerId
     *
     * @return string
     */
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SitesManufacturers
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

    /**
     * Set site
     *
     * @param \Reviews\DefaultBundle\Entity\Sites $site
     *
     * @return SitesManufacturers
     */
    public function setSite(\Reviews\DefaultBundle\Entity\Sites $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \Reviews\DefaultBundle\Entity\Sites
     */
    public function getSite()
    {
        return $this->site;
    }
}

