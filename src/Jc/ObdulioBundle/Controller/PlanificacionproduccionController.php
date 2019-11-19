<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Planificacionproduccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Planificacionproduccion controller.
 *
 * @Route("planificacionproduccion")
 */
class PlanificacionproduccionController extends Controller
{
    /**
     * Lists all planificacionproduccion entities.
     *
     * @Route("/", name="planificacionproduccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $planificacionproduccions = $em->getRepository('JcObdulioBundle:Planificacionproduccion')->findAll();

        return $this->render('planificacionproduccion/index.html.twig', array(
            'planificacionproduccions' => $planificacionproduccions,
        ));
    }

    /**
     * Creates a new planificacionproduccion entity.
     *
     * @Route("/new", name="planificacionproduccion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $planificacionproduccion = new Planificacionproduccion();
        $form = $this->createForm('Jc\ObdulioBundle\Form\PlanificacionproduccionType', $planificacionproduccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planificacionproduccion);
            $em->flush();

            return $this->redirectToRoute('planificacionproduccion_show', array('id' => $planificacionproduccion->getId()));
        }

        return $this->render('planificacionproduccion/new.html.twig', array(
            'planificacionproduccion' => $planificacionproduccion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a planificacionproduccion entity.
     *
     * @Route("/{id}", name="planificacionproduccion_show")
     * @Method("GET")
     */
    public function showAction(Planificacionproduccion $planificacionproduccion)
    {
        $deleteForm = $this->createDeleteForm($planificacionproduccion);

        return $this->render('planificacionproduccion/show.html.twig', array(
            'planificacionproduccion' => $planificacionproduccion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing planificacionproduccion entity.
     *
     * @Route("/{id}/edit", name="planificacionproduccion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Planificacionproduccion $planificacionproduccion)
    {
        $deleteForm = $this->createDeleteForm($planificacionproduccion);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\PlanificacionproduccionType', $planificacionproduccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planificacionproduccion_edit', array('id' => $planificacionproduccion->getId()));
        }

        return $this->render('planificacionproduccion/edit.html.twig', array(
            'planificacionproduccion' => $planificacionproduccion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a planificacionproduccion entity.
     *
     * @Route("/{id}", name="planificacionproduccion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Planificacionproduccion $planificacionproduccion)
    {
        $form = $this->createDeleteForm($planificacionproduccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($planificacionproduccion);
            $em->flush();
        }

        return $this->redirectToRoute('planificacionproduccion_index');
    }

    /**
     * Creates a form to delete a planificacionproduccion entity.
     *
     * @param Planificacionproduccion $planificacionproduccion The planificacionproduccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Planificacionproduccion $planificacionproduccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('planificacionproduccion_delete', array('id' => $planificacionproduccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
