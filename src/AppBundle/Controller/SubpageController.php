<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 22.08.2017
 * Time: 18:22
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SubpageController extends Controller
{
    /**
     * @Route(
     *     "/instructors",
     *     name="karate_instructors"
     * )
     * @Method("GET")
     */
    public function instructorAction(){

        $instructors = [
            [
                'imie'=>'Marian',
                'nazwisko'=>'Sokół',
                'stopien' => '4 dan',
                'tytul' => 'sensei',
                'avatar' => 'sensei_marian_sokol.jpg'
            ],
            [
                'imie'=>'Joanna',
                'nazwisko'=>'Zachara',
                'stopien' => '2 dan',
                'tytul' => 'sensei',
                'avatar' => 'sensei_joanna_zachara.jpg'
            ],
            [
                'imie'=>'Grzegorz',
                'nazwisko'=>'Sokół',
                'stopien' => '1 dan',
                'tytul' => 'sensei',
                'avatar' => 'sensei_grzegorz_sokol.jpg'
            ],
            [
                'imie'=>'Dariusz',
                'nazwisko'=>'Hezner',
                'stopien' => '1 kyū',
                'tytul' => '',
                'avatar' => 'sempai_dariusz_hezner.jpg'
            ],
            [
                'imie'=>'Łukasz',
                'nazwisko'=>'Sokół',
                'stopien' => '1 kyū',
                'tytul' => '',
                'avatar' => 'sempai_lukasz_sokol.jpg'
            ]
        ];


        return $this->render('Subpages/instructors.html.twig',[
            'instructors' => $instructors,
            'headerTitle' => 'Instruktorzy Karate Kyokushin Rzeszów'
        ]);
    }

}