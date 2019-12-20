<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Produccionleche
 *
 * @ORM\Table(name="produccionleche")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\ProduccionlecheRepository")
 */
class Produccionleche
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
     * @var int
     *
     * @ORM\Column(name="valor", type="integer")
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="factura", type="string", length=15, nullable=true, unique=false)
     */
    private $factura;
    /**
     * @ORM\ManyToOne(targetEntity="Termo", inversedBy="produccionleche")
     * @ORM\JoinColumn(name="fk_termo", referencedColumnName="id")
     */
    private $fkTermo;


    /**
     * Get id
     *
     * @return integer
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
     * @return Produccionleche
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
     * @param integer $valor
     *
     * @return Produccionleche
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return integer
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
     * @return Produccionleche
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
     * Set fkTermo
     *
     * @param \Jc\ObdulioBundle\Entity\Termo $fkTermo
     *
     * @return Produccionleche
     */
    public function setFkTermo(\Jc\ObdulioBundle\Entity\Termo $fkTermo = null)
    {
        $this->fkTermo = $fkTermo;

        return $this;
    }

    /**
     * Get fkTermo
     *
     * @return \Jc\ObdulioBundle\Entity\Termo
     */
    public function getFkTermo()
    {
        return $this->fkTermo;
    }
}

