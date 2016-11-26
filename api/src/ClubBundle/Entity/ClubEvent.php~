<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubEvent
 *
 * @ORM\Table(name="club_club_event")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubEventRepository")
 */
class ClubEvent
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
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ClubInfo", inversedBy="clubEvent")
     * @ORM\JoinColumn(name="id_club", referencedColumnName="id",onDelete="CASCADE")
     */

    private $idClub;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=45)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="ClubBundle\Entity\ClubEventDates", mappedBy="event", cascade={"remove"})
     * 
     * @ORM\OrderBy({"date" = "asc"})
     */
    private $dates;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=150, nullable=true)
     */
    private $photo;

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
     * Set title
     *
     * @param string $title
     *
     * @return ClubEvent
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ClubEvent
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return ClubEvent
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return ClubEvent
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
     * @return ClubEvent
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
     * @return ClubEvent
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
     * Add date
     *
     * @param \ClubBundle\Entity\ClubEventDates $date
     *
     * @return ClubEvent
     */
    public function addDate(\ClubBundle\Entity\ClubEventDates $date)
    {
        $this->dates[] = $date;

        return $this;
    }

    /**
     * Remove date
     *
     * @param \ClubBundle\Entity\ClubEventDates $date
     */
    public function removeDate(\ClubBundle\Entity\ClubEventDates $date)
    {
        $this->dates->removeElement($date);
    }

    /**
     * Get dates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDates()
    {
        return $this->dates;
    }
}
