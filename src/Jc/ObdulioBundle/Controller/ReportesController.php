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
        $reporte = $repo->getMesActual();
        $totales = $repo->getTotales();
        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
        
        $form = $this->createForm('Jc\ObdulioBundle\Form\ReporteType');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $filtro = $form->getData();
            $reporte = $repo->getReporte($filtro);            
            return $this->render(
                'JcObdulioBundle:Reportes:index.html.twig',
                array(
                    'form' => $form->createView(),
                    'reporte_nombre' => $filtro['reporte'],
                    'reporte_datos' => $reporte,
                    'totales' => $totales,
                    'tipos_producto' => $tipos,
                )
            );
        }

        return $this->render(
            'JcObdulioBundle:Reportes:index.html.twig',
            array(
                'form' => $form->createView(),
                'reporte_nombre' => null,
                'reporte_datos' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }
}
