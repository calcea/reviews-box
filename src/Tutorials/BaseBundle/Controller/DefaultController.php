<?php

namespace Tutorials\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TutorialsBaseBundle:Default:index.html.twig', array('name' => "George"));
    }
}
