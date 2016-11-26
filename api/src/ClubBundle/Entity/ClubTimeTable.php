<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubTimeTable
 *
 * @ORM\Table(name="club_time_table")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubTimeTableRepository")
 */
class ClubTimeTable
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
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ClubInfo", inversedBy="clubTimeTable")
     * @ORM\JoinColumn(name="id_club", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idClub;
    /**
     * @var string
     *
     * @ORM\Column(name="day", type="string", length=45)
     */
    private $day;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_opening_am", type="time")
     */
    private $timeOpeningAm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_closing_am", type="time")
     */
    private $timeClosingAm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_opening_pm", type="time")
     */
    private $timeOpeningPm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_closing_pm", type="time")
     */
    private $timeClosingPm;

    /**
     * @var bool
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $wholeweek;




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
     * Set day
     *
     * @param string $day
     *
     * @return ClubTimeTable
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set timeOpeningAm
     *
     * @param \DateTime $timeOpeningAm
     *
     * @return ClubTimeTable
     */
    public function setTimeOpeningAm($timeOpeningAm)
    {
        $this->timeOpeningAm = $timeOpeningAm;

        return $this;
    }

    /**
     * Get timeOpeningAm
     *
     * @return \DateTime
     */
    public function getTimeOpeningAm()
    {
        return $this->timeOpeningAm;
    }

    /**
     * Set timeClosingAm
     *
     * @param \DateTime $timeClosingAm
     *
     * @return ClubTimeTable
     */
    public function setTimeClosingAm($timeClosingAm)
    {
        $this->timeClosingAm = $timeClosingAm;

        return $this;
    }

    /**
     * Get timeClosingAm
     *
     * @return \DateTime
     */
    public function getTimeClosingAm()
    {
        return $this->timeClosingAm;
    }

    /**
     * Set timeOpeningPm
     *
     * @param \DateTime $timeOpeningPm
     *
     * @return ClubTimeTable
     */
    public function setTimeOpeningPm($timeOpeningPm)
    {
        $this->timeOpeningPm = $timeOpeningPm;

        return $this;
    }

    /**
     * Get timeOpeningPm
     *
     * @return \DateTime
     */
    public function getTimeOpeningPm()
    {
        return $this->timeOpeningPm;
    }

    /**
     * Set timeClosingPm
     *
     * @param \DateTime $timeClosingPm
     *
     * @return ClubTimeTable
     */
    public function setTimeClosingPm($timeClosingPm)
    {
        $this->timeClosingPm = $timeClosingPm;

        return $this;
    }

    /**
     * Get timeClosingPm
     *
     * @return \DateTime
     */
    public function getTimeClosingPm()
    {
        return $this->timeClosingPm;
    }

    /**
     * Set wholeweek
     *
     * @param boolean $wholeweek
     *
     * @return ClubTimeTable
     */
    public function setWholeweek($wholeweek)
    {
        $this->wholeweek = $wholeweek;

        return $this;
    }

    /**
     * Get wholeweek
     *
     * @return boolean
     */
    public function getWholeweek()
    {
        return $this->wholeweek;
    }

    /**
     * Set idClub
     *
     * @param \ClubBundle\Entity\ClubInfo $idClub
     *
     * @return ClubTimeTable
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
}
