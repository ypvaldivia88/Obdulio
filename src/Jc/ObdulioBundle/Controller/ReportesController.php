<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jc\ObdulioBundle\Repository\ReportesRepository;
use Symfony\Component\HttpFoundation\Request;

class ReportesController extends Controller
{
    public function indexAction(Request $request)
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $manager = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($manager);
        $listado = $repo->getMesActual();

        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->add('reporte', 'choice', array(
                'choices' => array(
                    'operativo'             => 'Operativo',
                    'consejo_popular'       => 'Consejo Popular',
                    'acumulado'             => 'Acumulado',
                    'prod_cultivo'          => 'Prod x Cultivo',
                    'huevo'                 => 'Huevo',
                    'ventas_viandas'        => 'Ventas Viandas',
                    'ventas_hortalizas'     => 'Ventas Hortalizas',
                    'ventas_granos'         => 'Ventas Granos',
                    'ventas_frutas'         => 'Ventas Frutas',
                    'ventas_totales'        => 'Ventas Totales',
                    'ventas_tot_est'        => 'Ventas Totales al Estado',
                    'ventas_tot_est_dia'    => 'Ventas Totales al Estado Diario',
                    'prod_dec_sem5'         => 'Producción Decenal - Semana 5',
                    'prod_dec_sem4'         => 'Producción Decenal - Semana 4',
                    'prod_dec_sem3'         => 'Producción Decenal - Semana 3',
                    'prod_dec_sem2'         => 'Producción Decenal - Semana 2',
                    'prod_dec_sem1'         => 'Producción Decenal - Semana 1',
                    'sust_imp_anual'        => 'Sustitución Importaciones Anual',
                    'sust_imp_mensual'      => 'Sustitución Importaciones Mensual',
                    'ventas_est_plan_real'  => 'Ventas al Estado - Plan Real',
                    'ventas_est_prod_total' => 'Ventas al Estado - Producción Total',
                    'ratificado_mes'        => 'Ratificado Mes',
                    'ratificado_acumulado'  => 'Ratificado Acumulado',
                    'turismo'               => 'Turismo',

                ),
                'required'    => true,
                'empty_value' => 'Filtrar por Reporte',
                'empty_data'  => null
            ))
            ->add('fechainicio', 'text')
            ->add('fechafin', 'text')
            ->add('tipoproducto', 'entity', array(
                'class' => 'JcObdulioBundle:Tipoproducto',
                'property' => 'nombre',
                'required'    => false,
                'empty_value' => 'Filtrar por Tipo de Producto',
                'empty_data'  => null
            ))
            ->add('unidad', 'entity', array(
                'class' => 'JcObdulioBundle:Unidad',
                'property' => 'nombre',
                'required'    => false,
                'empty_value' => 'Filtrar por Unidad',
                'empty_data'  => null
            ))
            ->add('tipounidad', 'entity', array(
                'class' => 'JcObdulioBundle:Tipodeunidad',
                'property' => 'nombre',
                'required'    => false,
                'empty_value' => 'Filtrar por Tipo de Unidad',
                'empty_data'  => null
            ))
            ->getForm();

        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $data = $form->getData();
            $listado = $repo->getListadoReporte($data);            
            return $this->render(
                'JcObdulioBundle:Reportes:index.html.twig',
                array(
                    'reporte' => $data['reporte'],
                    'listado' => $listado,
                    'form' => $form->createView(),
                )
            );
        }

        return $this->render(
            'JcObdulioBundle:Reportes:index.html.twig',
            array(
                'reporte' => null,
                'listado' => $listado,
                'form' => $form->createView(),
            )
        );
    }

    public function detallesAction($reporte, $fechainicio, $fechafin, $idTipoProducto, $idUnidad)
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);

        switch ($reporte) {
            case 'operativo':
                return $this->render(
                    'JcObdulioBundle:Reportes:detalles.html.twig',
                    array(
                        'listado' => $repo->getOperativo($fechainicio, $fechafin, $idTipoProducto, $idUnidad),
                        'nombreReporte' => 'Operativo',
                        'idReporte' => $reporte
                    )
                );

            default:
                return $this->render('JcObdulioBundle:Reportes:index.html.twig');
        }
    }

    public function operativoAction()
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);
        $tiposProducto = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();


        return $this->render(
            'JcObdulioBundle:Reportes:operativo.html.twig',
            array(
                'listado' => $repo->getOperativo(),
                'tiposProducto' => $tiposProducto
            )
        );
    }

    public function operativoTotalesAction($tipo)
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);

        return $this->render(
            'JcObdulioBundle:Reportes:totales.html.twig',
            array('listado' => $repo->getTotales($tipo))
        );
    }
}
