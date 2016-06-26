<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/23/2016
 * Time: 2:59 PM
 */

namespace Reviews\DefaultBundle\Services;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Reviews\DefaultBundle\Entity\ProductImages;
use Reviews\DefaultBundle\Entity\Properties;
use Reviews\DefaultBundle\Entity\Sites;
use Reviews\DefaultBundle\Entity\SitesProductsDetails;
use Reviews\ParserBundle\Repositories\Manufacturers;
use Reviews\SimilarityBundle\Services\FindSimilarities;
use Symfony\Component\Security\Core\SecurityContext;
use Webmozart\Assert\Assert;

class Products
{
    private $doctrine;
    private $productsRepository = null;

    private $user = null;

    public function __construct(Registry $doctrine, SecurityContext $context)
    {
        $this->user = $context->getToken()->getUser();
        $this->doctrine = $doctrine;
        $this->productsRepository = $doctrine->getRepository('ReviewsDefaultBundle:Products');
    }

    public function getPaginated($page = 1, $filters = array(), $orders = array())
    {
        return $this->productsRepository->getProductsPaginated($page, $filters, $orders);
    }

    public function getDetailsById($id)
    {
        Assert::string($id);
        return $this->productsRepository->find($id);
    }

    public function updateProduct(\Reviews\DefaultBundle\Entity\Products $product, $dataToUpdate)
    {

        if (isset($dataToUpdate['description'])) {
            $product->setDescription($dataToUpdate['description']);
        }
        if (isset($dataToUpdate['title'])) {
            $product->setName($dataToUpdate['title']);
        }
        if (isset($dataToUpdate['properties'])) {
            $this->removeAllProperties($product);
            foreach ($dataToUpdate['properties'] as $property) {
                $obj = new Properties();
                $obj->setName($property['name']);
                $obj->setValue($property['value']);
                $obj->setProduct($product);
                $product->addProperty($obj);
            }
        }
        if (isset($dataToUpdate['images'])) {
            $this->removeAllImages($product);
            foreach ($dataToUpdate['images'] as $image) {
                $obj = new ProductImages();
                $obj->setUrlOverlayPicture($image['overlay_url']);
                $obj->setUrlThumbnailPicture($image['thumbnail_url']);
                $obj->setPictureId($image['id']);
                $obj->setProduct($product);
                $product->addImage($obj);
            }
        }

        $this->doctrine->getManager()->persist($product);
        $this->doctrine->getManager()->flush();
        $this->insertIntoSitesProducts($product, $dataToUpdate);
        return $product;
    }

    public function insertIntoSitesProducts(\Reviews\DefaultBundle\Entity\Products $product, array $data)
    {
        $siteProduct = new SitesProductsDetails();
        $siteProduct->setProduct($product);
        $siteProduct->setHtmlDescription($data['description']);
        $site = $this->doctrine->getRepository('ReviewsDefaultBundle:Sites')->find($data['site_id']);
        $siteProduct->setSite($site);
        $siteProduct->setDetails($data['title']);
        $siteProduct->setProductUrl($data['url']);
        $siteProduct->setAdded(new \DateTime());
        $siteProduct->setUser($this->user);
        $this->doctrine->getManager()->persist($siteProduct);
        $this->doctrine->getManager()->flush();
    }

    protected function getFingerPrint($title)
    {
        $service = new FindSimilarities($this->doctrine, $title);
        return $service->getFingerPrint();
    }

    public function insertProduct(array $data)
    {
        $product = new \Reviews\DefaultBundle\Entity\Products();
        if (isset($data['description'])) {
            $product->setDescription($data['description']);
        }
        if (isset($data['title'])) {
            $product->setName($data['title']);
        }
        if (isset($data['properties'])) {
            $product->removeAllProperties();
            foreach ($data['properties'] as $property) {
                $obj = new Properties();
                $obj->setName($property['name']);
                $obj->setValue($property['value']);
                $obj->setProduct($product);
                $product->addProperty($obj);
            }
        }
        if (isset($data['images'])) {
            $product->removeAllImages();
            foreach ($data['images'] as $image) {
                $obj = new ProductImages();
                $obj->setUrlOverlayPicture($image['overlay_url']);
                $obj->setUrlThumbnailPicture($image['thumbnail_url']);
                $obj->setPictureId($image['id']);
                $obj->setProduct($product);
                $product->addImage($obj);
            }
        }
        if (isset($data['id'])) {
            $product->setProductId($data['id']);
        }
        if (isset($data['category'])) {
            $category = $this->doctrine->getRepository('ReviewsDefaultBundle:Categories')->find($data['category']);
            $product->setClass1($category);
            $product->setClass2($category);
            $product->setClass3($category);
        }
        if (isset($data['code'])) {
            $product->setCode($data['code']);
        }
        $product->setSimilarityHash($this->getFingerPrint($data['title']));
        $product->setAdded(new \DateTime());
        $product->setManufacturer($this->getManufacturer($data));
        $product->setDeleted(0);
        $this->doctrine->getManager()->persist($product);
        $this->doctrine->getManager()->flush();

        $this->insertIntoSitesProducts($product, $data);

        return $product;
    }

    /**
     * @param $data
     * @return array|\Reviews\DefaultBundle\Entity\Manufacturers
     * @throws \Exception
     */
    protected function getManufacturer($data)
    {
        if (!isset($data['manufacturer'])) {
            throw new \Exception('Empty manufacturer', 110);
        }
        $manufacturer = $this->doctrine->getRepository('ReviewsDefaultBundle:Manufacturers')->findBy(array('name' => $data['manufacturer']));
        if (empty($manufacturer)) {
            $manufacturers = new Manufacturers();
            $id = $manufacturers->getManufacturerIdByProductDescription($data['title']);
            if (!empty($id)) {
                return $this->doctrine->getRepository('ReviewsDefaultBundle:Manufacturers')->find($id);
            }
            $manufacturer = new \Reviews\DefaultBundle\Entity\Manufacturers();
            $manufacturer->setName($data['manufacturer']);
            $manufacturer->setManufacturerId(md5(microtime() . rand(999, 999999) . rand(1, 999)));
            return $manufacturer;
        }
        return $manufacturer[0];
    }

    public function getMostAppreciated()
    {
        return $this->productsRepository->getMostAppreciated();
    }

    public function getNewest()
    {
        return $this->productsRepository->getNewest();
    }

    public function getRandomProducts($page = 1)
    {
        return $this->productsRepository->getRandomProducts($page);
    }

    public function getMyProducts($page = 1)
    {
        return $this->productsRepository->getMyProducts($this->user, $page);
    }

    private function removeAllImages(\Reviews\DefaultBundle\Entity\Products $product)
    {
        $em = $this->doctrine->getManager();
        foreach ($product->getImages()->toArray() as $item) {
            $em->remove($item);
        }
        $product->removeAllImages();
        $em->flush();
    }

    private function removeAllProperties(\Reviews\DefaultBundle\Entity\Products $product)
    {
        $em = $this->doctrine->getManager();
        foreach ($product->getProperties()->toArray() as $item) {
            $em->remove($item);
        }
        $product->removeAllProperties();
        $em->flush();
    }
}