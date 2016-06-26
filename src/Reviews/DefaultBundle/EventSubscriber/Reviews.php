<?php
/**
 * Created by PhpStorm.
 * User: george
 * Date: 6/26/2016
 * Time: 11:06 AM
 */

namespace Reviews\DefaultBundle\EventSubscriber;


use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class Reviews implements EventSubscriber
{

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [Events::postPersist];
    }

    public function postPersist(LifecycleEventArgs $args){
        $entityManager = $args->getObjectManager();
        $object = $args->getObject();
        if($object instanceof \Reviews\DefaultBundle\Entity\Reviews){
            $product = $object->getProduct();
            $product->setRating($product->getAverageRating());
            $entityManager->persist($product);
            $entityManager->flush();
        }
    }
}