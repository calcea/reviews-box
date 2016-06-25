<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 6/7/2016
 * Time: 11:09 AM
 */

namespace Reviews\DefaultBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class ProductImages
{
    /**
     * @var string
     */
    private $picture_id;


    /**
     * @var string
     */
    private $filename;

    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $original_url;

    /**
     * @var \DateTime
     */
    private $last_date_modified;

    /**
     * @var string
     */
    private $url_overlay_picture;

    /**
     * @var string
     */
    private $url_thumbnail_picture;

    /**
     * @var int
     */
    private $main_picture;

    /**
     * @var string
     */
    private $product_code;


    /**
     * @var integer
     */
    private $chapter;
    /**
     * @var Products
     */
    private $product;

    /**
     * @return string
     */
    public function getPictureId()
    {
        return $this->picture_id;
    }

    /**
     * @param string $picture_id
     */
    public function setPictureId($picture_id)
    {
        $this->picture_id = $picture_id;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getOriginalUrl()
    {
        return $this->original_url;
    }

    /**
     * @param string $original_url
     */
    public function setOriginalUrl($original_url)
    {
        $this->original_url = $original_url;
    }

    /**
     * @return \DateTime
     */
    public function getLastDateModified()
    {
        return $this->last_date_modified;
    }

    /**
     * @param \DateTime $last_date_modified
     */
    public function setLastDateModified($last_date_modified)
    {
        $this->last_date_modified = $last_date_modified;
    }

    /**
     * @return string
     */
    public function getUrlOverlayPicture()
    {
        return $this->url_overlay_picture;
    }

    /**
     * @param string $url_overlay_picture
     */
    public function setUrlOverlayPicture($url_overlay_picture)
    {
        $this->url_overlay_picture = $url_overlay_picture;
    }

    /**
     * @return string
     */
    public function getUrlThumbnailPicture()
    {
        return $this->url_thumbnail_picture;
    }

    /**
     * @param string $url_thumbnail_picture
     */
    public function setUrlThumbnailPicture($url_thumbnail_picture)
    {
        $this->url_thumbnail_picture = $url_thumbnail_picture;
    }

    /**
     * @return int
     */
    public function getMainPicture()
    {
        return $this->main_picture;
    }

    /**
     * @param int $main_picture
     */
    public function setMainPicture($main_picture)
    {
        $this->main_picture = $main_picture;
    }

    /**
     * @return string
     */
    public function getProductCode()
    {
        return $this->product_code;
    }

    /**
     * @param string $product_code
     */
    public function setProductCode($product_code)
    {
        $this->product_code = $product_code;
    }

    /**
     * @return int
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * @param int $chapter
     */
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
    }

    public function getProduct(){
        return $this->product;
    }

    public function setProduct(Products $product){
        $this->product = $product;
    }

    public function toArray(){
        return [
          'url_thumbnail_picture' => $this->url_thumbnail_picture,
          'url_overlay_picture' => $this->url_overlay_picture
        ];
    }

}