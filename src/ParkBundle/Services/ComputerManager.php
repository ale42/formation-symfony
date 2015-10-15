<?php

namespace ParkBundle\Services;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Mapping\Entity;


/**
 * Class ComputerStatusExtension
 * @package ParkBundle\Twig
 */
class ComputerManager
{
    /**
     * @var Registry
     */
    private $doctrine;

    public function __construct(Registry $doctrine){
        $this->doctrine = $doctrine;
    }
    /**
     * @return Entity
     */
    public function listAllComputer()
    {
        $em= $this->doctrine->getManager();
        return $em->getRepository('ParkBundle:Computer')->findAll();
    }
}
