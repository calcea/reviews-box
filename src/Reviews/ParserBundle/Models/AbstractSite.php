<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/23/2016
 * Time: 9:42 PM
 */

namespace Reviews\ParserBundle\Models;


use Reviews\ParserBundle\Exceptions\InvalidUrl;
use Reviews\ParserBundle\Models\WebPageGrabber;
use Symfony\Component\DomCrawler\Crawler;
use Webmozart\Assert\Assert;

abstract class AbstractSite
{

    /**
     * Url for parse
     * @var null
     */
    protected $url = null;
    /**
     * The parsed product details
     * @var array
     */
    protected $details = array();
    /**
     * @var null|WebPageGrabber
     */
    protected $pageGrabber = null;
    /**
     * @var null|Crawler
     */
    protected $crawler = null;

    /**
     * AbstractSite constructor.
     * @param $url
     */
    public function __construct($pageContent, $url='')
    {
        $this->url = $url;
        $this->crawler = new Crawler($pageContent);
        $this->validatePage();
        $this->parse();
    }

    protected function getMd5(){
        return md5(microtime() . rand(99, 999999) . rand(999999, 99999999). rand(99999999, 99999999 + rand(1, 2016)) . '12321412441254353');
    }

    /**
     * Parse page content and returns the product details
     * @return mixed
     */
    abstract public function parse();

    /**
     * Validate the page content, if is there a product page or not
     * @return mixed
     */
    abstract public function validatePage();

}