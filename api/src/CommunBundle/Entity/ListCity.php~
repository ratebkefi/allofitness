<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListCity
 *
 * @ORM\Table(name="list_city")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\ListCityRepository")
 */
class ListCity
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
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListDepartement", inversedBy="idCity")
     * @ORM\JoinColumn(name="id_departement", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idDepartement;

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
     * @return ListCity
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
     * Set idDepartement
     *
     * @param \CommunBundle\Entity\ListDepartement $idDepartement
     *
     * @return ListCity
     */
    public function setIdDepartement(\CommunBundle\Entity\ListDepartement $idDepartement = null)
    {
        $this->idDepartement = $idDepartement;

        return $this;
    }

    /**
     * Get idDepartement
     *
     * @return \CommunBundle\Entity\ListDepartement
     */
    public function getIdDepartement()
    {
        return $this->idDepartement;
    }
}
