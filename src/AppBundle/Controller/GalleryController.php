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
     *     "/galeria",
     *     name = "karate_gallery_index"
     * )
     * @Method("GET")
     */
    public function indexAction() {

        $galleryRepo = $this->getDoctrine()->getRepository('AppBundle:Gallery');
        $gallery = $galleryRepo->findAll();

        dump($gallery);

        return $this->render('Subpages/gallery.html.twig',[
           'headerTitle' => 'Galeria',
           'galleryRepo' => $gallery,
        ]);
    }

}