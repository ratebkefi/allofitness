<?php

namespace CoachBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoachEventDates
 *
 * @ORM\Table(name="coach_event_dates")
 * @ORM\Entity(repositoryClass="CoachBundle\Repository\CoachEventDatesRepository")
 */
class CoachEventDates
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="CoachBundle\Entity\CoachEvent", inversedBy="coachEvent")
     * @ORM\JoinColumn(name="id_event", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     */
    private $event;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CoachEventDates
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set event
     *
     * @param \CoachBundle\Entity\CoachEvent $event
     *
     * @return CoachEventDates
     */
    public function setEvent(\CoachBundle\Entity\CoachEvent $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \CoachBundle\Entity\CoachEvent
     */
    public function getEvent()
    {
        return $this->event;
    }
}
