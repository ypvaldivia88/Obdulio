<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Tipodeunidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
/**
 * Tipodeunidad controller.
 *
 * @Route("tipodeunidad")
 */
class TipodeunidadController extends Controller
{
    /**
     * Lists all tipodeunidad entities.
     *
     * @Route("/index", name="tipodeunidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $tipodeunidads = $em->getRepository('JcObdulioBundle:Tipodeunidad')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'tipoproducto_delete');
        return $this->render('@JcObdulio/tipodeunidad/index.html.twig', array(
            'tipodeunidads' => $tipodeunidads,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }

    /**
     * Creates a new tipodeunidad entity.
     *
     * @Route("/new", name="tipodeunidad_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipodeunidad = new Tipodeunidad();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\TipodeunidadType', $tipodeunidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipodeunidad);
            $em->flush();
            $this->addFlash('mensaje', 'El tipo de unidad ha sido creada' );
            return $this->redirectToRoute('tipodeunidad_index');
        }

        return $this->render('@JcObdulio/tipodeunidad/new.html.twig', array(
            'tipodeunidad' => $tipodeunidad,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipodeunidad entity.
     *
     * @Route("/{id}", name="tipodeunidad_show")
     * @Method("GET")
     */
    public function showAction(Tipodeunidad $tipodeunidad)
    {
        $deleteForm = $this->createDeleteForm($tipodeunidad);

        return $this->render('@JcObdulio/tipodeunidad/show.html.twig', array(
            'tipodeunidad' => $tipodeunidad,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipodeunidad entity.
     *
     * @Route("/{id}/edit", name="tipodeunidad_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tipodeunidad $tipodeunidad)
    {
        $deleteForm = $this->createDeleteForm($tipodeunidad);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\TipodeunidadType', $tipodeunidad);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'El tipo de unidad '.$tipodeunidad->getNombre().' ha sido editada correctamente');
            return $this->redirectToRoute('tipodeunidad_index');
        }

        return $this->render('@JcObdulio/tipodeunidad/edit.html.twig', array(
            'tipodeunidad' => $tipodeunidad,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipodeunidad entity.
     *
     * @Route("/{id}", name="tipodeunidad_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tipodeunidad $tipodeunidad)
    {
        $form = $this->createDeleteForm($tipodeunidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deleteTipodeunidad($em, $tipodeunidad);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteTipodeunidad($em, $tipodeunidad);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('tipodeunidad_index');
    }
    private function deleteTipodeunidad($em, $tipodeunidad){
        $em->remove($tipodeunidad);
        $em->flush();

        $message = ('El tipo de unidad '.$tipodeunidad->getNombre().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }


    /**
     * Creates a form to delete a tipodeunidad entity.
     *
     * @param Tipodeunidad $tipodeunidad The tipodeunidad entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tipodeunidad $tipodeunidad)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipodeunidad_delete', array('id' => $tipodeunidad->getId())))
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
