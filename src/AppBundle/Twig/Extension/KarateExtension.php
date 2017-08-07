<?php

namespace AppBundle\Twig\Extension;

class KarateExtension extends \Twig_Extension {

    public function getName()
    {
        return 'karate_extension';
    }

    public function getFunctions()
    {
        return array(
          new \Twig_SimpleFunction('karate_test',array($this,'test'))
        );
    }


    public function test() {
        return 'test -ok';
    }

}