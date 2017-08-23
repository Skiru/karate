<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 08.07.2017
 * Time: 17:51
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UsersFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;


    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 0;
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }





    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {

        $userList = array(
            array(
                'username' => 'Lukasz',
                'email' => 'lkoziol16@gmail.com',
                'password' => 'zaq1@WSX',
                'roles' => 'ROLE_ADMIN',
            )
        );


        $encoderFactory = $this->container->get('security.encoder_factory');

        foreach ($userList as $user) {
            $User = new User();

            $password = $encoderFactory->getEncoder($User)->encodePassword($user['password'],null);

            $User->setUsername($user['username'])
                ->setRoles(array($user['roles']))
                ->setEmail($user['email'])
                ->setPassword($password)
                ->setEnabled(true);


            $this->addReference('user-'.$user['username'], $User);

            $manager->persist($User);

        }


        $manager->flush();
    }




}