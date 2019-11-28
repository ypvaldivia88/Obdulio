<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Produccion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

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
     * @Route("/index", name="produccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $produccions = $em->getRepository('JcObdulioBundle:Produccion')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'produccion_delete');
        return $this->render('@JcObdulio/produccion/index.html.twig', array(
            'produccions' => $produccions,'delete_form_ajax' => $deleteFormAjax -> createView()));
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
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\ProduccionType', $produccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produccion);
            $em->flush();

            $this->addFlash('mensaje', 'La producción ha sido creada' );
            return $this->redirectToRoute('produccion_index');
        }

        return $this->render('@JcObdulio/produccion/new.html.twig', array(
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

        return $this->render('@JcObdulio/produccion/show.html.twig', array(
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

            $this->addFlash('mensaje', 'La produccion '.$produccion->getFkProducto()->getNombre().' ha sido editado correctamente');
            return $this->redirectToRoute('produccion_index');
        }

        return $this->render('@JcObdulio/produccion/edit.html.twig', array(
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
            if($request->isXMLHttpRequest()){
                $res = $this->deleteProduccion($em, $produccion);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteProduccion($em, $produccion);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('produccion_index');
    }
    private function deleteProduccion($em, $produccion){
        $em->remove($produccion);
        $em->flush();

        $message = ('La producción '.$produccion->getFkProducto()->getNombre().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
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
    private function createCustomForm($id, $method, $route){
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod($method)
            ->getForm();
    }
}
