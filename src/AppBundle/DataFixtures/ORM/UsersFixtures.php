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
        return 1;
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
                'username' => 'mateo',
                'username_canonical' => 'mateo',
                'email' => 'mateusz.koziol15@gmail.com',
                'email_canonical' => 'mateusz.koziol15@gmail.com',
                'enabled' => true,
                'password' => 'haslo',
                'last_login' => '2012-01-01 12:12:12',
                'roles' => 'ROLE_ADMIN',
                'salt' => '12345'
            ),
            array(
                'username' => 'lolaa',
                'username_canonical' => 'lolaa',
                'email' => 'lolaa.lachowicz@gmail.com',
                'email_canonical' => 'lolaa.lachowicz@gmail.com',
                'enabled' => true,
                'password' => 'haslo',
                'last_login' => '2012-01-01 12:12:12',
                'roles' => 'ROLE_ADMIN',
                'salt' => '12345'
            )
        );


        $encoderFactory = $this->container->get('security.encoder_factory');

        foreach ($userList as $user) {
            $User = new User();

            $password = $encoderFactory->getEncoder($User)->encodePassword($user['password'],$user['salt']);

            $User->setUsername($user['username'])
                ->setUsernameCanonical($user['username_canonical'])
                ->setEnabled($user['enabled'])
                ->setRoles(array($user['roles']))
                ->setEmail($user['email'])
                ->setEmailCanonical($user['email_canonical'])
                ->setPassword($password)
                ->setSalt($user['salt'])
                ->setLastLogin(new \DateTime($user['last_login']));



            $manager->persist($User);

        }


        $manager->flush();
    }


}