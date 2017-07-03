<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 *
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id=null;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    protected $name;

    /**
     * Product in the category.
     *
     * @var Post[]
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="categories")
     **/
    protected $posts;

    /**
     * The category parent.
     *
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     **/
    protected $parent;

    /**
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Category $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }




    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post[] $posts
     */
    public function setPosts($posts)
    {
        $this->posts->clear();
        $this->posts= new ArrayCollection($posts);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add a product in the category.
     *
     * @param $post Post The post to associate
     */
    public function addPost($post)
    {
        if ($this->posts->contains($post)) {
            return;
        }

        $this->posts->add($post);
        $post->addCategory($this);
    }

    /**
     * @param Post $post
     */
    public function removePost($post)
    {
        if (!$this->posts->contains($post)) {
            return;
        }

        $this->posts->removeElement($post);
        $post->removeCategory($this);
    }

}