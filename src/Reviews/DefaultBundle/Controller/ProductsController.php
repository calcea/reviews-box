<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/23/2016
 * Time: 2:33 PM
 */

namespace Reviews\DefaultBundle\Controller;

use Cocur\Slugify\Slugify;
use Reviews\DefaultBundle\Entity\Products;
use Reviews\ParserBundle\Exceptions\InvalidPage;
use Reviews\ParserBundle\Exceptions\InvalidUrl;
use Reviews\ParserBundle\Exceptions\UnknownSite;
use Reviews\ParserBundle\Services\ParseProductPage;
use Reviews\PredictBundle\Services\SVM\Classify;
use Reviews\PredictBundle\Services\SVM\Model;
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
        $filters['search'] = $request->get('search', '');
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
        set_time_limit(0);
        ini_set('memory_limit', '1024M');
        $url = $request->get('url');
        $response = [
            'success' => 0,
            'error' => 0
        ];
        $products = [];
        try {
            $parser = new ParseProductPage($url);
            $data = $parser->parse();
            $similarityService = new FindSimilarities($this->getDoctrine(), $data['title']);
            $products = $similarityService->getSimilarProducts();
            if (isset($data['code'])) {
                $productsRepository = $this->getDoctrine()->getRepository('ReviewsDefaultBundle:Products');
                $product = $productsRepository->findBy(array('code' => $data['code']));
                if ($product && !isset($products[$product[0]->getProductId()])) {
                    $products = array_merge($product, $products);
                }
            }
            $response['success'] = 1;
        } catch (InvalidUrl $e) {
            $response['error'] = 1;
            $response['code'] = 101;
        } catch (InvalidPage $e) {
            $response['error'] = 1;
            $response['code'] = 102;
        } catch (UnknownSite $e) {
            $response['error'] = 1;
            $response['code'] = 103;
        } catch (\Exception $e) {
            $response['error'] = 1;
            $response['code'] = 104;
        }

        return new JsonResponse(['products' => $this->convertProductsToArray($products), 'response' => $response]);
    }

    public function addNewProductAction(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');
        $response = [
            'success' => 0,
            'error' => 0
        ];
        $url = $request->get('url');
        $parser = new ParseProductPage($url);
        try {
            $data = $parser->parse();
            if (!isset($data['id'])) {
                throw new UnknownSite();
            }
            if (isset($data['code'])) {
                $productsRepository = $this->getDoctrine()->getRepository('ReviewsDefaultBundle:Products');
                $product = $productsRepository->findBy(array('code' => $data['code']));
                $productService = $this->get('products');
                if ($product) {
                    $productObj = $productService->updateProduct($product[0], $data);
                } else {
                    $category = $this->getProductCategory($data['title']);
                    $data['category'] = $category;
                    $productObj = $productService->insertProduct($data);
                }
            }
            $slugify = new Slugify();
            $response['success'] = 1;
            $response['product_url'] = $this->get('router')->generate('products_show', array(
                'id' => $productObj->getProductId(),
                'slugName' => $slugify->slugify($productObj->getName())
            ));
        } catch (InvalidUrl $e) {
            $response['error'] = 1;
            $response['code'] = 101;
        } catch (InvalidPage $e) {
            $response['error'] = 1;
            $response['code'] = 102;
        } catch (UnknownSite $e) {
            $response['error'] = 1;
            $response['code'] = 103;
        } catch (\Exception $e) {
            $response['error'] = 1;
            $response['code'] = 104;
        }

        return new JsonResponse($response);
    }

    private function getProductCategory($text)
    {
        $doctrineContainer = $this->getDoctrine();
        $svmAlgorithm = new Classify(new Model($doctrineContainer, $this->get('cache')));
        return $svmAlgorithm->classify($text);
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
            'recordsPerPage' => $recordsPerPage,
            'totalPages' => (int)($totalPages / $recordsPerPage) + 1
        ];
    }

    public function saveReviewAction(Request $request, $id)
    {
        $product = $this->getDoctrine()->getRepository('ReviewsDefaultBundle:Products')->find($id);
        $review = $request->get('review');
        $score = $request->get('score');
        $slugify = new Slugify();
        $service = $this->get('reviews');
        $service->saveReview($product, $review, $score);
        $url = $this->get('router')->generate('products_show',
            array('id' => $id, 'slugName' => $slugify->slugify($product->getName())));
        return $this->redirect($url);
    }

    public function myProductsAction(Request $request, $page = 1){
        $service = $this->get('products');
        $products = $service->getMyProducts($page);
        return $this->render('ReviewsDefaultBundle:Products:my-products.html.twig',
            array('products' => $products, 'pagination' => $this->getPagination($products)));
    }
}