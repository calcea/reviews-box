<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/2/2016
 * Time: 8:47 PM
 */

namespace Reviews\ParserBundle\Services\UpdateFromJson;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Config\Definition\Exception\Exception;

class PcGarage extends AbstractUpdater
{

    private $site = null;
    private $categoriesMapper = array(
        'notebook / laptop' => 7,
        'tablete' => 47,
        'smartphone' => 47,
        'ssd' => 23,
        'ventilatoare / radiatoare' => 23,
        'accesorii gsm' => 47,
        'jucarii' => 502,
        'routere wireless' => 128,
        'casti' => 10,
        'hub-uri usb' => 13,
        'sisteme de operare' => 513,
        'hard disk-uri externe' => 23,
        'memorii externe' => 123,
        'solutii de securitate' => 513,
        'aplicatii office' => 513,
        'memorii' => 123,
        'baterii externe (powerbank)' => 13,
        'hard disk-uri' => 23,
        'tastaturi' => 13,
        'procesoare' => 23,
        'multifunctionale' => 4,
        'coolere' => 23,
        'placi video' => 23,
        'mouse' => 13,
        'televizoare led' => 10,
        'monitoare led' => 10,
        'casti bluetooth' => 10,
        'mouse pad' => 13,
        'placi de baza' => 23,
        'carcase' => 23,
        'placi de retea' => 23,
        'gamepad' => 13,
        'medii stocare' => 123,
        'scaune gaming' => 57,
        'mouse gaming' => 13,
        'casti gaming' => 10,
        'mini sisteme pc' => 7,
        'consumabile' => 4,
        'surse' => 23,
        'boxe' => 10,
        'dvd writere' => 23,
        'servere' => 128,
        'smartwatch' => 13,
        'placi de retea wireless' => 23,
        'sisteme brand' => 7,
        'switch-uri' => 128,
        'ups' => 128,
        'accesorii televizoare' => 10,
        'tastaturi gaming' => 13,
        'kit tastatura + mouse' => 13,
        'camere web' => 85,
        'jocuri' => 57,
        'videoproiectoare' => 85,
        'faxuri' => 4,
        'sisteme all-in-one' => 7,
        'camere video auto' => 85,
        'telefoane mobile' => 47,
        'placi de sunet' => 23,
        'imprimante' => 4,
        'telefoane fixe' => 47,
        'routere' => 128,
        'grafica si audio' => 85
    );

    private $categories = array();
    const PATH_TO_FILE = '/../../Resources/data/pcgarage.json';
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

        fclose($this->handleFile);
        return $result;
    }

    private function  parseLine($line)
    {
        $data = json_decode($line, true);
        if (!isset($data['results']) || !isset($data['results'][0]['code'])) {
            return array();
        }
        if(!$this->getCode($data['results'][0])){
            return array();
        }
        $result = array(
            'code' => $data['results'][0]['code'],
            'price' => isset($data['results'][0]['price']) ? floatval($data['results'][0]['price']) : 0,
            'name' => isset($data['results'][0]['name']) ? $data['results'][0]['name'] : '',
            'category' => isset($data['results'][0]['category']) ? $data['results'][0]['category'] : '',
            'page_url' => $data['pageUrl']
        );
        if (!in_array(strtolower($result['category']), $this->categories)) {
            $this->categories[] = strtolower($result['category']);
        }
        if ($this->getCategoryId($result['category'])) {
            $result['category'] = $this->getCategoryId($result['category']);
        } else {
            return array();
        }
        return $result;
    }

    private function getCategoryId($category)
    {
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

    private function getCode($item){
        if(preg_match('/\s/', $item['code'])){
            return false;
        }
        return $item['code'];
    }
}