<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 25.06.2017
 * Time: 18:53
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class KarateWebsiteKontroller extends Controller
{

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function indexAction(){

        $hello = "Welcome to the karate kyokushin website!";
        return $this->render('mainpage/index.html.twig',[
            'hello' => $hello,
        ]);
    }






}