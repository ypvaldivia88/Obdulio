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

    public function getReporteMesActual()
    {
        $query = $this->em->createQuery(
            "SELECT
                pri.valor AS real,
                pri.fecha,
                pri.factura,
                prt.nombre AS producto,
                tp.nombre AS tipoproducto,
                u.nombre AS unidad,
                tu.nombre AS tipounidad,
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
                END AS plan
            FROM
                JcObdulioBundle:Produccion pri
                JOIN pri.fkProducto prt
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.fkTipoproducto tp
                JOIN prt.planificacionproduccion pl
            WHERE pri.fecha >= :inicioMes
                AND pl.anno = :annoActual"
        );
        $query->setParameters(array(
            'inicioMes' => date('Y-m-1'),
            'mesActual' => date('m'),
            'annoActual' => date('Y')
        ));

        return $query->getResult();
    }

    public function getReporteMesActualTotales()
    {
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
            JOIN prt.fkTipoproducto tp
            JOIN pri.fkUnidad u
            JOIN u.fkTipodeunidad tu
            JOIN prt.planificacionproduccion pl
        WHERE pri.fecha >= :inicioMes
            AND pl.anno = :annoActual
        GROUP BY
            tp.nombre,
            u.nombre"
        );
        $query->setParameters(array(
            'inicioMes' => date('Y-m-1'),
            'mesActual' => date('m'),
            'annoActual' => date('Y')
        ));

        return $query->getResult();
    }

    public function getReporteFiltrado($filtro)
    {

        $fechainicio = $filtro['fechainicio'];
        $fechafin = $filtro['fechafin'];
        $tipoproducto = $filtro['tipoproducto'];
        $unidad = $filtro['unidad'];
        $tipounidad = $filtro['tipounidad'];

        if ($fechainicio == null) {
            $fechainicio = date($this->annoActual . '-' . $this->mesActual . '-1');
        }
        if ($fechafin == null) {
            $fechafin = date($this->annoActual . '-' . $this->mesActual . '-' . $this->fechaActual->format('d'));
        }
        if ($tipoproducto == null) {
            $tipoproducto = '';
        }
        if ($unidad == null) {
            $unidad = '';
        }

        if ($tipounidad == null) {
            $tipounidad = '';
        }

        $query = $this->em->createQuery(
            "SELECT
                pri.valor AS real,
                pri.fecha,
                pri.factura,
                prt.nombre AS producto,
                tp.nombre AS tipoproducto,
                u.nombre AS unidad,
                tu.nombre AS tipounidad,
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
                END AS plan
            FROM
                JcObdulioBundle:Produccion pri
                JOIN pri.fkProducto prt
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.fkTipoproducto tp
                JOIN prt.planificacionproduccion pl
            WHERE pri.fecha >= :fechainicio
                AND pri.fecha <= :fechafin 
                AND pl.anno = :annoActual
                AND tp.id = :idtp 
                AND u.id = :idu 
                AND tu.id = :idtu"
        );
        $query->setParameters(array(
            'fechainicio' => $fechainicio,
            'fechafin' => $fechafin,
            'mesActual' => date('m'),
            'annoActual' => date('Y'),
            'idtp' => $tipoproducto,
            'idu' => $unidad,
            'idtu' => $tipounidad,
        ));

        return $query->getResult();
    }

    public function getReporteFiltradoTotales($filtro)
    {
        if (!$filtro['fechainicio']) {
            $filtro['fechainicio'] = date('Y-m-1');
        }
        if (!$filtro['fechafin']) {
            $filtro['fechafin'] = new Datetime();
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
                JOIN prt.fkTipoproducto tp
                JOIN pri.fkUnidad u
                JOIN u.fkTipodeunidad tu
                JOIN prt.planificacionproduccion pl
            WHERE pri.fecha >= :fechainicio
                AND pri.fecha <= :fechafin
                AND pl.anno = :annoActual
            GROUP BY
                tp.nombre,
                u.nombre"
        );

        $query->setParameters(array(
            'fechainicio' => $filtro['fechainicio'],
            'fechafin' => $filtro['fechafin'],
            'mesActual' => date('m'),
            'annoActual' => date('Y'),
        ));

        return $query->getResult();
    }
}