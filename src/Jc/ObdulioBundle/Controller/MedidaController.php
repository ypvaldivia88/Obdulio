<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Medida;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * Medida controller.
 *
 * @Route("medida")
 */
class MedidaController extends Controller
{
    /**
     * Lists all medida entities.
     *
     * @Route("/index", name="medida_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $medidas = $em->getRepository('JcObdulioBundle:Medida')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'medida_delete');
        return $this->render('@JcObdulio/medida/index.html.twig', array(
            'medidas' => $medidas,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }

    /**
     * Creates a new medida entity.
     *
     * @Route("/new", name="medida_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $medida = new Medida();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\MedidaType', $medida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($medida);
            $em->flush();
            $this->addFlash('mensaje', 'La medida ha sido creado' );
            return $this->redirectToRoute('medida_index');
        }

        return $this->render('@JcObdulio/medida/new.html.twig', array(
            'medida' => $medida,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a medida entity.
     *
     * @Route("/{id}", name="medida_show")
     * @Method("GET")
     */
    public function showAction(Medida $medida)
    {
        $deleteForm = $this->createDeleteForm($medida);

        return $this->render('@JcObdulio/medida/show.html.twig', array(
            'medida' => $medida,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing medida entity.
     *
     * @Route("/{id}/edit", name="medida_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Medida $medida)
    {
        $deleteForm = $this->createDeleteForm($medida);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\MedidaType', $medida);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'la medida '.$medida->getNombre().' ha sido editada correctamente');
            return $this->redirectToRoute('medida_index');
        }

        return $this->render('@JcObdulio/medida/edit.html.twig', array(
            'medida' => $medida,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a medida entity.
     *
     * @Route("/{id}", name="medida_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Medida $medida)
    {
        $form = $this->createDeleteForm($medida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deleteMedida($em, $medida);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteMedida($em, $medida);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('medida_index');
    }
    private function deleteMedida($em, $medida){
        $em->remove($medida);
        $em->flush();

        $message = ('La medida '.$medida->getNombre().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }

    /**
     * Creates a form to delete a medida entity.
     *
     * @param Medida $medida The medida entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Medida $medida)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medida_delete', array('id' => $medida->getId())))
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
