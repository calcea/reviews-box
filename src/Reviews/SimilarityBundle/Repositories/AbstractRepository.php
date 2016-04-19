<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/7/2016
 * Time: 9:17 PM
 */

namespace Reviews\SimilarityBundle\Repositories;


abstract class AbstractRepository
{
    abstract public function add($id, $text);

    abstract public function get($id);

    abstract public function replace($id, $item);

    abstract public function toArray();
    
    abstract public function exist($id);
}