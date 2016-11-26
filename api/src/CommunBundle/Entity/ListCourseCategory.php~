<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListCourseCategory
 *
 * @ORM\Table(name="list_course_category")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\ListCourseCategoryRepository")
 */
class ListCourseCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="CoachBundle\Entity\CoachCourse", mappedBy="idCouseCategory" )
     */
    private $coachCourse;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coachCourse = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ListCourseCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add coachCourse
     *
     * @param \CoachBundle\Entity\CoachCourse $coachCourse
     *
     * @return ListCourseCategory
     */
    public function addCoachCourse(\CoachBundle\Entity\CoachCourse $coachCourse)
    {
        $this->coachCourse[] = $coachCourse;

        return $this;
    }

    /**
     * Remove coachCourse
     *
     * @param \CoachBundle\Entity\CoachCourse $coachCourse
     */
    public function removeCoachCourse(\CoachBundle\Entity\CoachCourse $coachCourse)
    {
        $this->coachCourse->removeElement($coachCourse);
    }

    /**
     * Get coachCourse
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoachCourse()
    {
        return $this->coachCourse;
    }
}
