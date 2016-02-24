<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 2/20/2016
 * Time: 2:03 PM
 */

namespace Reviews\SimilarityBundle\Services\SimHash\Comparator;


use Tga\SimHash\Comparator\ComparatorInterface;
use Tga\SimHash\Fingerprint;

class SimpleComparator implements ComparatorInterface
{

    /**
     * Compare the two fingerprints and return a similarity index between 0 and 1.
     *
     * @param Fingerprint $fp1
     * @param Fingerprint $fp2
     * @return float
     */
    public function compare(Fingerprint $fp1, Fingerprint $fp2)
    {
        if ($fp1->getSize() !== $fp2->getSize()) {
            throw new \LogicException(sprintf(
                'The fingerprints passed to the Simple comparator have different sizes (%s bits and %s bits).',
                $fp1->getSize(), $fp2->getSize()
            ));
        }
        $size = $fp1->getSize();
        $countDifferences = substr_count(decbin($fp1->getDecimal() ^ $fp2->getDecimal()), '1');

        return $this->computeSimilarityIndex($countDifferences, $size);
    }


    /**
     * Similarity index
     *
     * @param int $countDifferences
     * @return float
     */
    protected function computeSimilarityIndex($countDifferences, $size)
    {
        return (1 - $countDifferences / $size) * 100;
    }
}