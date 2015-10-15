<?php

namespace ParkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ip
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ParkBundle\Entity\IpRepository")
 */
class Ip
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=15)
     */
    private $ip;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetimetz")
     */
    private $updatedAt;

    /**
     *
     * @var string
     *
     * @ORM\OneToOne(targetEntity="ParkBundle\Entity\Computer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $computer;

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
     * Set ip
     *
     * @param string $ip
     *
     * @return Ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Ip
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Ip
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
     * Set computer
     *
     * @param \ParkBundle\Entity\Computer $computer
     *
     * @return Ip
     */
    public function setComputer(\ParkBundle\Entity\Computer $computer = null)
    {
        $this->computer = $computer;

        return $this;
    }

    /**
     * Get computer
     *
     * @return \ParkBundle\Entity\Computer
     */
    public function getComputer()
    {
        return $this->computer;
    }

    /**
     * Transform to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}
