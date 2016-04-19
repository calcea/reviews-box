<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/31/2016
 * Time: 2:00 PM
 */

namespace Reviews\ParserBundle\Services\UpdateFromJson;


use Doctrine\Bundle\DoctrineBundle\Registry;

class Evomag extends AbstractUpdater
{
    private $site = null;
    const SITE_ID = 2;
    const PATH_TO_FILE = '/../../Resources/data/evomag.json';
    private $categoriesMapper = array(
        "led tv" => 10,
        "laptopuri" => 7,
        "branduri" => 7,
        "multifunctionale" => 4,
        "monitoare led" => 53,
        "all in one pc" => 7,
        "telefoane mobile" => 47,
        "sisteme operare pc" => 513,
        "camere video auto" => 10,
        "routere" => 128,
        "imprimante laser alb-negru" => 4,
        "lazi frigorifice" => 1,
        "storcatoare" => 1,
        "ultrabook" => 7,
        "camere video" => 10,
        "epilatoare" => 1,
        "jocuri" => 57,
        "mouse" => 13,
        "antivirusi" => 513,
        "cabluri hdmi" => 13,
        "memorii laptop" => 23,
        "sterilizatoare si accesorii" => 385,
        "soundbar" => 10,
        "ceasuri barbatesti" => 13,
        "console" => 57,
        "solid-state drive (ssd)" => 23,
        "aplicatii" => 513,
        "rame digitale" => 85,
        "tastatura" => 13,
        "switch-uri" => 128,
        "sistem home cinema" => 10,
        "masini de gaurit" => 485,
        "babyphone" => 385,
        "monitoare video bebelusi" => 385,
        "cantare corporale" => 1,
        "procesoare" => 23,
        "ceasuri de dama" => 13,
        "casti bluetooth si audio" => 10,
        "videoproiectoare" => 85,
        "aparate foto compacte" => 85,
        "aparate foto d-slr" => 85,
        "supraveghere video" => 85,
        "cabluri imprimante" => 4,
        "consumabile" => 4,
        "accesorii monitoare",
        "acumulatori externi" => 13,
        "rucsacuri laptop" => 13,
        "accesorii camere video pentru sporturi extreme" => 85,
        "mouse pad" => 13,
        "cabluri hdd" => 13,
        "carduri memorie" => 123,
        "huse telefoane" => 47,
        "coolere cpu" => 23,
        "placi de baza" => 23,
        "casti - microfoane" => 10,
        "sisteme audio" => 10,
        "aparate frigorifice" => 1,
        "periferice" => 13,
        "suport proiectoare" => 85,
        "trepiede foto" => 85,
        "surse server" => 128,
        "huse tablete" => 47,
        "tablete" => 47,
        "cabluri de date" => 13,
        "alte accesorii tablete" => 47,
        "telefoane voip" => 47,
        "folii protectie telefoane" => 47,
        "huse foto" => 85,
        "cap lentila - body" => 85,
        "accesorii foto" => 85,
        "cabluri foto" => 13,
        "diverse foto" => 85,
        "adaptoare foto" => 85,
        "obiective" => 85,
        "memorii" => 123,
        "unitati optice" => 7,
        "placi video" => 23,
        "hdd-uri laptop" => 23,
        "accesorii laptop" => 13,
        "keylock laptop" => 13,
        "cooler-stand laptop" => 13,
        "accesorii smart tv" => 10,
        "smartwatch" => 13,
        "hdd desktop" => 23,
        "hard disk extern" => 23,
        "genti laptop" => 13,
        "curea smartwatch" => 13,
        "acumulatori video" => 85,
        "accesorii casa inteligenta" => 1,
        "imprimante foto" => 4,
        "carcase" => 23,
        "surse" => 23,
        "incarcator laptop" => 23,
        "huse laptop" => 13,
        "boxe" => 10,
        "masini de spalat vase" => 1,
        "folii protectie tablete" => 47,
        "masini de gaurit si insurubat cu acumulator" => 485,
        "aparate de aer conditionat" => 1,
        "memorii server" => 128,
        "mini difuzoare" => 10,
        "alte accesorii laptop-uri" => 13,
        "accesorii smartwatch" => 13,
        "dispozitive filtrare apa" => 1,
        "folii protectie smartwatch" => 13,
        "huse smartwatch" => 13,
        "ipod player" => 10,
        "stick usb" => 123,
        "accesorii ipod" => 13,
        "huse ipod" => 13,
        "servere" => 128,
        "sisteme operare server" => 513,
        "aragazuri" => 1,
        "alte accesorii proiector" => 85,
        "casti alergare" => 10,
        "hub usb" => 13,
        "fier de calcat" => 1,
        "fierbatoare apa" => 1,
        "blendere si tocatoare" => 1,
        "mixere" => 1,
        "statii de calcat" => 1,
        "hote" => 1,
        "polizoare unghiulare" => 485,
        "joystick" => 57,
        "cabluri" => 13,
        "diverse retea" => 128,
        "aspiratoare cu sac" => 1,
        "aparate filtrare aer" => 1,
        "aspiratoare fara sac" => 1,
        "accesorii aspiratoare" => 1,
        "masini de spalat rufe" => 1,
        "hdd server" => 23,
        "cuptor cu microunde" => 1,
        "alte accesorii servere" => 23,
        "camere web" => 85,
        "sisteme workstation" => 7,
        "incarcatoare smartwatch" => 13,
        "alte accesorii imprimante" => 4,
        "placi retea" => 23,
        "mese de calcat" => 1,
        "coolere vga" => 23,
        "controlere" => 244,
        "aspiratoare portabile" => 1,
        "plottere" => 4,
        "espressoare" => 1,
        "ionizatoare apa" => 1,
        "filtre si accesorii filtrare apa" => 1,
        "scannere" => 4,
        "monitoare lcd" => 53,
        "prajitoare paine" => 1,
        "dvd - blu-ray player" => 10,
        "lcd tv" => 10,
        "friteuze" => 1,
        "baterii laptop" => 13,
        "coolere server" => 23,
        "placi de baza server" => 128,
        "telecomenzi foto" => 85,
        "acumulatori foto" => 85,
        "filtre foto" => 85,
        "inele foto" => 85,
        "incarcatoare foto" => 85,
        "blitz-uri" => 85,
        "aparate foto mirrorless" => 85,
        "telefoane seniori" => 47,
        "tv tuner - placi captura" => 10,
        "radio" => 10,
        "fax kit" => 4,
        "accesorii unelte de mana" => 485,
        "hard disc imprimante" => 4,
        "fierastraie pentru decupat" => 485,
        "carcase server" => 181,
        "boxe portabile tablete" => 10,
        "aparate de gatit cu aburi" => 1,
        "placi de sunet" => 23,
        "imprimante laser color" => 4,
        "accesorii supraveghere video" => 85,
        "ciocan rotopercutor" => 485,
        "telefoane fixe" => 47,
        "prize inteligente" => 181,
    );


    private $categories = array();

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
            throw new \Exception('invalid file');
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
        $result = array(
            'code' => $this->getCode($data['results'][0]),
            'price' => isset($data['results'][0]['price']) ? floatval($data['results'][0]['price']) : 0,
            'name' => isset($data['results'][0]['name']) ? str_replace('Reducere!', '',
                $data['results'][0]['name']) : '',
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


    private function getCode($item)
    {
        $matches = array();
        preg_match('/\[.*\]/', $item['code'], $matches);
        $code = trim($matches[0], ' \[\]\r\n');
        return $code;
    }

    /**
     * Returns the current site object
     * @return mixed
     */
    protected function getSite()
    {
        if (!is_null($this->site)) {
            return $this->site;
        }
        $sitesRepository = $this->doctrineContainer->getRepository('ReviewsDefaultBundle:Sites');
        return $this->site = $sitesRepository->find(self::SITE_ID);
    }

    protected function getCategoryId($category)
    {
        if (isset($this->categoriesMapper[strtolower(trim($category))])) {
            return $this->categoriesMapper[strtolower(trim($category))];
        }
        return false;
    }
}