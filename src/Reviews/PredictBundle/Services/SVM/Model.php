<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/5/2016
 * Time: 12:20 PM
 */

namespace Reviews\PredictBundle\Services\SVM;


use CacheCache\Backends\File;
use CacheCache\Cache;
use Camspiers\StatisticalClassifier\Classifier\SVM;
use Camspiers\StatisticalClassifier\DataSource\DataArray;
use Camspiers\StatisticalClassifier\Model\SVMCachedModel;
use Camspiers\StatisticalClassifier\Normalizer\Token\PhpStemmer;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Cache\ApcCache;
use Reviews\DefaultBundle\Entity\Products;
use Reviews\PredictBundle\Services\Configs;
use Symfony\Component\Config\Definition\Exception\Exception;

class Model
{
    const CACHE_KEY = 'trained_data';

    private $doctrineContainer = null;
    private $enittyManager = null;
    private $model = null;
    private $cacheService = null;

    /**
     * TrainAbstract constructor.
     * @param Registry $doctrineContainer
     */
    public function __construct(Registry $doctrineContainer, ApcCache $cache)
    {
        $this->cacheService = $cache;
        $this->doctrineContainer = $doctrineContainer;
        $this->enittyManager = $doctrineContainer->getEntityManager();
    }

    /**
     * Returns the trained model
     *
     * @return SVM|null
     */
    public function getModel()
    {
        if (!is_null($this->model)) {
            return $this->model;
        }
        $cachedModel = new SVMCachedModel(
            $this->getModelDirectory() . $this->getModelFilename(),
            new Cache(
                new File(
                    array(
                        'dir' => $this->getModelDirectory()
                    )
                )
            )
        );
        $stemmer = new PhpStemmer(Configs::getStemmerParams()['language']);
        $source = $this->getDataSource();

        $this->model = new SVM($source, $cachedModel, null, null, $stemmer);
        if (!$cachedModel->isPrepared()) {
            $this->model->prepareModel();
        }

        return $this->model;
    }

    /**
     * Returns an array with products for trainig the model
     * @return array
     */
    protected function getTrainData()
    {
        $trainData = array();
        if ($trainData = $this->cacheService->fetch(self::CACHE_KEY)) {
            return json_decode($trainData, true);
        }
        $productsRepository = $this->doctrineContainer->getRepository("ReviewsDefaultBundle:Products");
        $products = $productsRepository->findAll();

        foreach ($products as $product) {
            /* @var $product \Reviews\DefaultBundle\Entity\Products */
            if (empty($this->getProductDescription($product))) {
                continue;
            }
            if (!empty(trim($product->getDescription())) && preg_match('/\s/', trim($product->getDescription()))) {
                $trainData[] = array(
                    'category' => $product->getClass1()->getCategoryId(),
                    'description' => trim($product->getDescription())
                );
            }
            if (!empty(trim($product->getName())) && preg_match('/\s/', trim($product->getName()))) {
                $trainData[] = array(
                    'category' => $product->getClass1()->getCategoryId(),
                    'description' => trim($product->getName())
                );
            }
        }
        $this->cacheService->save(self::CACHE_KEY, json_encode($trainData));
        return $trainData;
    }

    /**
     * Returns the text for training model
     * @param Products $product
     * @return string
     */
    protected function getProductDescription(Products $product)
    {
        return $product->getDescription() . ' ' . $product->getName();
    }

    /**
     * Return data source for training the model
     * @return DataArray
     */
    protected function getDataSource()
    {
        $data = $this->getTrainData();
        $source = new DataArray();
        foreach ($data as $item) {
            $source->addDocument($item['category'], $item['description']);
        }
        return $source;
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