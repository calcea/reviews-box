<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/23/2016
 * Time: 11:01 PM
 */

namespace Reviews\ParserBundle\Services;


use Reviews\ParserBundle\Exceptions\InvalidUrl;
use Reviews\ParserBundle\Models\AbstractSite;
use Reviews\ParserBundle\Models\Sites\Unknown;
use Reviews\ParserBundle\Services\SiteFactory;
use Webmozart\Assert\Assert;

class ParseProductPage
{
    /**
     * @var string
     */
    protected $url;
    /**
     * @var AbstractSite
     */
    protected $model;

    /**
     * ParseProductPage constructor.
     * @param $url
     */
    public function __construct($url)
    {
        Assert::string($url);
        $this->url = $url;
        $this->validateUrl();
        $this->model = SiteFactory::factory($url);
    }

    /**
     * Parse url and return the product details
     */
    public function parse()
    {
        return $this->model->parse();
    }

    /**
     * Test if the url is valid
     * @return bool
     */
    protected function validateUrl()
    {
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",
            $this->url)
        ) {
            throw new InvalidUrl();
        }
    }

    public function isUnknown()
    {
        return $this->model instanceof Unknown;
    }

}