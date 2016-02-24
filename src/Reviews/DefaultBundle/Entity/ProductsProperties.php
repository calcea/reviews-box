<?php

namespace Reviews\DefaultBundle\Entity;

/**
 * ProductsProperties
 */
class ProductsProperties
{
    /**
     * @var integer
     */
    private $propertyId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var \Reviews\DefaultBundle\Entity\Products
     */
    private $product;


    /**
     * Get propertyId
     *
     * @return integer
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProductsProperties
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
     * Set value
     *
     * @param string $value
     *
     * @return ProductsProperties
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set product
     *
     * @param \Reviews\DefaultBundle\Entity\Products $product
     *
     * @return ProductsProperties
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

