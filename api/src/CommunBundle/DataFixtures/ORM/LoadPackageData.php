<?php
namespace CommaunBundle\DataFixtures\ORM;

use CommunBundle\Entity\ListPackage;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPackageData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

         $package= new ListPackage();
        $package->setName('package B');
        $package->setCode('1CLUB');
        $manager->persist($package);
        $manager->flush();


        $package= new ListPackage();
        $package->setName('Package COURS COLLECTIFS');
        $package->setCode('1COACH');
        $manager->persist($package);
        $manager->flush();


        $package= new ListPackage();
        $package->setName('Package COURS COLLECTIFS + PERSONAL TRAINING');
        $package->setCode('2COACH');
        $manager->persist($package);
        $manager->flush();



    }

}