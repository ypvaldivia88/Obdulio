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
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }
    
    public function getReporteGeneral($filtro)
    {       
        $fechainicio = date('Y-m-1');
        $fechafin = date('Y-m-d');
        $tipoproducto = '%';
        $unidad = '%';
        $tipounidad = '%'; 
        $destino = '%'; 

        if ($filtro) {
            if($filtro['rangofechas'] != null){
                $fechainicio = explode(" / ", $filtro['rangofechas'])[0];
                $fechafin = explode(" / ", $filtro['rangofechas'])[1];
            }
            if($filtro['tipoproducto'] != null)
                $tipoproducto = $filtro['tipoproducto'];
            if($filtro['unidad'] != null)
                $unidad = $filtro['unidad'];
            if($filtro['tipounidad'] != null)
                $tipounidad = $filtro['tipounidad'];
            if($filtro['destino'] != null)
                $destino = $filtro['destino'];
        }
        
        $query = $this->em->createQuery(
            "SELECT
                SUM(pri.valor) AS real,
                pri.fecha,
                pri.factura,
                prt.nombre AS producto,
                tp.nombre AS tipoproducto,
                u.nombre AS unidad,
                tu.nombre AS tipounidad,
                SUM(CASE 
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
                d.nombre AS destino
            FROM
                JcObdulioBundle:Produccion pri
                JOIN pri.fkProducto prt
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.fkTipoproducto tp
                JOIN prt.planificacionproduccion pl
                JOIN pri.fkDestino d
            WHERE pri.fecha >= :fechainicio
                AND pri.fecha <= :fechafin 
                AND pl.anno = :annoActual
                AND tp.id LIKE :idtp 
                AND u.id LIKE :idu 
                AND tu.id LIKE :idtu
                AND d.id LIKE :idd
            GROUP BY
                pri.fecha,
                pri.factura,
                prt.nombre,
                tp.nombre,
                u.nombre,
                tu.nombre,
                d.nombre
            ORDER BY pri.fecha ASC"
        );
        $query->setParameters(array(
            'fechainicio' => $fechainicio,
            'fechafin' => $fechafin,
            'mesActual' => date('m'),
            'annoActual' => date('Y'),
            'idtp' => $tipoproducto,
            'idu' => $unidad,
            'idtu' => $tipounidad,
            'idd' => $destino,
        ));
        
        return $query->getResult();
    }
    
    public function getTotalDeUnProducto($filtro,$idProducto)
    {
        $fechainicio = date('Y-m-1');
        $fechafin = date('Y-m-d');
        $tipoproducto = '%';
        $unidad = '%';
        $tipounidad = '%'; 
        $destino = '%'; 

        if ($filtro) {
            if($filtro['rangofechas'] != null){
                $fechainicio = explode(" / ", $filtro['rangofechas'])[0];
                $fechafin = explode(" / ", $filtro['rangofechas'])[1];
            }
            if($filtro['tipoproducto'] != null)
                $tipoproducto = $filtro['tipoproducto'];
            if($filtro['unidad'] != null)
                $unidad = $filtro['unidad'];
            if($filtro['tipounidad'] != null)
                $tipounidad = $filtro['tipounidad'];
            if($filtro['destino'] != null)
                $destino = $filtro['destino'];
        }
        
        $query = $this->em->createQuery(
            "SELECT
                SUM(pri.valor) AS real,
                prt.nombre AS producto,
                u.nombre AS unidad,
                SUM(CASE 
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
                END) AS plan
            FROM
                JcObdulioBundle:Produccion pri
                JOIN pri.fkProducto prt
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.fkTipoproducto tp
                JOIN prt.planificacionproduccion pl
                JOIN pri.fkDestino d
            WHERE pri.fecha >= :fechainicio
                AND pri.fecha <= :fechafin 
                AND pl.anno = :annoActual
                AND tp.id LIKE :idtp 
                AND u.id LIKE :idu 
                AND tu.id LIKE :idtu
                AND d.id LIKE :idd
                AND prt.id = :idprt
            GROUP BY
                prt.nombre,
                u.nombre"
        );

        $query->setParameters(array(
            'fechainicio' => $fechainicio,
            'fechafin' => $fechafin,
            'mesActual' => date('m'),
            'annoActual' => date('Y'),
            'idtp' => $tipoproducto,
            'idu' => $unidad,
            'idtu' => $tipounidad,
            'idd' => $destino,
            'idprt' => $idProducto,
        ));

        return $query->getResult();
    }
    
    public function getTotalPorTipoProducto($filtro)
    {
        $fechainicio = date('Y-m-1');
        $fechafin = date('Y-m-d');
        $tipoproducto = '%';
        $unidad = '%';
        $tipounidad = '%'; 
        $destino = '%'; 

        if ($filtro) {
            if($filtro['rangofechas'] != null){
                $fechainicio = explode(" / ", $filtro['rangofechas'])[0];
                $fechafin = explode(" / ", $filtro['rangofechas'])[1];
            }
            if($filtro['tipoproducto'] != null)
                $tipoproducto = $filtro['tipoproducto'];
            if($filtro['unidad'] != null)
                $unidad = $filtro['unidad'];
            if($filtro['tipounidad'] != null)
                $tipounidad = $filtro['tipounidad'];
            if($filtro['destino'] != null)
                $destino = $filtro['destino'];
        }
        
        $query = $this->em->createQuery(
            "SELECT
                SUM(pri.valor) AS real,
                tp.nombre AS tipoproducto,
                u.nombre AS unidad,
                SUM(CASE 
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
                END) AS plan
            FROM
                JcObdulioBundle:Produccion pri
                JOIN pri.fkProducto prt
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.fkTipoproducto tp
                JOIN prt.planificacionproduccion pl
                JOIN pri.fkDestino d
            WHERE pri.fecha >= :fechainicio
                AND pri.fecha <= :fechafin 
                AND pl.anno = :annoActual
                AND tp.id LIKE :idtp 
                AND u.id LIKE :idu 
                AND tu.id LIKE :idtu
                AND d.id LIKE :idd
            GROUP BY
                tp.nombre,
                u.nombre"
        );

        $query->setParameters(array(
            'fechainicio' => $fechainicio,
            'fechafin' => $fechafin,
            'mesActual' => date('m'),
            'annoActual' => date('Y'),
            'idtp' => $tipoproducto,
            'idu' => $unidad,
            'idtu' => $tipounidad,
            'idd' => $destino,
        ));

        return $query->getResult();
    }
    
    public function getTotalPorDestino($filtro)
    {
        $fechainicio = date('Y-m-1');
        $fechafin = date('Y-m-d');
        $tipoproducto = '%';
        $unidad = '%';
        $tipounidad = '%'; 
        $destino = '%'; 

        if ($filtro) {
            if($filtro['rangofechas'] != null){
                $fechainicio = explode(" / ", $filtro['rangofechas'])[0];
                $fechafin = explode(" / ", $filtro['rangofechas'])[1];
            }
            if($filtro['tipoproducto'] != null)
                $tipoproducto = $filtro['tipoproducto'];
            if($filtro['unidad'] != null)
                $unidad = $filtro['unidad'];
            if($filtro['tipounidad'] != null)
                $tipounidad = $filtro['tipounidad'];
            if($filtro['destino'] != null)
                $destino = $filtro['destino'];
        }
        
        $query = $this->em->createQuery(
            "SELECT
                SUM(pri.valor) AS real,
                d.nombre AS destino,
                u.nombre AS unidad,
                SUM(CASE 
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
                END) AS plan
            FROM
                JcObdulioBundle:Produccion pri
                JOIN pri.fkProducto prt
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.fkTipoproducto tp
                JOIN prt.planificacionproduccion pl
                JOIN pri.fkDestino d
            WHERE pri.fecha >= :fechainicio
                AND pri.fecha <= :fechafin 
                AND pl.anno = :annoActual
                AND tp.id LIKE :idtp 
                AND u.id LIKE :idu 
                AND tu.id LIKE :idtu
                AND d.id LIKE :idd
            GROUP BY
                d.nombre,
                u.nombre"
        );

        $query->setParameters(array(
            'fechainicio' => $fechainicio,
            'fechafin' => $fechafin,
            'mesActual' => date('m'),
            'annoActual' => date('Y'),
            'idtp' => $tipoproducto,
            'idu' => $unidad,
            'idtu' => $tipounidad,
            'idd' => $destino,
        ));

        return $query->getResult();
    }
    
    public function getTotalProductoPorDestino($filtro)
    {
        $fechainicio = date('Y-m-1');
        $fechafin = date('Y-m-d');
        $tipoproducto = '%';
        $unidad = '%';
        $tipounidad = '%'; 
        $destino = '%'; 

        if ($filtro) {
            if($filtro['rangofechas'] != null){
                $fechainicio = explode(" / ", $filtro['rangofechas'])[0];
                $fechafin = explode(" / ", $filtro['rangofechas'])[1];
            }
            if($filtro['tipoproducto'] != null)
                $tipoproducto = $filtro['tipoproducto'];
            if($filtro['unidad'] != null)
                $unidad = $filtro['unidad'];
            if($filtro['tipounidad'] != null)
                $tipounidad = $filtro['tipounidad'];
            if($filtro['destino'] != null)
                $destino = $filtro['destino'];
        }
        
        $query = $this->em->createQuery(
            "SELECT
                prt.nombre AS producto,
                u.nombre AS unidad,
                d.nombre AS destino,
                SUM(pri.valor) AS real,
                SUM(CASE 
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
                END) AS plan
            FROM
                JcObdulioBundle:Produccion pri
                JOIN pri.fkProducto prt
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.fkTipoproducto tp
                JOIN prt.planificacionproduccion pl
                JOIN pri.fkDestino d
            WHERE pri.fecha >= :fechainicio
                AND pri.fecha <= :fechafin 
                AND pl.anno = :annoActual
                AND tp.id LIKE :idtp 
                AND u.id LIKE :idu 
                AND tu.id LIKE :idtu
                AND d.id LIKE :idd
            GROUP BY
                prt.nombre,
                u.nombre,
                d.nombre"
        );

        $query->setParameters(array(
            'fechainicio' => $fechainicio,
            'fechafin' => $fechafin,
            'mesActual' => date('m'),
            'annoActual' => date('Y'),
            'idtp' => $tipoproducto,
            'idu' => $unidad,
            'idtu' => $tipounidad,
            'idd' => $destino,
        ));

        return $query->getResult();
    }
}