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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $manufacturer;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->manufacturer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * Add manufacturer
     *
     * @param \Reviews\DefaultBundle\Entity\Manufacturers $manufacturer
     *
     * @return Sites
     */
    public function addManufacturer(\Reviews\DefaultBundle\Entity\Manufacturers $manufacturer)
    {
        $this->manufacturer[] = $manufacturer;

        return $this;
    }

    /**
     * Remove manufacturer
     *
     * @param \Reviews\DefaultBundle\Entity\Manufacturers $manufacturer
     */
    public function removeManufacturer(\Reviews\DefaultBundle\Entity\Manufacturers $manufacturer)
    {
        $this->manufacturer->removeElement($manufacturer);
    }

    /**
     * Get manufacturer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Add product
     *
     * @param \Reviews\DefaultBundle\Entity\Products $product
     *
     * @return Sites
     */
    public function addProduct(\Reviews\DefaultBundle\Entity\Products $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Reviews\DefaultBundle\Entity\Products $product
     */
    public function removeProduct(\Reviews\DefaultBundle\Entity\Products $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduct()
    {
        return $this->product;
    }
}
