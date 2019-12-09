<?php

namespace Jc\ObdulioBundle\Repository;

use DateTime;

/**
 * ReportesRepository
 *
 * Repositorio para consultas de Reportes
 */
class ReportesRepository extends \Doctrine\ORM\EntityRepository
{
    private $entityManager;
    private $fechaActual;
    private $mesActual;
    private $annoActual;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->fechaActual = new DateTime('NOW');
        $this->annoActual = $this->fechaActual->format('Y');
        $this->mesActual = $this->fechaActual->format('m');
    }

    public function getMesActual(){
        $query = $this->entityManager->createQuery(
            "SELECT
                Sum( pr.valor ) AS real,	
                CASE 
                    WHEN :mesActual = 1 THEN pl.enero 
                    WHEN :mesActual = 2 THEN pl.febrero 
                    WHEN :mesActual = 3 THEN pl.marzo 
                    WHEN :mesActual = 4 THEN pl.abril 
                    WHEN :mesActual = 5 THEN pl.mayo 
                    WHEN :mesActual = 6 THEN pl.junio 
                    WHEN :mesActual = 7 THEN pl.julio 
                    WHEN :mesActual = 8 THEN pl.agosto 
                    WHEN :mesActual = 9 THEN pl.septiembre 
                    WHEN :mesActual = 10 THEN pl.octubre 
                    WHEN :mesActual = 11 THEN pl.noviembre 
                    ELSE pl.diciembre 
                END AS plan,
                p.nombre AS producto,
                tp.nombre AS tipo,
                u.nombre AS unidad
            FROM JcObdulioBundle:Produccion pr
            LEFT JOIN JcObdulioBundle:Producto p WHERE pr.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Planificacionproduccion pl WHERE pl.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Tipoproducto tp WHERE p.fkTipoproducto = tp.id
            LEFT JOIN JcObdulioBundle:Unidad u WHERE pr.fkUnidad = u.id AND pl.fkUnidad = u.id
            WHERE
                pr.fecha >= :inicioMes
            GROUP BY
                p.nombre,
                plan,
                tp.nombre,
                u.nombre"
        );
        $inicioMes = date($this->annoActual.'-'.$this->mesActual.'-1');
        
        $query->setParameters(array(
            'mesActual' => $this->mesActual,
            'inicioMes' => $inicioMes,
        ));
        return $query->getResult();
    }

    public function getOperativo(){
        $query = $this->entityManager->createQuery(
            "SELECT
                Sum( pr.valor ) AS real,	
                CASE 
                    WHEN :mesActual = 1 THEN pl.enero 
                    WHEN :mesActual = 2 THEN pl.febrero 
                    WHEN :mesActual = 3 THEN pl.marzo 
                    WHEN :mesActual = 4 THEN pl.abril 
                    WHEN :mesActual = 5 THEN pl.mayo 
                    WHEN :mesActual = 6 THEN pl.junio 
                    WHEN :mesActual = 7 THEN pl.julio 
                    WHEN :mesActual = 8 THEN pl.agosto 
                    WHEN :mesActual = 9 THEN pl.septiembre 
                    WHEN :mesActual = 10 THEN pl.octubre 
                    WHEN :mesActual = 11 THEN pl.noviembre 
                    ELSE pl.diciembre 
                END AS plan,
                p.nombre AS producto,
                tp.nombre AS tipo,
                u.nombre AS unidad
            FROM JcObdulioBundle:Produccion pr
            LEFT JOIN JcObdulioBundle:Producto p WHERE pr.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Planificacionproduccion pl WHERE pl.fkProducto = p.id
            LEFT JOIN JcObdulioBundle:Tipoproducto tp WHERE p.fkTipoproducto = tp.id
            LEFT JOIN JcObdulioBundle:Unidad u WHERE pr.fkUnidad = u.id AND pl.fkUnidad = u.id
            WHERE
                pr.fecha >= :inicioMes
            GROUP BY
                p.nombre,
                plan,
                tp.nombre,
                u.nombre"
        );
        $inicioMes = date($this->annoActual.'-'.$this->mesActual.'-1');
        
        $query->setParameters(array(
            'mesActual' => $this->mesActual,
            'inicioMes' => $inicioMes,
        ));
        return $query->getResult();
    }

    public function getTotales($tipoProducto){
        $query = $this->entityManager->createQuery(
            "SELECT
                Sum(p.valor) AS real,
                tp.nombre AS tipo,
                u.nombre AS unidad,
                Sum(CASE 
                    WHEN :mesActual = 1 THEN pl.enero 
                    WHEN :mesActual = 2 THEN pl.febrero 
                    WHEN :mesActual = 3 THEN pl.marzo 
                    WHEN :mesActual = 4 THEN pl.abril 
                    WHEN :mesActual = 5 THEN pl.mayo 
                    WHEN :mesActual = 6 THEN pl.junio 
                    WHEN :mesActual = 7 THEN pl.julio 
                    WHEN :mesActual = 8 THEN pl.agosto 
                    WHEN :mesActual = 9 THEN pl.septiembre 
                    WHEN :mesActual = 10 THEN pl.octubre 
                    WHEN :mesActual = 11 THEN pl.noviembre 
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
                tp.id = :tipoProducto
            AND
                p.fecha >= :inicioMes
            GROUP BY
                tp.nombre,
                u.nombre,
                pl.anno"
        );
        $inicioMes = date($this->annoActual.'-'.$this->mesActual.'-1');
        $query->setParameters(array(
            'mesActual' => $this->mesActual,
            'tipoProducto' => $tipoProducto,
            'inicioMes' => $inicioMes,
        ));

        return $query->getResult();
    }
}