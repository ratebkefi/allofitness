<?php
namespace CommaunBundle\DataFixtures\ORM;



use ClubBundle\Entity\ListClubType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CommunBundle\Entity\ListDepartement;
use CommunBundle\Entity\ListCountry;

class LoadListClubTypeData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $clubtype = new ListClubType();
        $clubtype->setName("Club de fitness");
        $clubtype->setDescription("Club de forme avec plusieurs activités de fitness, cours collectifs encadrés avec coach...");
        $manager->persist($clubtype);
        $manager->flush();

        $clubtype = new ListClubType();
        $clubtype->setName("Fitness low cost / club de musculation");
        $clubtype->setDescription("Club avec parcours/équipements de musculation et/ou cardio, avec ou sans cours collectifs vidéo");
        $manager->persist($clubtype);
        $manager->flush();

        $clubtype = new ListClubType();
        $clubtype->setName("Salle de fitness 100% femmes");
        $clubtype->setDescription("Salle de gym réservée aux femmes");
        $manager->persist($clubtype);
        $manager->flush();

        $clubtype = new ListClubType();
        $clubtype->setName("Salle de gym / bien être");
        $clubtype->setDescription("Salle de gym avec enseignement en cours individuel ou collectif, Power Plate, Yoga, Pilates...");
        $manager->persist($clubtype);
        $manager->flush();

        $clubtype = new ListClubType();
        $clubtype->setName("Piscine avec activités fitness");
        $clubtype->setDescription("Centre d'Aquabiking proposant des séances d'aquabiking en piscine ou en cabine individuelle.");
        $manager->persist($clubtype);
        $manager->flush();

        $clubtype = new ListClubType();
        $clubtype->setName("Centre d'Aquabike / Aquabiking");
        $clubtype->setDescription("Centre d'Aquabiking proposant des séances d'aquabiking en piscine ou en cabine individuelle.");
        $manager->persist($clubtype);
        $manager->flush();

        $clubtype = new ListClubType();
        $clubtype->setName("Club de sport art-martiaux / combat");
        $clubtype->setDescription("Club, salle, lieu ou sont enseignés des cours d'art-martiaux\"");
        $manager->persist($clubtype);
        $manager->flush();

        $clubtype = new ListClubType();
        $clubtype->setName("Coach sportif");
        $clubtype->setDescription("Coach sportif à domicile ou en entreprise, préparateur physique, coaching forme en plein air, ...");
        $manager->persist($clubtype);
        $manager->flush();


        $clubtype = new ListClubType();
        $clubtype->setName("Ecole de danse");
        $clubtype->setDescription("Club, salle de danse, lieu ou sont enseignés des cours de danses");
        $manager->persist($clubtype);
        $manager->flush();


        $clubtype = new ListClubType();
        $clubtype->setName("Box Crossfit");
        $clubtype->setDescription("Salle de sport dédiée à la pratique du Crossfit , activité qui combine des mouvements fonctionnels à haute intensité");
        $manager->persist($clubtype);
        $manager->flush();


        $clubtype = new ListClubType();
        $clubtype->setName("Studio Yoga / Pilates");
        $clubtype->setDescription("Studio spécialisé dans les cours de yoga, pilates, barre au sol, qi gong, stretching, sophrologie et autres pratiques douces");
        $manager->persist($clubtype);
        $manager->flush();


        $clubtype = new ListClubType();
        $clubtype->setName("Studio Indoor Cycling");
        $clubtype->setDescription("Egalement appelée Spinning ou RPM, c'est une activité sportive qui se pratique en petit groupe avec 1 coach et de la musique pour se dépenser à fond !");
        $manager->persist($clubtype);
        $manager->flush();

    }

}