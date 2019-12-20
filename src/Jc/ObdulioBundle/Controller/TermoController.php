<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Termo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * Termo controller.
 *
 * @Route("termo")
 */
class TermoController extends Controller
{
    /**
     * Lists all termo entities.
     *
     * @Route("/index", name="termo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $termos = $em->getRepository('JcObdulioBundle:Termo')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'termo_delete');
        return $this->render('@JcObdulio/termo/index.html.twig', array(
            'termos' => $termos,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }


    /**
     * Creates a new termo entity.
     *
     * @Route("/new", name="termo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $termo = new Termo();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\TermoType', $termo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($termo);
            $em->flush();

            $this->addFlash('mensaje', 'La termo ha sido creado' );
            return $this->redirectToRoute('termo_index');
        }

        return $this->render('@JcObdulio/termo/new.html.twig', array(
            'termo' => $termo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a termo entity.
     *
     * @Route("/{id}", name="termo_show")
     * @Method("GET")
     */
    public function showAction(Termo $termo)
    {
        $deleteForm = $this->createDeleteForm($termo);

        return $this->render('@JcObdulio/termo/show.html.twig', array(
            'termo' => $termo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing termo entity.
     *
     * @Route("/{id}/edit", name="termo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Termo $termo)
    {
        $deleteForm = $this->createDeleteForm($termo);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\TermoType', $termo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'El Termo '.$termo->getNombre().' ha sido editado correctamente');
            return $this->redirectToRoute('termo_index');
        }

        return $this->render('@JcObdulio/termo/edit.html.twig', array(
            'termo' => $termo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a termo entity.
     *
     * @Route("/{id}", name="termo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Termo $termo)
    {
        $form = $this->createDeleteForm($termo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deleteTermo($em, $termo);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteTermo($em, $termo);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('termo_index');
    }
    private function deleteTermo($em, $termo){
        $em->remove($termo);
        $em->flush();

        $message = ('El Termo '.$termo->getNombre().' ha sido eliminado.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }

    /**
     * Creates a form to delete a termo entity.
     *
     * @param Termo $termo The termo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Termo $termo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('termo_delete', array('id' => $termo->getId())))
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
