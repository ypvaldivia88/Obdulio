<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Produccion
 *
 * @ORM\Table(name="produccion")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\ProduccionRepository")
 */
class Produccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float")
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="factura", type="string", length=15, nullable=true, unique=true)
     */
    private $factura;

    /**
     * @ORM\ManyToOne(targetEntity="Producto", inversedBy="produccion")
     * @ORM\JoinColumn(name="fk_producto", referencedColumnName="id")
     */
    private $fkProducto;

    /**
     * @ORM\ManyToOne(targetEntity="Destino", inversedBy="produccion")
     * @ORM\JoinColumn(name="fk_destino", referencedColumnName="id")
     */
    private $fkDestino;

    /**
     * @ORM\ManyToOne(targetEntity="Unidad", inversedBy="produccion")
     * @ORM\JoinColumn(name="fk_unidad", referencedColumnName="id")
     */
    private $fkUnidad;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Produccion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set valor
     *
     * @param float $valor
     *
     * @return Produccion
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set factura
     *
     * @param string $factura
     *
     * @return Produccion
     */
    public function setFactura($factura)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return string
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set fkProducto
     *
     * @param \Jc\ObdulioBundle\Entity\Producto $fkProducto
     *
     * @return Produccion
     */
    public function setFkProducto(\Jc\ObdulioBundle\Entity\Producto $fkProducto = null)
    {
        $this->fkProducto = $fkProducto;

        return $this;
    }

    /**
     * Get fkProducto
     *
     * @return \Jc\ObdulioBundle\Entity\Producto
     */
    public function getFkProducto()
    {
        return $this->fkProducto;
    }

    /**
     * Set fkDestino
     *
     * @param \Jc\ObdulioBundle\Entity\Destino $fkDestino
     *
     * @return Produccion
     */
    public function setFkDestino(\Jc\ObdulioBundle\Entity\Destino $fkDestino = null)
    {
        $this->fkDestino = $fkDestino;

        return $this;
    }

    /**
     * Get fkDestino
     *
     * @return \Jc\ObdulioBundle\Entity\Destino
     */
    public function getFkDestino()
    {
        return $this->fkDestino;
    }

    /**
     * Set fkUnidad
     *
     * @param \Jc\ObdulioBundle\Entity\Unidad $fkUnidad
     *
     * @return Produccion
     */
    public function setFkUnidad(\Jc\ObdulioBundle\Entity\Unidad $fkUnidad = null)
    {
        $this->fkUnidad = $fkUnidad;

        return $this;
    }

    /**
     * Get fkUnidad
     *
     * @return \Jc\ObdulioBundle\Entity\Unidad
     */
    public function getFkUnidad()
    {
        return $this->fkUnidad;
    }
}

