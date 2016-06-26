<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 3/22/2016
 * Time: 10:32 PM
 */

namespace Reviews\DefaultBundle\Repositories\Database;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use UserBundle\Entity\User;

class Products extends EntityRepository
{

    const DEFAULT_LIMIT = 3;

    const RECORDS_PER_PAGE = 15;

    public function findSimilarities($fingerPrint, $limit = 3, $threshold = 90)
    {
        if (!is_integer($limit)) {
            $limit = self::DEFAULT_LIMIT;
        }
        $conection = $this->_em->getConnection();
        $statement = $conection->prepare("
        SELECT  (1 - (LENGTH(CONV(similarity_hash ^ ?, 10, 2)) -
                LENGTH(REPLACE(CONV(similarity_hash ^ ?, 10, 2), '1', ''))) / LENGTH('1') / 64) * 100 AS comparison, products.*
        FROM products
        ORDER BY comparison desc LIMIT " . $limit);
        $statement->bindValue(1, $fingerPrint);
        $statement->bindValue(2, $fingerPrint);

        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
    }

    /**
     * Returns the products filtered and paginated
     *
     * @param int $page
     * @param array $filters
     * @param array $orders
     * @return array
     */
    public function getProductsPaginated($page = 1, $filters = array(), $orders = array())
    {
        $query = $this->createQueryBuilder('products')
            ->select('products')
            ->setFirstResult(($page-1) * self::RECORDS_PER_PAGE)
            ->setMaxResults(self::RECORDS_PER_PAGE);
        if(!empty($orders)){
            $query->orderBy('products.' . $orders['field'], $orders['direction']);
        }else{
            $query->orderBy('products.name');
        }
        if (isset($filters['category']) && !empty($filters['category'])) {
            $query->where('products.class1 = :category');
            $query->setParameter('category', $filters['category']);
        }

        if(isset($filters['search']) && !empty($filters['search'])){
            $query->where("products.name like :search");
            $query->orWhere("products.code like :search");
            $query->setParameter('search', '%' . $filters['search'] .'%');
        }

        $paginator = new Paginator($query);
        $totalPages = (int)(count($paginator) / self::RECORDS_PER_PAGE) + 1;

        return array(
            'page' => $page,
            'total_pages' => $totalPages,
            'total_records' => $totalPages * self::RECORDS_PER_PAGE,
            'records_per_page' => self::RECORDS_PER_PAGE,
            'products' => $paginator
        );
    }

    public function getMostAppreciated()
    {
        $query = $this->createQueryBuilder('products')
            ->select('products')
            ->orderBy('products.rating', 'desc')
            ->setMaxResults(self::RECORDS_PER_PAGE);

        return $query->getQuery()->getResult();

    }

    public function getNewest(){
        $query = $this->createQueryBuilder('products')
            ->select('products')
            ->orderBy('products.added', 'desc')
            ->setMaxResults(self::RECORDS_PER_PAGE);
        return $query->getQuery()->getResult();
    }

    public function getRandomProducts($page){
        $query = $this->createQueryBuilder('products')
            ->select('products')
            ->setFirstResult($page - 1)
            ->setMaxResults(self::RECORDS_PER_PAGE);

        return $query->getQuery()->getResult();
    }

    public function getMyProducts(User $user, $page = 1){
        $query = $this->createQueryBuilder('products')
            ->select('products')
            ->innerJoin('products.productDetails', 'pd')
            ->where('pd.user = :user')
            ->orderBy('products.name')
            ->setParameter('user', $user);
        $paginator = new Paginator($query);
        $totalPages = count($paginator);

        return array(
            'page' => $page,
            'total_pages' => $totalPages,
            'total_records' => $totalPages * self::RECORDS_PER_PAGE,
            'records_per_page' => self::RECORDS_PER_PAGE,
            'products' => $paginator
        );
    }

}