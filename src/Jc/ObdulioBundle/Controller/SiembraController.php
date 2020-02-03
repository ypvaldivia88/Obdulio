<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Siembra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * Siembra controller.
 *
 * @Route("siembra")
 */
class SiembraController extends Controller
{
    /**
     * Lists all siembra entities.
     *
     * @Route("/index", name="siembra_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $siembras = $em->getRepository('JcObdulioBundle:Siembra')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'siembra_delete');
        return $this->render('@JcObdulio/siembra/index.html.twig', array(
            'siembras' => $siembras,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }

    /**
     * Creates a new siembra entity.
     *
     * @Route("/new", name="siembra_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $siembra = new Siembra();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\SiembraType', $siembra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($siembra);
            $em->flush();

            $this->addFlash('mensaje', 'La siembra ha sido creada' );
            return $this->redirectToRoute('siembra_index');
        }

        return $this->render('@JcObdulio/siembra/new.html.twig', array(
            'siembra' => $siembra,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a siembra entity.
     *
     * @Route("/{id}", name="siembra_show")
     * @Method("GET")
     */
    public function showAction(Siembra $siembra)
    {
        $deleteForm = $this->createDeleteForm($siembra);

        return $this->render('@JcObdulio/siembra/show.html.twig', array(
            'siembra' => $siembra,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing siembra entity.
     *
     * @Route("/{id}/edit", name="siembra_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Siembra $siembra)
    {
        $deleteForm = $this->createDeleteForm($siembra);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\SiembraType', $siembra);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'La Siembra del Producto: '.$siembra->getFkProducto()->getNombre().' ha sido editada correctamente');
            return $this->redirectToRoute('siembra_index');
        }

        return $this->render('@JcObdulio/siembra/edit.html.twig', array(
            'siembra' => $siembra,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a siembra entity.
     *
     * @Route("/{id}", name="siembra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Siembra $siembra)
    {
        $form = $this->createDeleteForm($siembra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deleteSiembra($em, $siembra);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteSiembra($em, $siembra);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('siembra_index');
    }
    private function deleteSiembra($em, $siembra){
        $em->remove($siembra);
        $em->flush();

        $message = ('La Siembra del Producto: '.$siembra->getFkProducto()->getNombre().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }

    /**
     * Creates a form to delete a siembra entity.
     *
     * @param Siembra $siembra The siembra entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Siembra $siembra)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('siembra_delete', array('id' => $siembra->getId())))
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
