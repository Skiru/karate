<?php

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="galleries")
 * @ORM\Entity
 */
class Gallery
{

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
     * @var File
     *
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="gallery", cascade={"persist"})
     *
     */
    private $photos;

    /**
     * @var ArrayCollection
     */
    private $uploadedPhotos;

}