<?php
namespace CommaunBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoachBundle\Entity\NumberOfPersons;

class LoadListNumberOfPersonsData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $nbperson = new NumberOfPersons();
        $nbperson->setName('pour 2 personnes');
        $nbperson->setNbs(2);
        $manager->persist($nbperson);
        $manager->flush();

        $nbperson = new NumberOfPersons();
        $nbperson->setName('pour 3 personnes');
        $nbperson->setNbs(3);
        $manager->persist($nbperson);
        $manager->flush();

        $nbperson = new NumberOfPersons();
        $nbperson->setName('pour 4 personnes');
        $nbperson->setNbs(4);
        $manager->persist($nbperson);
        $manager->flush();

    }

}