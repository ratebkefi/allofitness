<?php
namespace CommaunBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CommunBundle\Entity\ListArea;

class LoadAreaData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $area = new ListArea();
        $area->setName("Moins de 400 m2");
        $manager->persist($area);
        $manager->flush();

        $area = new ListArea();
        $area->setName("De 400 à 1000 m2");
        $manager->persist($area);
        $manager->flush();

        $area = new ListArea();
        $area->setName("De 1000 à 2000 m2");
        $manager->persist($area);
        $manager->flush();

        $area = new ListArea();
        $area->setName("Plus de 2000 m2");
        $manager->persist($area);
        $manager->flush();



    }

}