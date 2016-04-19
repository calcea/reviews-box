<?php

namespace Reviews\SimilarityBundle\Controller;

use Reviews\SimilarityBundle\Services\FindSimilarities;
use Reviews\SimilarityBundle\Services\SimHash\Comparator\SimpleComparator;
use Reviews\SimilarityBundle\Services\SimHash\TextExtractor;
use Reviews\SimilarityBundle\Services\UpdateDatabaseSimHash;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tga\SimHash\SimHash;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $text1 = $text2 = '';
        $text1 = preg_replace("/[\n\r]/", "", $text1);
        $text2 = preg_replace("/[\n\r]/", "", $text2);
        $text1 = preg_replace('/[0-9]*/', '', $text1);
        $text2 = preg_replace('/[0-9]*/', '', $text2);
        dump($text1);
        dump($text2);
        similar_text(strtolower($text1), strtolower($text2), $percent);
        dump($percent);
        $similarity = new SimHash();
        $extractor = new TextExtractor();
        $comparator = new SimpleComparator();
        dump($this->compareStrings(implode(' ', $extractor->extract($text1)),
            implode(' ', $extractor->extract($text2))));

        $fp1 = $similarity->hash($extractor->extract('MOUSE ZALMAN ZM-M100'), \Tga\SimHash\SimHash::SIMHASH_64);
        $fp2 = $similarity->hash($extractor->extract('AL IPAD AIR 2 WI-FI 128GB SPACE GRAY'),
            \Tga\SimHash\SimHash::SIMHASH_64);

        dump($fp1->getBinary());
        dump($fp2->getBinary());

// Index between 0 and 1 : 0.80073740291681
        dump($comparator->compare($fp1, $fp2));
        die;

        return new Response();
    }

    function compareStrings($s1, $s2)
    {
        //one is empty, so no result
        if (strlen($s1) == 0 || strlen($s2) == 0) {
            return 0;
        }

        //replace none alphanumeric charactors
        //i left - in case its used to combine words
        $s1clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s1);
        $s2clean = preg_replace("/[^A-Za-z0-9-]/", ' ', $s2);

        //remove double spaces
        while (strpos($s1clean, "  ") !== false) {
            $s1clean = str_replace("  ", " ", $s1clean);
        }
        while (strpos($s2clean, "  ") !== false) {
            $s2clean = str_replace("  ", " ", $s2clean);
        }

        //create arrays
        $ar1 = explode(" ", $s1clean);
        $ar2 = explode(" ", $s2clean);
        $l1 = count($ar1);
        $l2 = count($ar2);

        //flip the arrays if needed so ar1 is always largest.
        if ($l2 > $l1) {
            $t = $ar2;
            $ar2 = $ar1;
            $ar1 = $t;
        }

        //flip array 2, to make the words the keys
        $ar2 = array_flip($ar2);


        $maxwords = max($l1, $l2);
        $matches = 0;

        //find matching words
        foreach ($ar1 as $word) {
            if (array_key_exists($word, $ar2)) {
                $matches++;
            }
        }

        return ($matches / $maxwords) * 100;
    }

    /**
     * Update Database with sim hash finger prints
     * @return JsonResponse
     */
    public function updateDatabaseAction()
    {
        set_time_limit(0);
        ini_set("memory_limit", '2524M');
        $doctrineContainer = $this->getDoctrine();
        $updateService = new UpdateDatabaseSimHash($doctrineContainer);
        $updateService->updateSimHash();

        return new JsonResponse();
    }

    public function findSimilaritiesAction()
    {
        $doctrineContainer = $this->getDoctrine();
        $service = new FindSimilarities($doctrineContainer, '
Vezi accesorii pentru acest produs
Laptop Lenovo IdeaPad 100-15 cu procesor Intel® Core™ i3-5005U 2.00GHz, Broadwell™, 15.6", 4GB, 500GB, DVD-RW, Intel® HD Graphics, Free DOS, Black');
        $products = $service->getSimilarProducts();
        /**
        * TODO dump addded
        */
        dump($products);
        die();
        return new JsonResponse();
    }
}
