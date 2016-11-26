<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Complaint
 *
 * @ORM\Table(name="complaint")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\ComplaintRepository")
 */
class Complaint
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
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="ComplaintD")
     * @ORM\JoinColumn(name="id_user_depositor_complaint", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idUserDepositorComplaint;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="ComplaintA")
     * @ORM\JoinColumn(name="id_user_accused", referencedColumnName="id",onDelete="CASCADE")
     */

    private $idUserAccused;

    /**
     * @var string
     *
     * @ORM\Column(name="type_reservation", type="string", length=50)
     */
    private $typeReservation;

    /**
     * @var int
     *
     * @ORM\Column(name="id_reservation", type="integer")
     */
    private $idReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;



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
     * Set typeReservation
     *
     * @param string $typeReservation
     *
     * @return Complaint
     */
    public function setTypeReservation($typeReservation)
    {
        $this->typeReservation = $typeReservation;

        return $this;
    }

    /**
     * Get typeReservation
     *
     * @return string
     */
    public function getTypeReservation()
    {
        return $this->typeReservation;
    }

    /**
     * Set idReservation
     *
     * @param integer $idReservation
     *
     * @return Complaint
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;

        return $this;
    }

    /**
     * Get idReservation
     *
     * @return integer
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Complaint
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
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return Complaint
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
     * Constructor
     */
    public function __construct()
    {
        $this->dateAdd = new \DateTime('now');
    }


    /**
     * Set idUserDepositorComplaint
     *
     * @param \UserBundle\Entity\User $idUserDepositorComplaint
     *
     * @return Complaint
     */
    public function setIdUserDepositorComplaint(\UserBundle\Entity\User $idUserDepositorComplaint = null)
    {
        $this->idUserDepositorComplaint = $idUserDepositorComplaint;

        return $this;
    }

    /**
     * Get idUserDepositorComplaint
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdUserDepositorComplaint()
    {
        return $this->idUserDepositorComplaint;
    }

    /**
     * Set idUserAccused
     *
     * @param \UserBundle\Entity\User $idUserAccused
     *
     * @return Complaint
     */
    public function setIdUserAccused(\UserBundle\Entity\User $idUserAccused = null)
    {
        $this->idUserAccused = $idUserAccused;

        return $this;
    }

    /**
     * Get idUserAccused
     *
     * @return \UserBundle\Entity\User
     */
    public function getIdUserAccused()
    {
        return $this->idUserAccused;
    }
}
