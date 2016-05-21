<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/23/2016
 * Time: 2:33 PM
 */

namespace Reviews\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{

    public function indexAction($page, $category)
    {
        $service = $this->get('products');
        $filters = array();
        if (!empty($category)) {
            $filters['category'] = $category;
        }
        $products = $service->getPaginated($page, $filters);

        return $this->render('ReviewsDefaultBundle:Products:index.html.twig', array('products' => $products));
    }

}