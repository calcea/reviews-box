<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 1/24/2016
 * Time: 10:27 AM
 */

namespace Reviews\PredictBundle\Services\Train;


use CacheCache\Backends\File;
use CacheCache\Cache;
use Camspiers\StatisticalClassifier\Classifier\ComplementNaiveBayes;
use Camspiers\StatisticalClassifier\Model\CachedModel;
use Camspiers\StatisticalClassifier\Normalizer\Token\PhpStemmer;
use Reviews\PredictBundle\Services\Configs;

class BayesAlgorithm extends TrainAbstract implements TrainInterface
{

    public function train()
    {
        $source = $this->getDataSource();
        $stemmer = new PhpStemmer(Configs::getStemmerParams()['language']);
        $model = new CachedModel(
            $this->getModelFilename(),
            new Cache((
                new File(
                    array(
                        'dir' => $this->getModelDirectory()
                    )
                )
                )
            )
        );
        $classifier = new ComplementNaiveBayes($source, $model, null, null, $stemmer);
        $classifier->prepareModel();
    }

    /**
     * Returns the model directory
     * @return mixed
     */
    protected function getModelDirectory()
    {
        return sprintf(Configs::getBayesParams()['directory'], __DIR__ . '/../..');
    }

    /**
     * Returns the model filename
     * @return mixed
     */
    protected function getModelFilename()
    {
        return Configs::getBayesParams()['filename'];
    }
}