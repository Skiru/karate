<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 08.07.2017
 * Time: 17:51
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TagsFixtures extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tagsList = [
            'karate',
            'rzeszow',
            'kyokushin',
            'dojo',
            'nowość',
            'strona internetowa',
            'egzamin',
            'informacje',
        ];

        foreach ($tagsList as $tagKey => $tagName) {
            $Tag = new Tag();

            $Tag->setName($tagName);

            $manager->persist($Tag);
            $this->addReference('tag_'.$tagName,$Tag);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 0;
    }
}