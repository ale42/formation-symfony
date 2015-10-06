<?php

namespace ParkBundle\Controller;

use ParkBundle\Entity\Computer;
use ParkBundle\Entity\Person;
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
                'enabled' => true,
                'person' => 1
            ),
            1 => array(
                'id' => 2,
                'name' => 'odinateur 2',
                'ip' => '192.168.0.2',
                'enabled' => false,
                'person' => 2
            ),
            2 => array(
                'id' => 3,
                'name' => 'ordinateur 3',
                'ip' => '192.168.0.3',
                'enabled' => true,
                'person' => 3
            ),
            3 => array(
                'id' => 4,
                'name' => 'ordinateur 4',
                'ip' => '192.168.0.4',
                'enabled' => false,
                'person' => 4
            ),
            4 => array(
                'id' => 5,
                'name' => 'ordinateur 5',
                'ip' => '192.168.0.5',
                'enabled' => true,
                'person' => 5
            ),
            5 => array(
                'id' => 6,
                'name' => 'ordinateur 6',
                'ip' => '192.168.0.6',
                'enabled' => true,
                'person' => 6
            ),
            6 => array(
                'id' => 7,
                'name' => 'ordinateur 7',
                'ip' => '192.168.0.7',
                'enabled' => true,
                'person' => 7
            ),
            7 => array(
                'id' => 8,
                'name' => 'ordinateur 8',
                'ip' => '192.168.0.8',
                'enabled' => true,
                'person' => 8
            ),
            8 => array(
                'id' => 9,
                'name' => 'ordinateur 9',
                'ip' => '192.168.0.9',
                'enabled' => true,
                'person' => 4
            ),
            9 => array(
                'id' => 10,
                'name' => 'ordinateur 10',
                'ip' => '192.168.0.10',
                'enabled' => true,
                'person' => 2
            ),
            10 => array(
                'id' => 11,
                'name' => 'ordinateur 11',
                'ip' => '192.168.0.11',
                'enabled' => true,
                'person' => 1
            ),
            11 => array(
                'id' => 12,
                'name' => 'ordinateur 12',
                'ip' => '192.168.0.12',
                'enabled' => true,
                'person' => 3
            ),
            12 => array(
                'id' => 13,
                'name' => 'ordinateur 13',
                'ip' => '192.168.0.13',
                'enabled' => true,
                'person' => 5
            )));
    }
    protected function getlistPerson()
    {
        return (array(
            0 => array(
                'firstname' => 'Alex',
                'lastname' => 'Andre'
            ),
            1 => array(
                'firstname' => 'Ayme',
                'lastname' => 'Ric'
            ),
            2 => array(
                'firstname' => 'Guill',
                'lastname' => 'Aume'
            ),
            3 => array(
                'firstname' => 'Ste',
                'lastname' => 'Ve'
            ),
            4 => array(
                'firstname' => 'Valé',
                'lastname' => 'Rie'
            ),
            5 => array(
                'firstname' => 'Syl',
                'lastname' => 'Vain'
            ),
            6 => array(
                'firstname' => 'John',
                'lastname' => 'Attan'
            ),
            7 => array(
                'firstname' => 'Pere',
                'lastname' => 'Noel'
            ),
            8 => array(
                'firstname' => 'Cou',
                'lastname' => 'Cou'
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
//        foreach($this->getlistPerson() as $person){
//            $newPerson = new Person();
//            $newPerson->setFirstname($person['firstname']);
//            $newPerson->setLastname($person['lastname']);
//            $em->persist($newPerson);
//        }
//        $em->flush();
        foreach($this->getlistComputer() as $computer){
            $newComputer = new Computer();
            $newComputer->setIp($computer['ip']);
            $newComputer->setName($computer['name']);
            $newComputer->setEnabled($computer['enabled']);
//            $newComputer->setPerson($computer['person']);
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
    /**
     * @Route("park_computer/display",name="park_computer/display")
     * @Template()
     */
    public function displayComputerOwnerAction(){
        return (array("list_computer" => $this->getDoctrine()
            ->getRepository('ParkBundle:Computer')
            ->findAll()
        ));

    }
}