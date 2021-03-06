<?php

namespace MemberBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MemberInfo
 *
 * @ORM\Table(name="member_info")
 * @ORM\Entity(repositoryClass="MemberBundle\Repository\MemberInfoRepository")
 */
class MemberInfo
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
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User", inversedBy="memberInfo")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListPackage", inversedBy="memberInfo")
     * @ORM\JoinColumn(name="id_package", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idPackage;

    /**
     * @ORM\OneToOne(targetEntity="CommunBundle\Entity\Adress", inversedBy="memberInfo")
     * @ORM\JoinColumn(name="id_ddress", referencedColumnName="id")
     */
    private $idAdress;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=150)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=150)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private $birthDate;


    /**
     * @var string
     *
     * @ORM\Column(name="sponsored_mail", type="string", length=255, nullable=true)
     */
    private $sponsoredMail;


    /**
     * @var string
     *
     * @ORM\Column(name="mobile_phone", type="string", length=45)
     */
    private $mobilePhone;

    /**
     * @var bool
     *
     * @ORM\Column(name="registered_newsletter", type="boolean", nullable=true)
     */
    private $registeredNewsletter;

    /**
     * @var int
     *
     * @ORM\Column(name="id_sponsor", type="integer", nullable=true)
     */
    private $idSponsor;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="ClubBundle\Entity\ClubReservation", mappedBy="idMember" )
     */
    private $clubReservation;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clubReservation = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return MemberInfo
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return MemberInfo
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthDate
     *
     * @param \DateTime $birthDate
     *
     * @return MemberInfo
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get birthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set mobilePhone
     *
     * @param string $mobilePhone
     *
     * @return MemberInfo
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * Get mobilePhone
     *
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Set registeredNewsletter
     *
     * @param boolean $registeredNewsletter
     *
     * @return MemberInfo
     */
    public function setRegisteredNewsletter($registeredNewsletter)
    {
        $this->registeredNewsletter = $registeredNewsletter;

        return $this;
    }

    /**
     * Get registeredNewsletter
     *
     * @return boolean
     */
    public function getRegisteredNewsletter()
    {
        return $this->registeredNewsletter;
    }

    /**
     * Set idSponsor
     *
     * @param integer $idSponsor
     *
     * @return MemberInfo
     */
    public function setIdSponsor($idSponsor)
    {
        $this->idSponsor = $idSponsor;

        return $this;
    }

    /**
     * Get idSponsor
     *
     * @return integer
     */
    public function getIdSponsor()
    {
        return $this->idSponsor;
    }

    /**
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return MemberInfo
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

    /**
     * Set idPackage
     *
     * @param \CommunBundle\Entity\ListPackage $idPackage
     *
     * @return MemberInfo
     */
    public function setIdPackage(\CommunBundle\Entity\ListPackage $idPackage = null)
    {
        $this->idPackage = $idPackage;

        return $this;
    }

    /**
     * Get idPackage
     *
     * @return \CommunBundle\Entity\ListPackage
     */
    public function getIdPackage()
    {
        return $this->idPackage;
    }

    /**
     * Set idAdress
     *
     * @param \CommunBundle\Entity\Adress $idAdress
     *
     * @return MemberInfo
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
     * Add clubReservation
     *
     * @param \ClubBundle\Entity\ClubReservation $clubReservation
     *
     * @return MemberInfo
     */
    public function addClubReservation(\ClubBundle\Entity\ClubReservation $clubReservation)
    {
        $this->clubReservation[] = $clubReservation;

        return $this;
    }

    /**
     * Remove clubReservation
     *
     * @param \ClubBundle\Entity\ClubReservation $clubReservation
     */
    public function removeClubReservation(\ClubBundle\Entity\ClubReservation $clubReservation)
    {
        $this->clubReservation->removeElement($clubReservation);
    }

    /**
     * Get clubReservation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubReservation()
    {
        return $this->clubReservation;
    }

    /**
     * Set sponsoredMail
     *
     * @param string $sponsoredMail
     *
     * @return MemberInfo
     */
    public function setSponsoredMail($sponsoredMail)
    {
        $this->sponsoredMail = $sponsoredMail;

        return $this;
    }

    /**
     * Get sponsoredMail
     *
     * @return string
     */
    public function getSponsoredMail()
    {
        return $this->sponsoredMail;
    }
}
