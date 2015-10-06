<?php

namespace ParkBundle\Controller;

use ParkBundle\Entity\Computer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class ComputerController extends Controller
{
    protected function getlistComputer()
    {
        return (array(
            0 => array(
                'id' => 1,
                'name' => 'ordinateur 1',
                'ip' => '192.168.0.1',
                'enabled' => true
            ),
            1 => array(
                'id' => 2,
                'name' => 'odinateur 2',
                'ip' => '192.168.0.2',
                'enabled' => false
            ),
            2 => array(
                'id' => 3,
                'name' => 'ordinateur 3',
                'ip' => '192.168.0.3',
                'enabled' => true
            ),
            3 => array(
                'id' => 4,
                'name' => 'ordinateur 4',
                'ip' => '192.168.0.4',
                'enabled' => false
            ),
            4 => array(
                'id' => 5,
                'name' => 'ordinateur 5',
                'ip' => '192.168.0.5',
                'enabled' => true
            )));
    }

    /**
     * @Route("/park_computer/debug", name="park_computer/debug")
     * @Template()
     */
    public function listComputerDebugAction(){
        return (array("list_computer" => $this->getlistComputer()));
    }

    /**
     * @Route("/park_computer", name="park_computer")
     * @Template()
     */
    public function listComputerAction(){
        return (array("list_computer" => $this->getDoctrine()
            ->getRepository('ParkBundle:Computer')
            ->findAll()
        ));
//        return (array("list_computer" => $this->getlistComputer()));
    }

    /**
     * @Route("/park_computer/test", name="park_computer/test")
     * @Template()
     */
    public function testAction(){
//        $em = $this->get("Doctrine");
//        $em = $em->getManager();
        $em = $this->getDoctrine()->getManager();
        foreach($this->getlistComputer() as $computer){
            $newComputer = new Computer();
            $newComputer->setIp($computer['ip']);
            $newComputer->setName($computer['name']);
            $newComputer->setEnabled($computer['enabled']);
            $em->persist($newComputer);
        }
        $em->flush();
        return new Response('Created product id '.$newComputer->getId());
    }

    /**
     * @Route("/park_computer/deleteAll", name="park_computer/deleteAll")
     * @Template()
     */
    public function deleteAllAction(){
        $em = $this->getDoctrine()->getManager();
        foreach($this->getDoctrine()->getRepository('ParkBundle:Computer')->findAll() as $computer){
            $em->remove($computer);
        }
        $em->flush();
        return new Response('Toutes les données ont été supprimées');
    }
}