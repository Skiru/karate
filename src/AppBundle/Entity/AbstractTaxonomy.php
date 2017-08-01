<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 08.07.2017
 * Time: 16:45
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Post;
use AppBundle\Libs\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
abstract class AbstractTaxonomy
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $slug;

    protected $posts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * Add post
     *
     * @param Post $post
     *
     * @return Tag
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param Post $post
     */
    public function removePost(Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AbstractTaxonomy
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return AbstractTaxonomy
     */
    public function setSlug($slug)
    {
        $this->slug = Utils::sluggify($slug);

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function preSave(){

        if ($this->slug === null){
            $this->setSlug($this->getName());
        }
    }

    function __toString()
    {
        return $this->getName();
    }
}
