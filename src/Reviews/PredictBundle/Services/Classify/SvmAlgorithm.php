<?php

namespace Reviews\PredictBundle\Services\Classify;

/**
 * Created by PhpStorm.
 * User: george
 * Date: 1/24/2016
 * Time: 11:09 AM
 */
use CacheCache\Backends\File;
use CacheCache\Cache;
use Camspiers\StatisticalClassifier\Classifier\SVM;
use Camspiers\StatisticalClassifier\DataSource;
use Camspiers\StatisticalClassifier\Model\SVMCachedModel;
use Camspiers\StatisticalClassifier\Normalizer\Token\PhpStemmer;
use Reviews\PredictBundle\Services\Configs;

class SvmAlgorithm extends ClassifyAbstract
{

    protected $model = null;

    public function classify($document)
    {
        $model = $this->getModel();
        dump($model->classify($document));die;

    }

    public function is($category, $document)
    {
        // TODO: Implement is() method.
    }

    protected function getModel()
    {
        if (is_null($this->model)) {
            $source = $this->getDataSource();
            $stemmer = new PhpStemmer(Configs::getStemmerParams()['language']);
            $model = new SVMCachedModel(
                $this->getModelDirectory() . $this->getModelFilename(),
                new Cache(
                    new File(
                        array(
                            'dir' => $this->getModelDirectory()
                        )
                    )
                )
            );
            $this->model = new SVM($source, $model, null, null, $stemmer);
        }
        return $this->model;
    }

    /**
     * Returns the directory where the trained model is saved
     * @return string
     */
    protected function getModelDirectory()
    {
        return realpath(sprintf(Configs::getSVMParams()['directory'], __DIR__ . '/../..')) . '/';
    }

    /**
     * Returns the model filename
     * @return mixed
     */
    protected function getModelFilename()
    {
        return Configs::getSVMParams()['filename'];
    }
}