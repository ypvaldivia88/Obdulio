<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Unidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

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
     * @Route("/index", name="unidad_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $unidads = $em->getRepository('JcObdulioBundle:Unidad')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'unidad_delete');
        return $this->render('@JcObdulio/unidad/index.html.twig', array(
            'unidads' => $unidads,'delete_form_ajax' => $deleteFormAjax -> createView()));
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
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\UnidadType', $unidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($unidad);
            $em->flush();

            $this->addFlash('mensaje', 'La unidad ha sido creada' );
            return $this->redirectToRoute('unidad_index');
        }

        return $this->render('@JcObdulio/unidad/new.html.twig', array(
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

        return $this->render('@JcObdulio/unidad/show.html.twig', array(
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

            $this->addFlash('mensaje', 'La Unidad '.$unidad->getNombre().' ha sido editada correctamente');
            return $this->redirectToRoute('unidad_index');
        }

        return $this->render('@JcObdulio/unidad/edit.html.twig', array(
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
            if($request->isXMLHttpRequest()){
                $res = $this->deleteUnidad($em, $unidad);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteUnidad($em, $unidad);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('unidad_index');
    }
    private function deleteUnidad($em, $unidad){
        $em->remove($unidad);
        $em->flush();

        $message = ('La unidad '.$unidad->getNombre().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
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
    private function createCustomForm($id, $method, $route){
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod($method)
            ->getForm();
    }
}
