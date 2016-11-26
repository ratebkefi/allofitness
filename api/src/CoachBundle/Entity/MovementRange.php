<?php

namespace CoachBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovementRange
 *
 * @ORM\Table(name="movement_range")
 * @ORM\Entity(repositoryClass="CoachBundle\Repository\MovementRangeRepository")
 */
class MovementRange
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
     * @ORM\Column(name="ray", type="integer")
     */
    private $ray;




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
     * Set name
     *
     * @param string $name
     *
     * @return MovementRange
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
     * Set ray
     *
     * @param integer $ray
     *
     * @return MovementRange
     */
    public function setRay($ray)
    {
        $this->ray = $ray;

        return $this;
    }

    /**
     * Get ray
     *
     * @return integer
     */
    public function getRay()
    {
        return $this->ray;
    }
}
