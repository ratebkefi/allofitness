<?php
namespace CommaunBundle\DataFixtures\ORM;

use CommunBundle\Entity\ListCivility;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;



class LoadListCivilityData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $civility = new ListCivility();
        $civility->setName("Mr");
        $manager->persist($civility);
        $manager->flush();

        $civility = new ListCivility();
        $civility->setName("Mme");
        $manager->persist($civility);
        $manager->flush();

        $civility = new ListCivility();
        $civility->setName("Mlle");
        $manager->persist($civility);
        $manager->flush();
    }

}