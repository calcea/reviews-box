<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/23/2016
 * Time: 9:41 PM
 */

namespace Reviews\ParserBundle\Models\Sites;


use Reviews\ParserBundle\Exceptions\InvalidPage;
use Reviews\ParserBundle\Models\AbstractSite;
use Symfony\Component\DomCrawler\Crawler;

class Emag extends AbstractSite
{
    const HOSTNAME = 'emag';
    const SITE_ID = 3;

    public function parse()
    {
        if ($this->crawler->filter('.product-title')) {
            $this->details['title'] = trim($this->crawler->filter('.product-title')->text());
        }
        if ($this->crawler->filter('.product-code span')) {
            $this->details['code'] = trim($this->crawler->filter('.product-code span')->text());
        }
        $this->details['images'] = $this->prepareImages($this->getImages());
        $this->details['properties'] = $this->prepareProperties($this->getProperties());
        $this->details['manufacturer'] = $this->getManufacturer();
        $this->details['description'] = $this->getDescription();
        $this->details['url'] = $this->url;
        $this->details['id'] = $this->getMd5();
        $this->details['site_id'] = self::SITE_ID;

        return $this->details;
    }

    /**
     * Validate the page content, if is there a product page or not
     * @return mixed
     */
    public function validatePage()
    {
        if ($this->crawler->filter('.product-title')->count() <= 0) {
            throw new InvalidPage();
        }
    }

    protected function getImages()
    {
        if (!$this->crawler->filter('#product-pictures-content')) {
            return array();
        }
        $images = $this->crawler->filter('#product-pictures-content img')->each(function (Crawler $node, $i) {
            return array(
                'thumbnail_url' => $node->attr('src'),
                'overlay_url' => $node->attr('src')
            );
        });

        return $images;
    }

    protected function prepareImages(array $images)
    {
        $result = array();
        foreach ($images as $image) {
            $tmp = $image;
            $tmp['id'] = $this->getMd5();
            if (preg_match('/res_[a-zA-Z0-9]{32}_/', $tmp['thumbnail_url'], $matches)) {
                preg_match('/(http|https):\/\/.*\//', $tmp['thumbnail_url'], $urlMatch);
                $tmp['thumbnail_url'] = $urlMatch[0] . $matches[0] . 'full.jpg';
                $tmp['overlay_url'] = $urlMatch[0] . $matches[0] . 'full.jpg';
            } else {
                continue;
            }
            $result[] = $tmp;
        }

        return $result;
    }

    protected function getProperties()
    {
        if ($this->crawler->filter('.product-specifications')->count() <= 0) {
            return [];
        }
        $properties = $this->crawler->filter('.product-specifications')->each(function (Crawler $node, $i) {
            if ($node->filter('tr')->count() <= 0) {
                return [];
            }
            return $node->filter('tr')->each(function (Crawler $tr, $poz) {
                return [
                    'name' => trim($tr->filter('td:nth-child(1)')->text()),
                    'value' => trim($tr->filter('td:nth-child(2)')->text()),
                ];
            });
        });
        return $properties;
    }

    protected function prepareProperties(array $properties)
    {
        $result = [];
        foreach ($properties as $group) {
            foreach ($group as $item) {
                $tmp = $item;
                $result[] = $tmp;
            }
        }
        return $result;
    }

    protected function getManufacturer()
    {
        if ($this->crawler->filter('.disclaimer-section a')) {
            return trim($this->crawler->filter('.disclaimer-section a')->text());
        }
        return '';
    }

    protected function getDescription()
    {
        if ($this->crawler->filter('.description-content')->count() > 0) {
            return $this->crawler->filter('.description-content')->html();
        }
        return '';
    }
}