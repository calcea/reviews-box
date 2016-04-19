<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/7/2016
 * Time: 9:16 PM
 */

namespace Reviews\SimilarityBundle\Repositories;


class SimHashStrings extends AbstractRepository
{
    private $data = array();

    /**
     * Add new item into repository
     * @param $id
     * @param $text
     */
    public function add($id, $text)
    {
        $this->data[$id] = array(
            'text' => $text,
            'sim_hash' => ''
        );
    }

    /**
     * Returns item by id
     * @param $id
     * @return array
     */
    public function get($id)
    {
        return (isset($this->data[$id])) ? $this->data[$id] : array();
    }

    /**
     * Returns all repository data
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Replace item by id
     * @param $id
     * @param $newItem
     */
    public function replace($id, $newItem)
    {
        if (!isset($this->data[$id])) {
            throw new \InvalidArgumentException("The given id does not exist in repository");
        }
        $this->data[$id] = $newItem;
    }

    /**
     * Returns repository representation as array
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    public function exist($id){
        return (isset($this->data[$id])) ? true : false;
    }
}