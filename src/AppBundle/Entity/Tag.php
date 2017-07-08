<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 08.07.2017
 * Time: 16:44
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tags")
 */
class Tag extends AbstractTaxonomy
{
    /**
     * @ORM\ManyToMany(
     *     targetEntity="Post",
     *     mappedBy="tags"
     * )
     */
    protected $posts;

}
