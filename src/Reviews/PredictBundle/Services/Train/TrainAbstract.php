<?php
/**
 * This class implements the general methods
 *
 * Created by PhpStorm.
 * User: george.calcea
 * Date: 1/24/2016
 * Time: 11:10 AM
 */

namespace Reviews\PredictBundle\Services\Train;


use Camspiers\StatisticalClassifier\DataSource\DataArray;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Reviews\DefaultBundle\Entity\Products;

abstract class TrainAbstract
{
    private $doctrineContainer = null;
    private $enittyManager = null;

    /**
     * TrainAbstract constructor.
     * @param Registry $doctrineContainer
     */
    public function __construct(Registry $doctrineContainer)
    {
        $this->doctrineContainer = $doctrineContainer;
        $this->enittyManager = $doctrineContainer->getEntityManager();
    }

    /**
     * Returns the model directory
     * @return mixed
     */
    abstract protected function getModelDirectory();

    /**
     * Returns the model filename
     * @return mixed
     */
    abstract protected function getModelFilename();

    /**
     * Returns data with the model is trained
     * @return array
     */
    protected function getTrainData()
    {
        $productsRepository = $this->doctrineContainer->getRepository("ReviewsDefaultBundle:Products");
        $products = $productsRepository->findAll();
        $trainData = array();
        foreach ($products as $product) {
            /* @var $product \Reviews\DefaultBundle\Entity\Products */
            if (empty($this->getProductDescription($product))) {
                continue;
            }
            $trainData[] = array(
                'category' => $product->getClass1(),
                'description' => $this->getProductDescription($product)
            );

        }
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
     * Return data source to train model
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
}