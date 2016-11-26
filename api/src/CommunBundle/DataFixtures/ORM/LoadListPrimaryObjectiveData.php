<?php
namespace CommaunBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoachBundle\Entity\PrimaryObjective;

class LoadListPrimaryObjectiveData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $objectif = new PrimaryObjective();
        $objectif->setName('Découverte/Initiation');
        $manager->persist($objectif);
        $manager->flush();

        $objectif = new PrimaryObjective();
        $objectif->setName('Découverte/Initiation');
        $manager->persist($objectif);
        $manager->flush();

        $objectif = new PrimaryObjective();
        $objectif->setName('Performances');
        $manager->persist($objectif);
        $manager->flush();

    }

}