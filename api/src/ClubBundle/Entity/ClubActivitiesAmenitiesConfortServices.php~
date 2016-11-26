<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubActivitiesAmenitiesConfortServices
 *
 * @ORM\Table(name="club_activities_amenities_confort_services")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubActivitiesAmenitiesConfortServicesRepository")
 */
class ClubActivitiesAmenitiesConfortServices
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
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubInfo", mappedBy="idClubActivitiesAmenitiesConfortServices", cascade={"remove"})
     */
    private $clubInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="course_schedule", type="string", length=150, nullable=true)
     */
    private $courseSchedule;

    /**
     * @ORM\ManyToMany(targetEntity="ClubBundle\Entity\ClubActivitie")
     */
    private $clubActivitie;

    /**
     * @ORM\ManyToMany(targetEntity="ClubBundle\Entity\ClubEquipement")
     */
    private $equipment;

    /**
     * @var string
     *
     * @ORM\Column(name="equipment_other", type="string", length=255, nullable=true)
     */
    private $equipmentOther;

    /**
     * @ORM\ManyToMany(targetEntity="ClubBundle\Entity\ClubConfort")
     */
    private $confort;

    /**
     * @var string
     *
     * @ORM\Column(name="confort_other", type="string", length=255, nullable=true)
     */
    private $confortOther;

    /**
     * @ORM\ManyToMany(targetEntity="ClubBundle\Entity\ClubService")
     */
    private $services;

    /**
     * @var string
     *
     * @ORM\Column(name="services_other", type="string", length=255, nullable=true)
     */
    private $servicesOther;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, options={"default":0})
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime", nullable=true)
     */
    private $dateAdd;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clubActivitie = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->confort = new \Doctrine\Common\Collections\ArrayCollection();
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set courseSchedule
     *
     * @param string $courseSchedule
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function setCourseSchedule($courseSchedule)
    {
        $this->courseSchedule = $courseSchedule;

        return $this;
    }

    /**
     * Get courseSchedule
     *
     * @return string
     */
    public function getCourseSchedule()
    {
        return $this->courseSchedule;
    }

    /**
     * Set equipmentOther
     *
     * @param string $equipmentOther
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function setEquipmentOther($equipmentOther)
    {
        $this->equipmentOther = $equipmentOther;

        return $this;
    }

    /**
     * Get equipmentOther
     *
     * @return string
     */
    public function getEquipmentOther()
    {
        return $this->equipmentOther;
    }

    /**
     * Set confortOther
     *
     * @param string $confortOther
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function setConfortOther($confortOther)
    {
        $this->confortOther = $confortOther;

        return $this;
    }

    /**
     * Get confortOther
     *
     * @return string
     */
    public function getConfortOther()
    {
        return $this->confortOther;
    }

    /**
     * Set servicesOther
     *
     * @param string $servicesOther
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function setServicesOther($servicesOther)
    {
        $this->servicesOther = $servicesOther;

        return $this;
    }

    /**
     * Get servicesOther
     *
     * @return string
     */
    public function getServicesOther()
    {
        return $this->servicesOther;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateAdd
     * 
     * @ORM\PrePersist
     * 
     * @param \DateTime $dateAdd
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function setDateAdd()
    {
        $this->dateAdd = new \DateTime('NOW');

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
     * Set clubInfo
     *
     * @param \ClubBundle\Entity\ClubInfo $clubInfo
     *
     * @return ClubActivitiesAmenitiesConfortServices
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
     * Add clubActivitie
     *
     * @param \ClubBundle\Entity\ClubActivitie $clubActivitie
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function addClubActivitie(\ClubBundle\Entity\ClubActivitie $clubActivitie)
    {
        $this->clubActivitie[] = $clubActivitie;

        return $this;
    }

    /**
     * Remove clubActivitie
     *
     * @param \ClubBundle\Entity\ClubActivitie $clubActivitie
     */
    public function removeClubActivitie(\ClubBundle\Entity\ClubActivitie $clubActivitie)
    {
        $this->clubActivitie->removeElement($clubActivitie);
    }

    /**
     * Get clubActivitie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubActivitie()
    {
        return $this->clubActivitie;
    }

    /**
     * Add equipment
     *
     * @param \ClubBundle\Entity\ClubEquipement $equipment
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function addEquipment(\ClubBundle\Entity\ClubEquipement $equipment)
    {
        $this->equipment[] = $equipment;

        return $this;
    }

    /**
     * Remove equipment
     *
     * @param \ClubBundle\Entity\ClubEquipement $equipment
     */
    public function removeEquipment(\ClubBundle\Entity\ClubEquipement $equipment)
    {
        $this->equipment->removeElement($equipment);
    }

    /**
     * Get equipment
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Add confort
     *
     * @param \ClubBundle\Entity\ClubConfort $confort
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function addConfort(\ClubBundle\Entity\ClubConfort $confort)
    {
        $this->confort[] = $confort;

        return $this;
    }

    /**
     * Remove confort
     *
     * @param \ClubBundle\Entity\ClubConfort $confort
     */
    public function removeConfort(\ClubBundle\Entity\ClubConfort $confort)
    {
        $this->confort->removeElement($confort);
    }

    /**
     * Get confort
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConfort()
    {
        return $this->confort;
    }

    /**
     * Add service
     *
     * @param \ClubBundle\Entity\ClubService $service
     *
     * @return ClubActivitiesAmenitiesConfortServices
     */
    public function addService(\ClubBundle\Entity\ClubService $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \ClubBundle\Entity\ClubService $service
     */
    public function removeService(\ClubBundle\Entity\ClubService $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
}
