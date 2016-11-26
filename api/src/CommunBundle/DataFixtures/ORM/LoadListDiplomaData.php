<?php
namespace CommaunBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoachBundle\Entity\Diploma;


class LoadListDiplomaData  implements FixtureInterface {

    /**
     * {@inheritDoc}
     */

    public function load(ObjectManager $manager)
    {
        $diploma = new Diploma();
        $diploma->setName('Diplômé');
        $manager->persist($diploma);
        $manager->flush();

        $diploma = new Diploma();
        $diploma->setName('En formation');
        $manager->persist($diploma);
        $manager->flush();

    }

}