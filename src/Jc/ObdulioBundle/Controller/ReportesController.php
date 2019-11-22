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
                pr.valor AS real,	
                pl.enero,
                pl.febrero,
                pl.marzo,
                pl.abril,
                pl.mayo,
                pl.junio,
                pl.julio,
                pl.agosto,
                pl.septiembre,
                pl.octubre,
                pl.noviembre,
                pl.diciembre,
                p.nombre AS producto,
                tp.nombre AS tipo,
                u.nombre AS unidad
            FROM JcObdulioBundle:Produccion pr
            LEFT JOIN JcObdulioBundle:Producto p WHERE pr.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Planificacionproduccion pl WHERE pl.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Tipoproducto tp WHERE p.fkTipoproducto = tp.id
            LEFT JOIN JcObdulioBundle:Unidad u WHERE pr.fkUnidad = u.id AND pl.fkUnidad = u.id"   
        );        

        $operativo = $query->getResult();      
        $tiposProducto = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
     
        
        return $this->render('JcObdulioBundle:Reportes:operativo.html.twig', array('operativo' => $operativo, 'tiposProducto' => $tiposProducto));
    }

    public function totalesAction($tipoProducto){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "SELECT
                Sum(produccion.valor) AS `real`,
                tipoproducto.nombre AS tipo,
                unidad.nombre AS unidad,
                Sum(planificacionproduccion.enero) AS ene,
                Sum(planificacionproduccion.febrero) AS feb,
                Sum(planificacionproduccion.marzo) AS mar,
                Sum(planificacionproduccion.abril) AS abr,
                Sum(planificacionproduccion.mayo) AS may,
                Sum(planificacionproduccion.junio) AS jun,
                Sum(planificacionproduccion.julio) AS jul,
                Sum(planificacionproduccion.agosto) AS ago,
                Sum(planificacionproduccion.septiembre) AS sep,
                Sum(planificacionproduccion.octubre) AS oct,
                Sum(planificacionproduccion.noviembre) AS nov,
                Sum(planificacionproduccion.diciembre) AS dic,
                planificacionproduccion.`año`
                FROM
                produccion
                INNER JOIN producto ON produccion.fk_producto = producto.id
                INNER JOIN tipoproducto ON producto.fk_tipoproducto = tipoproducto.id
                INNER JOIN unidad ON produccion.fk_unidad = unidad.id
                INNER JOIN planificacionproduccion ON planificacionproduccion.fk_producto = producto.id AND planificacionproduccion.fk_unidad = unidad.id
                WHERE
                tipoproducto.id = 2
                GROUP BY
                tipoproducto.nombre,
                unidad.nombre,
                planificacionproduccion.`año`"   
        );        
        
        $listado = $query->getResult();           
        
        return $this->render('JcObdulioBundle:Reportes:totales.html.twig', array('listado' => $listado));
    }
}
