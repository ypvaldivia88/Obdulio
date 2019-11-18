<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query\ResultSetMapping;

class ReportesController extends Controller
{
    public function operativoAction(){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT
                pr.valor,	
                CASE MONTH(CURRENT_DATE())
                    WHEN 1 THEN pl.enero 
                    WHEN 2 THEN pl.febrero 
                    WHEN 3 THEN pl.marzo 
                    WHEN 4 THEN pl.abril 
                    WHEN 5 THEN pl.mayo 
                    WHEN 6 THEN pl.junio 
                    WHEN 7 THEN pl.julio 
                    WHEN 8 THEN pl.agosto 
                    WHEN 9 THEN pl.septiembre 
                    WHEN 10 THEN pl.octubre 
                    WHEN 11 THEN pl.noviembre 
                    ELSE pl.diciembre 
                END,
                p.nombre,
                tp.nombre,
                u.nombre
            FROM JcObdulioBundle:Produccion pr
            LEFT JOIN JcObdulioBundle:Producto p ON pr.fk_producto = p.id
            LEFT JOIN JcObdulioBundle:Planificacionproduccion pl ON pl.fk_producto = p.id
            LEFT JOIN JcObdulioBundle:Tipoproducto tp ON p.fk_tipoproducto = tp.id
            LEFT JOIN JcObdulioBundle:Unidad u ON pr.fk_unidad = u.id AND pl.fk_unidad = u.id"   
        );
        
        $reporte = $query->getResult();
        
        /* //listado de unidades
        $articulos = $em->getRepository('JcObdulioBundle:Unidad')->findAll();
        //listado de tipos de productos
        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
        //listado de productos
        $productos = $em->getRepository('JcObdulioBundle:Producto')->findAll();
        //plan mensual de cada unidad para cada producto */
        
        return $this->render('JcObdulioBundle:Reportes:operativo.html.twig', array('reporte' => $reporte));
    }
}
