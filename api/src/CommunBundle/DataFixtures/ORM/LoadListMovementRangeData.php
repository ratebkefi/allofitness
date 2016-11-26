<?php
namespace CommaunBundle\DataFixtures\ORM;

use CoachBundle\Entity\MovementRange;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadListMovementRangeData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $mv= new MovementRange();
        $mv->setName('5 km');
        $mv->setRay(5);
        $manager->persist($mv);
        $manager->flush();

        $mv= new MovementRange();
        $mv->setName('10 km');
        $mv->setRay(10);
        $manager->persist($mv);
        $manager->flush();

        $mv= new MovementRange();
        $mv->setName('50 km');
        $mv->setRay(50);
        $manager->persist($mv);
        $manager->flush();


    }

}