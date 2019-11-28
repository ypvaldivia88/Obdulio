<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Planificacionproduccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

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
     * @Route("/index", name="planificacionproduccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $planificacionproduccions = $em->getRepository('JcObdulioBundle:Planificacionproduccion')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'planificacionproduccion_delete');
        return $this->render('@JcObdulio/planificacionproduccion/index.html.twig', array(
            'planificacionproduccions' => $planificacionproduccions,'delete_form_ajax' => $deleteFormAjax -> createView()));
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
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\PlanificacionproduccionType', $planificacionproduccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planificacionproduccion);
            $em->flush();

            $this->addFlash('mensaje', 'La planificación de la producción ha sido creada' );
            return $this->redirectToRoute('planificacionproduccion_index');
        }

        return $this->render('@JcObdulio/planificacionproduccion/new.html.twig', array(
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

        return $this->render('@JcObdulio/planificacionproduccion/show.html.twig', array(
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

            $this->addFlash('mensaje', 'La planificación de la producción '.$planificacionproduccion->getFkProducto()->getNombre().' ha sido editada correctamente');
            return $this->redirectToRoute('planificacionproduccion_index');
        }

        return $this->render('@JcObdulio/planificacionproduccion/edit.html.twig', array(
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
            if($request->isXMLHttpRequest()){
                $res = $this->deletePlanificacionproduccion($em, $planificacionproduccion);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deletePlanificacionproduccion($em, $planificacionproduccion);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('planificacionproduccion_index');
    }
    private function deletePlanificacionproduccion($em, $planificacionproduccion){
        $em->remove($planificacionproduccion);
        $em->flush();

        $message = ('La planificación de la producción '.$planificacionproduccion->getFkProducto()->getNombre().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
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
    private function createCustomForm($id, $method, $route){
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod($method)
            ->getForm();
    }
}
