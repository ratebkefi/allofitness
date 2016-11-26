<?php

namespace CoachBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NumberOfPersons
 *
 * @ORM\Table(name="number_of_persons")
 * @ORM\Entity(repositoryClass="CoachBundle\Repository\NumberOfPersonsRepository")
 */
class NumberOfPersons
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
     * @ORM\Column(name="nbs", type="integer")
     */
    private $nbs;


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
     * @return NumberOfPersons
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
     * Set nbs
     *
     * @param integer $nbs
     *
     * @return NumberOfPersons
     */
    public function setNbs($nbs)
    {
        $this->nbs = $nbs;

        return $this;
    }

    /**
     * Get nbs
     *
     * @return int
     */
    public function getNbs()
    {
        return $this->nbs;
    }
}
