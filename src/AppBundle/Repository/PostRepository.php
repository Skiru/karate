<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 01.08.2017
 * Time: 21:12
 */

namespace AppBundle\Repository;
use DateTime;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository{

    public function getQueryBuilder(array $params = array()) {

        $qb = $this->createQueryBuilder('p')
            ->select('p, c, t')
            ->leftJoin('p.category', 'c')
            ->leftJoin('p.tags','t');

        if (!empty($params['status'])) {
            $qb->where('p.publishedDate <= :currDate AND p.publishedDate IS NOT NULL')
                ->setParameter('currDate', new DateTime());
        } else if ('unpublished' == $params['status']) {
            $qb->where('p.publishedDate > :currDate OR p.publishedDate IS NULL')
                ->setParameter('currDate', new DateTime());

        }

        if (!empty($params['orderBy'])) {
            $orderDir = !empty($params['orderDir']) ? $params['orderDir'] : NULL;
            $qb->orderBy($params['orderBy'], $orderDir);
        }

        return $qb;


    }

}