<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 19.08.2017
 * Time: 12:56
 */

namespace AppBundle\Service;


use Symfony\Component\Filesystem\Filesystem;

class LocalFilesystemFileDeleter implements FileDeleter
{
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var string
     */
    private $filePath;

    function __construct(Filesystem $filesystem, $filePath)
    {
        $this->filesystem = $filesystem;
        $this->filePath = $filePath;
    }

    public function delete(string $pathToFile) {
        $this->filesystem->remove(
            $this->filePath.'/'.$pathToFile
        );
    }

}