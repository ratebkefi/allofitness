<?php

namespace CommunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListAd
 *
 * @ORM\Table(name="list_ad")
 * @ORM\Entity(repositoryClass="CommunBundle\Repository\ListAdRepository")
 */
class ListAd
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
     * @ORM\ManyToOne(targetEntity="CommunBundle\Entity\ListTypeAd", inversedBy="listAd")
     * @ORM\JoinColumn(name="id_type_ad", referencedColumnName="id",onDelete="CASCADE")
     */
    private $idTypeAd;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredDate", type="date")
     */
    private $expiredDate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;


    /**
     * Constructor
     */
    public function __construct()
    {

        $this->status = 1;
        $this->dateAdd = new \DateTime('now');

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
     * Set title
     *
     * @param string $title
     *
     * @return ListAd
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set expiredDate
     *
     * @param \DateTime $expiredDate
     *
     * @return ListAd
     */
    public function setExpiredDate($expiredDate)
    {
        $this->expiredDate = $expiredDate;

        return $this;
    }

    /**
     * Get expiredDate
     *
     * @return \DateTime
     */
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ListAd
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
     * Set idTypeAd
     *
     * @param \CommunBundle\Entity\ListTypeAd $idTypeAd
     *
     * @return ListAd
     */
    public function setIdTypeAd(\CommunBundle\Entity\ListTypeAd $idTypeAd = null)
    {
        $this->idTypeAd = $idTypeAd;

        return $this;
    }

    /**
     * Get idTypeAd
     *
     * @return \CommunBundle\Entity\ListTypeAd
     */
    public function getIdTypeAd()
    {
        return $this->idTypeAd;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return ListAd
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
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     *
     * @return ListAd
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
     * Set photo
     *
     * @param string $photo
     *
     * @return ListAd
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return ListAd
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
