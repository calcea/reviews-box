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
        $randomPage = rand(1,1000);
        $service = $this->get('products');
        return $this->render('ReviewsDefaultBundle:Default:index.html.twig',
            array(
                'mostAppreciated' => $service->getMostAppreciated(),
                'randomProducts' => $service->getPaginated($randomPage)['products'],
                'newestProducts' => $service->getNewest()
            )
        );
    }

}
