<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/23/2016
 * Time: 2:59 PM
 */

namespace Reviews\DefaultBundle\Services;


use Doctrine\Bundle\DoctrineBundle\Registry;

class Products
{
    private $doctrine;
    private $productsRepository = null;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->productsRepository = $doctrine->getRepository('ReviewsDefaultBundle:Products');
    }

    public function getPaginated($page = 1, $filters = array(), $orders = array())
    {
        return $this->productsRepository->findAll();
    }
}