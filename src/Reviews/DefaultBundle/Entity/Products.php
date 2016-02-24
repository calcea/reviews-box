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
     * @var integer
     */
    private $class1;

    /**
     * @var integer
     */
    private $class2;

    /**
     * @var integer
     */
    private $class3;

    /**
     * @var \DateTime
     */
    private $added = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $deleted = '0';

    /**
     * @var \Reviews\DefaultBundle\Entity\Manufacturers
     */
    private $manufacturer;


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
     * Set class1
     *
     * @param integer $class1
     *
     * @return Products
     */
    public function setClass1($class1)
    {
        $this->class1 = $class1;

        return $this;
    }

    /**
     * Get class1
     *
     * @return integer
     */
    public function getClass1()
    {
        return $this->class1;
    }

    /**
     * Set class2
     *
     * @param integer $class2
     *
     * @return Products
     */
    public function setClass2($class2)
    {
        $this->class2 = $class2;

        return $this;
    }

    /**
     * Get class2
     *
     * @return integer
     */
    public function getClass2()
    {
        return $this->class2;
    }

    /**
     * Set class3
     *
     * @param integer $class3
     *
     * @return Products
     */
    public function setClass3($class3)
    {
        $this->class3 = $class3;

        return $this;
    }

    /**
     * Get class3
     *
     * @return integer
     */
    public function getClass3()
    {
        return $this->class3;
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
}

