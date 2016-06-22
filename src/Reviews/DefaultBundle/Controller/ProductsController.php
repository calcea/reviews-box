<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/23/2016
 * Time: 2:33 PM
 */

namespace Reviews\DefaultBundle\Controller;

use Reviews\DefaultBundle\Entity\Products;
use Reviews\ParserBundle\Services\ParseProductPage;
use Reviews\SimilarityBundle\Services\FindSimilarities;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{

    public function indexAction(Request $request, $category = '', $page = 1)
    {
        $service = $this->get('products');
        $filters = array();
        if (!empty($category)) {
            $filters['category'] = $category;
        }
        $products = $service->getPaginated($page, $filters);
        return $this->render('ReviewsDefaultBundle:Products:index.html.twig',
            array('products' => $products, 'pagination' => $this->getPagination($products)));
    }


    public function showAction(Request $request, $id)
    {
        $service = $this->get('products');
        $product = $service->getDetailsById($id);
        $similarityService = new FindSimilarities($this->getDoctrine(), $product->getName(), 80, 10);
        $relatedProducts = $similarityService->getSimilarProducts();
        return $this->render('ReviewsDefaultBundle:Products:show.html.twig',
            array(
                'product' => $product,
                'relatedProducts' => $this->removeProductFromRelatedProducts($relatedProducts, $id)
            ));
    }


    public function addProductAction(Request $request)
    {
        $url = $request->get('url');
        $parser = new ParseProductPage($url);
        $data = $parser->parse();
        $similarityService = new FindSimilarities($this->getDoctrine(), $data['title']);
        $products = $similarityService->getSimilarProducts();
        return new JsonResponse(['products' =>$this->convertProductsToArray($products)]);
    }

    private function convertProductsToArray($products)
    {
        $data = [];
        foreach ($products as $product) {
            $data[] = $product->toArray();
        }

        return $data;
    }

    private function removeProductFromRelatedProducts($products, $removedProductId)
    {
        $data = [];
        foreach ($products as $key => $product) {
            /* @var $product Products */
            if ($product->getProductId() != $removedProductId && !in_array($product->getProductId(), $data)) {
                $data[$product->getProductId()] = $product;
            }
        }
        return $data;
    }

    private function getPagination(array $products)
    {
        $currentPage = $products['page'];
        $totalPages = $products['total_pages'];
        $records = $products['total_records'];
        $recordsPerPage = $products['records_per_page'];
        $previous = $currentPage == 1 ? null : $currentPage - 1;
        $next = $currentPage < $totalPages ? $currentPage + 1 : null;

        return [
            'previous' => $previous,
            'page1' => $currentPage == 1 ? $currentPage : $currentPage - 1,
            'page2' => $currentPage > 1 ? $currentPage : $currentPage + 1,
            'page3' => $currentPage == $totalPages ? $currentPage : ($currentPage == 1) ? $currentPage + 2 : $currentPage + 1,
            'next' => $next,
            'active' => $currentPage,
            'currentResults' => $currentPage == $totalPages ? $records : $recordsPerPage * $currentPage,
            'totalRecords' => $records,
            'recordsPerPage' => $recordsPerPage
        ];
    }
}