<?php

namespace CavavinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vins
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CavavinBundle\Entity\VinsRepository")
 */
class Vins
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
     * @ORM\Column(name="Nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="R�gion", type="string", length=50)
     */
    private $region;

    /**
     * @var integer
     *
     * @ORM\Column(name="Quantit�", type="integer")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255)
     */
    private $type;

}

