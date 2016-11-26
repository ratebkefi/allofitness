<?php

namespace CoachBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoachCoursePlanning
 *
 * @ORM\Table(name="coach_course_planning")
 * @ORM\Entity(repositoryClass="CoachBundle\Repository\CoachCoursePlanningRepository")
 */
class CoachCoursePlanning
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
     * @ORM\ManyToOne(targetEntity="CoachBundle\Entity\CoachInfo", inversedBy="coachCoursePlanning")
     * @ORM\JoinColumn(name="id_coach", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idCoach;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="time")
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="time")
     */
    private $endTime;

    /**
     * @var int
     *
     * @ORM\Column(name="day_of_week", type="integer")
     */
    private $dayOfWeek;

    /**
     * @var string
     *
     * @ORM\Column(name="week_of_year", type="string", length=45)
     */
    private $weekOfYear;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_course", type="date")
     */
    private $dateCourse;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateAdd = new \DateTime('now');
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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return CoachCoursePlanning
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return CoachCoursePlanning
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set dayOfWeek
     *
     * @param integer $dayOfWeek
     *
     * @return CoachCoursePlanning
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }

    /**
     * Get dayOfWeek
     *
     * @return integer
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    /**
     * Set weekOfYear
     *
     * @param string $weekOfYear
     *
     * @return CoachCoursePlanning
     */
    public function setWeekOfYear($weekOfYear)
    {
        $this->weekOfYear = $weekOfYear;

        return $this;
    }

    /**
     * Get weekOfYear
     *
     * @return string
     */
    public function getWeekOfYear()
    {
        return $this->weekOfYear;
    }

    /**
     * Set dateCourse
     *
     * @param \DateTime $dateCourse
     *
     * @return CoachCoursePlanning
     */
    public function setDateCourse($dateCourse)
    {
        $this->dateCourse = $dateCourse;

        return $this;
    }

    /**
     * Get dateCourse
     *
     * @return \DateTime
     */
    public function getDateCourse()
    {
        return $this->dateCourse;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return CoachCoursePlanning
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return CoachCoursePlanning
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return CoachCoursePlanning
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set idCoach
     *
     * @param \CoachBundle\Entity\CoachInfo $idCoach
     *
     * @return CoachCoursePlanning
     */
    public function setIdCoach(\CoachBundle\Entity\CoachInfo $idCoach = null)
    {
        $this->idCoach = $idCoach;

        return $this;
    }

    /**
     * Get idCoach
     *
     * @return \CoachBundle\Entity\CoachInfo
     */
    public function getIdCoach()
    {
        return $this->idCoach;
    }
}
