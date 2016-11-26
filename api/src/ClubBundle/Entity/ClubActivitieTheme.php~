<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubActivitieTheme
 *
 * @ORM\Table(name="club_activitie_theme")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubActivitieThemeRepository")
 */
class ClubActivitieTheme
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

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
     * @ORM\OneToMany(targetEntity="ClubBundle\Entity\ClubActivitie", mappedBy="idActivitieTheme", cascade={"remove"})
     */
    private $clubActivitie;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clubActivitie = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return ClubActivitieTheme
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return ClubActivitieTheme
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
     * @return ClubActivitieTheme
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
     * Add clubActivitie
     *
     * @param \ClubBundle\Entity\ClubActivitie $clubActivitie
     *
     * @return ClubActivitieTheme
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
}
