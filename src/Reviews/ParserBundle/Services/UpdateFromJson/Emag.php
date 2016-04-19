<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/2/2016
 * Time: 8:39 PM
 */

namespace Reviews\ParserBundle\Services\UpdateFromJson;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Config\Definition\Exception\Exception;

class Emag extends AbstractUpdater
{

    private $site = null;

    private $categoriesMapper = array(
        'masini de spalat rufe' => 1,
        'tablete si accesorii' => 47,
        'televizoare' => 10,
        'laptop si 2-in-1' => 7,
        'periferice tv-audio' => 10,
        'telefoane mobile' => 47,
        'periferice si accesorii' => 13,
        'accesorii electrocasnice mari' => 1,
        'retelistica' => 128,
        'periferice mobile' => 47,
        'boxe portabile si casti' => 10,
        'stocare date' => 123,
        'ipad si accesorii' => 47,
        'accesorii tv - audio' => 10,
        'accesorii telefoane' => 47,
        'electronice' => 502,
        'cabluri si adaptoare' => 7,
        'accesorii gaming' => 57,
        'aparate frigorifice' => 1,
        'software' => 513,
        'cuptoare cu microunde' => 1,
        'laptop-uri si sisteme gaming' => 7,
        'aspiratoare si fiare de calcat' => 1,
        'desktop pc si monitoare' => 7,
        'aragazuri' => 1,
        'incorporabile' => 1,
        'preparare alimente' => 1,
        'procesare alimente' => 1,
        'accesorii foto-video' => 10,
        'preparare cafea si bauturi' => 1,
        'foto-video' => 10,
        'jucarii' => 502,
        'ingrijirea parului' => 385,
        'videoproiectoare si accesorii' => 10,
        'smartwatch si smartband' => 13,
        'audio hi-fi' => 10,
        'iphone si accesorii' => 47,
        'console hardware' => 57,
        'jocuri pc' => 57,
        'imprimante si consumabile' => 4,
        'cantare de baie' => 1,
        'hote' => 1,
        'masini de spalat vase' => 1,
        'jocuri consola' => 57,
        'playere portabile' => 57,
        'ingrijire personala' => 385,
        'climatizare',
        'ceasuri electronice' => 13,
        'masini de cusut' => 1,
        'home cinema si audio' => 10,
        'bricolaj',
        'sisteme de bucatarie' => 1,
        'accesorii' => 385,
        'uscatoare de rufe' => 1,
        'sisteme supraveghere' => 10,
    );

    private $categories = array();
    const PATH_TO_FILE = '/../../Resources/data/emag.json';
    const SITE_ID = 1;
    private $handleFile = null;

    public function __construct(Registry $doctrineContainer)
    {
        parent::__construct($doctrineContainer);
        $this->handleFile = fopen(realpath(__DIR__ . self::PATH_TO_FILE), "r");
    }


    public function parse()
    {
        $result = array();
        if ($this->handleFile) {
            while (($line = fgets($this->handleFile)) !== false) {
                $parsedLine = $this->parseLine($line);
                if (!empty($parsedLine)) {
                    $result = array_merge($result, [$parsedLine]);
                }
            }
        } else {
            throw new Exception('invalid file');
        }
        /**
        * TODO dump addded
        */
        dump($result);
        die();
        fclose($this->handleFile);
        return $result;
    }

    private function  parseLine($line)
    {
        $data = json_decode($line, true);
        /**
        * TODO dump addded
        */
        dump($data);
        if (!isset($data['results']) || !isset($data['results'][0]['code'])) {
            return array();
        }

        $result = array(
            'code' => $data['results'][0]['code'],
            'price' => isset($data['results'][0]['price']) ? floatval($data['results'][0]['price']) : 0,
            'name' => isset($data['results'][0]['name']) ? $data['results'][0]['name'] : '',
            'category' => isset($data['results'][0]['category']) ? $data['results'][0]['category'] : '',
            'page_url' => $data['pageUrl']
        );
        if ($this->getCategoryId($result['category'])) {
            $result['category'] = $this->getCategoryId($result['category']);
        } else {
            return array();
        }
        return $result;
    }

    private function getCategoryId($category)
    {
        return $category;
        if (isset($this->categoriesMapper[strtolower(trim($category))])) {
            return $this->categoriesMapper[strtolower(trim($category))];
        }
        return false;
    }

    protected function getSite()
    {
        if (!is_null($this->site)) {
            return $this->site;
        }
        $sitesRepository = $this->doctrineContainer->getRepository('ReviewsDefaultBundle:Sites');
        return $this->site = $sitesRepository->find(self::SITE_ID);
    }
}