<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PhotoRepository extends EntityRepository{

    public function getGalleryPhotos($slug) {

        $qb = $this->createQueryBuilder('p')
            ->select('p')
            ->leftJoin('p.gallery','g');

        $qb->andWhere('g.slug = :slug')
            ->setParameter('slug',$slug);

        return $qb->getQuery()->getArrayResult();
    }

}