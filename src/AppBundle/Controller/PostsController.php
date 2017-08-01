<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 31.07.2017
 * Time: 20:14
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;

class PostsController extends Controller
{

    protected $itemsLimit = 5;

    /**
     * @Route(
     *     "/{page}",
     *     name="karate_posts_index",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
     * )
     * @Method("GET")
     */
    public function indexAction($page){
        $postsRepo = $this->getDoctrine()->getRepository('AppBundle:Post');
        //$allPosts = $postsRepo->findBy(array(),array('publishedDate'=>'desc'));

        $qb = $postsRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC'
        ));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb,$page,$this->itemsLimit);

        return $this->render('mainpage/index.html.twig',[
            'pagination' => $pagination
        ]);
    }


}