<?php

namespace CoachBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoachEvent
 *
 * @ORM\Table(name="coach_event")
 * @ORM\Entity(repositoryClass="CoachBundle\Repository\CoachEventRepository")
 */
class CoachEvent
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
     * @ORM\Column(name="title", type="string", length=45)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
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
     * @ORM\ManyToOne(targetEntity="CoachBundle\Entity\CoachInfo", inversedBy="coachEvent")
     * @ORM\JoinColumn(name="id_coach", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idCoach;

    /**
     * @ORM\OneToMany(targetEntity="CoachBundle\Entity\CoachEventDates", mappedBy="event", cascade={"remove"})
     * 
     * @ORM\OrderBy({"date" = "asc"})
     */
    private $dates;

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
     * @return CoachEvent
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
     * @return CoachEvent
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
     * @return CoachEvent
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
     * @return CoachEvent
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
     * @return CoachEvent
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
     * Set idCoach
     *
     * @param \CoachBundle\Entity\CoachInfo $idCoach
     *
     * @return CoachEvent
     */
    public function setIdCoach(\CoachBundle\Entity\CoachInfo $idCoach = null)
    {
        $this->idCoach = $idCoach;

        return $this;
    }

    /**
     * Get idCoach
     *
     * @return \CoachBundle\Entity\CoachInfo
     */
    public function getIdCoach()
    {
        return $this->idCoach;
    }

    /**
     * Add date
     *
     * @param \CoachBundle\Entity\CoachEventDates $date
     *
     * @return CoachEvent
     */
    public function addDate(\CoachBundle\Entity\CoachEventDates $date)
    {
        $this->dates[] = $date;

        return $this;
    }

    /**
     * Remove date
     *
     * @param \CoachBundle\Entity\CoachEventDates $date
     */
    public function removeDate(\CoachBundle\Entity\CoachEventDates $date)
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
