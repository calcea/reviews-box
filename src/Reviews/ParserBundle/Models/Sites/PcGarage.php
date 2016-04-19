<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/23/2016
 * Time: 9:41 PM
 */

namespace Reviews\ParserBundle\Models\Sites;


use Reviews\ParserBundle\Models\AbstractSite;

class PcGarage extends AbstractSite
{
    const HOSTNAME = 'pcgarage';

    public function parse()
    {
        // TODO: Implement parse() method.
    }

    /**
     * Validate the page content, if is there a product page or not
     * @return mixed
     */
    public function validatePage()
    {
        // TODO: Implement validatePage() method.
    }
}