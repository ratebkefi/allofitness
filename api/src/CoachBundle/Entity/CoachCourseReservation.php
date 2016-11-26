<?php

namespace CoachBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoachCourseReservation
 *
 * @ORM\Table(name="coach_course_reservation")
 * @ORM\Entity(repositoryClass="CoachBundle\Repository\CoachCourseReservationRepository")
 */
class CoachCourseReservation
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
     * @ORM\OneToOne(targetEntity="CoachBundle\Entity\CoachCourse", inversedBy="coachCourseReservation")
     * @ORM\JoinColumn(name="id_course", referencedColumnName="id")
     */
    private $idCourse;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="coachCourseReservation")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idUser;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\PaymentMethod", inversedBy="coachCourseReservation")
     * @ORM\JoinColumn(name="number_of_persons", referencedColumnName="id",onDelete="CASCADE")
     */
    private $paymentMethod;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_date", type="datetime")
     */
    private $paymentDate;

    /**
     * @var int
     *
     * @ORM\Column(name="number_of_participants", type="integer")
     */
    private $numberOfParticipants;


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
     * Set price
     *
     * @param float $price
     *
     * @return CoachCourseReservation
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
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return CoachCourseReservation
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
     * @return CoachCourseReservation
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
     * Set paymentMethod
     *
     * @param string $paymentMethod
     *
     * @return CoachCourseReservation
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set paymentDate
     *
     * @param \DateTime $paymentDate
     *
     * @return CoachCourseReservation
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Get paymentDate
     *
     * @return \DateTime
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set numberOfParticipants
     *
     * @param integer $numberOfParticipants
     *
     * @return CoachCourseReservation
     */
    public function setNumberOfParticipants($numberOfParticipants)
    {
        $this->numberOfParticipants = $numberOfParticipants;

        return $this;
    }

    /**
     * Get numberOfParticipants
     *
     * @return integer
     */
    public function getNumberOfParticipants()
    {
        return $this->numberOfParticipants;
    }

    /**
     * Set idCourse
     *
     * @param \CoachBundle\Entity\CoachCourse $idCourse
     *
     * @return CoachCourseReservation
     */
    public function setIdCourse(\CoachBundle\Entity\CoachCourse $idCourse = null)
    {
        $this->idCourse = $idCourse;

        return $this;
    }

    /**
     * Get idCourse
     *
     * @return \CoachBundle\Entity\CoachCourse
     */
    public function getIdCourse()
    {
        return $this->idCourse;
    }

    /**
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return CoachCourseReservation
     */
    public function setIdUser(\UserBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
