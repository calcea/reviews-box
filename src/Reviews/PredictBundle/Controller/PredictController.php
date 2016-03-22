<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 1/24/2016
 * Time: 11:42 AM
 */

namespace Reviews\PredictBundle\Controller;


use Reviews\PredictBundle\Services\SVM\Classify;
use Reviews\PredictBundle\Services\SVM\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PredictController extends Controller
{

    public function classifyAction($text)
    {
        set_time_limit(0);
        ini_set("memory_limit", '2524M');
        try {
            $doctrineContainer = $this->getDoctrine();
            $svmAlgorithm = new Classify(new Model($doctrineContainer, $this->get('cache')));
            $category = $svmAlgorithm->classify($text);
        } catch (Exception $e) {
            dump($e);
            die;
        }
        return new JsonResponse(array('category' => $category));
    }

}