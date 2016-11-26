<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubAccess
 *
 * @ORM\Table(name="club_access")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubAccessRepository")
 */
class ClubAccess
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
     * @var bool
     *
     * @ORM\Column(name="metro", type="boolean", nullable=true)
     */
    private $metro;

    /**
     * @var string
     *
     * @ORM\Column(name="metro_description", type="text", nullable=true)
     */
    private $metroDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="rer", type="boolean", nullable=true)
     */
    private $rer;

    /**
     * @var string
     *
     * @ORM\Column(name="rer_description", type="text", nullable=true)
     */
    private $rerDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="tramway", type="boolean", nullable=true)
     */
    private $tramway;

    /**
     * @var string
     *
     * @ORM\Column(name="tramway_description", type="text", nullable=true)
     */
    private $tramwayDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="bus", type="boolean", nullable=true)
     */
    private $bus;

    /**
     * @var string
     *
     * @ORM\Column(name="bus_description", type="text", nullable=true)
     */
    private $busDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="borne_velo", type="boolean", nullable=true)
     */
    private $borneVelo;

    /**
     * @var string
     *
     * @ORM\Column(name="borne_velo_description", type="text", nullable=true)
     */
    private $borneVeloDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="parking", type="boolean", nullable=true)
     */
    private $parking;

    /**
     * @var string
     *
     * @ORM\Column(name="parking_description", type="text", nullable=true)
     */
    private $parkingDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="routier", type="boolean", nullable=true)
     */
    private $routier;

    /**
     * @var string
     *
     * @ORM\Column(name="routier_description", type="text", nullable=true)
     */
    private $routierDescription;

    /**
     * @var bool
     *
     * @ORM\Column(name="autres", type="boolean", nullable=true)
     */
    private $autres;

    /**
     * @var string
     *
     * @ORM\Column(name="autres_description", type="text", nullable=true)
     */
    private $autresDescription;

    /**
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubInfo", mappedBy="idAccess", cascade={"remove"})
     */
    private $clubInfo;




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
     * Set metro
     *
     * @param boolean $metro
     *
     * @return ClubAccess
     */
    public function setMetro($metro)
    {
        $this->metro = $metro;

        return $this;
    }

    /**
     * Get metro
     *
     * @return boolean
     */
    public function getMetro()
    {
        return $this->metro;
    }

    /**
     * Set metroDescription
     *
     * @param string $metroDescription
     *
     * @return ClubAccess
     */
    public function setMetroDescription($metroDescription)
    {
        $this->metroDescription = $metroDescription;

        return $this;
    }

    /**
     * Get metroDescription
     *
     * @return string
     */
    public function getMetroDescription()
    {
        return $this->metroDescription;
    }

    /**
     * Set rer
     *
     * @param boolean $rer
     *
     * @return ClubAccess
     */
    public function setRer($rer)
    {
        $this->rer = $rer;

        return $this;
    }

    /**
     * Get rer
     *
     * @return boolean
     */
    public function getRer()
    {
        return $this->rer;
    }

    /**
     * Set rerDescription
     *
     * @param string $rerDescription
     *
     * @return ClubAccess
     */
    public function setRerDescription($rerDescription)
    {
        $this->rerDescription = $rerDescription;

        return $this;
    }

    /**
     * Get rerDescription
     *
     * @return string
     */
    public function getRerDescription()
    {
        return $this->rerDescription;
    }

    /**
     * Set tramway
     *
     * @param boolean $tramway
     *
     * @return ClubAccess
     */
    public function setTramway($tramway)
    {
        $this->tramway = $tramway;

        return $this;
    }

    /**
     * Get tramway
     *
     * @return boolean
     */
    public function getTramway()
    {
        return $this->tramway;
    }

    /**
     * Set tramwayDescription
     *
     * @param string $tramwayDescription
     *
     * @return ClubAccess
     */
    public function setTramwayDescription($tramwayDescription)
    {
        $this->tramwayDescription = $tramwayDescription;

        return $this;
    }

    /**
     * Get tramwayDescription
     *
     * @return string
     */
    public function getTramwayDescription()
    {
        return $this->tramwayDescription;
    }

    /**
     * Set bus
     *
     * @param boolean $bus
     *
     * @return ClubAccess
     */
    public function setBus($bus)
    {
        $this->bus = $bus;

        return $this;
    }

    /**
     * Get bus
     *
     * @return boolean
     */
    public function getBus()
    {
        return $this->bus;
    }

    /**
     * Set busDescription
     *
     * @param string $busDescription
     *
     * @return ClubAccess
     */
    public function setBusDescription($busDescription)
    {
        $this->busDescription = $busDescription;

        return $this;
    }

    /**
     * Get busDescription
     *
     * @return string
     */
    public function getBusDescription()
    {
        return $this->busDescription;
    }

    /**
     * Set borneVelo
     *
     * @param boolean $borneVelo
     *
     * @return ClubAccess
     */
    public function setBorneVelo($borneVelo)
    {
        $this->borneVelo = $borneVelo;

        return $this;
    }

    /**
     * Get borneVelo
     *
     * @return boolean
     */
    public function getBorneVelo()
    {
        return $this->borneVelo;
    }

    /**
     * Set borneVeloDescription
     *
     * @param string $borneVeloDescription
     *
     * @return ClubAccess
     */
    public function setBorneVeloDescription($borneVeloDescription)
    {
        $this->borneVeloDescription = $borneVeloDescription;

        return $this;
    }

    /**
     * Get borneVeloDescription
     *
     * @return string
     */
    public function getBorneVeloDescription()
    {
        return $this->borneVeloDescription;
    }

    /**
     * Set parking
     *
     * @param boolean $parking
     *
     * @return ClubAccess
     */
    public function setParking($parking)
    {
        $this->parking = $parking;

        return $this;
    }

    /**
     * Get parking
     *
     * @return boolean
     */
    public function getParking()
    {
        return $this->parking;
    }

    /**
     * Set parkingDescription
     *
     * @param string $parkingDescription
     *
     * @return ClubAccess
     */
    public function setParkingDescription($parkingDescription)
    {
        $this->parkingDescription = $parkingDescription;

        return $this;
    }

    /**
     * Get parkingDescription
     *
     * @return string
     */
    public function getParkingDescription()
    {
        return $this->parkingDescription;
    }

    /**
     * Set routier
     *
     * @param boolean $routier
     *
     * @return ClubAccess
     */
    public function setRoutier($routier)
    {
        $this->routier = $routier;

        return $this;
    }

    /**
     * Get routier
     *
     * @return boolean
     */
    public function getRoutier()
    {
        return $this->routier;
    }

    /**
     * Set routierDescription
     *
     * @param string $routierDescription
     *
     * @return ClubAccess
     */
    public function setRoutierDescription($routierDescription)
    {
        $this->routierDescription = $routierDescription;

        return $this;
    }

    /**
     * Get routierDescription
     *
     * @return string
     */
    public function getRoutierDescription()
    {
        return $this->routierDescription;
    }

    /**
     * Set autres
     *
     * @param boolean $autres
     *
     * @return ClubAccess
     */
    public function setAutres($autres)
    {
        $this->autres = $autres;

        return $this;
    }

    /**
     * Get autres
     *
     * @return boolean
     */
    public function getAutres()
    {
        return $this->autres;
    }

    /**
     * Set autresDescription
     *
     * @param string $autresDescription
     *
     * @return ClubAccess
     */
    public function setAutresDescription($autresDescription)
    {
        $this->autresDescription = $autresDescription;

        return $this;
    }

    /**
     * Get autresDescription
     *
     * @return string
     */
    public function getAutresDescription()
    {
        return $this->autresDescription;
    }

    /**
     * Set clubInfo
     *
     * @param \ClubBundle\Entity\ClubInfo $clubInfo
     *
     * @return ClubAccess
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
}
