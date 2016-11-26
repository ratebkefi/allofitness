<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListDepartement
 *
 * @ORM\Table(name="list_departement")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\ListDepartementRepository")
 */
class ListDepartement
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
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListRegion", inversedBy="idDepartement")
     * @ORM\JoinColumn(name="id_region", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idRegion;

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
     * @return ListDepartement
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
     * Set idRegion
     *
     * @param \CommunBundle\Entity\ListRegion $idRegion
     *
     * @return ListDepartement
     */
    public function setIdRegion(\CommunBundle\Entity\ListRegion $idRegion = null)
    {
        $this->idRegion = $idRegion;

        return $this;
    }

    /**
     * Get idRegion
     *
     * @return \CommunBundle\Entity\ListRegion
     */
    public function getIdRegion()
    {
        return $this->idRegion;
    }



}
