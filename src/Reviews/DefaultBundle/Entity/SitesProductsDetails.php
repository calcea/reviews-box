<?php

namespace Reviews\DefaultBundle\Entity;

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
     * @var string
     */
    private $productId;

    /**
     * @var \Reviews\DefaultBundle\Entity\Sites
     */
    private $site;


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
     * Set productId
     *
     * @param string $productId
     *
     * @return SitesProductsDetails
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
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
}

