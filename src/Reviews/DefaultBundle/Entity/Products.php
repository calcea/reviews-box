<?php

namespace Reviews\DefaultBundle\Entity;

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
     * @var \Reviews\DefaultBundle\Entity\Manufacturers
     */
    private $manufacturer;

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
     * Add site
     *
     * @param \Reviews\DefaultBundle\Entity\Sites $site
     *
     * @return Products
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

