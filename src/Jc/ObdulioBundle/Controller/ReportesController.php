<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jc\ObdulioBundle\Repository\ReportesRepository;
use Symfony\Component\HttpFoundation\Request;

class ReportesController extends Controller
{
    public function indexAction(Request $request)
    {
        //var_dump($request);
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);
        $listado = $repo->getMesActual();
        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
        
        $form = $this->createForm('Jc\ObdulioBundle\Form\ReporteType');
        $form->handleRequest($request);

        //var_dump($form->getData());
        if ($form->isValid()) {
            $data = $form->getData();
            $listado = $repo->getListadoReporte($data);            
            return $this->render(
                'JcObdulioBundle:Reportes:index.html.twig',
                array(
                    'form' => $form->createView(),
                    'reporte' => $data['reporte'],
                    'listado' => $listado,
                    'tipos_producto' => $tipos,
                )
            );
        }

        return $this->render(
            'JcObdulioBundle:Reportes:index.html.twig',
            array(
                'form' => $form->createView(),
                'reporte' => null,
                'listado' => $listado,
                'tipos_producto' => $tipos,
            )
        );
    }
}
