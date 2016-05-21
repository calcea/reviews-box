<?php

namespace Reviews\DefaultBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

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
     * @var ArrayCollection
     */
    private $siteProducts;

    /**
     * Sites constructor.
     */
    public function __construct()
    {
        $this->siteProducts = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getSiteProducts()
    {
        return $this->siteProducts;
    }

    /**
     * @param  SitesProductsDetails $productDetails
     * @return $this
     */
    public function addSiteProduct(SitesProductsDetails $productDetails)
    {
        $this->siteProducts->add($productDetails);

        return $this;
    }

    /**
     * @param $product
     * @return $this
     */
    public function removeSiteProduct($product)
    {
        $this->siteProducts->removeElement($product);

        return $this;
    }
}

