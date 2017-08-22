<?php

namespace AppBundle\Form\Type;


use AppBundle\Entity\Photo;
use AppBundle\Form\DataTransformer\FileTransformer;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomFileType extends AbstractType
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class,[
                'multiple' => false,
            ])
        ;

        $builder
            ->addViewTransformer(new FileTransformer(
                $this->logger
            ))
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        /**
         * @var $entity Photo
         */
        $entity = $form->getParent()->getData();

        if ($entity instanceof Photo) {

            $view->vars['file_uri'] = (null === $entity->getImageName())
            ? null
                : '/uploads/images/galleries/'.$entity->getImageName();
            ;

        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'file_uri' => null
        ]);
    }


}