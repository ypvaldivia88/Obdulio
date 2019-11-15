<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Unidad
 *
 * @ORM\Table(name="unidad")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\UnidadRepository")
 */
class Unidad
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
     * @ORM\OneToMany(targetEntity="Produccion", mappedBy="fkUnidad")
     */
    protected $produccion;

    /**
     * @ORM\OneToMany(targetEntity="Planificacionproduccion", mappedBy="fkUnidad")
     */
    protected $planificacionproduccion;


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
     * @return Unidad
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
     * Set produccion
     *
     * @param \Jc\ObdulioBundle\Entity\Produccion $produccion
     *
     * @return Unidad
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
     * @return Unidad
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
}

