<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 6/7/2016
 * Time: 9:25 PM
 */

namespace Reviews\DefaultBundle\Entity;


class Properties
{
    /**
     * @var string
     */
    private $property_id;

    /**
     * @var string
     */
    private $product_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $property_hash_id;

    /**
     * @var Products
     */
    private $product;

    /**
     * @var ArrayCollection
     */
    private $products;

    /**
     * Lesson constructor.
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getPropertyId()
    {
        return $this->property_id;
    }

    /**
     * @param string $property_id
     */
    public function setPropertyId($property_id)
    {
        $this->property_id = $property_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPropertyHashId()
    {
        return $this->property_hash_id;
    }

    /**
     * @param string $property_hash_id
     */
    public function setPropertyHashId($property_hash_id)
    {
        $this->property_hash_id = $property_hash_id;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Products $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param string $product_id
     */
    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param $question
     * @return $this
     */
    public function addProduct($product)
    {
        $this->products->add($product);

        return $this;
    }

    /**
     * @param $product
     * @return $this
     */
    public function removeProduct($product)
    {
        $this->products->removeElement($product);

        return $this;
    }
}