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

    /**
     * @Route("/login",name="karate_login")
     * @Method("GET")
     */
    public function loginAction(){

        return $this->render('mainpage/login.html.twig');
    }

    /**
     * @Route("/register",name="karate_register")
     * @Method("GET")
     */
    public function registerAction(){

        return $this->render('mainpage/register.html.twig');
    }



}