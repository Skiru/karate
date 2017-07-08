<?php
/**
 * Created by PhpStorm.
 * User: Skiru
 * Date: 08.07.2017
 * Time: 17:51
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\Category;

class CategoriesFixtures extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categoriesList = [
            'egzamin' => 'egzamin karate',
            'ogloszenie' => 'wiadomosc ogloszenie',
            'nowosc' => 'zmian w karate',
            'wazne' => 'wazna wiadomosc',
            'osobowe' => 'Samoloty osobowe i pasażerskie',
            'odrzutowe' => 'Samoloty odrzutowe',
            'wojskowe' => 'Samoloty wojskowe',
            'kosmiczne' => 'Promy kosmiczne',
            'tajne' => 'Tajne rozwiązania'
            //'nowa' => 'Nowa kategoria'
        ];

        foreach ($categoriesList as $catKey => $catName) {
            $Category = new Category();

            $Category->setName($catName);

            $manager->persist($Category);
            $this->addReference('category_'.$catKey,$Category);
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