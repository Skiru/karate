<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 02.09.2017
 * Time: 10:08
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrainingScheduleController extends Controller
{
    /**
     * @Route(
     *     "/treningi/rzeszow",
     *     name="karate_training_schedule_rzeszow"
     * )
     * @Method("GET")
     */
    public function rzeszowAction(){



        return $this->render('Subpages/treningi_rzeszow.html.twig',[
            'headerTitle' => sprintf("Harmonogram treningów w Rzeszowie ważne od %d %s %d", 4,"września", 2017)
        ]);
    }
    /**
     * @Route(
     *     "/treningi/hyzne",
     *     name="karate_training_schedule_hyzne"
     * )
     * @Method("GET")
     */
    public function hyzneAction(){



        return $this->render('Subpages/treningi_hyzne.html.twig',[
            'headerTitle' => sprintf("Harmonogram treningów w Hyżnem ważne od %d %s %d", 5,"września", 2017)
        ]);
    }

}