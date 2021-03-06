<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Producto
 *
 * @ORM\Table(name="producto")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\ProductoRepository")
 */
class Producto
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="Tipoproducto", inversedBy="producto")
     * @ORM\JoinColumn(name="fk_tipoproducto", referencedColumnName="id")
     */
    private $fkTipoproducto;
    /**
     * @ORM\ManyToOne(targetEntity="Medida", inversedBy="producto")
     * @ORM\JoinColumn(name="fk_medida", referencedColumnName="id")
     */
    private $fkMedida;

    /**
     * @ORM\OneToMany(targetEntity="Produccion", mappedBy="fkProducto")
     */
    protected $produccion;

    /**
     * @ORM\OneToMany(targetEntity="Planificacionproduccion", mappedBy="fkProducto")
     */
    protected $planificacionproduccion;

    /**
     * @ORM\OneToMany(targetEntity="Siembra", mappedBy="fkUnidad")
     */
    protected $siembra;
    /**
     * @ORM\OneToMany(targetEntity="Venta", mappedBy="fkUnidad")
     */
    protected $venta;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * Set fkTipoproducto
     *
     * @param \Jc\ObdulioBundle\Entity\Tipoproducto $fkTipoproducto
     *
     * @return Producto
     */
    public function setFkTipoproducto(\Jc\ObdulioBundle\Entity\Tipoproducto $fkTipoproducto = null)
    {
        $this->fkTipoproducto = $fkTipoproducto;

        return $this;
    }

    /**
     * Get fkTipoproducto
     *
     * @return \Jc\ObdulioBundle\Entity\Tipoproducto
     */
    public function getFkTipoproducto()
    {
        return $this->fkTipoproducto;
    }

    /**
     * Set produccion
     *
     * @param \Jc\ObdulioBundle\Entity\Produccion $produccion
     *
     * @return Producto
     */
    public function setProduccion(\Jc\ObdulioBundle\Entity\Produccion $produccion = null)
    {
        $this->produccion = $produccion;

        return $this;
    }

    /**
     * Get produccion
     *
     * @return \Jc\ObdulioBundle\Entity\Produccion
     */
    public function getProduccion()
    {
        return $this->produccion;
    }

    /**
     * Set planificacionproduccion
     *
     * @param \Jc\ObdulioBundle\Entity\Planificacionproduccion $planificacionproduccion
     *
     * @return Producto
     */
    public function setPlanificacionproduccion(\Jc\ObdulioBundle\Entity\Planificacionproduccion $planificacionproduccion = null)
    {
        $this->planificacionproduccion = $planificacionproduccion;

        return $this;
    }

    /**
     * Get planificacionproduccion
     *
     * @return \Jc\ObdulioBundle\Entity\Planificacionproduccion
     */
    public function getPlanificacionproduccion()
    {
        return $this->planificacionproduccion;
    }

    /**
     * Set fkMedida
     *
     * @param \Jc\ObdulioBundle\Entity\Medida $fkMedida
     *
     * @return Producto
     */
    public function setFkMedida(\Jc\ObdulioBundle\Entity\Medida $fkMedida = null)
    {
        $this->fkMedida = $fkMedida;

        return $this;
    }

    /**
     * Get fkMedida
     *
     * @return \Jc\ObdulioBundle\Entity\Medida
     */
    public function getFkMedida()
    {
        return $this->fkMedida;
    }
    /**
     * Set siembra
     *
     * @param \Jc\ObdulioBundle\Entity\Siembra $siembra
     *
     * @return Producto
     */
    public function setSiembra(\Jc\ObdulioBundle\Entity\Siembra $siembra = null)
    {
        $this->siembra = $siembra;

        return $this;
    }

    /**
     * Get siembra
     *
     * @return \Jc\ObdulioBundle\Entity\Siembra
     */
    public function getSiembra()
    {
        return $this->siembra;
    }
    /**
     * Set venta
     *
     * @param \Jc\ObdulioBundle\Entity\Venta $venta
     *
     * @return Producto
     */
    public function setVenta(\Jc\ObdulioBundle\Entity\Venta $venta = null)
    {
        $this->venta = $venta;

        return $this;
    }

    /**
     * Get venta
     *
     * @return \Jc\ObdulioBundle\Entity\Venta
     */
    public function getVenta()
    {
        return $this->venta;
    }
}