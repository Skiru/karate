<?php

namespace AppBundle\Event\Listener;


use AppBundle\Entity\Photo;
use AppBundle\Libs\Utils;
use AppBundle\Service\LocalFilesystemFileMover;
use AppBundle\Service\PhotoFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class PhotoUploadListener
{
    /**
     * @var LocalFilesystemFileMover
     */
    private $fileMover;
    /**
     * @var PhotoFilePathHelper
     */
    private $photoFilePathHelper;

    public function __construct(LocalFilesystemFileMover $fileMover, PhotoFilePathHelper $photoFilePathHelper)
    {
        $this->fileMover=$fileMover;
        $this->photoFilePathHelper = $photoFilePathHelper;
    }

    public function prePersist(LifecycleEventArgs $eventArgs) {

        $entity = $eventArgs->getEntity();

        // if not Photo entity return false
        if (false === $eventArgs->getEntity() instanceof Photo) {
            return false;
        }

        /**
         * @var $entity Photo
         */

        //get access to the file
        $file = $entity->getImageFile();

        $temporaryLocation = $file->getPathname();

        $newLocation = $this->photoFilePathHelper->getNewFilePath(
          $file->getClientOriginalName()
        );

        $this->fileMover->move($temporaryLocation,$newLocation);

        //addition infos setting up for entity before persisting
        $entity->setSlug(
          Utils::sluggify($file->getClientOriginalName())
        );

        $entity->setImageSize(
            $file->getClientSize()/1048576
        );

        $entity->setImageName(
          $file->getClientOriginalName()
        );




        return true;
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs) {

    }

}