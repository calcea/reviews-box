<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 6/23/2016
 * Time: 9:14 PM
 */

namespace Reviews\DefaultBundle\Services;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Reviews\DefaultBundle\Entity\Products;
use Symfony\Component\Security\Core\SecurityContext;

class Reviews
{

    private $doctrine = null;

    private $user = null;

    public function __construct(Registry $doctrine, SecurityContext $context)
    {
        $this->doctrine = $doctrine;
        $this->user = $context->getToken()->getUser();
        $reviewsRepository = $this->doctrine->getRepository("ReviewsDefaultBundle:Reviews");
    }

    public function saveReview(Products $product, $review, $rating){
        $reviewObject = new \Reviews\DefaultBundle\Entity\Reviews();
        $reviewObject->setUser($this->user);
        $reviewObject->setReview($review);
        $reviewObject->setProduct($product);
        $reviewObject->setRating($rating);
        $reviewObject->setAdded(new \DateTime());
        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($reviewObject);
        $entityManager->flush();
    }
}