<?php

namespace ParkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ComputerController extends Controller
{
    protected function getlistComputer()
    {
        return (array(
            0 => array(
                'id' => 1,
                'name' => 'oRRRrdinateur 1',
                'ip' => '192.168.0.1',
                'enabled' => true
            ),
            1 => array(
                'id' => 2,
                'name' => 'oRdinateur 2',
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
        return (array("list_computer" => $this->getlistComputer()));
    }
}