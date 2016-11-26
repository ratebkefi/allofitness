<?php
namespace CommaunBundle\DataFixtures\ORM;

use ClubBundle\Entity\ListClubFunction;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CommunBundle\Entity\ListDepartement;
use CommunBundle\Entity\ListCountry;
use CommunBundle\Entity\ListRegion;
use CommunBundle\Entity\ListCity;


class LoadClubFunctionData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $function = new ListClubFunction();
        $function->setName("Gérant de club");
        $manager->persist($function);
        $manager->flush();

        $function = new ListClubFunction();
        $function->setName("Responsable de club");
        $manager->persist($function);
        $manager->flush();

        $function = new ListClubFunction();
        $function->setName("Manager général");
        $manager->persist($function);
        $manager->flush();

        $function = new ListClubFunction();
        $function->setName("Président d'une association");
        $manager->persist($function);
        $manager->flush();

        $function = new ListClubFunction();
        $function->setName("Responsable marketing");
        $manager->persist($function);
        $manager->flush();

        $function = new ListClubFunction();
        $function->setName("Responsable communication");
        $manager->persist($function);
        $manager->flush();

        $function = new ListClubFunction();
        $function->setName("Chargé de ventes");
        $manager->persist($function);
        $manager->flush();

        $function = new ListClubFunction();
        $function->setName("Responsable d'équipe");
        $manager->persist($function);
        $manager->flush();

    }

}