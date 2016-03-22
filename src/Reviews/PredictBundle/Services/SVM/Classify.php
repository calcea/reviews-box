<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/5/2016
 * Time: 12:24 PM
 */

namespace Reviews\PredictBundle\Services\SVM;


class Classify
{
    /**
     * @var \Camspiers\StatisticalClassifier\Classifier\SVM|null
     */
    private $model = null;

    /**
     * Classify constructor.
     * @param Model $model
     * @param int $threshold
     */
    public function __construct(Model $model, $threshold = 0)
    {
        $this->model = $model->getModel();
        if ($threshold) {
            $this->model->setThreshold($threshold);
        }
    }

    /**
     * @param $text
     * @return bool|string
     */
    public function classify($text)
    {
        return $this->model->classify($text);
    }

    /**
     * @param $category
     * @param $text
     */
    public function is($category, $text)
    {
        $this->model->is($category, $text);
    }

}