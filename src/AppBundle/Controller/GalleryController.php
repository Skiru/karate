<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 24.08.2017
 * Time: 14:08
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GalleryController extends Controller
{


    /**
     * @Route(
     *     "/galeria/{slug}",
     *     name = "karate_gallery_photos"
     * )
     * @var $photo array
     * @Method("GET")
     */
    public function photoAction($slug) {

        $galleryRepo = $this->getDoctrine()->getRepository('AppBundle:Gallery');
        $gallery = $galleryRepo->findOneBySlug($slug);

        if ($gallery === null) {
            throw $this->createNotFoundException('Szukana galeria nie został odnaleziona!');
        }



        //situation where gallery is just created and dont have photos yet
        $noPhotos=false;

        $photoRepo = $this->getDoctrine()->getRepository('AppBundle:Photo');


        $photo = $photoRepo->getGalleryPhotos($slug);

        if ($photo === null){
            throw $this->createNotFoundException('Szukana galeria nie został odnaleziona!');
        }

        if (empty($photo)) {
            $noPhotos=true;
        }

        return $this->render('Subpages/photos.html.twig',[
            'photos' => $photo,
            'noPhotos' => $noPhotos,
            'gallery' => $gallery,
        ]);
    }


    /**
     * @Route(
     *     "/galeria/",
     *     name = "karate_gallery_index"
     * )
     * @Method("GET")
     */
    public function indexAction() {

        $galleryRepo = $this->getDoctrine()->getRepository('AppBundle:Gallery');
        $gallery = $galleryRepo->findAll();

        //situation where there's no gallery yet
        $noGallery=false;

        if  (empty($gallery)){
            $noGallery = true;
        }


        return $this->render('Subpages/gallery.html.twig',[
            'headerTitle' => 'Galeria',
            'galleryRepo' => $gallery,
            'noGallery' => $noGallery,
        ]);
    }



}