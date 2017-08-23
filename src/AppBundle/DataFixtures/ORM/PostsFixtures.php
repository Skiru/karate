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
use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostsFixtures extends AbstractFixture implements OrderedFixtureInterface
{

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
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
//        $user = new User();
//        $user->setUsername('Mateusz');
//        $user->setPassword('zaq1@WSX');
//        $user->setEmail('mateusz.koziol19@gmail.com');
//        $user->setRoles(array('ROLE_ADMIN'));
//        $user->setEnabled(true);
//        $user->setUsernameCanonical('mateusz');

        $postsList = array(
            array(
                'title' => 'Nowa strona internetowa Rzeszowskiego Klubu Karate Kyokushin',
                'content' => '<p>Z wielką przyjemnością chielibyśmy zaprezentować nową stronę Internetową klubu. Znajdą się tutaj wszystkie aktualności, terminarze, rozkłady treningów jak również galerie zdjęć z imprez oraz obozów. Życzymy milego użytkowania. OSU! </p>',
                'category' => 'ogloszenie',
                'tags' => array('informacje', 'strona internetowa', 'nowość'),
                'author' => 'Lukasz',
                'createDate' => new DateTime('now'),
                'publishedDate' => new DateTime('now'),
            ),
        );


        foreach ($postsList as $idx => $details) {
            $post = new Post();
            $post->setTitle($details['title'])
                ->setContent($details['content'])
                ->setAuthor($this->getReference('user-'.$details['author']))
                ->setCreateDate($details['createDate']);
//                ->setCreateDate(new DateTime($details['createDate']));

            if (null != $details['publishedDate'])
            {
//                $post->setPublishedDate(new DateTime($details['publishedDate']));
                $post->setPublishedDate($details['publishedDate']);
            }

            $manager->persist($post);

            $post->setCategory($this->getReference('category_'.$details['category']));

            foreach ($details['tags'] as $tagName) {
                $post->addTag($this->getReference('tag_'.$tagName));
            }

            $this->addReference('post-'.$idx, $post);

        }

        $manager->flush();
    }


}