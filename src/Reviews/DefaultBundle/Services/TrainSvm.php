<?php
namespace Reviews\DefaultBundle\Services;

use CacheCache\Backends\File;
use CacheCache\Cache;
use Camspiers\StatisticalClassifier\Classifier\SVM;
use Camspiers\StatisticalClassifier\DataSource\DataArray;
use Camspiers\StatisticalClassifier\Model\SVMCachedModel;
use Camspiers\StatisticalClassifier\Normalizer\Token\PhpStemmer;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * Created by PhpStorm.
 * User: george
 * Date: 1/10/2016
 * Time: 11:28 AM
 */
class TrainSvm
{

    private $doctrineContainer = null;
    private $enittyManager = null;

    public function __construct(Registry $doctrineContainer)
    {
        $this->doctrineContainer = $doctrineContainer;
        $this->enittyManager = $doctrineContainer->getEntityManager();
    }

    protected function getTrainData()
    {
        set_time_limit(0);
        ini_set("memory_limit", "512M");
        $productsRepository = $this->doctrineContainer->getRepository("ReviewsDefaultBundle:Products");
        $products = $productsRepository->findAll();
        $trainData = array();
        foreach ($products as $product) {
            /* @var $product \Reviews\DefaultBundle\Entity\Products */
            if (empty($product->getDescription())) {
                continue;
            }
            $trainData[] = array(
                'category' => $product->getClass1(),
                'description' => $product->getDescription()
            );

        }
        return $trainData;
    }


    public function train()
    {
        $data = $this->getTrainData();
        $source = new DataArray();
        foreach ($data as $item) {
            $source->addDocument($item['category'], $item['description']);
        }
        $stemmer = new PhpStemmer('romanian');
        $model = new SVMCachedModel(
            __DIR__ . '/model.svm',
            new Cache(
                new File(
                    array(
                        'dir' => __DIR__
                    )
                )
            )
        );
        $classifier = new SVM($source, $model, null, null, $stemmer, null);
        dump($classifier->classify(''));
        die;
    }

}