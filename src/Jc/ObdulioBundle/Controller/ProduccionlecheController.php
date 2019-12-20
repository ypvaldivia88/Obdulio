<?php

namespace Jc\ObdulioBundle\Controller;

use Jc\ObdulioBundle\Entity\Produccionleche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * Produccionleche controller.
 *
 * @Route("produccionleche")
 */
class ProduccionlecheController extends Controller
{
    /**
     * Lists all produccionleche entities.
     *
     * @Route("/index", name="produccionleche_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $produccionleches = $em->getRepository('JcObdulioBundle:Produccionleche')->findAll();
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'produccionleche_delete');
        return $this->render('@JcObdulio/produccionleche/index.html.twig', array(
            'produccionleches' => $produccionleches,'delete_form_ajax' => $deleteFormAjax -> createView()));
    }

    /**
     * Creates a new produccionleche entity.
     *
     * @Route("/new", name="produccionleche_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produccionleche = new Produccionleche();
        if($this->getUser()==NULL){ return $this->redirectToRoute('rh_usuarios_logout');}
        $form = $this->createForm('Jc\ObdulioBundle\Form\ProduccionlecheType', $produccionleche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produccionleche);
            $em->flush();

            $this->addFlash('mensaje', 'La Produccion de leche ha sido creada' );
            return $this->redirectToRoute('produccionleche_index');
        }

        return $this->render('@JcObdulio/produccionleche/new.html.twig', array(
            'produccionleche' => $produccionleche,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produccionleche entity.
     *
     * @Route("/{id}", name="produccionleche_show")
     * @Method("GET")
     */
    public function showAction(Produccionleche $produccionleche)
    {
        $deleteForm = $this->createDeleteForm($produccionleche);

        return $this->render('@JcObdulio/produccionleche/show.html.twig', array(
            'produccionleche' => $produccionleche,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produccionleche entity.
     *
     * @Route("/{id}/edit", name="produccionleche_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produccionleche $produccionleche)
    {
        $deleteForm = $this->createDeleteForm($produccionleche);
        $editForm = $this->createForm('Jc\ObdulioBundle\Form\ProduccionlecheType', $produccionleche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('mensaje', 'La Produccion de Leche '.$produccionleche->getId().' ha sido editada correctamente');
            return $this->redirectToRoute('produccionleche_index');
        }
        return $this->render('@JcObdulio/produccionleche/edit.html.twig', array(
            'produccionleche' => $produccionleche,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produccionleche entity.
     *
     * @Route("/{id}", name="produccionleche_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produccionleche $produccionleche)
    {
        $form = $this->createDeleteForm($produccionleche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($request->isXMLHttpRequest()){
                $res = $this->deleteProduccionleche($em, $produccionleche);
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'])),
                    200,
                    array('Content-Type' => 'application/json')
                );

            }
            $res = $this->deleteProduccionleche($em, $produccionleche);
            $this->addFlash($res['alert'], $res['message']);
        }

        return $this->redirectToRoute('produccionleche_index');
    }
    private function deleteProduccionleche($em, $produccionleche){
        $em->remove($produccionleche);
        $em->flush();

        $message = ('La Produccion de leche '.$produccionleche->getId().' ha sido eliminada.');
        $removed = 1;
        $alert = 'mensaje';

        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }

    /**
     * Creates a form to delete a produccionleche entity.
     *
     * @param Produccionleche $produccionleche The produccionleche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produccionleche $produccionleche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produccionleche_delete', array('id' => $produccionleche->getId())))
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
