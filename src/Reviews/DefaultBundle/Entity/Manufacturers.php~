<?php

namespace Reviews\DefaultBundle\Entity;

/**
 * Manufacturers
 */
class Manufacturers
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
     * @var string
     */
    private $description;


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
     * @return Manufacturers
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
     * Set description
     *
     * @param string $description
     *
     * @return Manufacturers
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $site;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->site = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add site
     *
     * @param \Reviews\DefaultBundle\Entity\Sites $site
     *
     * @return Manufacturers
     */
    public function addSite(\Reviews\DefaultBundle\Entity\Sites $site)
    {
        $this->site[] = $site;

        return $this;
    }

    /**
     * Remove site
     *
     * @param \Reviews\DefaultBundle\Entity\Sites $site
     */
    public function removeSite(\Reviews\DefaultBundle\Entity\Sites $site)
    {
        $this->site->removeElement($site);
    }

    /**
     * Get site
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSite()
    {
        return $this->site;
    }
}
