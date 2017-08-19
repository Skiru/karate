<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 19.08.2017
 * Time: 11:48
 */

namespace AppBundle\Service;


class PhotoFilePathHelper
{
    /**
     * @var string
     */
    private $photoFileDirectory;

    function __construct(string $photoFileDirectory)
    {
        $this->photoFileDirectory = $photoFileDirectory;
    }

    public function getNewFilePath(string $newFileName){
        return $this->photoFileDirectory.$newFileName;
    }

}