<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubInfo
 *
 * @ORM\Table(name="club_info")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubInfoRepository")
 */
class ClubInfo
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
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListPackage", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_package", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idPackage;

    /**
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ClubNetwork", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_network", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idNetwork;


    /**
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ListClubFunction", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="responsible_function", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idFunction;

    /**
     * @ORM\OneToOne(targetEntity="CommunBundle\Entity\Adress", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_adress", referencedColumnName="id")
     */
    private $idAdress;

    /**
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ListClubType", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_type", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idType;


    /**
     * @var string
     *
     * @ORM\Column(name="club_name", type="string", length=200)
     */
    private $clubName;

    /**
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubAccess", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_access", referencedColumnName="id")
     */
    private $idAccess;


    /**
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubActivitiesAmenitiesConfortServices", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_club_activities_amenities", referencedColumnName="id")
     */
    private $idClubActivitiesAmenitiesConfortServices;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name_responsible", type="string", length=150)
     */
    private $firstNameResponsible;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name_responsible", type="string", length=150)
     */
    private $lastNameResponsible;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="cellphone", type="string", length=45, nullable=true)
     */
    private $cellphone;



    /**
     * @var string
     *
     * @ORM\Column(name="email_of_the_person_contacted", type="string", length=255)
     */
    private $emailOfThePersonContacted;

    /**
     * @var string
     *
     * @ORM\Column(name="email_of_the_person_contacted_cc", type="string", length=255, nullable=true)
     */
    private $emailOfThePersonContactedCc;

    /**
     * @var string
     *
     * @ORM\Column(name="url_site", type="string", length=255)
     */
    private $urlSite;


    /**
     * @var string
     *
     * @ORM\Column(name="presentation_1", type="text", nullable=true)
     */
    private $presentation1;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation_2", type="text", nullable=true)
     */
    private $presentation2;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation_3", type="text", nullable=true)
     */
    private $presentation3;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation_4", type="text", nullable=true)
     */
    private $presentation4;

    /**
     * @var int
     *
     * @ORM\Column(name="number_discovery_pass", type="integer", nullable=true)
     */
    private $numberDiscoveryPass;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime", nullable=true)
     */
    private $dateAdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="invitation_and_discovery_pass", type="integer", nullable=true)
     */
    private $invitationAndDiscoveryPass;



    /**
     * @ORM\OneToOne(targetEntity="UserBundle\Entity\User", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUser;



    /**
     * @var integer
     *
     * @ORM\Column(name="moy_reviews", type="float", scale=2, options={"default"=0})
     */
    private $moyReviews;

    /**
     * @ORM\OneToMany(targetEntity="ClubBundle\Entity\ClubMedia", mappedBy="idClub", cascade={"remove"})
     */
    private $clubMedia;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListArea", inversedBy="clubInfo")
     * @ORM\JoinColumn(name="id_area", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idArea;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clubMedia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateAdd = new \DateTime('now');
        $this->moyReviews = 0;
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
     * Set clubName
     *
     * @param string $clubName
     *
     * @return ClubInfo
     */
    public function setClubName($clubName)
    {
        $this->clubName = $clubName;

        return $this;
    }

    /**
     * Get clubName
     *
     * @return string
     */
    public function getClubName()
    {
        return $this->clubName;
    }

    /**
     * Set firstNameResponsible
     *
     * @param string $firstNameResponsible
     *
     * @return ClubInfo
     */
    public function setFirstNameResponsible($firstNameResponsible)
    {
        $this->firstNameResponsible = $firstNameResponsible;

        return $this;
    }

    /**
     * Get firstNameResponsible
     *
     * @return string
     */
    public function getFirstNameResponsible()
    {
        return $this->firstNameResponsible;
    }

    /**
     * Set lastNameResponsible
     *
     * @param string $lastNameResponsible
     *
     * @return ClubInfo
     */
    public function setLastNameResponsible($lastNameResponsible)
    {
        $this->lastNameResponsible = $lastNameResponsible;

        return $this;
    }

    /**
     * Get lastNameResponsible
     *
     * @return string
     */
    public function getLastNameResponsible()
    {
        return $this->lastNameResponsible;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return ClubInfo
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cellphone
     *
     * @param string $cellphone
     *
     * @return ClubInfo
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    /**
     * Get cellphone
     *
     * @return string
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set emailOfThePersonContacted
     *
     * @param string $emailOfThePersonContacted
     *
     * @return ClubInfo
     */
    public function setEmailOfThePersonContacted($emailOfThePersonContacted)
    {
        $this->emailOfThePersonContacted = $emailOfThePersonContacted;

        return $this;
    }

    /**
     * Get emailOfThePersonContacted
     *
     * @return string
     */
    public function getEmailOfThePersonContacted()
    {
        return $this->emailOfThePersonContacted;
    }

    /**
     * Set emailOfThePersonContactedCc
     *
     * @param string $emailOfThePersonContactedCc
     *
     * @return ClubInfo
     */
    public function setEmailOfThePersonContactedCc($emailOfThePersonContactedCc)
    {
        $this->emailOfThePersonContactedCc = $emailOfThePersonContactedCc;

        return $this;
    }

    /**
     * Get emailOfThePersonContactedCc
     *
     * @return string
     */
    public function getEmailOfThePersonContactedCc()
    {
        return $this->emailOfThePersonContactedCc;
    }

    /**
     * Set urlSite
     *
     * @param string $urlSite
     *
     * @return ClubInfo
     */
    public function setUrlSite($urlSite)
    {
        $this->urlSite = $urlSite;

        return $this;
    }

    /**
     * Get urlSite
     *
     * @return string
     */
    public function getUrlSite()
    {
        return $this->urlSite;
    }

    /**
     * Set presentation1
     *
     * @param string $presentation1
     *
     * @return ClubInfo
     */
    public function setPresentation1($presentation1)
    {
        $this->presentation1 = $presentation1;

        return $this;
    }

    /**
     * Get presentation1
     *
     * @return string
     */
    public function getPresentation1()
    {
        return $this->presentation1;
    }

    /**
     * Set presentation2
     *
     * @param string $presentation2
     *
     * @return ClubInfo
     */
    public function setPresentation2($presentation2)
    {
        $this->presentation2 = $presentation2;

        return $this;
    }

    /**
     * Get presentation2
     *
     * @return string
     */
    public function getPresentation2()
    {
        return $this->presentation2;
    }

    /**
     * Set presentation3
     *
     * @param string $presentation3
     *
     * @return ClubInfo
     */
    public function setPresentation3($presentation3)
    {
        $this->presentation3 = $presentation3;

        return $this;
    }

    /**
     * Get presentation3
     *
     * @return string
     */
    public function getPresentation3()
    {
        return $this->presentation3;
    }

    /**
     * Set presentation4
     *
     * @param string $presentation4
     *
     * @return ClubInfo
     */
    public function setPresentation4($presentation4)
    {
        $this->presentation4 = $presentation4;

        return $this;
    }

    /**
     * Get presentation4
     *
     * @return string
     */
    public function getPresentation4()
    {
        return $this->presentation4;
    }

    /**
     * Set numberDiscoveryPass
     *
     * @param integer $numberDiscoveryPass
     *
     * @return ClubInfo
     */
    public function setNumberDiscoveryPass($numberDiscoveryPass)
    {
        $this->numberDiscoveryPass = $numberDiscoveryPass;

        return $this;
    }

    /**
     * Get numberDiscoveryPass
     *
     * @return integer
     */
    public function getNumberDiscoveryPass()
    {
        return $this->numberDiscoveryPass;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return ClubInfo
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
     * @return ClubInfo
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
     * Set invitationAndDiscoveryPass
     *
     * @param integer $invitationAndDiscoveryPass
     *
     * @return ClubInfo
     */
    public function setInvitationAndDiscoveryPass($invitationAndDiscoveryPass)
    {
        $this->invitationAndDiscoveryPass = $invitationAndDiscoveryPass;

        return $this;
    }

    /**
     * Get invitationAndDiscoveryPass
     *
     * @return integer
     */
    public function getInvitationAndDiscoveryPass()
    {
        return $this->invitationAndDiscoveryPass;
    }

    /**
     * Set moyReviews
     *
     * @param float $moyReviews
     *
     * @return ClubInfo
     */
    public function setMoyReviews($moyReviews)
    {
        $this->moyReviews = $moyReviews;

        return $this;
    }

    /**
     * Get moyReviews
     *
     * @return float
     */
    public function getMoyReviews()
    {
        return $this->moyReviews;
    }

    /**
     * Set idPackage
     *
     * @param \CommunBundle\Entity\ListPackage $idPackage
     *
     * @return ClubInfo
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
     * Set idNetwork
     *
     * @param \ClubBundle\Entity\ClubNetwork $idNetwork
     *
     * @return ClubInfo
     */
    public function setIdNetwork(\ClubBundle\Entity\ClubNetwork $idNetwork = null)
    {
        $this->idNetwork = $idNetwork;

        return $this;
    }

    /**
     * Get idNetwork
     *
     * @return \ClubBundle\Entity\ClubNetwork
     */
    public function getIdNetwork()
    {
        return $this->idNetwork;
    }

    /**
     * Set idFunction
     *
     * @param \ClubBundle\Entity\ListClubFunction $idFunction
     *
     * @return ClubInfo
     */
    public function setIdFunction(\ClubBundle\Entity\ListClubFunction $idFunction = null)
    {
        $this->idFunction = $idFunction;

        return $this;
    }

    /**
     * Get idFunction
     *
     * @return \ClubBundle\Entity\ListClubFunction
     */
    public function getIdFunction()
    {
        return $this->idFunction;
    }

    /**
     * Set idAdress
     *
     * @param \CommunBundle\Entity\Adress $idAdress
     *
     * @return ClubInfo
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
     * Set idType
     *
     * @param \ClubBundle\Entity\ListClubType $idType
     *
     * @return ClubInfo
     */
    public function setIdType(\ClubBundle\Entity\ListClubType $idType = null)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return \ClubBundle\Entity\ListClubType
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set idAccess
     *
     * @param \ClubBundle\Entity\ClubAccess $idAccess
     *
     * @return ClubInfo
     */
    public function setIdAccess(\ClubBundle\Entity\ClubAccess $idAccess = null)
    {
        $this->idAccess = $idAccess;

        return $this;
    }

    /**
     * Get idAccess
     *
     * @return \ClubBundle\Entity\ClubAccess
     */
    public function getIdAccess()
    {
        return $this->idAccess;
    }

    /**
     * Set idClubActivitiesAmenitiesConfortServices
     *
     * @param \ClubBundle\Entity\ClubActivitiesAmenitiesConfortServices $idClubActivitiesAmenitiesConfortServices
     *
     * @return ClubInfo
     */
    public function setIdClubActivitiesAmenitiesConfortServices(\ClubBundle\Entity\ClubActivitiesAmenitiesConfortServices $idClubActivitiesAmenitiesConfortServices = null)
    {
        $this->idClubActivitiesAmenitiesConfortServices = $idClubActivitiesAmenitiesConfortServices;

        return $this;
    }

    /**
     * Get idClubActivitiesAmenitiesConfortServices
     *
     * @return \ClubBundle\Entity\ClubActivitiesAmenitiesConfortServices
     */
    public function getIdClubActivitiesAmenitiesConfortServices()
    {
        return $this->idClubActivitiesAmenitiesConfortServices;
    }

    /**
     * Set idUser
     *
     * @param \UserBundle\Entity\User $idUser
     *
     * @return ClubInfo
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
     * Add clubMedia
     *
     * @param \ClubBundle\Entity\ClubMedia $clubMedia
     *
     * @return ClubInfo
     */
    public function addClubMedia(\ClubBundle\Entity\ClubMedia $clubMedia)
    {
        $this->clubMedia[] = $clubMedia;

        return $this;
    }

    /**
     * Remove clubMedia
     *
     * @param \ClubBundle\Entity\ClubMedia $clubMedia
     */
    public function removeClubMedia(\ClubBundle\Entity\ClubMedia $clubMedia)
    {
        $this->clubMedia->removeElement($clubMedia);
    }

    /**
     * Get clubMedia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubMedia()
    {
        return $this->clubMedia;
    }

    /**
     * Set idArea
     *
     * @param \CommunBundle\Entity\ListArea $idArea
     *
     * @return ClubInfo
     */
    public function setIdArea(\CommunBundle\Entity\ListArea $idArea = null)
    {
        $this->idArea = $idArea;

        return $this;
    }

    /**
     * Get idArea
     *
     * @return \CommunBundle\Entity\ListArea
     */
    public function getIdArea()
    {
        return $this->idArea;
    }
}
