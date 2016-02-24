<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 2/20/2016
 * Time: 12:49 PM
 */

namespace Reviews\SimilarityBundle\Services\StopWords;


class RomanianRepository extends RepositoryAbstract
{

    /**
     * Return repository language
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return 'ro';
    }
}