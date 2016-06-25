<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/22/2016
 * Time: 10:10 PM
 */

namespace Reviews\SimilarityBundle\Services;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Reviews\SimilarityBundle\Repositories\SimHashStrings;
use Reviews\SimilarityBundle\Services\SimHash\TextExtractor;
use Webmozart\Assert\Assert;

class FindSimilarities
{

    private $text = '';
    private $threshold;
    private $doctrine = null;
    private $numberOfProducts = null;

    public function __construct(Registry $doctrineManager, $text, $threshold = 80, $limit = 3)
    {
        Assert::string($text, 'The given parameter is not string');
        Assert::greaterThan($threshold, 0);
        Assert::lessThan($threshold, 100);
        $this->text = $text;
        $this->threshold = $threshold;
        $this->doctrine = $doctrineManager;
        $this->numberOfProducts = $limit;
    }

    public function getSimilarProducts()
    {
        $fingerPrint = $this->getFingerPrint();
        $productsSimilarities = $this->getFromProductsTable($fingerPrint);
        $sitesProductsSimilarities = $this->getFromSitesProductsTable($fingerPrint);

        $products = array_merge($productsSimilarities, $sitesProductsSimilarities);
        usort($products, array($this, 'sortArray'));

        return $this->mapProductsWithEntity($products);
    }


    private function mapProductsWithEntity(array $products)
    {
        $productIds = [];
        $data = [];
        $productRepository = $this->doctrine->getRepository('ReviewsDefaultBundle:Products');
        foreach ($products as $product) {
            if(in_array($product['product_id'], $productIds)){
                continue;
            }
            $data[$product['product_id']] = $productRepository->find($product['product_id']);
            $productIds[] = $product['product_id'];
        }
        return $data;
    }

    private function getFromProductsTable($fingerPrint)
    {
        $productsRepository = $this->doctrine->getRepository('ReviewsDefaultBundle:Products');
        $productsSimilarities = $productsRepository->findSimilarities($fingerPrint, $this->numberOfProducts);

        return $productsSimilarities;
    }

    private function getFromSitesProductsTable($fingerPrint)
    {
        $sitesProductsRepository = $this->doctrine->getRepository('ReviewsDefaultBundle:SitesProductsDetails');
        $sitesProductsSimilarities = $sitesProductsRepository->findSimilarities($fingerPrint, $this->numberOfProducts);
        return $sitesProductsSimilarities;
    }


    public function sortArray($product1, $product2)
    {
        if ($product1['comparison'] > $product2['comparison']) {
            return -1;
        }

        if ($product1['comparison'] < $product2['comparison']) {
            return 1;
        }
        return 0;
    }

    public function getFingerPrint()
    {
        $repository = new SimHashStrings();
        $simhashCalculator = new CalculateSimhash($repository, new TextExtractor());
        $repository->add(1, $this->text);
        $simhashCalculator->calculate();
        return $repository->get(1)['sim_hash'];
    }
}