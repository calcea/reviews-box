<?php
namespace Reviews\PredictBundle\Services\Train;

use CacheCache\Backends\File;
use CacheCache\Cache;
use Camspiers\StatisticalClassifier\Classifier\SVM;
use Camspiers\StatisticalClassifier\DataSource\DataArray;
use Camspiers\StatisticalClassifier\Model\SVMCachedModel;
use Camspiers\StatisticalClassifier\Normalizer\Token\PhpStemmer;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Reviews\PredictBundle\Services\Configs;

/**
 * This class handle the SVM algorithm
 *
 * User: george.calcea
 * Date: 1/10/2016
 * Time: 11:28 AM
 */
class SvmAlgorithm extends TrainAbstract implements TrainInterface
{
    /**
     * Train the current algorithm and save the model trained
     */
    public function train()
    {
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
        if (!$model->isPrepared()) {
            $source = $this->getDataSource();
            $classifier = new SVM($source, $model, null, null, $stemmer);
            $classifier->prepareModel();
        }
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