<?php

namespace CavavinBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CavavinBundle\Entity\Vins;
use CavavinBundle\Form\VinsType;

/**
 * Vins controller.
 *
 * @Route("/vins")
 */
class VinsController extends Controller
{

    /**
     * Lists all Vins entities.
     *
     * @Route("/", name="vins")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CavavinBundle:Vins')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Vins entity.
     *
     * @Route("/", name="vins_create")
     * @Method("POST")
     * @Template("CavavinBundle:Vins:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vins();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vins_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Vins entity.
     *
     * @param Vins $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vins $entity)
    {
        $form = $this->createForm(new VinsType(), $entity, array(
            'action' => $this->generateUrl('vins_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vins entity.
     *
     * @Route("/new", name="vins_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vins();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vins entity.
     *
     * @Route("/{id}", name="vins_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CavavinBundle:Vins')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vins entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vins entity.
     *
     * @Route("/{id}/edit", name="vins_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CavavinBundle:Vins')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vins entity.');
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
    * Creates a form to edit a Vins entity.
    *
    * @param Vins $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vins $entity)
    {
        $form = $this->createForm(new VinsType(), $entity, array(
            'action' => $this->generateUrl('vins_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vins entity.
     *
     * @Route("/{id}", name="vins_update")
     * @Method("PUT")
     * @Template("CavavinBundle:Vins:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CavavinBundle:Vins')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vins entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vins_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vins entity.
     *
     * @Route("/{id}", name="vins_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CavavinBundle:Vins')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vins entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vins'));
    }

    /**
     * Creates a form to delete a Vins entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vins_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
