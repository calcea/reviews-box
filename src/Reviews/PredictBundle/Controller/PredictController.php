<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 1/24/2016
 * Time: 11:42 AM
 */

namespace Reviews\PredictBundle\Controller;


use Reviews\PredictBundle\Services\Train\BayesAlgorithm;
use Reviews\PredictBundle\Services\Train\SvmAlgorithm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PredictController extends Controller
{

    public function trainAction()
    {
        set_time_limit(0);
        ini_set("memory_limit", '512M');
        $doctrineContainer = $this->getDoctrine();
        $svmAlgorithm = new SvmAlgorithm($doctrineContainer);
        $svmAlgorithm->train();
//        $bayesAlgorithm = new BayesAlgorithm($doctrineContainer);
//        $bayesAlgorithm->train();
        return $this->render('ReviewsDefaultBundle:Default:index.html.twig', array('name' => "asd"));
    }

    public function classifyAction(){
        set_time_limit(0);
        ini_set("memory_limit", '512M');
        $doctrineContainer = $this->getDoctrine();
        $svmAlgorithm = new \Reviews\PredictBundle\Services\Classify\SvmAlgorithm($doctrineContainer);
        $svmAlgorithm->classify('Bitdefender Total Security 2015, Retail Renewal, 1 an, 1 utilizator');
        return $this->render('ReviewsDefaultBundle:Default:index.html.twig', array('name' => "asd"));
    }

}