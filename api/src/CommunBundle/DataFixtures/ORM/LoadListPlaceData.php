<?php
namespace CommaunBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoachBundle\Entity\Place;

class LoadListPlaceData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $place= new Place();
        $place->setName('A domicile');
        $manager->persist($place);
        $manager->flush();

        $place= new Place();
        $place->setName('Chez le Coach');
        $manager->persist($place);
        $manager->flush();

        $place= new Place();
        $place->setName('Dans un lieu à définir avec le Coach');
        $manager->persist($place);
        $manager->flush();

        $place= new Place();
        $place->setName('En extérieur');
        $manager->persist($place);
        $manager->flush();

    }

}