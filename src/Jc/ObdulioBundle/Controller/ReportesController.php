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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

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

    public function operativoAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:operativo.html.twig',
            array(
                'titulo_reporte' => 'Operativo',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function consejoPopularAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:consejo_popular.html.twig',
            array(
                'titulo_reporte' => 'Consejo Popular',
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalProductoPorDestino($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Producto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:acumulado.html.twig',
            array(
                'titulo_reporte' => 'Acumulado',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'agrupados' => $tipos,
            )
        );
    }

    public function produccionPorCultivoAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:prod_cultivo.html.twig',
            array(
                'titulo_reporte' => 'Producción por Cultivo',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function huevoAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $huevo = $em->getRepository('JcObdulioBundle:Producto')->findOneBy(array('nombre' => 'Huevo'));
        $totales = $repo->getTotalDeUnProducto($filtro, $huevo['id']);

        return $this->render(
            'JcObdulioBundle:Reportes:huevo.html.twig',
            array(
                'titulo_reporte' => 'Huevos',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
            )
        );
    }

    public function ventasViandasAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_viandas.html.twig',
            array(
                'titulo_reporte' => 'Ventas Viandas',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
            )
        );
    }

    public function ventasFrutasAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_frutas.html.twig',
            array(
                'titulo_reporte' => 'Ventas Frutas',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
            )
        );
    }

    public function ventasHortalizasAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_hortalizas.html.twig',
            array(
                'titulo_reporte' => 'Ventas Hortalizas',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
            )
        );
    }

    public function ventasGranosAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_granos.html.twig',
            array(
                'titulo_reporte' => 'Ventas Granos',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
            )
        );
    }

    public function ventasTotalesAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_totales.html.twig',
            array(
                'titulo_reporte' => 'Ventas Totales',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function ventasTotEstAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_tot_est.html.twig',
            array(
                'titulo_reporte' => 'Ventas Totales al Estado',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function ventasTotEstDiaAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_tot_est_dia.html.twig',
            array(
                'titulo_reporte' => 'Ventas Totales al Estado Diario',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function ventasEstProdTotalAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_est_prod_total.html.twig',
            array(
                'titulo_reporte' => 'Ventas al Estado - Producción Total',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function ventasEstPlanRealAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:ventas_est_plan_real.html.twig',
            array(
                'titulo_reporte' => 'Ventas al Estado - Plan Real',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function turismoAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:turismo.html.twig',
            array(
                'titulo_reporte' => 'Turismo',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function sustImpMensualAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:sust_imp_mensual.html.twig',
            array(
                'titulo_reporte' => 'Sustitución de Importaciones Mensual',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function sustImpAnualAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:sust_imp_anual.html.twig',
            array(
                'titulo_reporte' => 'Sustitución de Importaciones Anual',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function ratificadoMesAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:ratificado_mes.html.twig',
            array(
                'titulo_reporte' => 'Ratificado - Mes',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function ratificadoAcumuladoAction(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:ratificado_acumulado.html.twig',
            array(
                'titulo_reporte' => 'Ratificado - Acumulado',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function prodDecSem5Action(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:prod_dec_sem5.html.twig',
            array(
                'titulo_reporte' => 'Producción Decenal - Semana 5',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function prodDecSem4Action(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:prod_dec_sem4.html.twig',
            array(
                'titulo_reporte' => 'Producción Decenal - Semana 4',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function prodDecSem3Action(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:prod_dec_sem3.html.twig',
            array(
                'titulo_reporte' => 'Producción Decenal - Semana 3',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function prodDecSem2Action(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:prod_dec_sem2.html.twig',
            array(
                'titulo_reporte' => 'Producción Decenal - Semana 2',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

    public function prodDecSem1Action(Request $request)
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
            return $this->redirectToRoute('reportes_' . $filtro['reporte'], array($request));
        }

        $reporte = $repo->getReporteGeneral($filtro);
        $totales = $repo->getTotalPorTipoProducto($filtro);

        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        return $this->render(
            'JcObdulioBundle:Reportes:prod_dec_sem1.html.twig',
            array(
                'titulo_reporte' => 'Producción Decenal - Semana 1',
                'form' => $form->createView(),
                'reporte' => $reporte,
                'totales' => $totales,
                'tipos_producto' => $tipos,
            )
        );
    }

}
