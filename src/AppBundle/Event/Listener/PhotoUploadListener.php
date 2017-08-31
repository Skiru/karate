<?php

namespace AppBundle\Event\Listener;


use AppBundle\Entity\Photo;
use AppBundle\Libs\Utils;
use AppBundle\Service\FileDeleter;
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
    /**
     * @var FileDeleter
     */
    private $fileDeleter;

    public function __construct(
        LocalFilesystemFileMover $fileMover,
        PhotoFilePathHelper $photoFilePathHelper,
        FileDeleter $fileDeleter
    )
    {
        $this->fileMover=$fileMover;
        $this->photoFilePathHelper = $photoFilePathHelper;
        $this->fileDeleter = $fileDeleter;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $this->upload(
            $eventArgs->getEntity()
        );
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        $this->upload(
            $eventArgs->getEntity()
        );
    }

    /**
     * @param $entity Photo
     * @return bool
     */
    private function upload($entity)
    {
        // if not Photo entity return false
        if (false === $entity instanceof Photo) {
            return false;
        }

        /**
         * @var $entity Photo
         */
        if ($entity->getImageName() !== null) {
            $this->fileDeleter->delete(
                $entity->getImageName()
            );
        }


        //get access to the file
        $file = $entity->getImageFile();

        $temporaryLocation = $file->getPathname();


//        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $fileName = md5(uniqid()).'-'.$file->getClientOriginalName();

        $newLocation = $this->photoFilePathHelper->getNewFilePath(
//            $file->getClientOriginalName()
            $fileName
        );

        $this->fileMover->move(
            $temporaryLocation,
            $newLocation
        );



        //addition infos setting up for entity before persisting
        //$file->getClientOriginalName()


        $entity
            ->setImageSize(
                $file->getClientSize()/1048576
            )
            ->setImageName(
                $fileName
            )
        ;

        return true;
    }


    public function preRemove(LifecycleEventArgs $eventArgs) {

        /**
         * @var $entity Photo
         */
        $entity = $eventArgs->getEntity();

        // if not Photo entity return false
        if (false === $entity instanceof Photo) {
            return false;
        }

        $entity->setImageFile(null);
        $this->fileDeleter->delete(
            (string)$entity->getImageName()
        );



    }

}