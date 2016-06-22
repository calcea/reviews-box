<?php

namespace Reviews\DefaultBundle\Controller;

use Camspiers\StatisticalClassifier\Classifier\SVM;
use Camspiers\StatisticalClassifier\DataSource\DataArray;
use Reviews\DefaultBundle\Services\TrainSvm;
use Reviews\ParserBundle\Services\ParseProductPage;
use Reviews\SimilarityBundle\Services\FindSimilarities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction()
    {

//        $source = new DataArray();
//        $source->addDocument('spam', 'Some spam document');
//        $source->addDocument('spam', 'Another spam document');
//        $source->addDocument('ham', 'Some ham document');
//        $source->addDocument('ham', 'Another ham document');
//
//        $classifier = new SVM($source);
//        echo $classifier->is('ham', 'Some ham document'); // bool(true)
//        echo $classifier->classify('Some ham document'); // string "ham"
//        die;
//
//        $doctrine = $this->getDoctrine();
//        $svmService = new TrainSvm($doctrine);
//        $svmService->train();

        return $this->render('ReviewsDefaultBundle:Default:index.html.twig', array('name' => "asd"));
    }

}
