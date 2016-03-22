<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/21/2016
 * Time: 8:11 PM
 */

namespace Reviews\SimilarityBundle\Services;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Reviews\SimilarityBundle\Repositories\AbstractRepository;
use Reviews\SimilarityBundle\Repositories\SimHashStrings;
use Reviews\SimilarityBundle\Services\SimHash\TextExtractor;

class UpdateDatabaseSimHash
{
    private $doctrineContainer = null;
    private $entityManager = null;

    /**
     * UpdateDatabaseSimHash constructor.
     * @param Registry $doctrineContainer
     */
    public function __construct(Registry $doctrineContainer)
    {
        $this->doctrineContainer = $doctrineContainer;
        $this->entityManager = $doctrineContainer->getEntityManager();
    }

    /**
     * Updates the simhash fingerprints in the products table
     */
    public function updateSimHash()
    {
        $productsDoctrineRepository = $this->doctrineContainer->getRepository("ReviewsDefaultBundle:Products");
        $products = $productsDoctrineRepository->findAll();
        $repository = $this->getSimHashRepositoryByProducts($products);
        $this->addSimHashFingerPrints($repository);
        $this->updateProductsTable($products, $repository);
    }

    /**
     * Calculates the simhash fingerprints on given repository
     * @param AbstractRepository $repository
     */
    protected function addSimHashFingerPrints(AbstractRepository $repository)
    {
        $simHashCalculator = new CalculateSimhash($repository, new TextExtractor());
        $simHashCalculator->calculate();
    }

    /**
     * @param array $products
     * @return SimHashStrings
     */
    protected function getSimHashRepositoryByProducts(array $products)
    {
        $repository = new SimHashStrings();
        foreach ($products as $product) {
            /* @var $product \Reviews\DefaultBundle\Entity\Products */
            $id = $product->getProductId();
            $name = $product->getName();
            $repository->add($id, $name);
        }

        return $repository;
    }

    /**
     * @param array $products
     * @param AbstractRepository $repository
     */
    protected function updateProductsTable(array $products, AbstractRepository $repository)
    {
        $entityManager = $this->doctrineContainer->getManager();
        foreach ($products as $product) {
            /* @var $product \Reviews\DefaultBundle\Entity\Products */
            $simHash = $repository->get($product->getProductId())['sim_hash'];
            $product->setSimilarityHash($simHash);
        }
        $entityManager->flush();
    }
}