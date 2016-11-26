<?php
namespace CommaunBundle\DataFixtures\ORM;

use CommunBundle\Entity\ListAd;
use CommunBundle\Entity\ListTypeAd;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadListadData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $ad = new ListAd();
        $ad->setTitle('Annonce 1');
        $ad->setUrl('url 1');
        $ad->setPhoto('photo 1');
        $ad->setDescription('description 1');
        $ad->setExpiredDate(new \DateTime('now'));

        $typead = new ListTypeAd();
        $typead->setName('Type annnonce 1');
        $typead->setName('Type annnonce 1');
        $manager->persist($typead);
        $ad->setIdTypeAd($typead);

        $manager->persist($ad);
        $manager->flush();

        $ad = new ListAd();
        $ad->setTitle('Annonce 2');
        $ad->setUrl('url 23');
        $ad->setPhoto('photo 2');
        $ad->setDescription('description 2');
        $ad->setExpiredDate(new \DateTime('now'));

        $typead = new ListTypeAd();
        $typead->setName('Type annnonce 2');
        $manager->persist($typead);
        $ad->setIdTypeAd($typead);

        $manager->persist($ad);
        $manager->flush();


        $ad = new ListAd();
        $ad->setTitle('Annonce 3');
        $ad->setUrl('url 3');
        $ad->setPhoto('photo 3');
        $ad->setDescription('description 3');
        $ad->setExpiredDate(new \DateTime('now'));

        $typead = new ListTypeAd();
        $typead->setName('Type annnonce 3');
        $manager->persist($typead);
        $ad->setIdTypeAd($typead);

        $manager->persist($ad);
        $manager->flush();


        $ad = new ListAd();
        $ad->setTitle('Annonce 4');
        $ad->setUrl('url 4');
        $ad->setPhoto('photo 4');
        $ad->setDescription('description 4');
        $ad->setExpiredDate(new \DateTime('now'));

        $typead = new ListTypeAd();
        $typead->setName('Type annnonce 4');
        $manager->persist($typead);
        $ad->setIdTypeAd($typead);

        $manager->persist($ad);
        $manager->flush();



    }

}