<?php

namespace Reviews\PredictBundle\Services\Classify;
use Reviews\PredictBundle\Services\Train\TrainAbstract;

/**
 * Created by PhpStorm.
 * User: george
 * Date: 1/24/2016
 * Time: 11:10 AM
 */
abstract class ClassifyAbstract extends TrainAbstract
{

    abstract public function classify($document);

    abstract public function is($category, $document);

    abstract protected function getModel();

}