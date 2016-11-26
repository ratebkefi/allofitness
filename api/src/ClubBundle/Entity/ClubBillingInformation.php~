<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubBillingInformation
 *
 * @ORM\Table(name="club_billing_information")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubBillingInformationRepository")
 */
class ClubBillingInformation
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
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubSubscriptionInvoice", inversedBy="clubBillingInformation")
     * @ORM\JoinColumn(name="id_club_subscription_invoice", referencedColumnName="id")
     */
    private $idClubSubscriptionInvoice;

    /**
     * @ORM\OneToOne(targetEntity="CommunBundle\Entity\Adress", inversedBy="clubBillingInformation")
     * @ORM\JoinColumn(name="id_adress", referencedColumnName="id")
     */
    private $idAdress;

    /**
     * @var int
     *
     * @ORM\Column(name="denomination", type="integer")
     */
    private $denomination;

    /**
     * @var string
     *
     * @ORM\Column(name="social_reason", type="string", length=150)
     */
    private $socialReason;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=250)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name_manager", type="string", length=150)
     */
    private $lastNameManager;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name_manager", type="string", length=150)
     */
    private $firstNameManager;



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
     * Set denomination
     *
     * @param integer $denomination
     *
     * @return ClubBillingInformation
     */
    public function setDenomination($denomination)
    {
        $this->denomination = $denomination;

        return $this;
    }

    /**
     * Get denomination
     *
     * @return integer
     */
    public function getDenomination()
    {
        return $this->denomination;
    }

    /**
     * Set socialReason
     *
     * @param string $socialReason
     *
     * @return ClubBillingInformation
     */
    public function setSocialReason($socialReason)
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    /**
     * Get socialReason
     *
     * @return string
     */
    public function getSocialReason()
    {
        return $this->socialReason;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return ClubBillingInformation
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set lastNameManager
     *
     * @param string $lastNameManager
     *
     * @return ClubBillingInformation
     */
    public function setLastNameManager($lastNameManager)
    {
        $this->lastNameManager = $lastNameManager;

        return $this;
    }

    /**
     * Get lastNameManager
     *
     * @return string
     */
    public function getLastNameManager()
    {
        return $this->lastNameManager;
    }

    /**
     * Set firstNameManager
     *
     * @param string $firstNameManager
     *
     * @return ClubBillingInformation
     */
    public function setFirstNameManager($firstNameManager)
    {
        $this->firstNameManager = $firstNameManager;

        return $this;
    }

    /**
     * Get firstNameManager
     *
     * @return string
     */
    public function getFirstNameManager()
    {
        return $this->firstNameManager;
    }

    /**
     * Set idClubSubscriptionInvoice
     *
     * @param \ClubBundle\Entity\ClubSubscriptionInvoice $idClubSubscriptionInvoice
     *
     * @return ClubBillingInformation
     */
    public function setIdClubSubscriptionInvoice(\ClubBundle\Entity\ClubSubscriptionInvoice $idClubSubscriptionInvoice = null)
    {
        $this->idClubSubscriptionInvoice = $idClubSubscriptionInvoice;

        return $this;
    }

    /**
     * Get idClubSubscriptionInvoice
     *
     * @return \ClubBundle\Entity\ClubSubscriptionInvoice
     */
    public function getIdClubSubscriptionInvoice()
    {
        return $this->idClubSubscriptionInvoice;
    }

    /**
     * Set idAdress
     *
     * @param \CommunBundle\Entity\Adress $idAdress
     *
     * @return ClubBillingInformation
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
}
