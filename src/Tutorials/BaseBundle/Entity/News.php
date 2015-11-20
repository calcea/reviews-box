<?php

namespace Tutorials\BaseBundle\Entity;

/**
 * News
 */
class News
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $user;

    /**
     * @var boolean
     */
    private $isDeleted = 0;

    /**
     * @return int
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param int $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }

    /**
     * @var integer
     */
    private $mediaId;    /**
     * @var integer
     */
    private $media;

    /**
     * @var boolean
     */
    private $isApproved;

    /**
     * @var integer
     */
    private $likes;

    /**
     * @var integer
     */
    private $shares;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return News
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
     * @return News
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
     * Set user
     *
     * @param string $user
     *
     * @return News
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return News
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set mediaId
     *
     * @param integer $mediaId
     *
     * @return News
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;

        return $this;
    }

    /**
     * Get mediaId
     *
     * @return integer
     */
    public function getMediaId()
    {
        return $this->mediaId;
    }

    /**
     * Set isApproved
     *
     * @param boolean $isApproved
     *
     * @return News
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return boolean
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     *
     * @return News
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return integer
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set shares
     *
     * @param integer $shares
     *
     * @return News
     */
    public function setShares($shares)
    {
        $this->shares = $shares;

        return $this;
    }

    /**
     * Get shares
     *
     * @return integer
     */
    public function getShares()
    {
        return $this->shares;
    }
}

