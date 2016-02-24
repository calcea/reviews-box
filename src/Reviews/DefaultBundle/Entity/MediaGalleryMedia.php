<?php

namespace Reviews\DefaultBundle\Entity;

/**
 * MediaGalleryMedia
 */
class MediaGalleryMedia
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $position;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \Reviews\DefaultBundle\Entity\MediaGallery
     */
    private $gallery;

    /**
     * @var \Reviews\DefaultBundle\Entity\MediaMedia
     */
    private $media;


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
     * Set position
     *
     * @param integer $position
     *
     * @return MediaGalleryMedia
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return MediaGalleryMedia
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return MediaGalleryMedia
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MediaGalleryMedia
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set gallery
     *
     * @param \Reviews\DefaultBundle\Entity\MediaGallery $gallery
     *
     * @return MediaGalleryMedia
     */
    public function setGallery(\Reviews\DefaultBundle\Entity\MediaGallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Reviews\DefaultBundle\Entity\MediaGallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set media
     *
     * @param \Reviews\DefaultBundle\Entity\MediaMedia $media
     *
     * @return MediaGalleryMedia
     */
    public function setMedia(\Reviews\DefaultBundle\Entity\MediaMedia $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Reviews\DefaultBundle\Entity\MediaMedia
     */
    public function getMedia()
    {
        return $this->media;
    }
}

