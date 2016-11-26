<?php
namespace CommaunBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CommunBundle\Entity\ListDepartement;
use CommunBundle\Entity\ListCountry;
use CommunBundle\Entity\ListRegion;
use CommunBundle\Entity\ListCity;


class LoadAdessData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $country = new ListCountry();
        $country->setName("France");
        $manager->persist($country);
        $manager->flush();

        $region = new ListRegion();
        $region->setName("Guadeloupe");
        $region->setIdCountry($country);
        $manager->persist($region);
        $manager->flush();

        $departement= new ListDepartement();
        $departement->setName("Ain");
        $departement->setIdRegion($region);
        $manager->persist($departement);
        $manager->flush();

        $city = new ListCity();
        $city->setName("ozan");
        $city->setIdDepartement($departement);
        $manager->persist($city);
        $manager->flush();

    }

}