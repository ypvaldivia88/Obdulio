<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Venta
 *
 * @ORM\Table(name="venta")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\VentaRepository")
 */
class Venta
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
     * @var float
     *
     * @ORM\Column(name="enero", type="float", nullable=true)
     */
    private $enero;

    /**
     * @var float
     *
     * @ORM\Column(name="febrero", type="float", nullable=true)
     */
    private $febrero;

    /**
     * @var float
     *
     * @ORM\Column(name="marzo", type="float", nullable=true)
     */
    private $marzo;

    /**
     * @var float
     *
     * @ORM\Column(name="abril", type="float", nullable=true)
     */
    private $abril;

    /**
     * @var float
     *
     * @ORM\Column(name="mayo", type="float", nullable=true)
     */
    private $mayo;

    /**
     * @var float
     *
     * @ORM\Column(name="junio", type="float", nullable=true)
     */
    private $junio;

    /**
     * @var float
     *
     * @ORM\Column(name="julio", type="float", nullable=true)
     */
    private $julio;

    /**
     * @var float
     *
     * @ORM\Column(name="agosto", type="float", nullable=true)
     */
    private $agosto;

    /**
     * @var float
     *
     * @ORM\Column(name="septiembre", type="float", nullable=true)
     */
    private $septiembre;

    /**
     * @var float
     *
     * @ORM\Column(name="octubre", type="float", nullable=true)
     */
    private $octubre;

    /**
     * @var float
     *
     * @ORM\Column(name="noviembre", type="float", nullable=true)
     */
    private $noviembre;

    /**
     * @var float
     *
     * @ORM\Column(name="diciembre", type="float", nullable=true)
     */
    private $diciembre;

    /**
     * @var int
     *
     * @ORM\Column(name="anno", type="integer")
     */
    private $anno;
    /**
     * @ORM\ManyToOne(targetEntity="Producto", inversedBy="venta")
     * @ORM\JoinColumn(name="fk_producto", referencedColumnName="id")
     */
    private $fkProducto;
    /**
     * @ORM\ManyToOne(targetEntity="Unidad", inversedBy="venta")
     * @ORM\JoinColumn(name="fk_unidad", referencedColumnName="id")
     */
    private $fkUnidad;


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
     * Set enero
     *
     * @param float $enero
     *
     * @return Venta
     */
    public function setEnero($enero)
    {
        $this->enero = $enero;
    
        return $this;
    }

    /**
     * Get enero
     *
     * @return float
     */
    public function getEnero()
    {
        return $this->enero;
    }

    /**
     * Set febrero
     *
     * @param float $febrero
     *
     * @return Venta
     */
    public function setFebrero($febrero)
    {
        $this->febrero = $febrero;
    
        return $this;
    }

    /**
     * Get febrero
     *
     * @return float
     */
    public function getFebrero()
    {
        return $this->febrero;
    }

    /**
     * Set marzo
     *
     * @param float $marzo
     *
     * @return Venta
     */
    public function setMarzo($marzo)
    {
        $this->marzo = $marzo;
    
        return $this;
    }

    /**
     * Get marzo
     *
     * @return float
     */
    public function getMarzo()
    {
        return $this->marzo;
    }

    /**
     * Set abril
     *
     * @param float $abril
     *
     * @return Venta
     */
    public function setAbril($abril)
    {
        $this->abril = $abril;
    
        return $this;
    }

    /**
     * Get abril
     *
     * @return float
     */
    public function getAbril()
    {
        return $this->abril;
    }

    /**
     * Set mayo
     *
     * @param float $mayo
     *
     * @return Venta
     */
    public function setMayo($mayo)
    {
        $this->mayo = $mayo;
    
        return $this;
    }

    /**
     * Get mayo
     *
     * @return float
     */
    public function getMayo()
    {
        return $this->mayo;
    }

    /**
     * Set junio
     *
     * @param float $junio
     *
     * @return Venta
     */
    public function setJunio($junio)
    {
        $this->junio = $junio;
    
        return $this;
    }

    /**
     * Get junio
     *
     * @return float
     */
    public function getJunio()
    {
        return $this->junio;
    }

    /**
     * Set julio
     *
     * @param float $julio
     *
     * @return Venta
     */
    public function setJulio($julio)
    {
        $this->julio = $julio;
    
        return $this;
    }

    /**
     * Get julio
     *
     * @return float
     */
    public function getJulio()
    {
        return $this->julio;
    }

    /**
     * Set agosto
     *
     * @param float $agosto
     *
     * @return Venta
     */
    public function setAgosto($agosto)
    {
        $this->agosto = $agosto;
    
        return $this;
    }

    /**
     * Get agosto
     *
     * @return float
     */
    public function getAgosto()
    {
        return $this->agosto;
    }

    /**
     * Set septiembre
     *
     * @param float $septiembre
     *
     * @return Venta
     */
    public function setSeptiembre($septiembre)
    {
        $this->septiembre = $septiembre;
    
        return $this;
    }

    /**
     * Get septiembre
     *
     * @return float
     */
    public function getSeptiembre()
    {
        return $this->septiembre;
    }

    /**
     * Set octubre
     *
     * @param float $octubre
     *
     * @return Venta
     */
    public function setOctubre($octubre)
    {
        $this->octubre = $octubre;
    
        return $this;
    }

    /**
     * Get octubre
     *
     * @return float
     */
    public function getOctubre()
    {
        return $this->octubre;
    }

    /**
     * Set noviembre
     *
     * @param float $noviembre
     *
     * @return Venta
     */
    public function setNoviembre($noviembre)
    {
        $this->noviembre = $noviembre;
    
        return $this;
    }

    /**
     * Get noviembre
     *
     * @return float
     */
    public function getNoviembre()
    {
        return $this->noviembre;
    }

    /**
     * Set diciembre
     *
     * @param float $diciembre
     *
     * @return Venta
     */
    public function setDiciembre($diciembre)
    {
        $this->diciembre = $diciembre;
    
        return $this;
    }

    /**
     * Get diciembre
     *
     * @return float
     */
    public function getDiciembre()
    {
        return $this->diciembre;
    }

    /**
     * Set anno
     *
     * @param integer $anno
     *
     * @return Venta
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;
    
        return $this;
    }

    /**
     * Get anno
     *
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }
    /**
     * Set fkProducto
     *
     * @param \Jc\ObdulioBundle\Entity\Producto $fkProducto
     *
     * @return Venta
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
     * Set fkUnidad
     *
     * @param \Jc\ObdulioBundle\Entity\Unidad $fkUnidad
     *
     * @return Venta
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

