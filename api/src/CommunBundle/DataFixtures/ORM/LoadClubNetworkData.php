<?php
namespace CommaunBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CommunBundle\Entity\ListDepartement;
use ClubBundle\Entity\ClubNetwork;


class LoadClubNetworkData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $network = new ClubNetwork();
        $network->setName("Aucun réseau / Indépendant");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("100 % FORME");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Accrosport");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Activium");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Amazonia");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("BASIC FIT");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Cap Tonic");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("CMG SPORTS CLUB");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("CMG SPORTS CLUB Waou");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Curves");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Edenya");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Elancia");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Energie Forme");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Euforie");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Feel Sport");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Femmes en forme");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("FITLANE");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Fitness Club Concept");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Fitness Park");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Fitness Price");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Forest'Hill");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Forme Express");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Freedom Fitness");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Freeness");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Garden Gym");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("GIGAFIT");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("GIGAGYM");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("GoFitness");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("GymSpa");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("HealthCity");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Idéal Féminin");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Keep Cool");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("L'Appart Fitness");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("L'Orange Bleue");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("L'Usine");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Lady Concept");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Lady fitness");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Lady Moving");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Les Cercles de la Forme");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Liberty GYM");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Makadam Fitness");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Montana Fitness Club");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Movida Club");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Moving");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Moving Express");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("NEONESS");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("New York Gym");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Océania Club");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Optimum Gym");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Power Plate®");

        $manager->persist($network);
        $manager->flush();


        $network = new ClubNetwork();
        $network->setName("Run'Up Form");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Sport Inside");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Sthen");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Urban Fit Center");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Urban GYM");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Urban GYM Flash");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Vert Marine");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Vit'Halles DailyMove");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Vita liberté");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Wake Up Form");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("WATERBIKE");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("Welness Sport Club");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName("WideClub");

        $manager->persist($network);
        $manager->flush();

        $network = new ClubNetwork();
        $network->setName(" Autre réseau");

    }

}