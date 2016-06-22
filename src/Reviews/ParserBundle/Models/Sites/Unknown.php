<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/14/2016
 * Time: 8:04 PM
 */

namespace Reviews\ParserBundle\Models\Sites;


use Reviews\ParserBundle\Models\AbstractSite;

class Unknown extends AbstractSite
{

    protected $details = array();

    /**
     * Parse page content and returns the product details
     * @return mixed
     */
    public function parse()
    {
        if ($this->crawler->filter('title')) {
            $this->details['title'] = $this->crawler->filter('title')->text();
        }
        return $this->details;
    }

    /**
     * Validate the page content, if is there a product page or not
     * @return mixed
     */
    public function validatePage()
    {
    }

    public function getTitle()
    {
        if (isset($this->details['title'])) {
            return $this->details['title'];
        }
        return '';
    }
}