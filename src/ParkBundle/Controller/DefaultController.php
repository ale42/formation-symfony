<?php

namespace ParkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route(
     *      "/hello/{name}/{chiffre}",
     *      requirements={
     *          "name": "[a-zA-Z]+",
     *          "chiffre": "[0-8]"
     *          }
     *      )
     * @Template()
     */
    public function indexAction($name, $chiffre)
    {
        return $this->render('ParkBundle:Default:index.html.twig',
            array('name' => $name, 'chiffre' => $chiffre));
    }
    /**
     * Test en yml
     */
    public function indexBisAction($name, $routing)
    {
        return $this->render('ParkBundle:Default:index2.html.twig',
            array('name' => $name, 'routing' => $routing));
    }
}
