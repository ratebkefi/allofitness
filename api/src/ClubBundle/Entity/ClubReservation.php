<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubReservation
 *
 * @ORM\Table(name="club_reservation")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubReservationRepository")
 */
class ClubReservation
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
     * @var int
     *
     * @ORM\Column(name="id_club", type="integer")
     */
    private $idClub;

    /**
     * @ORM\ManyToOne(targetEntity="MemberBundle\Entity\MemberInfo", inversedBy="clubReservation")
     * @ORM\JoinColumn(name="id_member", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idMember;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date")
     */
    private $dateReservation;

    /**
     * @var float
     *
     * @ORM\Column(name="percentage_reduction", type="float")
     */
    private $percentageReduction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_date", type="datetime")
     */


    private $paymentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_method", type="string", length=150)
     */

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\PaymentMethod", inversedBy="clubReservation")
     * @ORM\JoinColumn(name="payment_method", referencedColumnName="id",onDelete="CASCADE")
     */
    private $paymentMethod;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

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
     * Set idClub
     *
     * @param integer $idClub
     *
     * @return ClubReservation
     */
    public function setIdClub($idClub)
    {
        $this->idClub = $idClub;

        return $this;
    }

    /**
     * Get idClub
     *
     * @return integer
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return ClubReservation
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
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     *
     * @return ClubReservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set percentageReduction
     *
     * @param float $percentageReduction
     *
     * @return ClubReservation
     */
    public function setPercentageReduction($percentageReduction)
    {
        $this->percentageReduction = $percentageReduction;

        return $this;
    }

    /**
     * Get percentageReduction
     *
     * @return float
     */
    public function getPercentageReduction()
    {
        return $this->percentageReduction;
    }

    /**
     * Set paymentDate
     *
     * @param \DateTime $paymentDate
     *
     * @return ClubReservation
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
     * Set paymentMethod
     *
     * @param string $paymentMethod
     *
     * @return ClubReservation
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
     * Set status
     *
     * @param integer $status
     *
     * @return ClubReservation
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
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return ClubReservation
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
     * Set idMember
     *
     * @param \MemberBundle\Entity\MemberInfo $idMember
     *
     * @return ClubReservation
     */
    public function setIdMember(\MemberBundle\Entity\MemberInfo $idMember = null)
    {
        $this->idMember = $idMember;

        return $this;
    }

    /**
     * Get idMember
     *
     * @return \MemberBundle\Entity\MemberInfo
     */
    public function getIdMember()
    {
        return $this->idMember;
    }
}
