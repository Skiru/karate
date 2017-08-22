<?php

namespace AppBundle\Form\DataTransformer;


use Psr\Log\LoggerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FileTransformer implements DataTransformerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    /**
     * Converts the data used in code to a format that can be rendered in the form
     *
     * @var mixed|null $file
     */
    public function transform($file = null)
    {
        $this->logger->debug('transformer',[
           'file' => $file,
        ]);

        return [
            'file' => $file
        ];
    }

    /**
     * Converts the data from the form submission to a format that can be used in code
     *
     * @var array $data
     * @return mixed
     */
    public function reverseTransform($data)
    {
        $this->logger->debug('reverseTransform',[
            'data' => $data,
        ]);

        return $data['file'];
    }


}