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

    public function addProductAction(){
        $url = 'http://www.altex.ro/laptop-asus-rog-g551vw-fy179d-intelr-coretm-i7-6700hq-pana-la-3-5ghz-15-6-full-hd-8gb-1tb-nvidia-geforce-gtx-960m-4gb-gddr5-free-dos';
        $parserService = new ParseProductPage($url);
        $details = $parserService->parse();
        $similarityService = new FindSimilarities($this->getDoctrine(), $details['title']);
        /**
        * TODO dump addded
        */
        dump($similarityService->getSimilarProducts());
        die();

        return new JsonResponse();
    }

}
