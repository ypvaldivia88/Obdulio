<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jc\ObdulioBundle\Repository\ReportesRepository;
use Symfony\Component\HttpFoundation\Request;

class ReportesController extends Controller
{
    public function generalAction(Request $request)
    {        
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }
        
        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);        

        $form = $this->createForm('Jc\ObdulioBundle\Form\ReporteType');
        $form->handleRequest($request);

        $filtro = $form->getData();

        if ($filtro && $filtro['reporte'] != null) {
            return $this->redirectToRoute('reportes_'.$filtro['reporte'],array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalXtipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:general.html.twig',
            array(
                'titulo_reporte' => 'General',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function acumuladoAction(Request $request)
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }
        
        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);        

        $form = $this->createForm('Jc\ObdulioBundle\Form\ReporteType');
        $form->handleRequest($request); 

        $filtro = $form->getData();

        if ($filtro && $filtro['reporte'] != 'acumulado') {
            return $this->redirectToRoute('reportes_'.$filtro['reporte'],array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalXtipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:acumulado.html.twig',
            array(
                'titulo_reporte' => 'Acumulado',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }
    
}
