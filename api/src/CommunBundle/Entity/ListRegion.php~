<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListRegion
 *
 * @ORM\Table(name="list_region")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\ListRegionRepository")
 */
class ListRegion
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
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListCountry", inversedBy="idRegion")
     * @ORM\JoinColumn(name="id_country", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idCountry;


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
     * @return ListRegion
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
     * Set idCountry
     *
     * @param \CommunBundle\Entity\ListCountry $idCountry
     *
     * @return ListRegion
     */
    public function setIdCountry(\CommunBundle\Entity\ListCountry $idCountry = null)
    {
        $this->idCountry = $idCountry;

        return $this;
    }

    /**
     * Get idCountry
     *
     * @return \CommunBundle\Entity\ListCountry
     */
    public function getIdCountry()
    {
        return $this->idCountry;
    }



}
