<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Unidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Unidad controller.
 *
 * @Route("unidad")
 */
class UnidadController extends Controller
{
    /**
     * Lists all unidad entities.
     *
     * @Route("/", name="unidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $unidads = $em->getRepository('JcObdulioBundle:Unidad')->findAll();

        return $this->render('unidad/index.html.twig', array(
            'unidads' => $unidads,
        ));
    }

    /**
     * Creates a new unidad entity.
     *
     * @Route("/new", name="unidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $unidad = new Unidad();
        $form = $this->createForm('Jc\ObdulioBundle\Form\UnidadType', $unidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unidad);
            $em->flush();

            return $this->redirectToRoute('unidad_show', array('id' => $unidad->getId()));
        }

        return $this->render('unidad/new.html.twig', array(
            'unidad' => $unidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a unidad entity.
     *
     * @Route("/{id}", name="unidad_show")
     * @Method("GET")
     */
    public function showAction(Unidad $unidad)
    {
        $deleteForm = $this->createDeleteForm($unidad);

        return $this->render('unidad/show.html.twig', array(
            'unidad' => $unidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing unidad entity.
     *
     * @Route("/{id}/edit", name="unidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Unidad $unidad)
    {
        $deleteForm = $this->createDeleteForm($unidad);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\UnidadType', $unidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unidad_edit', array('id' => $unidad->getId()));
        }

        return $this->render('unidad/edit.html.twig', array(
            'unidad' => $unidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a unidad entity.
     *
     * @Route("/{id}", name="unidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Unidad $unidad)
    {
        $form = $this->createDeleteForm($unidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($unidad);
            $em->flush();
        }

        return $this->redirectToRoute('unidad_index');
    }

    /**
     * Creates a form to delete a unidad entity.
     *
     * @param Unidad $unidad The unidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Unidad $unidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('unidad_delete', array('id' => $unidad->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
