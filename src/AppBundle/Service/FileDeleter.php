<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 19.08.2017
 * Time: 12:59
 */

namespace AppBundle\Service;

interface FileDeleter
{
    public function delete(string $pathToFile);
}