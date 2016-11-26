<?php
namespace CommaunBundle\DataFixtures\ORM;

use CommunBundle\Entity\ListCourseCategory;
use CommunBundle\Entity\ListPackage;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCourseCategorieData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $course= new ListCourseCategory();
        $course->setName('cours categorie 1');
        $manager->persist($course);
        $manager->flush();

        $course= new ListCourseCategory();
        $course->setName('cours categorie 2');
        $manager->persist($course);
        $manager->flush();

        $course= new ListCourseCategory();
        $course->setName('cours categorie 3');
        $manager->persist($course);
        $manager->flush();

    }

}