<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 07.08.2017
 * Time: 19:39
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function getTagsListOcc() {
       $qb = $this->createQueryBuilder('t')
           ->select('t.slug, t.name, COUNT(p) as occ')
           ->leftJoin('t.posts', 'p')
           ->groupBy('t.slug, t.name');

       return $qb->getQuery()->getArrayResult();
    }


}