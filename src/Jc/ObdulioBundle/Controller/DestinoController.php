<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Destino;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * Destino controller.
 *
 * @Route("destino")
 */
class DestinoController extends Controller
{
    /**
     * Lists all destino entities.
     *
     * @Route("/index", name="destino_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $destinos = $em->getRepository('JcObdulioBundle:Destino')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'destino_delete');
        return $this->render('@JcObdulio/destino/index.html.twig', array(
            'destinos' => $destinos,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }

    /**
     * Creates a new destino entity.
     *
     * @Route("/new", name="destino_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $destino = new Destino();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\DestinoType', $destino);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($destino);
            $em->flush();

            $this->addFlash('mensaje', 'El destino ha sido creado' );
            return $this->redirectToRoute('destino_index');
        }

        return $this->render('@JcObdulio/destino/new.html.twig', array(
            'destino' => $destino,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a destino entity.
     *
     * @Route("/{id}", name="destino_show")
     * @Method("GET")
     */
    public function showAction(Destino $destino)
    {
        $deleteForm = $this->createDeleteForm($destino);

        return $this->render('@JcObdulio/destino/show.html.twig', array(
            'destino' => $destino,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing destino entity.
     *
     * @Route("/{id}/edit", name="destino_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Destino $destino)
    {
        $deleteForm = $this->createDeleteForm($destino);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\DestinoType', $destino);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'El destino '.$destino->getNombre().' ha sido editado correctamente');
            return $this->redirectToRoute('destino_index');
        }

        return $this->render('@JcObdulio/destino/edit.html.twig', array(
            'destino' => $destino,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a destino entity.
     *
     * @Route("/{id}", name="destino_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Destino $destino)
    {
        $form = $this->createDeleteForm($destino);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deleteDestino($em, $destino);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteDestino($em, $destino);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('destino_index');
    }
    private function deleteDestino($em, $destino){
        $em->remove($destino);
        $em->flush();

        $message = ('El destino '.$destino->getNombre().' ha sido eliminado.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }

    /**
     * Creates a form to delete a destino entity.
     *
     * @param Destino $destino The destino entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Destino $destino)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('destino_delete', array('id' => $destino->getId())))
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
