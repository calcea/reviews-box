<?php

namespace Reviews\DefaultBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Products
 */
class Products
{
    /**
     * @var string
     */
    private $productId;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $added = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $deleted;

    /**
     * @var integer
     */
    private $similarityHash = '0';

    /**
     * @var \Reviews\DefaultBundle\Entity\Manufacturers
     */
    private $manufacturer;

    /**
     * @var \Reviews\DefaultBundle\Entity\Categories
     */
    private $class1;

    /**
     * @var \Reviews\DefaultBundle\Entity\Categories
     */
    private $class2;

    /**
     * @var \Reviews\DefaultBundle\Entity\Categories
     */
    private $class3;

    /**
     * @var ArrayCollection
     */
    private $productDetails;


    /**
     * @var ArrayCollection
     */
    private $images;


    /**
     * @var ArrayCollection
     */
    private $properties;

    /**
     * @var ArrayCollection
     */
    private $reviews;

    /**
     * Products constructor.
     */
    public function __construct()
    {
        $this->productDetails = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->properties = new ArrayCollection();
        $this->reviews = new ArrayCollection();
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
     * Set code
     *
     * @param string $code
     *
     * @return Products
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Products
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
     * @return Products
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
     * Set added
     *
     * @param \DateTime $added
     *
     * @return Products
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
     * Set deleted
     *
     * @param boolean $deleted
     *
     * @return Products
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set similarityHash
     *
     * @param integer $similarityHash
     *
     * @return Products
     */
    public function setSimilarityHash($similarityHash)
    {
        $this->similarityHash = $similarityHash;

        return $this;
    }

    /**
     * Get similarityHash
     *
     * @return integer
     */
    public function getSimilarityHash()
    {
        return $this->similarityHash;
    }

    /**
     * Set manufacturer
     *
     * @param \Reviews\DefaultBundle\Entity\Manufacturers $manufacturer
     *
     * @return Products
     */
    public function setManufacturer(\Reviews\DefaultBundle\Entity\Manufacturers $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \Reviews\DefaultBundle\Entity\Manufacturers
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set class1
     *
     * @param \Reviews\DefaultBundle\Entity\Categories $class1
     *
     * @return Products
     */
    public function setClass1(\Reviews\DefaultBundle\Entity\Categories $class1 = null)
    {
        $this->class1 = $class1;

        return $this;
    }

    /**
     * Get class1
     *
     * @return \Reviews\DefaultBundle\Entity\Categories
     */
    public function getClass1()
    {
        return $this->class1;
    }

    /**
     * Set class2
     *
     * @param \Reviews\DefaultBundle\Entity\Categories $class2
     *
     * @return Products
     */
    public function setClass2(\Reviews\DefaultBundle\Entity\Categories $class2 = null)
    {
        $this->class2 = $class2;

        return $this;
    }

    /**
     * Get class2
     *
     * @return \Reviews\DefaultBundle\Entity\Categories
     */
    public function getClass2()
    {
        return $this->class2;
    }

    /**
     * Set class3
     *
     * @param \Reviews\DefaultBundle\Entity\Categories $class3
     *
     * @return Products
     */
    public function setClass3(\Reviews\DefaultBundle\Entity\Categories $class3 = null)
    {
        $this->class3 = $class3;

        return $this;
    }

    /**
     * Get class3
     *
     * @return \Reviews\DefaultBundle\Entity\Categories
     */
    public function getClass3()
    {
        return $this->class3;
    }

    /**
     * @param $productId
     */
    public function setProductId($productId){
        $this->productId = $productId;
    }

    /**
     * @return ArrayCollection
     */
    public function getProductDetails()
    {
        return $this->productDetails;
    }

    /**
     * @param $productDetail
     * @return $this
     */
    public function addProductDetail($productDetail)
    {
        $this->productDetails->add($productDetail);

        return $this;
    }

    /**
     * @param $productDetails
     * @return $this
     */
    public function removeProductDetail($productDetails)
    {
        $this->productDetails->removeElement($productDetails);

        return $this;
    }


    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param $image
     * @return $this
     */
    public function addImage($image)
    {
        $this->images->add($image);

        return $this;
    }

    /**
     * @param $image
     * @return $this
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);

        return $this;
    }



    /**
     * @return ArrayCollection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param $property
     * @return $this
     */
    public function addProperty($property)
    {
        $this->properties->add($property);

        return $this;
    }

    /**
     * @param $property
     * @return $this
     */
    public function removeProperty($property)
    {
        $this->properties->removeElement($property);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * @param $review
     * @return $this
     */
    public function addReview($review)
    {
        $this->reviews->add($review);

        return $this;
    }

    /**
     * @param $review
     * @return $this
     */
    public function removeReview($review)
    {
        $this->reviews->removeElement($review);

        return $this;
    }

    public function toArray(){
        $images = [];
        foreach ($this->images->toArray() as $image) {
            $images[] = $image->toArray();
        }
        if(empty($images)){
            $images = [[
                'url_thumbnail_picture' => '/img/product_default.jpg',
                'url_overlay_picture' => '/img/product_default.jpg'
            ]];
        }
        return [
            'product_id' => $this->productId,
            'name' => $this->name,
            'description' => $this->description,
            'images' => $images
        ];
    }

    public function __toString()
    {
        if(!is_null($this->name)){
            return $this->name;
        }

        return '';
    }
}

