<?php

namespace Reviews\DefaultBundle\Entity;

/**
 * ProductsImages
 */
class ProductsImages
{
    /**
     * @var integer
     */
    private $productImageId;

    /**
     * @var string
     */
    private $overlayUrl;

    /**
     * @var string
     */
    private $thumbnailUrl;

    /**
     * @var \DateTime
     */
    private $added = 'CURRENT_TIMESTAMP';

    /**
     * @var \Reviews\DefaultBundle\Entity\Products
     */
    private $product;


    /**
     * Get productImageId
     *
     * @return integer
     */
    public function getProductImageId()
    {
        return $this->productImageId;
    }

    /**
     * Set overlayUrl
     *
     * @param string $overlayUrl
     *
     * @return ProductsImages
     */
    public function setOverlayUrl($overlayUrl)
    {
        $this->overlayUrl = $overlayUrl;

        return $this;
    }

    /**
     * Get overlayUrl
     *
     * @return string
     */
    public function getOverlayUrl()
    {
        return $this->overlayUrl;
    }

    /**
     * Set thumbnailUrl
     *
     * @param string $thumbnailUrl
     *
     * @return ProductsImages
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * Get thumbnailUrl
     *
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * Set added
     *
     * @param \DateTime $added
     *
     * @return ProductsImages
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
     * Set product
     *
     * @param \Reviews\DefaultBundle\Entity\Products $product
     *
     * @return ProductsImages
     */
    public function setProduct(\Reviews\DefaultBundle\Entity\Products $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Reviews\DefaultBundle\Entity\Products
     */
    public function getProduct()
    {
        return $this->product;
    }
}
