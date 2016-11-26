<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubSubscriptionInvoice
 *
 * @ORM\Table(name="club_subscription_invoice")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubSubscriptionInvoiceRepository")
 */
class ClubSubscriptionInvoice
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
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ClubInfo", inversedBy="clubSubscriptionInvoice")
     * @ORM\JoinColumn(name="id_club", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idClub;

    /**
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubBillingInformation", mappedBy="idClubSubscriptionInvoice", cascade={"remove"})
     */
    private $clubBillingInformation;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var float
     *
     * @ORM\Column(name="price_without_tax", type="float")
     */
    private $priceWithoutTax;

    /**
     * @var bool
     *
     * @ORM\Column(name="account_activation", type="boolean")
     */
    private $accountActivation;

    /**
     * @var float
     *
     * @ORM\Column(name="account_activation_fees_without_tax", type="float")
     */
    private $accountActivationFeesWithoutTax;

    /**
     * @var float
     *
     * @ORM\Column(name="tva", type="float")
     */
    private $tva;

    /**
     * @var float
     *
     * @ORM\Column(name="total_without_tax", type="float")
     */
    private $totalWithoutTax;

    /**
     * @var float
     *
     * @ORM\Column(name="total_all_taxes_included", type="float")
     */
    private $totalAllTaxesIncluded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="date")
     */
    private $dueDate;

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
     * Set duration
     *
     * @param integer $duration
     *
     * @return ClubSubscriptionInvoice
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set priceWithoutTax
     *
     * @param float $priceWithoutTax
     *
     * @return ClubSubscriptionInvoice
     */
    public function setPriceWithoutTax($priceWithoutTax)
    {
        $this->priceWithoutTax = $priceWithoutTax;

        return $this;
    }

    /**
     * Get priceWithoutTax
     *
     * @return float
     */
    public function getPriceWithoutTax()
    {
        return $this->priceWithoutTax;
    }

    /**
     * Set accountActivation
     *
     * @param boolean $accountActivation
     *
     * @return ClubSubscriptionInvoice
     */
    public function setAccountActivation($accountActivation)
    {
        $this->accountActivation = $accountActivation;

        return $this;
    }

    /**
     * Get accountActivation
     *
     * @return boolean
     */
    public function getAccountActivation()
    {
        return $this->accountActivation;
    }

    /**
     * Set accountActivationFeesWithoutTax
     *
     * @param float $accountActivationFeesWithoutTax
     *
     * @return ClubSubscriptionInvoice
     */
    public function setAccountActivationFeesWithoutTax($accountActivationFeesWithoutTax)
    {
        $this->accountActivationFeesWithoutTax = $accountActivationFeesWithoutTax;

        return $this;
    }

    /**
     * Get accountActivationFeesWithoutTax
     *
     * @return float
     */
    public function getAccountActivationFeesWithoutTax()
    {
        return $this->accountActivationFeesWithoutTax;
    }

    /**
     * Set tva
     *
     * @param float $tva
     *
     * @return ClubSubscriptionInvoice
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return float
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set totalWithoutTax
     *
     * @param float $totalWithoutTax
     *
     * @return ClubSubscriptionInvoice
     */
    public function setTotalWithoutTax($totalWithoutTax)
    {
        $this->totalWithoutTax = $totalWithoutTax;

        return $this;
    }

    /**
     * Get totalWithoutTax
     *
     * @return float
     */
    public function getTotalWithoutTax()
    {
        return $this->totalWithoutTax;
    }

    /**
     * Set totalAllTaxesIncluded
     *
     * @param float $totalAllTaxesIncluded
     *
     * @return ClubSubscriptionInvoice
     */
    public function setTotalAllTaxesIncluded($totalAllTaxesIncluded)
    {
        $this->totalAllTaxesIncluded = $totalAllTaxesIncluded;

        return $this;
    }

    /**
     * Get totalAllTaxesIncluded
     *
     * @return float
     */
    public function getTotalAllTaxesIncluded()
    {
        return $this->totalAllTaxesIncluded;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return ClubSubscriptionInvoice
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return ClubSubscriptionInvoice
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return ClubSubscriptionInvoice
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
     * @return ClubSubscriptionInvoice
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
     * Set idClub
     *
     * @param \ClubBundle\Entity\ClubInfo $idClub
     *
     * @return ClubSubscriptionInvoice
     */
    public function setIdClub(\ClubBundle\Entity\ClubInfo $idClub = null)
    {
        $this->idClub = $idClub;

        return $this;
    }

    /**
     * Get idClub
     *
     * @return \ClubBundle\Entity\ClubInfo
     */
    public function getIdClub()
    {
        return $this->idClub;
    }

    /**
     * Set clubBillingInformation
     *
     * @param \ClubBundle\Entity\ClubBillingInformation $clubBillingInformation
     *
     * @return ClubSubscriptionInvoice
     */
    public function setClubBillingInformation(\ClubBundle\Entity\ClubBillingInformation $clubBillingInformation = null)
    {
        $this->clubBillingInformation = $clubBillingInformation;

        return $this;
    }

    /**
     * Get clubBillingInformation
     *
     * @return \ClubBundle\Entity\ClubBillingInformation
     */
    public function getClubBillingInformation()
    {
        return $this->clubBillingInformation;
    }
}
