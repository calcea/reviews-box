<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/23/2016
 * Time: 9:40 PM
 */

namespace Reviews\ParserBundle\Services;


use Reviews\ParserBundle\Models\Sites\Cel;
use Reviews\ParserBundle\Models\Sites\Emag;
use Reviews\ParserBundle\Models\Sites\PcGarage;
use Reviews\ParserBundle\Models\Sites\Unknown;
use Reviews\ParserBundle\Models\WebPageGrabber;

class SiteFactory
{

    /**
     * Factory from url
     * @param $url
     * @return Cel|Emag|PcGarage
     */
    static public function factory($url)
    {
        switch (self::getHostFromUrl($url)) {
            case Emag::HOSTNAME:
                return new Emag(self::getContent($url));
            case PcGarage::HOSTNAME:
                return new PcGarage(self::getContent($url));
            case Cel::HOSTNAME:
                return new Cel(self::getContent($url));
            default:
                return new Unknown(self::getContent($url));
                /**
                 * TODO de aruncat o exceptie pentru a afisa o eroare user frendly
                 */
                break;
        }

    }

    /**
     * Returns hostname from url
     * @param $url
     * @return string
     */
    static private function getHostFromUrl($url)
    {
        $components = parse_url($url);
        $host = preg_replace('/(www\.|\.com|\.ro|\.net)/', '', $components['host']);
        return strtolower($host);
    }

    /**
     * Returns the page content from url
     * @param $url
     * @return string
     * @throws \Reviews\ParserBundle\Exceptions\InvalidPage
     */
    static private function getContent($url)
    {
        $pageGrabber = new WebPageGrabber($url);
        return $pageGrabber->getPageContent();
    }
}