<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 4/13/2016
 * Time: 8:45 PM
 */

namespace Reviews\DefaultBundle\Repositories\Database;

use Doctrine\ORM\EntityRepository;

class SitesProductsDetails extends EntityRepository
{

    const DEFAULT_LIMIT = 3;

    public function findSimilarities($fingerPrint, $limit = 3, $threshold = 90)
    {
        if (!is_integer($limit)) {
            $limit = self::DEFAULT_LIMIT;
        }
        $conection = $this->_em->getConnection();
        $statement = $conection->prepare("
        SELECT  (1 - (LENGTH(CONV(similarity_hash ^ ?, 10, 2)) -
                LENGTH(REPLACE(CONV(similarity_hash ^ ?, 10, 2), '1', ''))) / LENGTH('1') / 64) * 100 AS comparison, sites_products_details.*
        FROM sites_products_details
        ORDER BY comparison desc LIMIT " . $limit);
        $statement->bindValue(1, $fingerPrint);
        $statement->bindValue(2, $fingerPrint);

        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
    }

}