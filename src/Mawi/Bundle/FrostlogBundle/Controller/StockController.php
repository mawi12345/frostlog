<?php

namespace Mawi\Bundle\FrostlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Mawi\Bundle\FrostlogBundle\Entity\Stock;
use Mawi\Bundle\FrostlogBundle\Form\StockType;
use Mawi\Bundle\FrostlogBundle\Form\StockNewType;

/**
 * Stock controller.
 *
 * @Route("/stock")
 */
class StockController extends Controller
{

    /**
     * Creates a new Stock entity.
     *
     * @Route("/create", name="stock_create")
     * @Method("POST")
     * @Template("MawiFrostlogBundle:Stock:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Stock();
        $form = $this->createForm(new StockNewType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $count = $form->get('count')->getData();
            for ($i=0; $i<$count; $i++) {
                $stock = new Stock();
                $stock->copy($entity);
                $em->persist($stock);
            }
            $em->flush();
            
            return $this->redirect($this->generateUrl('home'));
            //return $this->redirect($this->generateUrl('stock_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Stock entity.
     *
     * @Route("/new", name="stock_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Stock();
        $form   = $this->createForm(new StockNewType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stock entity.
     *
     * @Route("/show/{id}", name="stock_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MawiFrostlogBundle:Stock')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stock entity.
     *
     * @Route("/edit/{id}", name="stock_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MawiFrostlogBundle:Stock')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }

        $editForm = $this->createForm(new StockType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * unloads an existing Stock entity.
     *
     * @Route("/unload/{id}", name="stock_unload")
     * @Method("GET")
     */
    public function unloadAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MawiFrostlogBundle:Stock')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }
        
        $entity->setDeparture(new \DateTime());
        $em->persist($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl('productstock', array('id' => $entity->getProduct()->getId())));
    }

    /**
     * Edits an existing Stock entity.
     *
     * @Route("/update/{id}", name="stock_update")
     * @Method("PUT")
     * @Template("MawiFrostlogBundle:Stock:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MawiFrostlogBundle:Stock')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StockType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stock_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Stock entity.
     *
     * @Route("/delete/{id}", name="stock_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MawiFrostlogBundle:Stock')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stock entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('home'));
    }

    /**
     * Creates a form to delete a Stock entity by id.
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
