<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 29.06.2017
 * Time: 21:44
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Category")
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=100,nullable=false)
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="categories")
     */
    private $name;

}