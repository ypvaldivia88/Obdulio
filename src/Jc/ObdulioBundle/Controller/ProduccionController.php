<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Produccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Produccion controller.
 *
 * @Route("produccion")
 */
class ProduccionController extends Controller
{
    /**
     * Lists all produccion entities.
     *
     * @Route("/", name="produccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produccions = $em->getRepository('JcObdulioBundle:Produccion')->findAll();

        return $this->render('produccion/index.html.twig', array(
            'produccions' => $produccions,
        ));
    }

    /**
     * Creates a new produccion entity.
     *
     * @Route("/new", name="produccion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produccion = new Produccion();
        $form = $this->createForm('Jc\ObdulioBundle\Form\ProduccionType', $produccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produccion);
            $em->flush();

            return $this->redirectToRoute('produccion_show', array('id' => $produccion->getId()));
        }

        return $this->render('produccion/new.html.twig', array(
            'produccion' => $produccion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produccion entity.
     *
     * @Route("/{id}", name="produccion_show")
     * @Method("GET")
     */
    public function showAction(Produccion $produccion)
    {
        $deleteForm = $this->createDeleteForm($produccion);

        return $this->render('produccion/show.html.twig', array(
            'produccion' => $produccion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produccion entity.
     *
     * @Route("/{id}/edit", name="produccion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produccion $produccion)
    {
        $deleteForm = $this->createDeleteForm($produccion);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\ProduccionType', $produccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produccion_edit', array('id' => $produccion->getId()));
        }

        return $this->render('produccion/edit.html.twig', array(
            'produccion' => $produccion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produccion entity.
     *
     * @Route("/{id}", name="produccion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produccion $produccion)
    {
        $form = $this->createDeleteForm($produccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produccion);
            $em->flush();
        }

        return $this->redirectToRoute('produccion_index');
    }

    /**
     * Creates a form to delete a produccion entity.
     *
     * @param Produccion $produccion The produccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produccion $produccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produccion_delete', array('id' => $produccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
