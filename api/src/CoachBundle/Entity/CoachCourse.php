<?php

namespace CoachBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoachCourse
 *
 * @ORM\Table(name="coach_course")
 * @ORM\Entity(repositoryClass="CoachBundle\Repository\CoachCourseRepository")
 */
class CoachCourse
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
     * @ORM\OneToOne(targetEntity="CommunBundle\Entity\Adress", inversedBy="coachInfo")
     * @ORM\JoinColumn(name="id_adress", referencedColumnName="id")
     */
    private $idAdress;

    /**
     * @ORM\ManyToOne(targetEntity="CoachBundle\Entity\CoachInfo", inversedBy="coachCourse")
     * @ORM\JoinColumn(name="id_coach", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idCoach;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListCourseCategory", inversedBy="coachCourse")
     * @ORM\JoinColumn(name="id_couse_category", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idCouseCategory;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_update", type="datetime")
     */
    private $dateUpdate;

    /**
     * @ORM\ManyToOne(targetEntity="CoachBundle\Entity\MovementRange", inversedBy="coachCourse")
     * @ORM\JoinColumn(name="movement_range", referencedColumnName="id",onDelete="CASCADE")
     */
    private $movementRange;

    /**
     * @var string
     *
     * @ORM\Column(name="experience", type="text")
     */
    private $experience;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;




    /**
     * @ORM\ManyToMany(targetEntity="CoachBundle\Entity\Diploma")
     */
    private $diploma;

    /**
     * @ORM\ManyToMany(targetEntity="CoachBundle\Entity\Place")
     */
    private $place;


    /**
     * @ORM\ManyToMany(targetEntity="CoachBundle\Entity\PrimaryObjective")
     */
    private $primaryObjective;


    /**
     * @ORM\ManyToMany(targetEntity="CoachBundle\Entity\NumberOfPersons")
     */

    private $numberOfPersons;


    /**
     * @var bool
     *
     * @ORM\Column(name="service_approval", type="boolean")
     */
    private $serviceApproval;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="CoachBundle\Entity\CoachCourseReservation", mappedBy="idCourse", cascade={"remove"})
     */
    private $coachCourseReservation;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diploma = new \Doctrine\Common\Collections\ArrayCollection();
        $this->place = new \Doctrine\Common\Collections\ArrayCollection();
        $this->primaryObjective = new \Doctrine\Common\Collections\ArrayCollection();
        $this->numberOfPersons = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idAdress
     *
     * @param \CommunBundle\Entity\Adress $idAdress
     *
     * @return CoachInfo
     */
    public function setIdAdress(\CommunBundle\Entity\Adress $idAdress = null)
    {
        $this->idAdress = $idAdress;

        return $this;
    }

    /**
     * Get idAdress
     *
     * @return \CommunBundle\Entity\Adress
     */
    public function getIdAdress()
    {
        return $this->idAdress;
    }



    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return CoachCourse
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
     * @return CoachInfo
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
     * Set dateUpdate
     *
     * @param \DateTime $dateUpdate
     *
     * @return CoachCourse
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get dateUpdate
     *
     * @return \DateTime
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * Set experience
     *
     * @param string $experience
     *
     * @return CoachCourse
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set serviceApproval
     *
     * @param boolean $serviceApproval
     *
     * @return CoachCourse
     */
    public function setServiceApproval($serviceApproval)
    {
        $this->serviceApproval = $serviceApproval;

        return $this;
    }

    /**
     * Get serviceApproval
     *
     * @return boolean
     */
    public function getServiceApproval()
    {
        return $this->serviceApproval;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return CoachCourse
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set idCoach
     *
     * @param \CoachBundle\Entity\CoachInfo $idCoach
     *
     * @return CoachCourse
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

    /**
     * Set idCouseCategory
     *
     * @param \CommunBundle\Entity\ListCourseCategory $idCouseCategory
     *
     * @return CoachCourse
     */
    public function setIdCouseCategory(\CommunBundle\Entity\ListCourseCategory $idCouseCategory = null)
    {
        $this->idCouseCategory = $idCouseCategory;

        return $this;
    }

    /**
     * Get idCouseCategory
     *
     * @return \CommunBundle\Entity\ListCourseCategory
     */
    public function getIdCouseCategory()
    {
        return $this->idCouseCategory;
    }

    /**
     * Set movementRange
     *
     * @param \CoachBundle\Entity\MovementRange $movementRange
     *
     * @return CoachCourse
     */
    public function setMovementRange(\CoachBundle\Entity\MovementRange $movementRange = null)
    {
        $this->movementRange = $movementRange;

        return $this;
    }

    /**
     * Get movementRange
     *
     * @return \CoachBundle\Entity\MovementRange
     */
    public function getMovementRange()
    {
        return $this->movementRange;
    }

    /**
     * Add diploma
     *
     * @param \CoachBundle\Entity\Diploma $diploma
     *
     * @return CoachCourse
     */
    public function addDiploma(\CoachBundle\Entity\Diploma $diploma)
    {
        $this->diploma[] = $diploma;

        return $this;
    }

    /**
     * Remove diploma
     *
     * @param \CoachBundle\Entity\Diploma $diploma
     */
    public function removeDiploma(\CoachBundle\Entity\Diploma $diploma)
    {
        $this->diploma->removeElement($diploma);
    }

    /**
     * Get diploma
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiploma()
    {
        return $this->diploma;
    }

    /**
     * Add place
     *
     * @param \CoachBundle\Entity\Place $place
     *
     * @return CoachCourse
     */
    public function addPlace(\CoachBundle\Entity\Place $place)
    {
        $this->place[] = $place;

        return $this;
    }

    /**
     * Remove place
     *
     * @param \CoachBundle\Entity\Place $place
     */
    public function removePlace(\CoachBundle\Entity\Place $place)
    {
        $this->place->removeElement($place);
    }

    /**
     * Get place
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Add primaryObjective
     *
     * @param \CoachBundle\Entity\PrimaryObjective $primaryObjective
     *
     * @return CoachCourse
     */
    public function addPrimaryObjective(\CoachBundle\Entity\PrimaryObjective $primaryObjective)
    {
        $this->primaryObjective[] = $primaryObjective;

        return $this;
    }

    /**
     * Remove primaryObjective
     *
     * @param \CoachBundle\Entity\PrimaryObjective $primaryObjective
     */
    public function removePrimaryObjective(\CoachBundle\Entity\PrimaryObjective $primaryObjective)
    {
        $this->primaryObjective->removeElement($primaryObjective);
    }

    /**
     * Get primaryObjective
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrimaryObjective()
    {
        return $this->primaryObjective;
    }

    /**
     * Add numberOfPerson
     *
     * @param \CoachBundle\Entity\NumberOfPersons $numberOfPerson
     *
     * @return CoachCourse
     */
    public function addNumberOfPerson(\CoachBundle\Entity\NumberOfPersons $numberOfPerson)
    {
        $this->numberOfPersons[] = $numberOfPerson;

        return $this;
    }

    /**
     * Remove numberOfPerson
     *
     * @param \CoachBundle\Entity\NumberOfPersons $numberOfPerson
     */
    public function removeNumberOfPerson(\CoachBundle\Entity\NumberOfPersons $numberOfPerson)
    {
        $this->numberOfPersons->removeElement($numberOfPerson);
    }

    /**
     * Get numberOfPersons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNumberOfPersons()
    {
        return $this->numberOfPersons;
    }

    /**
     * Set coachCourseReservation
     *
     * @param \CoachBundle\Entity\CoachCourseReservation $coachCourseReservation
     *
     * @return CoachCourse
     */
    public function setCoachCourseReservation(\CoachBundle\Entity\CoachCourseReservation $coachCourseReservation = null)
    {
        $this->coachCourseReservation = $coachCourseReservation;

        return $this;
    }

    /**
     * Get coachCourseReservation
     *
     * @return \CoachBundle\Entity\CoachCourseReservation
     */
    public function getCoachCourseReservation()
    {
        return $this->coachCourseReservation;
    }
}
