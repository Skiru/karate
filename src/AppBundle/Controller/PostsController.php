<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class PostsController extends Controller
{
    protected $itemsLimit = 3;

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

        $pagination=$this->getPaginatedPosts(array(
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC'
        ), $page);

        return $this->render('mainpage/index.html.twig',[
            'pagination' => $pagination,
            'listTitle' => "Najnowsze aktualności"
        ]);
    }

    /**
     * @Route(
     *     "/search/{page}",
     *     name="karate_search",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
     * )
     * @Method("GET")
     */
    public function searchAction(Request $request, $page){

        $searchParam = $request->query->get('search');


        $pagination=$this->getPaginatedPosts(array(
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'search' => $searchParam
        ), $page);

        return $this->render('mainpage/index.html.twig',[
            'pagination' => $pagination,
            'listTitle' => sprintf('Wyniki wyszukiwania dla frazy: "%s"',$searchParam),
            'searchParam' => $searchParam
        ]);
    }




    /**
     * @Route(
     *     "/category/{slug}/{page}",
     *     name = "karate_category",
     *     defaults = {"page"=1},
     *     requirements = {"page" = "\d+"}
     * )
     */
    public function categoryAction($slug , $page){

        $categoryRepo = $this->getDoctrine()->getRepository('AppBundle:Category');
        $category = $categoryRepo->findOneBySlug($slug);

        $pagination = $this->getPaginatedPosts(array('status' => 'published',
            'status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'categorySlug' => $slug
        ), $page);

        return $this->render('mainpage/index.html.twig',[
            'pagination' => $pagination,
            'listTitle' => sprintf('Wpisy w kategorii "%s"', $category->getName())
        ]);
    }


    /**
     * @Route(
     *     "/tag/{slug}/{page}",
     *     name = "karate_tag",
     *     defaults = {"page"=1},
     *     requirements = {"page" = "\d+"}
     * )
     */
    public function tagAction($slug , $page){

        $tagRepo = $this->getDoctrine()->getRepository('AppBundle:Tag');
        $tag = $tagRepo->findOneBySlug($slug);

        $pagination = $this->getPaginatedPosts(array('status' => 'published',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'tagSlug' => $slug
        ), $page);

        return $this->render('mainpage/index.html.twig',[
            'pagination' => $pagination,
            'listTitle' => sprintf('Wpisy z tagiem "%s"', $tag->getName())
        ]);
    }

    /**
     * @param array $params
     * @param $page
     * @return pagination object for knp_paginator_bundle
     */
    protected function getPaginatedPosts(array  $params = array(), $page) {
        $postsRepo = $this->getDoctrine()->getRepository('AppBundle:Post');

        $qb = $postsRepo->getQueryBuilder($params);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb,$page,$this->itemsLimit);

        return $pagination;

    }

    /**
     * @Route(
     *     "/post/{slug}",
     *     name = "karate_single_post"
     * )
     *
     */
    public function postAction($slug){

        $postRepo = $this->getDoctrine()->getRepository('AppBundle:Post');

        $post = $postRepo->getPublishedPost($slug);

        if ($post === null){
            throw $this->createNotFoundException('Szukany post nie został odnaleziony');
        }

        return $this->render('Posts/post.html.twig',[
            'post' => $post
        ]);

    }

}