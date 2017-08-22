<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\Timestampable;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="galleries")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Gallery
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     *
     */
    private $description;

    /**
     * @var Photo[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="gallery", cascade={"persist"})
     *
     */
    private $photos;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->setUpdatedAt();
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
     * @return Gallery
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
     * Set description
     *
     * @param string $description
     *
     * @return Gallery
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add photo
     *
     * @param Photo $photo
     *
     * @return Gallery
     */
    public function addPhoto(Photo $photo)
    {
        $this->photos[] = $photo;

        $photo->setGallery($this);

        return $this;
    }

    /**
     * Remove photo
     *
     * @param Photo $photo
     */
    public function removePhoto(Photo $photo)
    {
        $photo->setGallery(null);
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     *
     * @return Photo[]|ArrayCollection
     */
    public function getPhotos()
    {
        return $this->photos;
    }


    function __toString()
    {
        return $this->name;
    }
}
