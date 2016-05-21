<?php

namespace Reviews\SimilarityBundle\Services\StopWords;

use Webmozart\Assert\Assert;

/**
 * Created by PhpStorm.
 * User: george
 * Date: 2/20/2016
 * Time: 12:10 PM
 */
class Remove
{
    /**
     * @var RepositoryAbstract
     */
    private $stopWordsRepository;

    /**
     * Remove constructor.
     * @param RepositoryAbstract $stopwords
     */
    public function __construct(RepositoryAbstract $stopwords)
    {
        $this->stopWordsRepository = $stopwords;
    }

    /**
     * Return repository that contains the stopwords
     * @return RepositoryAbstract
     */
    public function getStopWordsRepository()
    {
        return $this->stopWordsRepository;
    }

    /**
     * Remove all stopwords from a string
     * @param $text
     * @return string
     */
    public function remove($text)
    {
        Assert::string($text, 'The given parameter must be a string. Got: %s');
        $textTokens = explode(' ', $text);
        foreach ($textTokens as $key => $textToken) {
            if ($this->stopWordsRepository->contains($textToken)) {
                unset($textTokens[$key]);
            }
        }
        return implode(' ', $textTokens);
    }

}