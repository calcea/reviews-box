<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 6/7/2016
 * Time: 10:04 PM
 */

namespace Reviews\DefaultBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use UserBundle\Entity\User;

class Reviews
{
    /**
     * @var string
     */
    private $review_id;

    /**
     * @var Products
     */
    private $product;

    /**
     * @var integer
     */
    private $user_id;

    /**
     * @var string
     */
    private $review;

    /**
     * @var integer
     */
    private $rating;

    /**
     * @var User
     */
    private $user;

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
    public function getReviewId()
    {
        return $this->review_id;
    }

    /**
     * @param string $review_id
     */
    public function setReviewId($review_id)
    {
        $this->review_id = $review_id;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param int $user_id
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param string $review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    public function __toString()
    {
        if(!is_null($this->user) && !is_null($this->product)){
            return $this->user->getUsername().' -> '.$this->product->getName();
        }

        return '';
    }

}