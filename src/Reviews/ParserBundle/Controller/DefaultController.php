<?php

namespace Reviews\ParserBundle\Controller;

use Reviews\ParserBundle\Services\UpdateFromJson\Emag;
use Reviews\ParserBundle\Services\UpdateFromJson\Evomag;
use Reviews\ParserBundle\Services\UpdateFromJson\Flanco;
use Reviews\ParserBundle\Services\UpdateFromJson\PcGarage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Reviews\ParserBundle\Services\Import;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('ReviewsParserBundle:Default:index.html.twig', array('name' => "asd"));
    }

    public function updateFromJsonAction(){

        set_time_limit(0);
        $doctrine = $this->getDoctrine();
//        $parser = new Flanco($doctrine);
//        $parser = new Evomag($doctrine);
//        $parser = new Emag($doctrine);
        $parser = new PcGarage($doctrine);
        $count = $parser->update();
        return new JsonResponse(array('count' => $count));
    }
}
