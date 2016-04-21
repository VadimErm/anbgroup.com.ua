<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Content;
use AppBundle\Form\ContentType;

/**
 * Content controller.
 *
 */
class ContentController extends Controller
{

    /**
     * Lists all Content entities.
     *
     */
    public function indexAction()
    {
        $entity = new Content();
        $new_form   = $this->createCreateForm($entity);
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Content')->findAll();

        return $this->render('default/Content/index.html.twig', array(
            'entities' => $entities,
            'new_form' => $new_form->createView(),
        ));
    }
    /**
     * Creates a new Content entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Content();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('content_show', array('id' => $entity->getId())));
        }

        return $this->render('default/Content/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Content entity.
     *
     * @param Content $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Content $entity)
    {
        $form = $this->createForm(new ContentType(), $entity, array(
            'action' => $this->generateUrl('content_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Content entity.
     *
     */
    public function newAction()
    {
        $entity = new Content();
        $form   = $this->createCreateForm($entity);

        return $this->render('default/Content/new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Content entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Content')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Content entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('default/Content/show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Content entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Content')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Content entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('default/Content/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Content entity.
    *
    * @param Content $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Content $entity)
    {
        $form = $this->createForm(new ContentType(), $entity, array(
            'action' => $this->generateUrl('content_update', array('id' => $entity->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Обновить'));

        return $form;
    }
    /**
     * Edits an existing Content entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Content')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Content entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('content_show', array('id' => $id)));
        }

        return $this->render('default/Content/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Content entity.
     *
     */
    public function deleteAction( $id)
    {      
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Content')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Content entity.');
            }

            $em->remove($entity);
            $em->flush();
        

        return $this->redirect($this->generateUrl('content'));
    }

    /**
     * Creates a form to delete a Content entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('content_delete', array('id' => $id)))
            ->setMethod('POST')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
    
}
