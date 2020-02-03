<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Venta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * Ventum controller.
 *
 * @Route("venta")
 */
class VentaController extends Controller
{
    /**
     * Lists all ventum entities.
     *
     * @Route("/index", name="venta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $ventas = $em->getRepository('JcObdulioBundle:Venta')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'venta_delete');
        return $this->render('@JcObdulio/venta/index.html.twig', array(
            'ventas' => $ventas,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }

    /**
     * Creates a new ventum entity.
     *
     * @Route("/new", name="venta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ventum = new Venta();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\VentaType', $ventum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ventum);
            $em->flush();

            $this->addFlash('mensaje', 'La venta ha sido creada' );
            return $this->redirectToRoute('venta_index');
        }

        return $this->render('@JcObdulio/venta/new.html.twig', array(
            'ventum' => $ventum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ventum entity.
     *
     * @Route("/{id}", name="venta_show")
     * @Method("GET")
     */
    public function showAction(Venta $ventum)
    {
        $deleteForm = $this->createDeleteForm($ventum);

        return $this->render('@JcObdulio/venta/show.html.twig', array(
            'ventum' => $ventum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ventum entity.
     *
     * @Route("/{id}/edit", name="venta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Venta $ventum)
    {
        $deleteForm = $this->createDeleteForm($ventum);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\VentaType', $ventum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'La Venta del producto: '.$ventum->getFkProducto()->getNombre().' ha sido editada correctamente');
            return $this->redirectToRoute('venta_index');
        }

        return $this->render('@JcObdulio/venta/edit.html.twig', array(
            'ventum' => $ventum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ventum entity.
     *
     * @Route("/{id}", name="venta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Venta $ventum)
    {
        $form = $this->createDeleteForm($ventum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deleteVenta($em, $ventum);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteVenta($em, $ventum);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('venta_index');
    }
    private function deleteVenta($em, $ventum){
        $em->remove($ventum);
        $em->flush();

        $message = ('La Venta del Producto: '.$ventum->getFkProducto()->getNombre().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }

    /**
     * Creates a form to delete a ventum entity.
     *
     * @param Venta $ventum The ventum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Venta $ventum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('venta_delete', array('id' => $ventum->getId())))
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
