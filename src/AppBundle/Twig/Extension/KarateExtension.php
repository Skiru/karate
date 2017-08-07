<?php

namespace AppBundle\Twig\Extension;

use Doctrine\Common\Persistence\ManagerRegistry;
use Twig_Environment;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class KarateExtension extends \Twig_Extension {

    /**
     * @var Registry
     */
    private $doctrine;


    /**
     * @var \Twig_Environment
     */
    private $environment;

    function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function initRuntime(Twig_Environment $environment)
    {
        $this->environment = $environment;
    }


    public function getName()
    {
        return 'karate_extension';
    }

    public function getFunctions()
    {
        return array(

            new Twig_SimpleFunction('print_categories_list',array($this,'printCategoriesList'), array('is_safe' => array('html'))),
            new Twig_SimpleFunction('print_tags_cloud',array($this,'tagsCloud'), array('is_safe' => array('html')))

        );
    }

    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter('ab_shorten', array($this, 'shorten'), array('is_safe' => array('html')))
        );
    }

    public function printCategoriesList() {

        $categoryRepo = $this->doctrine->getRepository('AppBundle:Category');
        $categoriesList = $categoryRepo->findAll();


        return $this->environment->render('Template/categoriesList.html.twig',[
            'categoriesList' => $categoriesList
        ]);

    }

    public function tagsCloud($limit = 40, $minFontSize = 1, $maxFontSize = 3) {

        $tagRepo = $this->doctrine->getRepository('AppBundle:Tag');
        $tagList = $tagRepo->getTagsListOcc();

        $tagList = $this->prepareTagsCloud($tagList, $limit, $minFontSize, $maxFontSize);

        return $this->environment->render('Template/tagsCloud.html.twig', [
           'tagsList' => $tagList
        ]);
    }

    protected function prepareTagsCloud($tagsList, $limit, $minFontSize, $maxFontSize){
        $occs = array_map(function($row){
            return (int)$row['occ'];
        }, $tagsList);

        $minOcc = min($occs);
        $maxOcc = max($occs);

        $spread = $maxOcc - $minOcc;

        $spread = ($spread == 0) ? 1 : $spread;

        usort($tagsList, function($a, $b){
            $ao = $a['occ'];
            $bo = $b['occ'];

            if($ao === $bo) return 0;

            return ($ao < $bo) ? 1 : -1;
        });

        $tagsList = array_slice($tagsList, 0, $limit);

        shuffle($tagsList);

        foreach($tagsList as &$row){
            $row['fontSize'] = round(($minFontSize + ($row['occ'] - $minOcc) * ($maxFontSize - $minFontSize) / $spread), 2);
        }

        return $tagsList;
    }

    public function shorten($text, $length = 200, $wrapTag = 'p') {
        $text = strip_tags($text);
        $text = substr($text, 0, $length).'[...]';
        $openTag = "<{$wrapTag}>";
        $closeTag = "</{$wrapTag}>";

        return $openTag.$text.$closeTag;
    }




}