<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 01.08.2017
 * Time: 21:12
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use DateTime;

class PostRepository extends EntityRepository{

    public function getPublishedPost($slug) {

        $qb = $this->getQueryBuilder(array(
            'status' => 'published'
        ));

        $qb->andWhere('p.slug = :slug')
            ->setParameter('slug', $slug);

        return $qb->getQuery()->getOneOrNullResult();

    }


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

        if (!empty($params['categorySlug'])){

            $qb->andWhere('c.slug = :categorySlug')
                ->setParameter('categorySlug', $params['categorySlug']);
        }

        if (!empty($params['tagSlug'])) {
            $qb->andWhere('t.slug = :tagSlug')
                ->setParameter('tagSlug', $params['tagSlug']);
        }

        if (!empty($params['search'])) {
            $searchParam = '%'.$params['search'].'%';
            
            $qb->andWhere('p.title like :searchParam OR p.content LIKE :searchParam')
                ->setParameter('searchParam', $searchParam);
        }

        return $qb;


    }

}