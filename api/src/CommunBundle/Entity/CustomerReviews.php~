<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerReviews
 *
 * @ORM\Table(name="customer_reviews")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\CustomerReviewsRepository")
 */
class CustomerReviews
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="customerReviews")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id",onDelete="CASCADE")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ClubInfo", inversedBy="customerReviews")
     * @ORM\JoinColumn(name="club_info", referencedColumnName="id",onDelete="CASCADE")
     */
    private $club_info;
    
    /**
     * @ORM\ManyToOne(targetEntity="CoachBundle\Entity\CoachInfo", inversedBy="customerReviews")
     * @ORM\JoinColumn(name="coach_info", referencedColumnName="id",onDelete="CASCADE")
     */
    private $coach_info;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

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

    
    public function __construct() {
        $this->dateAdd = new \DateTime('NOW');
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
     * Set text
     *
     * @param string $text
     *
     * @return CustomerReviews
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return CustomerReviews
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return CustomerReviews
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
     * @return CustomerReviews
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
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return CustomerReviews
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set clubInfo
     *
     * @param \ClubBundle\Entity\ClubInfo $clubInfo
     *
     * @return CustomerReviews
     */
    public function setClubInfo(\ClubBundle\Entity\ClubInfo $clubInfo = null)
    {
        $this->club_info = $clubInfo;

        return $this;
    }

    /**
     * Get clubInfo
     *
     * @return \ClubBundle\Entity\ClubInfo
     */
    public function getClubInfo()
    {
        return $this->club_info;
    }

    /**
     * Set coachInfo
     *
     * @param \CoachBundle\Entity\CoachInfo $coachInfo
     *
     * @return CustomerReviews
     */
    public function setCoachInfo(\CoachBundle\Entity\CoachInfo $coachInfo = null)
    {
        $this->coach_info = $coachInfo;

        return $this;
    }

    /**
     * Get coachInfo
     *
     * @return \CoachBundle\Entity\CoachInfo
     */
    public function getCoachInfo()
    {
        return $this->coach_info;
    }
}
