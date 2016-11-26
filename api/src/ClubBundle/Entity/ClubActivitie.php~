<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubActivitie
 *
 * @ORM\Table(name="club_activitie")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubActivitieRepository")
 */
class ClubActivitie
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
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ClubActivitieTheme", inversedBy="clubActivitie")
     * @ORM\JoinColumn(name="id_activitie_theme", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idActivitieTheme;

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
     * Set name
     *
     * @param string $name
     *
     * @return ClubActivitie
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
     * @return ClubActivitie
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
     * @return ClubActivitie
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
     * Set idActivitieTheme
     *
     * @param \ClubBundle\Entity\ClubActivitieTheme $idActivitieTheme
     *
     * @return ClubActivitie
     */
    public function setIdActivitieTheme(\ClubBundle\Entity\ClubActivitieTheme $idActivitieTheme = null)
    {
        $this->idActivitieTheme = $idActivitieTheme;

        return $this;
    }

    /**
     * Get idActivitieTheme
     *
     * @return \ClubBundle\Entity\ClubActivitieTheme
     */
    public function getIdActivitieTheme()
    {
        return $this->idActivitieTheme;
    }
}
