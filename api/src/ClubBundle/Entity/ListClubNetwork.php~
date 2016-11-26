<?php

namespace ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListClubNetwork
 *
 * @ORM\Table(name="list_club_network")
 * @ORM\Entity(repositoryClass="ClubBundle\Repository\ListClubNetworkRepository")
 */
class ListClubNetwork
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
     * @ORM\OneToMany(targetEntity="ClubBundle\Entity\ClubInfo", mappedBy="idNetwork", cascade={"remove"})
     */
    private $clubInfo;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clubInfo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return ListClubNetwork
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
     * Add clubInfo
     *
     * @param \ClubBundle\Entity\ClubInfo $clubInfo
     *
     * @return ListClubNetwork
     */
    public function addClubInfo(\ClubBundle\Entity\ClubInfo $clubInfo)
    {
        $this->clubInfo[] = $clubInfo;

        return $this;
    }

    /**
     * Remove clubInfo
     *
     * @param \ClubBundle\Entity\ClubInfo $clubInfo
     */
    public function removeClubInfo(\ClubBundle\Entity\ClubInfo $clubInfo)
    {
        $this->clubInfo->removeElement($clubInfo);
    }

    /**
     * Get clubInfo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubInfo()
    {
        return $this->clubInfo;
    }
}
