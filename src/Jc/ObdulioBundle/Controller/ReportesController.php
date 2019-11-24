<?php

namespace Jc\ObdulioBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query\ResultSetMapping;

class ReportesController extends Controller
{
    public function operativoAction(){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}

        $em = $this->getDoctrine()->getManager();

        $d = new DateTime('NOW');
        $annoActual = $d->format('Y');

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
                u.nombre AS unidad,
                pl.anno
            FROM JcObdulioBundle:Produccion pr
            LEFT JOIN JcObdulioBundle:Producto p WHERE pr.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Planificacionproduccion pl WHERE pl.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Tipoproducto tp WHERE p.fkTipoproducto = tp.id
            LEFT JOIN JcObdulioBundle:Unidad u WHERE pr.fkUnidad = u.id AND pl.fkUnidad = u.id
            Where pl.anno = ?1" 
        );

        $query->setParameter(1, $annoActual);        

        $listado = $query->getResult();      
        $tiposProducto = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
     
        
        return $this->render('JcObdulioBundle:Reportes:operativo.html.twig', array('listado' => $listado, 'tiposProducto' => $tiposProducto));
    }

    public function totalesAction($id){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}

        $em = $this->getDoctrine()->getManager();

        $d = new DateTime('NOW');
        $annoActual = $d->format('Y');

        $query = $em->createQuery(
            "SELECT
                Sum(p.valor) AS real,
                tp.nombre AS tipo,
                u.nombre AS unidad,
                Sum(pl.enero) AS ene,
                Sum(pl.febrero) AS feb,
                Sum(pl.marzo) AS mar,
                Sum(pl.abril) AS abr,
                Sum(pl.mayo) AS may,
                Sum(pl.junio) AS jun,
                Sum(pl.julio) AS jul,
                Sum(pl.agosto) AS ago,
                Sum(pl.septiembre) AS sep,
                Sum(pl.octubre) AS oct,
                Sum(pl.noviembre) AS nov,
                Sum(pl.diciembre) AS dic,
                pl.anno
                FROM
                JcObdulioBundle:Produccion AS p
                INNER JOIN JcObdulioBundle:Producto AS pr WHERE p.fkProducto = pr.id
                INNER JOIN JcObdulioBundle:Tipoproducto AS tp WHERE pr.fkTipoproducto = tp.id
                INNER JOIN JcObdulioBundle:Unidad AS u WHERE p.fkUnidad = u.id
                INNER JOIN JcObdulioBundle:Planificacionproduccion AS pl WHERE pl.fkProducto = pr.id AND pl.fkUnidad = u.id
                WHERE
                tp.id = ?1 AND pl.anno = ?2
                GROUP BY
                tp.nombre,
                u.nombre,
                pl.anno"   
        );        
        
        $query->setParameter(1,$id);
        $query->setParameter(2,$annoActual);
        
        $listado = $query->getResult();           
        
        return $this->render('JcObdulioBundle:Reportes:totales.html.twig', array('listado' => $listado));
    }
}
