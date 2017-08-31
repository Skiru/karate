<?php

namespace AppBundle\Service;


use Symfony\Component\Filesystem\Filesystem;

class LocalFilesystemFileMover implements FileMover
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }


    public function move($existingFilePath, $newFilePath){

        $this->filesystem->rename($existingFilePath,$newFilePath);

        $this->filesystem->chmod($newFilePath,0755,0000,true);
        return true;

    }

}