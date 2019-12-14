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
    private $fechaActual;
    private $mesActual;
    private $annoActual;

    public function __construct($em)
    {
        $this->em = $em;
        $this->fechaActual = new DateTime('NOW');
        $this->annoActual = $this->fechaActual->format('Y');
        $this->mesActual = $this->fechaActual->format('m');
    }

    public function getMesActual(){
        $inicioMes = date($this->annoActual.'-'.$this->mesActual.'-1');
        $query = $this->em->createQuery(
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
            LEFT JOIN pr.fkProducto p
            LEFT JOIN p.planificacionproduccion pl
            LEFT JOIN p.fkTipoproducto tp
            LEFT JOIN JcObdulioBundle:Unidad u WHERE pr.fkUnidad = u.id AND pl.fkUnidad = u.id
            WHERE
                pr.fecha >= :inicioMes
            GROUP BY
                p.nombre,
                plan,
                tp.nombre,
                u.nombre"
        );
        $query->setParameters(array(
            'mesActual' => $this->mesActual,
            'inicioMes' => $inicioMes,
        ));
        return $query->getResult();
    }

    public function getReporte($filtro)
    {
        switch ($filtro['reporte']) {
            case 'operativo':
            case 'consejo_popular':
            case 'acumulado':
            case 'prod_cultivo':
            case 'huevo':
            case 'ventas_viandas':
            case 'ventas_hortalizas':
            case 'ventas_granos':
            case 'ventas_frutas':
            case 'ventas_totales':
            case 'ventas_tot_est':
            case 'ventas_tot_est_dia':
            case 'prod_dec_sem5':
            case 'prod_dec_sem4':
            case 'prod_dec_sem3':
            case 'prod_dec_sem2':
            case 'prod_dec_sem1':
            case 'sust_imp_anual':
            case 'sust_imp_mensual':
            case 'ventas_est_plan_real':
            case 'ventas_est_prod_total':
            case 'ratificado_mes':
            case 'ratificado_acumulado':
            case 'turismo':
                return $this->getGeneralFiltrado($filtro);
                break;

            default:
                return $this->getGeneralFiltrado($filtro);
                break;
        }
    }

    public function getGeneralFiltrado($filtro){

        $fechainicio = $filtro['fechainicio'];
        $fechafin = $filtro['fechafin'];
        $tipoproducto = $filtro['tipoproducto'];
        $unidad = $filtro['unidad'];
        $tipounidad = $filtro['tipounidad'];

        if ($fechainicio == null) {
            $fechainicio = date($this->annoActual.'-'.$this->mesActual.'-1');
        }
        if ($fechafin == null) {
            $fechafin = date($this->annoActual.'-'.$this->mesActual.'-'.$this->fechaActual->format('d'));
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
                Sum( pr.valor ) AS real,	
                CASE 
                    WHEN :mes = 1 THEN pl.enero 
                    WHEN :mes = 2 THEN pl.febrero 
                    WHEN :mes = 3 THEN pl.marzo 
                    WHEN :mes = 4 THEN pl.abril 
                    WHEN :mes = 5 THEN pl.mayo 
                    WHEN :mes = 6 THEN pl.junio 
                    WHEN :mes = 7 THEN pl.julio 
                    WHEN :mes = 8 THEN pl.agosto 
                    WHEN :mes = 9 THEN pl.septiembre 
                    WHEN :mes = 10 THEN pl.octubre 
                    WHEN :mes = 11 THEN pl.noviembre 
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
            LEFT JOIN JcObdulioBundle:Tipodeunidad tu WHERE tu.id = u.fkTipodeunidad
            WHERE
                pr.fecha >= :fechainicio AND
                pr.fecha <= :fechafin AND
                tp.id = :idtp AND
                u.id = :idu AND
                tu.id = :idtu
            GROUP BY
                p.nombre,
                plan,
                tp.nombre,
                u.nombre"
        );
        $query->setParameters(array(
            'mes' => $this->mesActual,
            'fechainicio' => $fechainicio,
            'fechafin' => $fechafin,
            'idtp' => $tipoproducto,
            'idu' => $unidad,
            'idtu' => $tipounidad,
        ));
        return $query->getResult();
    }

    public function getTotales(){
        $query = $this->em->createQuery(
            "SELECT
                Sum(produccion.valor) real,
                tp.nombre tipo,
                u.nombre unidad,
                tu.nombre tipounidad,
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
                END) plan,
                pl.anno
            FROM
                JcObdulioBundle:Produccion produccion
                LEFT JOIN produccion.fkProducto producto
                LEFT JOIN producto.fkTipoproducto tp
                LEFT JOIN produccion.fkUnidad u
                LEFT JOIN producto.planificacionproduccion pl 
                    WITH pl.fkProducto = producto.id AND pl.fkUnidad = u.id
                LEFT JOIN u.fkTipodeunidad tu
            WHERE                
            produccion.fecha >= :inicioMes
            GROUP BY
                tp.nombre,
                tu.nombre,
                u.nombre,
                pl.anno"
        );
        $inicioMes = date($this->annoActual.'-'.$this->mesActual.'-1');
        $query->setParameters(array(
            'mesActual' => $this->mesActual,
            'inicioMes' => $inicioMes,
        ));

        return $query->getResult();
    }
}