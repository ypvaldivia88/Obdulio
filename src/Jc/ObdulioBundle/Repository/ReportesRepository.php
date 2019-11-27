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

    public function getOperativo()
    {
        $query = $this->entityManager->createQuery(
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

        $query->setParameter(1, $this->mesActual);
        $query->setParameter(2, $this->annoActual);

        return $query->getResult();
    }

    public function getTotales($tipo)
    {
        $query = $this->entityManager->createQuery(
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

        $query->setParameter(1, $this->mesActual);
        $query->setParameter(2, $tipo);
        $query->setParameter(3, $this->annoActual);

        return $query->getResult();
    }
}
