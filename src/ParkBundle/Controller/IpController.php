<?php

namespace ParkBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ParkBundle\Entity\Ip;
use ParkBundle\Form\IpType;

/**
 * Ip controller.
 *
 * @Route("/ip")
 */
class IpController extends Controller
{

    /**
     * Lists all Ip entities.
     *
     * @Route("/", name="ip")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParkBundle:Ip')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Ip entity.
     *
     * @Route("/", name="ip_create")
     * @Method("POST")
     * @Template("ParkBundle:Ip:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Ip();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ip_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Ip entity.
     *
     * @param Ip $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ip $entity)
    {
        $form = $this->createForm(new IpType(), $entity, array(
            'action' => $this->generateUrl('ip_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ip entity.
     *
     * @Route("/new", name="ip_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ip();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Ip entity.
     *
     * @Route("/{id}", name="ip_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParkBundle:Ip')->find($id);
//        $entity = $em->getRepository('ParkBundle:Ip')->getUnaffectedIps();
//        echo("<pre>");
//        foreach($entity as $item){
//            \Doctrine\Common\Util\Debug::dump($item->getIp());
//        }
//        die;
//        var_dump($entity);echo("</pre>");die;

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ip entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Ip entity.
     *
     * @Route("/{id}/edit", name="ip_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParkBundle:Ip')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ip entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Ip entity.
    *
    * @param Ip $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ip $entity)
    {
        $form = $this->createForm(new IpType(), $entity, array(
            'action' => $this->generateUrl('ip_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ip entity.
     *
     * @Route("/{id}", name="ip_update")
     * @Method("PUT")
     * @Template("ParkBundle:Ip:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParkBundle:Ip')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ip entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ip_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Ip entity.
     *
     * @Route("/{id}", name="ip_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParkBundle:Ip')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ip entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ip'));
    }

    /**
     * Creates a form to delete a Ip entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ip_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
