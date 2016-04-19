<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/29/2016
 * Time: 9:08 PM
 */

namespace Reviews\ParserBundle\Services\UpdateFromJson;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Reviews\DefaultBundle\Entity\Products;
use Reviews\DefaultBundle\Entity\Sites;
use Reviews\DefaultBundle\Entity\SitesProductsDetails;
use Reviews\ParserBundle\Repositories\Manufacturers;

abstract class AbstractUpdater
{
    const SITE_ID = 0;
    /**
     * @var Registry|null
     */
    protected $doctrineContainer = null;
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager|null|object
     */
    protected $entityManager = null;
    /**
     * @var null|Manufacturers
     */
    protected $manufacturersRepository = null;

    /**
     * AbstractUpdater constructor.
     * @param Registry $doctrineContainer
     */
    public function __construct(Registry $doctrineContainer)
    {
        $this->doctrineContainer = $doctrineContainer;
        $this->entityManager = $doctrineContainer->getManager();
        $this->manufacturersRepository = new Manufacturers();
    }

    /**
     * Parse file and return products
     * @return mixed
     */
    abstract public function parse();

    /**
     * Updates database with data from parsed file
     * @return int
     */
    public function update()
    {
        $data = $this->parse();

        $productsDoctrineRepository = $this->doctrineContainer->getRepository("ReviewsDefaultBundle:Products");

        $countUnmatches = 0;
        $countMatches = 0;
        foreach ($data as $item) {
            /* @var $product [0] \Reviews\DefaultBundle\Entity\Products */
            $product = $productsDoctrineRepository->findBy(array('code' => $item['code']));
            if (empty($product)) {
                $product = $this->insertProduct($item);
                if (!$product) {
                    $countUnmatches++;
                    continue;
                }
            } else {
                $product = $product[0];
            }
            $this->insertSiteProductDetails($product, $item);
            $countMatches++;

        }

        dump("Unmached:" . $countUnmatches);
        dump("Matches:" . $countMatches);
        die;
        return $countUnmatches;
    }

    /**
     * Returns the current site object
     * @return mixed
     */
    abstract protected function getSite();

    /**
     * Inserts an entry into products table
     * @param array $item
     * @return bool|Products
     */
    protected function insertProduct(array $item)
    {
        $categoriesDoctrineRepository = $this->doctrineContainer->getRepository("ReviewsDefaultBundle:Categories");
        $manufacturersDoctrineRepository = $this->doctrineContainer->getRepository("ReviewsDefaultBundle:Manufacturers");
        $productId = md5(rand(1000, 9999999) . uniqid() . microtime() . 'salt123salt123salt123salt123salt123salt123');
        $product = new Products();
        $date = new \DateTime();
        if (!$manufacturerId = $this->manufacturersRepository->getManufacturerIdByProductDescription($item['name'])) {
            return false;
        }
        $category = $categoriesDoctrineRepository->find($item['category']);
        $manufacturer = $manufacturersDoctrineRepository->find($manufacturerId);
        $item['manufacturer_id'] = $manufacturerId;
        $product->setProductId($productId);
        $product->setAdded($date);
        $product->setClass1($category);
        $product->setCode($item['code']);
        $product->setName($item['name']);
        $product->setDescription($item['name']);
        $product->setDeleted(false);
        $product->setManufacturer($manufacturer);

        $this->entityManager->persist($product);

        return $product;

    }

    /**
     * Inserts an entry into sites_products_details table
     * @param Products $product
     * @param array $item
     */
    protected function insertSiteProductDetails(Products $product, array $item)
    {
        $sitesProductsRepository = $this->doctrineContainer->getRepository('ReviewsDefaultBundle:SitesProductsDetails');
        $obj = $sitesProductsRepository->findBy(array(
            'productId' => $product->getProductId(),
            'site' => $this->getSite()
        ));
        if (!empty($obj)) {
            return;
        }
        $date = new \DateTime();
        $product->setName($item['name']);
        $siteProduct = new SitesProductsDetails();
        $siteProduct->setProductId($product->getProductId());
        $siteProduct->setSite($this->getSite());
        $siteProduct->setPrice($item['price']);
        $siteProduct->setProductUrl($item['page_url']);
        $siteProduct->setDetails($item['name']);
        $siteProduct->setAdded($date);
        $this->entityManager->persist($siteProduct);
        $this->entityManager->flush();
    }

}
