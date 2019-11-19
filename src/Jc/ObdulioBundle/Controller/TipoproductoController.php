<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Tipoproducto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tipoproducto controller.
 *
 * @Route("tipoproducto")
 */
class TipoproductoController extends Controller
{
    /**
     * Lists all tipoproducto entities.
     *
     * @Route("/", name="tipoproducto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoproductos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render('tipoproducto/index.html.twig', array(
            'tipoproductos' => $tipoproductos,
        ));
    }

    /**
     * Creates a new tipoproducto entity.
     *
     * @Route("/new", name="tipoproducto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoproducto = new Tipoproducto();
        $form = $this->createForm('Jc\ObdulioBundle\Form\TipoproductoType', $tipoproducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoproducto);
            $em->flush();

            return $this->redirectToRoute('tipoproducto_show', array('id' => $tipoproducto->getId()));
        }

        return $this->render('tipoproducto/new.html.twig', array(
            'tipoproducto' => $tipoproducto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoproducto entity.
     *
     * @Route("/{id}", name="tipoproducto_show")
     * @Method("GET")
     */
    public function showAction(Tipoproducto $tipoproducto)
    {
        $deleteForm = $this->createDeleteForm($tipoproducto);

        return $this->render('tipoproducto/show.html.twig', array(
            'tipoproducto' => $tipoproducto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoproducto entity.
     *
     * @Route("/{id}/edit", name="tipoproducto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tipoproducto $tipoproducto)
    {
        $deleteForm = $this->createDeleteForm($tipoproducto);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\TipoproductoType', $tipoproducto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipoproducto_edit', array('id' => $tipoproducto->getId()));
        }

        return $this->render('tipoproducto/edit.html.twig', array(
            'tipoproducto' => $tipoproducto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoproducto entity.
     *
     * @Route("/{id}", name="tipoproducto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tipoproducto $tipoproducto)
    {
        $form = $this->createDeleteForm($tipoproducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoproducto);
            $em->flush();
        }

        return $this->redirectToRoute('tipoproducto_index');
    }

    /**
     * Creates a form to delete a tipoproducto entity.
     *
     * @param Tipoproducto $tipoproducto The tipoproducto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tipoproducto $tipoproducto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoproducto_delete', array('id' => $tipoproducto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
