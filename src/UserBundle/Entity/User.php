<?php

namespace UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Reviews\DefaultBundle\Entity\Reviews;
use Reviews\DefaultBundle\Entity\SitesProductsDetails;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class User extends BaseUser
{

    /**
     * Default photo url.
     */
    const DEFAULT_PHOTO_URL = 'uploads/user_avatar/avatar-default.png';

    /**
     * User id.
     *
     * @var integer
     */
    protected $id;

    /**
     * User birthday.
     *
     * @var \DateTime
     */
    protected $birthday;

    /**
     * Avatar url.
     *
     * @var string
     */
    protected $avatarUrl;

    /**
     * Old avatar path.
     *
     * @var string
     */
    protected $oldAvatarUrl;

    /**
     * @var UploadedFile
     */
    protected $avatar;


    protected $reviews;

    protected $products;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->reviews = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get user birthday.
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set user birthday.
     *
     * @param \DateTime $birthday
     * @return $this
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * Get avatar url.
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        if(!is_null($this->avatarUrl)){
            return $this->avatarUrl;
        }

        return self::DEFAULT_PHOTO_URL;
    }

    /**
     * Set avatarUrl.
     *
     * @param $avatarUrl
     * @return $this
     */
    public function setAvatarUrl($avatarUrl)
    {
        $this->oldAvatarUrl = $this->avatarUrl;
        $this->avatarUrl = $avatarUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getOldAvatarUrl()
    {
        return $this->oldAvatarUrl;
    }

    /**
     * @param string $oldAvatarUrl
     * @return User
     */
    public function setOldAvatarUrl($oldAvatarUrl)
    {
        $this->oldAvatarUrl = $oldAvatarUrl;
        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param UploadedFile $avatar
     * @return User
     */
    public function setAvatar($avatar = null)
    {
        $this->avatar = $avatar;
        return $this;
    }



    /**
     * @param Badge $review
     * @param bool $updateRelation
     * @return $this
     */
    public function removeReview(Reviews $review, $updateRelation = true)
    {
        $this->reviews->removeElement($review);
        if($updateRelation){
            $review->removeUser($this, false);
        }

        return $this;
    }

    /**
     * @param Badge $review
     * @param bool $updateRelation
     * @return $this
     */
    public function addReview(Reviews $review, $updateRelation = true)
    {
        $this->reviews[] = $review;
        if($updateRelation){
            $review->addUser($this, false);
        }

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
     * @param ArrayCollection $reviews
     * @return $this
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * @param Badge $review
     * @param bool $updateRelation
     * @return $this
     */
    public function removeProduct(SitesProductsDetails $product, $updateRelation = true)
    {
        $this->products->removeElement($product);

        return $this;
    }

    /**
     * @param Badge $review
     * @param bool $updateRelation
     * @return $this
     */
    public function addProduct(SitesProductsDetails $product, $updateRelation = true)
    {
        $this->products[] = $product;
        if($updateRelation){
            $product->addUser($this, false);
        }

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;

        return $this;
    }

}

