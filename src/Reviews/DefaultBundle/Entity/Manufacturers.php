<?php

namespace Reviews\DefaultBundle\Entity;

/**
 * Manufacturers
 */
class Manufacturers
{
    /**
     * @var string
     */
    private $manufacturerId;

    /**
     * @var string
     */
    private $name;


    /**
     * Get manufacturerId
     *
     * @return string
     */
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Manufacturers
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
}

