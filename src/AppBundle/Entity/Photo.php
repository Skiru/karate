<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 11.08.2017
 * Time: 12:30
 */

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\Gallery;
use AppBundle\Libs\Utils;
use DateTime;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="photos")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Photo
{
    use Timestampable;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $slug;

    /**
     * @var UploadedFile
     */
    private $imageFile;


    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="float")
     *
     * @var float
     */
    private $imageSize;


    /**
     * @var Gallery
     *
     * @ORM\ManyToOne(targetEntity="Gallery", inversedBy="photos")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     **/
    private $gallery;


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
     * @param UploadedFile|null $imageFile
     * @return $this
     */
    public function setImageFile(UploadedFile $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if ($imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt();
        }

        return $this;
    }




    /**
     * @return UploadedFile
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Photo
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
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Photo
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set imageSize
     *
     * @param float $imageSize
     *
     * @return Photo
     */
    public function setImageSize($imageSize)
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    /**
     * Get imageSize
     *
     * @return float
     */
    public function getImageSize()
    {
        return $this->imageSize;
    }



    /**
     * Set gallery
     *
     * @param Gallery $gallery
     *
     * @return Photo
     */
    public function setGallery(Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    function __toString()
    {
        return (string)$this->getSlug();
    }


}
