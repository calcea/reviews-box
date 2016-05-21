<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 2/20/2016
 * Time: 12:17 PM
 */

namespace Reviews\SimilarityBundle\Services\StopWords;


use Webmozart\Assert\Assert;

abstract class RepositoryAbstract
{
    /**
     * An array that contains all stopwords
     * @var array
     */
    private $stopWords = array();

    /**
     * RepositoryAbstract constructor.
     * @param array $stopWords
     */
    private function __construct(array $stopWords)
    {
        $this->stopWords = $stopWords;
    }

    /**
     * Construct object from string with stopwords delimited by delimiter parameter
     *
     * @param $stopWordsString
     * @param $delimiter
     * @return RepositoryAbstract
     */
    public static function fromString($stopWordsString, $delimiter)
    {
        Assert::string($stopWordsString, 'The first parameter must be a string. Got: %s');
        $stopWords = explode($delimiter, $stopWordsString);

        return new static($stopWords);
    }

    /**
     * Construct object from array with stopwords
     *
     * @param array $stopWords
     * @return RepositoryAbstract
     */
    public static function fromArray(array $stopWords)
    {
        return new static($stopWords);
    }

    /**
     * Test if the repository contains given word
     *
     * @param $word
     * @return bool
     */
    public function contains($word)
    {
        Assert::string($word, 'The word parameter must be a string. Got: %s');
        return in_array($word, $this->stopWords);
    }

    /**
     * Return repository language
     *
     * @return mixed
     */
    abstract public function getLanguage();
}