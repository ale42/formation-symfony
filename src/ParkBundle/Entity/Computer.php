<?php

namespace ParkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Computer
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ParkBundle\Entity\ComputerRepository")
 */
class Computer
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
     * @ORM\Column(name="name", type="string", length=40)
     */
    private $name;

    /**
     * On associe a un ordinateur une IP et pas une IP a un pc
     * On pourra donc faire this->getComputer()->getIp()
     *
     * Sauf si on rajoute le même code dans l'entity IP (ce qui est fait une relation bilatérale)
     *
     * @var string
     *
     * @ORM\OneToOne(targetEntity="ParkBundle\Entity\Ip")
     * @ORM\JoinColumn(nullable=true)
     */
    private $ip;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="ParkBundle\Entity\Person", inversedBy="computers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $person;

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
     * @return Computer
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Computer
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set person
     *
     * @param \ParkBundle\Entity\Person $person
     *
     * @return Computer
     */
    public function setPerson(\ParkBundle\Entity\Person $person = null)
    {
        $person->addComputer($this);
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \ParkBundle\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set ip
     *
     * @param \ParkBundle\Entity\Ip $ip
     *
     * @return Computer
     */
    public function setIp(\ParkBundle\Entity\Ip $ip = null)
    {
        $this->ip = $ip;
        $ip->setIp($this);

        return $this;
    }

    /**
     * Get ip
     *
     * @return \ParkBundle\Entity\Ip
     */
    public function getIp()
    {
        return $this->ip;
    }
}
