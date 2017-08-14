<?php

namespace AppBundle\Controller\EasyAdmin;

use AppBundle\Entity\Gallery;
use AppBundle\Entity\Photo;
use AppBundle\Form\GalleryType;
use AppBundle\Libs\Utils;
use DateTime;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController;
use Symfony\Component\BrowserKit\Request;

class PhotoController extends AdminController
{
//    public function galleryNewAction(Request $request){
//        $gallery = new Gallery();
//        $form = $this->get('form.factory')->create(GalleryType::class,$gallery);
//
//        if ($request->getMethod('POST') && $form->handleRequest($request)->isValid()) {
//
//            $gallery->setUpdatedAt(new \DateTime());
//            $this->em->flush($gallery);
//
//
//            $this->addFlash('success', sprintf('Photo %s dodane!'));
//
//        }
//
//        return $this->redirectToRoute('easyadmin',[
//            'action' => 'show',
//        ]);
//
//
//    }

    /**
     * @param Photo $entity
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|void
     */
    protected function prePersistEntity($entity)
    {
        $imgFile = $entity->getImageFile();

        $entity->setSlug(Utils::sluggify($imgFile->getFileInfo()->getFilename()));
        $entity->setImageName($entity->getImageName());
        $entity->setImageSize($imgFile->getFileInfo()->getSize());
        $entity->setUploadAt(new DateTime('now'));
        $entity->setGallery($entity->getGallery());

        $this->em->flush();


        $this->addFlash('success', sprintf('Photo %s dodane!', $entity->getImageName()));

        return $this->redirectToRoute('easyadmin',[
           'action' => 'show',
        ]);
    }


}