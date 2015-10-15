<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ParkBundle\Entity\Person;
use ParkBundle\Form\PersonType;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Security controller.
 *
 * @Route("/")
 */
class SecurityController extends Controller
{

    /**
     * Allow user to login
     *
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            '@App/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    /**
     * Login check route, just use to create the route, happy to use annotation
     *
     * @Route("/login_check", name="security_login_check")
     */
    public function loginCheckAction()
    {
        throw new AccessDeniedException("Vous n'avez pas les droits pour accéder a cette page");
    }

    /**
     * Allow user to logout
     *
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
//        return $this->redirect($this->generateUrl('computer'));
    }

    /**
     * Allow admin to login
     *
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render('@App/admin.html.twig');
    }

    /**
     * Admin check route
     *
     * @Route("/admin_check", name="admin_check")
     */
    public function adminCheckAction()
    {
        throw new AccessDeniedException("Vous n'avez pas les droits pour accéder a cette page");
    }
}
