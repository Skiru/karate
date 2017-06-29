<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 29.06.2017
 * Time: 20:08
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Post
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="Post")
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
    private $id;

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
     * @ORM\Column(name="created_at", type="date",nullable=false)
     */
    private $createdAt;


    /**
     * @var string
     * @ORM\Column(type="string")
     * @ORM\OneToMany(targetEntity="Category", mappedBy="name")
     */
    private $categories;


    /**
     * @var string
     *
     * @ORM\Column(name="cover_image",type="string", nullable=false)
     * @Assert\NotBlank(message="Proszę wybrać zdjęcie będące okładką aktualności.")
     * @Assert\File(mimeTypes={"image/png", "image/jpeg", "image/bmp"}, maxSize=10485760)
     * @Assert\File(maxSizeMessage="Przekroczony maksmalny (10MB) rozmiar pliku graficznego.", mimeTypesMessage="Nieprawidłowe rozszerzenei pliku. Dozwolone *.jpeg, *.bmp, *.png")
     */
    private $coverImage;



}