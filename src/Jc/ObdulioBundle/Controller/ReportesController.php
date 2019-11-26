<?php

namespace Jc\ObdulioBundle\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReportesController extends Controller
{
    public function operativoAction()
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();

        $d = new DateTime('NOW');
        $annoActual = $d->format('Y');
        $mesActual = $d->format('m');

        $query = $em->createQuery(
            "SELECT
                pr.valor AS real,	
                CASE 
                    WHEN ?1 = 1 THEN pl.enero 
                    WHEN ?1 = 2 THEN pl.febrero 
                    WHEN ?1 = 3 THEN pl.marzo 
                    WHEN ?1 = 4 THEN pl.abril 
                    WHEN ?1 = 5 THEN pl.mayo 
                    WHEN ?1 = 6 THEN pl.junio 
                    WHEN ?1 = 7 THEN pl.julio 
                    WHEN ?1 = 8 THEN pl.agosto 
                    WHEN ?1 = 9 THEN pl.septiembre 
                    WHEN ?1 = 10 THEN pl.octubre 
                    WHEN ?1 = 11 THEN pl.noviembre 
                    ELSE pl.diciembre 
                END AS plan,
                p.nombre AS producto,
                tp.nombre AS tipo,
                u.nombre AS unidad,
                pl.anno
            FROM JcObdulioBundle:Produccion pr
            LEFT JOIN JcObdulioBundle:Producto p WHERE pr.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Planificacionproduccion pl WHERE pl.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Tipoproducto tp WHERE p.fkTipoproducto = tp.id
            LEFT JOIN JcObdulioBundle:Unidad u WHERE pr.fkUnidad = u.id AND pl.fkUnidad = u.id
            Where pl.anno = ?2"
        );

        $query->setParameter(1, $mesActual);
        $query->setParameter(2, $annoActual);

        $listado = $query->getResult();
        $tiposProducto = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();


        return $this->render('JcObdulioBundle:Reportes:operativo.html.twig', array('listado' => $listado, 'tiposProducto' => $tiposProducto));
    }

    public function totalesAction($tipo)
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();

        $d = new DateTime('NOW');
        $annoActual = $d->format('Y');
        $mesActual = $d->format('m');

        $query = $em->createQuery(
            "SELECT
                Sum(p.valor) AS real,
                tp.nombre AS tipo,
                u.nombre AS unidad,
                Sum(CASE 
                    WHEN ?1 = 1 THEN pl.enero 
                    WHEN ?1 = 2 THEN pl.febrero 
                    WHEN ?1 = 3 THEN pl.marzo 
                    WHEN ?1 = 4 THEN pl.abril 
                    WHEN ?1 = 5 THEN pl.mayo 
                    WHEN ?1 = 6 THEN pl.junio 
                    WHEN ?1 = 7 THEN pl.julio 
                    WHEN ?1 = 8 THEN pl.agosto 
                    WHEN ?1 = 9 THEN pl.septiembre 
                    WHEN ?1 = 10 THEN pl.octubre 
                    WHEN ?1 = 11 THEN pl.noviembre 
                    ELSE pl.diciembre 
                END) AS plan,
                pl.anno
                FROM
                JcObdulioBundle:Produccion AS p
                INNER JOIN JcObdulioBundle:Producto AS pr WHERE p.fkProducto = pr.id
                INNER JOIN JcObdulioBundle:Tipoproducto AS tp WHERE pr.fkTipoproducto = tp.id
                INNER JOIN JcObdulioBundle:Unidad AS u WHERE p.fkUnidad = u.id
                INNER JOIN JcObdulioBundle:Planificacionproduccion AS pl WHERE pl.fkProducto = pr.id AND pl.fkUnidad = u.id
                WHERE
                tp.id = ?2 AND pl.anno = ?3
                GROUP BY
                tp.nombre,
                u.nombre,
                pl.anno"
        );

        $query->setParameter(1, $mesActual);
        $query->setParameter(2, $tipo);
        $query->setParameter(3, $annoActual);

        $listado = $query->getResult();

        return $this->render('JcObdulioBundle:Reportes:totales.html.twig', array('listado' => $listado));
    }
}
