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

class Cel extends AbstractSite
{
    const HOSTNAME = 'cel';
    const SITE_ID = 4;

    public function parse()
    {
        if ($this->crawler->filter('.pageHeading h2')->count() > 0) {
            $this->details['title'] = trim($this->crawler->filter('.pageHeading h2')->text());
        }
        if ($this->crawler->filter('#cod')) {
            $this->details['code'] = trim($this->crawler->filter('#cod')->text());
        }
        $this->details['images'] = $this->prepareImages($this->getImages());
        $this->details['properties'] = $this->getProperties();
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
        if ($this->crawler->filter('.descriere_titlu span')->count() <= 0) {
            throw new InvalidPage();
        }
    }

    protected function getImages()
    {
        if ($this->crawler->filter('#pzx td:nth-child(1) img')->count() <= 0 && $this->crawler->filter('#pzx .poze_secundare')->count() <= 0) {
            return array();
        }
        $images = $this->crawler->filter('#pzx .poze_secundare img')->each(function (Crawler $node, $i) {
            return array(
                'thumbnail_url' => $node->attr('src'),
                'overlay_url' => $node->attr('src')
            );
        });
        if ($this->crawler->filter('#pzx td:nth-child(1) a img')->count() > 0) {
            $images[] = [
                'thumbnail_url' => $this->crawler->filter('#pzx td:nth-child(1) a img')->attr('src'),
                'overlay_url' => $this->crawler->filter('#pzx td:nth-child(1) a img')->attr('src'),
            ];
        }
        return $images;
    }

    protected function prepareImages(array $images)
    {
        $result = array();
        foreach ($images as $image) {
            $tmp = $image;
            $tmp['id'] = $this->getMd5();
            if (strpos($tmp['thumbnail_url'], '/thumbs/')) {
                $tmp['thumbnail_url'] = str_replace('/thumbs/', '/mari/', $tmp['thumbnail_url']);
                $tmp['overlay_url'] = $tmp['thumbnail_url'];
            } elseif (strpos($tmp['thumbnail_url'], '/Products/')) {
                $tmp['thumbnail_url'] = str_replace('/Products/', '/mari/', $tmp['thumbnail_url']);
                $tmp['overlay_url'] = $tmp['thumbnail_url'];
            } else {
                continue;
            }
            $result[] = $tmp;
        }
        return $result;
    }

    protected function getProperties()
    {
        if ($this->crawler->filter('.c3')->count() <= 0) {
            return [];
        }
        $properties = $this->crawler->filter('.c3')->each(function (Crawler $node, $i) {
            $parent = $node->parents()->first();
            if ($parent->filter('.c3')->count() <= 0 || $parent->filter('.c4')->count() <= 0) {
                return [];
            }

            return [
                'name' => trim($parent->filter('.c3')->text()),
                'value' => trim($parent->filter('.c4')->text())
            ];
        });

        return $properties;
    }


    protected function getManufacturer()
    {

        return '';
    }

    protected function getDescription()
    {
        if ($this->crawler->filter('.descriere span')->count() > 0) {
            return $this->crawler->filter('.descriere span')->html();
        }
        return '';
    }
}