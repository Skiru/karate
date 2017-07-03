<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 29.06.2017
 * Time: 20:08
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Class Post
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="post")
 * @Vich\Uploadable
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id=null;

    /**
     * @ORM\ManyToOne(targetEntity="User",  inversedBy="posts")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt=null;


    /**
     * @var Category[]
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinTable(name="post_category")
     */
    private $categories;



    /**
     * @var string
     *
     * @ORM\Column(name="cover_image",type="string",length=255, nullable=false)
    */
    private $image;


    /**
     * This unmapped property stores the binary contents of the image file
     * associated with the product.
     *
     * @Vich\UploadableField(mapping="post_image", fileNameProperty="image")
     * @var File
     */
    private $imageFile;


    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param File $imageFile
     */
    public function setImageFile(File $image=null)
    {
        $this->imageFile = $image;

        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->createdAt = new \DateTime('now');
        }
    }


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add a category in the post association.
     * (Owning side).
     *
     * @param $category Category the category to associate
     */
    public function addCategory($category)
    {
        if ($this->categories->contains($category)) {
            return;
        }

        $this->categories->add($category);
        $category->addPost($this);
    }

    /**
     * Remove a category in the product association.
     * (Owning side).
     *
     * @param $category Category the category to associate
     */
    public function removeCategory($category)
    {
        if (!$this->categories->contains($category)) {
            return;
        }

        $this->categories->removeElement($category);
        $category->removePost($this);
    }


    /**
     * @param Category[] $categories
     */
    public function setCategories($categories)
    {
        foreach ($this->getCategories() as $category) {
            $this->removeCategory($category);
        }
        foreach ($categories as $category) {
            $this->addCategory($category);
        }
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $coverImage
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }





}