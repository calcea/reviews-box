<?php

namespace Reviews\PredictBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReviewsPredictBundle:Default:index.html.twig', array('name' => $name));
    }
}
