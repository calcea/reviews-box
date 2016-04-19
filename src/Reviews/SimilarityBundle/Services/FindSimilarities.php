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

    public function __construct(Registry $doctrineManager, $text, $threshold = 80)
    {
        Assert::string($text, 'The given parameter is not string');
        Assert::greaterThan($threshold, 0);
        Assert::lessThan($threshold, 100);
        $this->text = $text;
        $this->threshold = $threshold;
        $this->doctrine = $doctrineManager;
    }

    public function getSimilarProducts()
    {
        $fingerPrint = $this->getFingerPrint();
        $productsSimilarities = $this->getFromProductsTable($fingerPrint);
        $sitesProductsSimilarities = $this->getFromSitesProductsTable($fingerPrint);

        $products = array_merge($productsSimilarities, $sitesProductsSimilarities);
        usort($products, array($this, 'sortArray'));

        return $products;
    }


    private function getFromProductsTable($fingerPrint)
    {
        $productsRepository = $this->doctrine->getRepository('ReviewsDefaultBundle:Products');
        $productsSimilarities = $productsRepository->findSimilarities($fingerPrint);

        return $productsSimilarities;
    }

    private function getFromSitesProductsTable($fingerPrint)
    {
        $sitesProductsRepository = $this->doctrine->getRepository('ReviewsDefaultBundle:SitesProductsDetails');
        $sitesProductsSimilarities = $sitesProductsRepository->findSimilarities($fingerPrint);
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

    private function getFingerPrint()
    {
        $repository = new SimHashStrings();
        $simhashCalculator = new CalculateSimhash($repository, new TextExtractor());
        $repository->add(1, $this->text);
        $simhashCalculator->calculate();
        return $repository->get(1)['sim_hash'];
    }
}