<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adress
 *
 * @ORM\Table(name="adress")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\AdressRepository")
 */
class Adress
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
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListRegion", inversedBy="adress")
     * @ORM\JoinColumn(name="id_region", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idRegion;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListDepartement", inversedBy="adress")
     * @ORM\JoinColumn(name="id_departement", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idDepartement;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListCity", inversedBy="adress")
     * @ORM\JoinColumn(name="id_city", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idCity;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=200, nullable=true)
     */
    private $idCp;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListCountry", inversedBy="adress")
     * @ORM\JoinColumn(name="id_country", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idCountry;

    /**
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubInfo", mappedBy="idAdress", cascade={"remove"})
     */
    private $clubInfo;

    /**
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubBillingInformation", mappedBy="idAdress", cascade={"remove"})
     */
    private $clubBillingInformation;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=200, nullable=true)
     */
    private $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="adress_continued", type="string", length=200, nullable=true)
     */
    private $adress_continued;



    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=45, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=45, nullable=true)
     */
    private $latitude;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @ORM\OneToOne(targetEntity="CoachBundle\Entity\CoachCourse", mappedBy="idAdress", cascade={"remove"})
     */
    private $coachCourse;

    /**
     * @ORM\OneToOne(targetEntity="CoachBundle\Entity\CoachInfo", mappedBy="idAdress", cascade={"remove"})
     */
    private $coachInfo;

    /**
     * @ORM\OneToOne(targetEntity="MemberBundle\Entity\MemberInfo", mappedBy="idAdress", cascade={"remove"})
     */
    private $memberInfo;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etat = 0;
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
     * Set adress
     *
     * @param string $adress
     *
     * @return Adress
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set adressContinued
     *
     * @param string $adressContinued
     *
     * @return Adress
     */
    public function setAdressContinued($adressContinued)
    {
        $this->adress_continued = $adressContinued;

        return $this;
    }

    /**
     * Get adressContinued
     *
     * @return string
     */
    public function getAdressContinued()
    {
        return $this->adress_continued;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Adress
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Adress
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Adress
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
     * @return Adress
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
     * Set idRegion
     *
     * @param \CommunBundle\Entity\ListRegion $idRegion
     *
     * @return Adress
     */
    public function setIdRegion(\CommunBundle\Entity\ListRegion $idRegion = null)
    {
        $this->idRegion = $idRegion;

        return $this;
    }

    /**
     * Get idRegion
     *
     * @return \CommunBundle\Entity\ListRegion
     */
    public function getIdRegion()
    {
        return $this->idRegion;
    }

    /**
     * Set idDepartement
     *
     * @param \CommunBundle\Entity\ListDepartement $idDepartement
     *
     * @return Adress
     */
    public function setIdDepartement(\CommunBundle\Entity\ListDepartement $idDepartement = null)
    {
        $this->idDepartement = $idDepartement;

        return $this;
    }

    /**
     * Get idDepartement
     *
     * @return \CommunBundle\Entity\ListDepartement
     */
    public function getIdDepartement()
    {
        return $this->idDepartement;
    }

    /**
     * Set idCity
     *
     * @param \CommunBundle\Entity\ListCity $idCity
     *
     * @return Adress
     */
    public function setIdCity(\CommunBundle\Entity\ListCity $idCity = null)
    {
        $this->idCity = $idCity;

        return $this;
    }

    /**
     * Get idCity
     *
     * @return \CommunBundle\Entity\ListCity
     */
    public function getIdCity()
    {
        return $this->idCity;
    }


    /**
     * Set idCountry
     *
     * @param \CommunBundle\Entity\ListCountry $idCountry
     *
     * @return Adress
     */
    public function setIdCountry(\CommunBundle\Entity\ListCountry $idCountry = null)
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    /**
     * Get idCountry
     *
     * @return \CommunBundle\Entity\ListCountry
     */
    public function getIdCountry()
    {
        return $this->idCountry;
    }

    /**
     * Set clubInfo
     *
     * @param \ClubBundle\Entity\ClubInfo $clubInfo
     *
     * @return Adress
     */
    public function setClubInfo(\ClubBundle\Entity\ClubInfo $clubInfo = null)
    {
        $this->clubInfo = $clubInfo;

        return $this;
    }

    /**
     * Get clubInfo
     *
     * @return \ClubBundle\Entity\ClubInfo
     */
    public function getClubInfo()
    {
        return $this->clubInfo;
    }

    /**
     * Set clubBillingInformation
     *
     * @param \ClubBundle\Entity\ClubBillingInformation $clubBillingInformation
     *
     * @return Adress
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

    /**
     * Set coachCourse
     *
     * @param \CoachBundle\Entity\CoachCourse $coachCourse
     *
     * @return Adress
     */
    public function setCoachCourse(\CoachBundle\Entity\CoachCourse $coachCourse = null)
    {
        $this->coachCourse = $coachCourse;

        return $this;
    }

    /**
     * Get coachCourse
     *
     * @return \CoachBundle\Entity\CoachCourse
     */
    public function getCoachCourse()
    {
        return $this->coachCourse;
    }

    /**
     * Set coachInfo
     *
     * @param \CoachBundle\Entity\CoachInfo $coachInfo
     *
     * @return Adress
     */
    public function setCoachInfo(\CoachBundle\Entity\CoachInfo $coachInfo = null)
    {
        $this->coachInfo = $coachInfo;

        return $this;
    }

    /**
     * Get coachInfo
     *
     * @return \CoachBundle\Entity\CoachInfo
     */
    public function getCoachInfo()
    {
        return $this->coachInfo;
    }

    /**
     * Set memberInfo
     *
     * @param \MemberBundle\Entity\MemberInfo $memberInfo
     *
     * @return Adress
     */
    public function setMemberInfo(\MemberBundle\Entity\MemberInfo $memberInfo = null)
    {
        $this->memberInfo = $memberInfo;

        return $this;
    }

    /**
     * Get memberInfo
     *
     * @return \MemberBundle\Entity\MemberInfo
     */
    public function getMemberInfo()
    {
        return $this->memberInfo;
    }

    /**
     * Set idCp
     *
     * @param string $idCp
     *
     * @return Adress
     */
    public function setIdCp($idCp)
    {
        $this->idCp = $idCp;

        return $this;
    }

    /**
     * Get idCp
     *
     * @return string
     */
    public function getIdCp()
    {
        return $this->idCp;
    }
}
