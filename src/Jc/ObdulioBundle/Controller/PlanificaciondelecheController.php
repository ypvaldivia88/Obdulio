<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Planificaciondeleche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * Planificaciondeleche controller.
 *
 * @Route("planificaciondeleche")
 */
class PlanificaciondelecheController extends Controller
{
    /**
     * Lists all planificaciondeleche entities.
     *
     * @Route("/index", name="planificaciondeleche_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $planificaciondeleches = $em->getRepository('JcObdulioBundle:Planificaciondeleche')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'planificaciondeleche_delete');
        return $this->render('@JcObdulio/planificaciondeleche/index.html.twig', array(
            'planificaciondeleches' => $planificaciondeleches,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }

    /**
     * Creates a new planificaciondeleche entity.
     *
     * @Route("/new", name="planificaciondeleche_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $planificaciondeleche = new Planificaciondeleche();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\PlanificaciondelecheType', $planificaciondeleche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planificaciondeleche);
            $em->flush();

            $this->addFlash('mensaje', 'La Planificacion de leche ha sido creada' );
            return $this->redirectToRoute('planificaciondeleche_index');
        }

        return $this->render('@JcObdulio/planificaciondeleche/new.html.twig', array(
            'planificaciondeleche' => $planificaciondeleche,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a planificaciondeleche entity.
     *
     * @Route("/{id}", name="planificaciondeleche_show")
     * @Method("GET")
     */
    public function showAction(Planificaciondeleche $planificaciondeleche)
    {
        $deleteForm = $this->createDeleteForm($planificaciondeleche);

        return $this->render('@JcObdulio/planificaciondeleche/show.html.twig', array(
            'planificaciondeleche' => $planificaciondeleche,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing planificaciondeleche entity.
     *
     * @Route("/{id}/edit", name="planificaciondeleche_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Planificaciondeleche $planificaciondeleche)
    {
        $deleteForm = $this->createDeleteForm($planificaciondeleche);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\PlanificaciondelecheType', $planificaciondeleche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'La Planificacion de leche '.$planificaciondeleche->getId().' ha sido editada correctamente');
            return $this->redirectToRoute('planificaciondeleche_index');
        }

        return $this->render('@JcObdulio/planificaciondeleche/edit.html.twig', array(
            'planificaciondeleche' => $planificaciondeleche,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a planificaciondeleche entity.
     *
     * @Route("/{id}", name="planificaciondeleche_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Planificaciondeleche $planificaciondeleche)
    {
        $form = $this->createDeleteForm($planificaciondeleche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deletePlanificaciondeleche($em, $planificaciondeleche);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deletePlanificaciondeleche($em, $planificaciondeleche);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('planificaciondeleche_index');
    }
    private function deletePlanificaciondeleche($em, $planificaciondeleche){
        $em->remove($planificaciondeleche);
        $em->flush();

        $message = ('La Planificacion de leche '.$planificaciondeleche->getId().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }

    /**
     * Creates a form to delete a planificaciondeleche entity.
     *
     * @param Planificaciondeleche $planificaciondeleche The planificaciondeleche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Planificaciondeleche $planificaciondeleche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('planificaciondeleche_delete', array('id' => $planificaciondeleche->getId())))
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
