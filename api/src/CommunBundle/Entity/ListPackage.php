<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListPackage
 *
 * @ORM\Table(name="list_package")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\ListPackageRepository")
 */
class ListPackage
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="ClubBundle\Entity\ClubInfo", mappedBy="idPackage", cascade={"remove"})
     */
    private $clubInfo;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="MemberBundle\Entity\MemberInfo", mappedBy="idPackage" )
     */
    private $memberInfo;

    /**
     * @ORM\OneToMany(targetEntity="CoachBundle\Entity\CoachInfo", mappedBy="idPackage", cascade={"remove"})
     */
    private $coachInfo;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="package", cascade={"remove"})
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clubInfo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->memberInfo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->coachInfo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return ListPackage
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
     * @return ListPackage
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

    /**
     * Add memberInfo
     *
     * @param \MemberBundle\Entity\MemberInfo $memberInfo
     *
     * @return ListPackage
     */
    public function addMemberInfo(\MemberBundle\Entity\MemberInfo $memberInfo)
    {
        $this->memberInfo[] = $memberInfo;

        return $this;
    }

    /**
     * Remove memberInfo
     *
     * @param \MemberBundle\Entity\MemberInfo $memberInfo
     */
    public function removeMemberInfo(\MemberBundle\Entity\MemberInfo $memberInfo)
    {
        $this->memberInfo->removeElement($memberInfo);
    }

    /**
     * Get memberInfo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemberInfo()
    {
        return $this->memberInfo;
    }

    /**
     * Add coachInfo
     *
     * @param \CoachBundle\Entity\CoachInfo $coachInfo
     *
     * @return ListPackage
     */
    public function addCoachInfo(\CoachBundle\Entity\CoachInfo $coachInfo)
    {
        $this->coachInfo[] = $coachInfo;

        return $this;
    }

    /**
     * Remove coachInfo
     *
     * @param \CoachBundle\Entity\CoachInfo $coachInfo
     */
    public function removeCoachInfo(\CoachBundle\Entity\CoachInfo $coachInfo)
    {
        $this->coachInfo->removeElement($coachInfo);
    }

    /**
     * Get coachInfo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoachInfo()
    {
        return $this->coachInfo;
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return ListPackage
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ListPackage
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
}
