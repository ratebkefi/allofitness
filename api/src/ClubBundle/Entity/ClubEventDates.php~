<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubEventDates
 *
 * @ORM\Table(name="club_event_dates")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ClubEventDatesRepository")
 */
class ClubEventDates
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
     * @ORM\ManyToOne(targetEntity="ClubBundle\Entity\ClubEvent", inversedBy="clubEvent")
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
     * @return ClubEventDates
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
     * @param \ClubBundle\Entity\ClubEvent $event
     *
     * @return ClubEventDates
     */
    public function setEvent(\ClubBundle\Entity\ClubEvent $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \ClubBundle\Entity\ClubEvent
     */
    public function getEvent()
    {
        return $this->event;
    }
}
