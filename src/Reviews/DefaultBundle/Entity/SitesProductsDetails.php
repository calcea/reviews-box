<?php

namespace Reviews\DefaultBundle\Entity;

use UserBundle\Entity\User;

/**
 * SitesProductsDetails
 */
class SitesProductsDetails
{
    /**
     * @var integer
     */
    private $siteProductDetailId;

    /**
     * @var string
     */
    private $details;

    /**
     * @var string
     */
    private $productUrl;

    /**
     * @var string
     */
    private $htmlDescription;

    /**
     * @var string
     */
    private $similarityHash;

    /**
     * @var \DateTime
     */
    private $added = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $price;

    /**
     * @var \Reviews\DefaultBundle\Entity\Sites
     */
    private $site;

    /**
     * @var \Reviews\DefaultBundle\Entity\Products
     */
    private $product;

    /**
     * @var User
     */
    private $user;

    /**
     * Get siteProductDetailId
     *
     * @return integer
     */
    public function getSiteProductDetailId()
    {
        return $this->siteProductDetailId;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return SitesProductsDetails
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set productUrl
     *
     * @param string $productUrl
     *
     * @return SitesProductsDetails
     */
    public function setProductUrl($productUrl)
    {
        $this->productUrl = $productUrl;

        return $this;
    }

    /**
     * Get productUrl
     *
     * @return string
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * Set htmlDescription
     *
     * @param string $htmlDescription
     *
     * @return SitesProductsDetails
     */
    public function setHtmlDescription($htmlDescription)
    {
        $this->htmlDescription = $htmlDescription;

        return $this;
    }

    /**
     * Get htmlDescription
     *
     * @return string
     */
    public function getHtmlDescription()
    {
        return $this->htmlDescription;
    }

    /**
     * Set similarityHash
     *
     * @param string $similarityHash
     *
     * @return SitesProductsDetails
     */
    public function setSimilarityHash($similarityHash)
    {
        $this->similarityHash = $similarityHash;

        return $this;
    }

    /**
     * Get similarityHash
     *
     * @return string
     */
    public function getSimilarityHash()
    {
        return $this->similarityHash;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     *
     * @return SitesProductsDetails
     */
    public function setAdded($added)
    {
        $this->added = $added;

        return $this;
    }

    /**
     * Get added
     *
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return SitesProductsDetails
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set site
     *
     * @param \Reviews\DefaultBundle\Entity\Sites $site
     *
     * @return SitesProductsDetails
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

    /**
     * @return Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param $product
     * @return $this
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

}

