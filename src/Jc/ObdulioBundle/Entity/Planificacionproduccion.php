<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Planificacionproduccion
 *
 * @ORM\Table(name="planificacionproduccion")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\PlanificacionproduccionRepository")
 */
class Planificacionproduccion
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
     * @ORM\Column(name="enero", type="float")
     */
    private $enero;

    /**
     * @var float
     *
     * @ORM\Column(name="febrero", type="float")
     */
    private $febrero;

    /**
     * @var float
     *
     * @ORM\Column(name="marzo", type="float")
     */
    private $marzo;

    /**
     * @var float
     *
     * @ORM\Column(name="abril", type="float")
     */
    private $abril;

    /**
     * @var float
     *
     * @ORM\Column(name="mayo", type="float")
     */
    private $mayo;

    /**
     * @var float
     *
     * @ORM\Column(name="junio", type="float")
     */
    private $junio;

    /**
     * @var float
     *
     * @ORM\Column(name="julio", type="float")
     */
    private $julio;

    /**
     * @var float
     *
     * @ORM\Column(name="agosto", type="float")
     */
    private $agosto;

    /**
     * @var float
     *
     * @ORM\Column(name="septiembre", type="float")
     */
    private $septiembre;

    /**
     * @var float
     *
     * @ORM\Column(name="octubre", type="float")
     */
    private $octubre;

    /**
     * @var float
     *
     * @ORM\Column(name="noviembre", type="float")
     */
    private $noviembre;

    /**
     * @var float
     *
     * @ORM\Column(name="diciembre", type="float")
     */
    private $diciembre;

    /**
     * @var int
     *
     * @ORM\Column(name="anno", type="integer")
     */
    private $anno;     

    /**
     * @ORM\ManyToOne(targetEntity="Producto", inversedBy="planificacionproduccion")
     * @ORM\JoinColumn(name="fk_producto", referencedColumnName="id")
     */
    private $fkProducto;

    /**
     * @ORM\ManyToOne(targetEntity="Unidad", inversedBy="planificacionproduccion")
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
     * Set enero
     *
     * @param float $enero
     *
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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
     * @param int $anno
     *
     * @return Planificacionproduccion
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;
        return $this;
    }

    /**
     * Get anno
     *
     * @return int
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
     * @return Planificacionproduccion
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
     * @return Planificacionproduccion
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

