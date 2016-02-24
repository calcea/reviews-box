<?php

namespace Reviews\ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Reviews\ParserBundle\Services\Import;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('ReviewsParserBundle:Default:index.html.twig', array('name' => "asd"));
    }
}
