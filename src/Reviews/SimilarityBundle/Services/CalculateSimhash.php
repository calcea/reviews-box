<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/7/2016
 * Time: 9:22 PM
 */

namespace Reviews\SimilarityBundle\Services;


use Reviews\SimilarityBundle\Repositories\AbstractRepository;
use Reviews\SimilarityBundle\Repositories\SimHashStrings;
use Tga\SimHash\Extractor\ExtractorInterface;
use Tga\SimHash\SimHash;

class CalculateSimhash
{
    private $repository = null;
    private $simHashService = null;
    private $extractor = null;

    /**
     * CalculateSimhash constructor.
     * @param AbstractRepository $repository
     * @param ExtractorInterface $extractor
     */
    public function __construct(AbstractRepository $repository, ExtractorInterface $extractor)
    {
        $this->extractor = $extractor;
        $this->repository = $repository;
        $this->simHashService = new SimHash();
    }

    /**
     * Calculates the sim hash for every element from repository
     */
    public function calculate()
    {
        $data = $this->repository->toArray();
        $fingerPrint = null;
        foreach ($data as $id => $item) {
            $fingerPrint = $this->simHashService->hash($this->extractor->extract($item['text']), SimHash::SIMHASH_64);
            $binary = $fingerPrint->getBinary();
            $gmp = \gmp_init($binary, 2);
            $simHash = \gmp_strval($gmp);
            $item['sim_hash'] = $simHash;
            $this->repository->replace($id, $item);
        }
    }

    /**
     * Returns the current repository
     * @return null|AbstractRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }
}