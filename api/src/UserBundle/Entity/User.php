<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */

class User implements AdvancedUserInterface
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=255, nullable=true)
     */
    private $roles;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @var bool
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="date")
     */
    private $lastLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires_at", type="date", nullable=true)
     */
    private $expiresAt;

    /**
     * @var string
     *
     * @ORM\Column(name="plain_password", type="string", length=255)
     */
    private $plainPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="date")
     */
    private $createTime;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListPackage", inversedBy="user")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $package;


    /**
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListCivility", inversedBy="user")
     * @ORM\JoinColumn(name="civility_id", referencedColumnName="id",onDelete="CASCADE")
     */
    private $civility;


    /**
     * @ORM\OneToOne(targetEntity="CoachBundle\Entity\CoachInfo", mappedBy="idUser", cascade={"remove"})
     */
    private $coachInfo;

    /**
     * @ORM\OneToOne(targetEntity="ClubBundle\Entity\ClubInfo", mappedBy="idUser", cascade={"remove"})
     */
    private $clubInfo;



    /**
     * @ORM\OneToOne(targetEntity="MemberBundle\Entity\MemberInfo", mappedBy="idUser", cascade={"remove"})
     */
    private $memberInfo;


    /**
     * @var string
     * @ORM\Column(name="confirmation_token", type="string", length=255)
     */
    protected $confirmationToken;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etat = 0;
        $this->enabled = false;
        $this->createTime = new \DateTime('now');
    }


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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set locked
     *
     * @param boolean $locked
     *
     * @return User
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return bool
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     *
     * @return User
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }



    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Get roles Club
     *
     * @return string
     */
    public function getRolesClub()
    {
        return array('ROLE_CLUB');
    }

    /**
     * Get roles Coachs
     *
     * @return string
     */
    public function getRolesCoachs()
    {
        return array('ROLE_COACHS');
    }

    /**
     * Get roles Coachs
     *
     * @return string
     */
    public function getRolesAdmin()
    {
        return array('ROLE_ADMIN');
    }


    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
            ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }


    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return User
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    public function __toString()
    {
        return $this->getUsername();
    }


    /**
     * Set status
     *
     * @param integer $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }







    /**
     * Set package
     *
     * @param \CommunBundle\Entity\ListPackage $package
     *
     * @return User
     */
    public function setPackage(\CommunBundle\Entity\ListPackage $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \CommunBundle\Entity\ListPackage
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set coachInfo
     *
     * @param \CoachBundle\Entity\CoachInfo $coachInfo
     *
     * @return User
     */
    public function setCoachInfo(\CoachBundle\Entity\CoachInfo $coachInfo = null)
    {
        $this->coachInfo = $coachInfo;

        return $this;
    }

    /**
     * Get coachInfo
     *
     * @return \CoachBundle\Entity\CoachInfo
     */
    public function getCoachInfo()
    {
        return $this->coachInfo;
    }

    /**
     * Set clubInfo
     *
     * @param \ClubBundle\Entity\ClubInfo $clubInfo
     *
     * @return User
     */
    public function setClubInfo(\ClubBundle\Entity\ClubInfo $clubInfo = null)
    {
        $this->clubInfo = $clubInfo;

        return $this;
    }

    /**
     * Get clubInfo
     *
     * @return \ClubBundle\Entity\ClubInfo
     */
    public function getClubInfo()
    {
        return $this->clubInfo;
    }






    /**
     * Set memberInfo
     *
     * @param \MemberBundle\Entity\MemberInfo $memberInfo
     *
     * @return User
     */
    public function setMemberInfo(\MemberBundle\Entity\MemberInfo $memberInfo = null)
    {
        $this->memberInfo = $memberInfo;

        return $this;
    }

    /**
     * Get memberInfo
     *
     * @return \MemberBundle\Entity\MemberInfo
     */
    public function getMemberInfo()
    {
        return $this->memberInfo;
    }



    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     *
     * @return User
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set civility
     *
     * @param \CommunBundle\Entity\ListCivility $civility
     *
     * @return User
     */
    public function setCivility(\CommunBundle\Entity\ListCivility $civility = null)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return \CommunBundle\Entity\ListCivility
     */
    public function getCivility()
    {
        return $this->civility;
    }
}
