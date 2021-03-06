<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 *
 */
class Category extends AbstractTaxonomy
{
    /**
     * @ORM\OneToMany(
     *     targetEntity="Post",
     *     mappedBy="category"
     * )
     */
    protected $posts;
}
