<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Tipoproducto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

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
     * @Route("/index", name="tipoproducto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $tipoproductos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'tipoproducto_delete');
        return $this->render('@JcObdulio/tipoproducto/index.html.twig', array(
            'tipoproductos' => $tipoproductos,'delete_form_ajax' => $deleteFormAjax -> createView()));
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
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\TipoproductoType', $tipoproducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoproducto);
            $em->flush();

            $this->addFlash('mensaje', 'El tipo producto ha sido creado' );
            return $this->redirectToRoute('tipoproducto_index');
        }

        return $this->render('@JcObdulio/tipoproducto/new.html.twig', array(
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

        return $this->render('@JcObdulio/tipoproducto/show.html.twig', array(
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

            $this->addFlash('mensaje', 'El tipo de producto '.$tipoproducto->getNombre().' ha sido editado correctamente');
            return $this->redirectToRoute('tipoproducto_index');
        }

        return $this->render('@JcObdulio/tipoproducto/edit.html.twig', array(
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
            if($request->isXMLHttpRequest()){
                $res = $this->deleteTipoproducto($em, $tipoproducto);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteTipoproducto($em, $tipoproducto);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('tipoproducto_index');
    }
    private function deleteTipoproducto($em, $tipoproducto){
        $em->remove($tipoproducto);
        $em->flush();

        $message = ('El tipo de producto '.$tipoproducto->getNombre().' ha sido eliminado.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
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
    private function createCustomForm($id, $method, $route){
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod($method)
            ->getForm();
    }
}
