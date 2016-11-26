<?php
namespace CommaunBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CommunBundle\Entity\ListCourseCategory;

class LoadListCourseCategoryData  implements FixtureInterface {
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $category = new ListCourseCategory();
        $category->setName('Tennis');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Remise en forme');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Sports de combat');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Running');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Yoga');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Pilates');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Cross-fit');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Prépa physique');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Musculation');
        $manager->persist($category);
        $manager->flush();

        $category = new ListCourseCategory();
        $category->setName('Zumba');
        $manager->persist($category);
        $manager->flush();


    }

}