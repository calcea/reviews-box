<?php

namespace Reviews\DefaultBundle\Controller;

use Camspiers\StatisticalClassifier\Classifier\SVM;
use Camspiers\StatisticalClassifier\DataSource\DataArray;
use Reviews\DefaultBundle\Services\TrainSvm;
use Reviews\ParserBundle\Services\ParseProductPage;
use Reviews\SimilarityBundle\Services\FindSimilarities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $randomPage = rand(1, 1000);
        $service = $this->get('products');
        return $this->render('ReviewsDefaultBundle:Default:index.html.twig',
            array(
                'mostAppreciated' => $service->getMostAppreciated(),
                'randomProducts' => $service->getRandomProducts($randomPage),
                'newestProducts' => $service->getNewest()
            )
        );
    }

    public function contactAction()
    {
        return $this->render('ReviewsDefaultBundle:Default:contact.html.twig');
    }

    public function aboutUsAction()
    {
        return $this->render('ReviewsDefaultBundle:Default:about-us.html.twig');
    }

    public function instructionsAction(Request $request)
    {
        $sites = $this->getDoctrine()->getRepository('ReviewsDefaultBundle:Sites')->findAll();

        return $this->render('ReviewsDefaultBundle:Default:instructions.html.twig', array(
            'sites' => $sites
        ));
    }
}
