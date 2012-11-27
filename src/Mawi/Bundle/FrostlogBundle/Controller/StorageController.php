<?php

namespace Mawi\Bundle\FrostlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mawi\Bundle\FrostlogBundle\Entity\Storage;
use Mawi\Bundle\FrostlogBundle\Form\StorageType;

/**
 * Storage controller.
 *
 * @Route("/storage")
 */
class StorageController extends Controller
{
    /**
     * Lists all Storage entities.
     *
     * @Route("/index", name="storage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MawiFrostlogBundle:Storage')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Storage entity.
     *
     * @Route("/create", name="storage_create")
     * @Method("POST")
     * @Template("MawiFrostlogBundle:Storage:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Storage();
        $form = $this->createForm(new StorageType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('storage_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Storage entity.
     *
     * @Route("/new", name="storage_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Storage();
        $form   = $this->createForm(new StorageType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Storage entity.
     *
     * @Route("/show/{id}", name="storage_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MawiFrostlogBundle:Storage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Storage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Storage entity.
     *
     * @Route("/edit/{id}", name="storage_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MawiFrostlogBundle:Storage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Storage entity.');
        }

        $editForm = $this->createForm(new StorageType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Storage entity.
     *
     * @Route("/update/{id}", name="storage_update")
     * @Method("PUT")
     * @Template("MawiFrostlogBundle:Storage:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MawiFrostlogBundle:Storage')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Storage entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StorageType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('storage_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Storage entity.
     *
     * @Route("/delete/{id}", name="storage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MawiFrostlogBundle:Storage')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Storage entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('storage'));
    }

    /**
     * Creates a form to delete a Storage entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
