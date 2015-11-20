<?php

namespace Tutorials\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Request;


class NewsController extends Controller
{
    public function indexAction(Request $request)
    {
        $news = new \Tutorials\BaseBundle\Entity\News();

        $builder = $this->createFormBuilder($news)
            ->add("media", "sonata_media_type", array(
                "provider" => "sonata.media.provider.image",
                "context" => "engine"
            ))
            ->add("name", "text")
            ->add("description", "text")
            ->add("submit", "submit")
            ->getForm();

        if($request->getMethod() == "POST"){
            $builder->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $data = $builder->getData();
            $media = $data->getMedia();
            $data->setMedia(null);
            $data->setUser(10);
            $em->persist($media);
            $em->flush();
            $data->setMediaId($media->getId());
//            dump($data);die;
            $em->persist($data);
            $em->flush();
            $builder->getData();
        }

        return $this->render('TutorialsBaseBundle:News:index.html.twig', array(
            'form' => $builder->createView(),
        ));
    }

    public function addAction(Request $request)
    {


        $params = $request->request->all();

        echo "<pre>";
        print_r($params);
        die();
    }
}
