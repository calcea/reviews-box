<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 1/24/2016
 * Time: 10:33 AM
 */

namespace Reviews\PredictBundle\Services;

use Symfony\Component\Yaml\Parser;

/**
 * Description of Configs
 *
 * @author george.tutuianu
 */
class Configs
{
    /**
     * Configs parsed from config file
     * @var array
     */
    private static $configInstance = null;

    /**
     * Get params for the SVM
     *
     * @return array
     */
    public static function getSVMParams()
    {
        $configs = self::getConfigInstance();
        return $configs['SVM'];
    }

    /**
     * Get params for the Bayes
     *
     * @return array
     */
    public static function getBayesParams()
    {
        $configs = self::getConfigInstance();
        return $configs['Bayes'];
    }

    /**
     * Get params for the Stemmer
     *
     * @return array
     */
    public static function getStemmerParams()
    {
        $configs = self::getConfigInstance();
        return $configs['Stemmer'];
    }

    /**
     * Get an instance of the config
     *
     * @return array
     */
    private static function getConfigInstance()
    {
        if (is_null(self::$configInstance)) {
            self::initializeConfigs();
        }

        return self::$configInstance;
    }

    /**
     * Parse the config file and store the values
     */
    private static function initializeConfigs()
    {
        $configsPath = realpath(sprintf('%s/../Resources/config', __DIR__));
        $filePath = sprintf('%s/parameters.yml', $configsPath);

        $ymlParser = new Parser();
        $value = $ymlParser->parse(file_get_contents($filePath));

        self::$configInstance = $value;
    }
}
