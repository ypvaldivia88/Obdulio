<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Planificaciondeleche
 *
 * @ORM\Table(name="planificaciondeleche")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\PlanificaciondelecheRepository")
 */
class Planificaciondeleche
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
     * @var int
     *
     * @ORM\Column(name="enero", type="integer")
     */
    private $enero;

    /**
     * @var int
     *
     * @ORM\Column(name="febrero", type="integer")
     */
    private $febrero;

    /**
     * @var int
     *
     * @ORM\Column(name="marzo", type="integer")
     */
    private $marzo;

    /**
     * @var int
     *
     * @ORM\Column(name="abril", type="integer")
     */
    private $abril;

    /**
     * @var int
     *
     * @ORM\Column(name="mayo", type="integer")
     */
    private $mayo;

    /**
     * @var int
     *
     * @ORM\Column(name="junio", type="integer")
     */
    private $junio;

    /**
     * @var int
     *
     * @ORM\Column(name="julio", type="integer")
     */
    private $julio;

    /**
     * @var int
     *
     * @ORM\Column(name="agosto", type="integer")
     */
    private $agosto;

    /**
     * @var int
     *
     * @ORM\Column(name="septiembre", type="integer")
     */
    private $septiembre;

    /**
     * @var int
     *
     * @ORM\Column(name="octubre", type="integer")
     */
    private $octubre;

    /**
     * @var int
     *
     * @ORM\Column(name="noviembre", type="integer")
     */
    private $noviembre;

    /**
     * @var int
     *
     * @ORM\Column(name="diciembre", type="integer")
     */
    private $diciembre;

    /**
     * @var int
     *
     * @ORM\Column(name="anno", type="integer")
     */
    private $anno;
    /**
     * @ORM\ManyToOne(targetEntity="Termo", inversedBy="planificacionleche")
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
     * Set enero
     *
     * @param integer $enero
     *
     * @return Planificaciondeleche
     */
    public function setEnero($enero)
    {
        $this->enero = $enero;
    
        return $this;
    }

    /**
     * Get enero
     *
     * @return integer
     */
    public function getEnero()
    {
        return $this->enero;
    }

    /**
     * Set febrero
     *
     * @param integer $febrero
     *
     * @return Planificaciondeleche
     */
    public function setFebrero($febrero)
    {
        $this->febrero = $febrero;
    
        return $this;
    }

    /**
     * Get febrero
     *
     * @return integer
     */
    public function getFebrero()
    {
        return $this->febrero;
    }

    /**
     * Set marzo
     *
     * @param integer $marzo
     *
     * @return Planificaciondeleche
     */
    public function setMarzo($marzo)
    {
        $this->marzo = $marzo;
    
        return $this;
    }

    /**
     * Get marzo
     *
     * @return integer
     */
    public function getMarzo()
    {
        return $this->marzo;
    }

    /**
     * Set abril
     *
     * @param integer $abril
     *
     * @return Planificaciondeleche
     */
    public function setAbril($abril)
    {
        $this->abril = $abril;
    
        return $this;
    }

    /**
     * Get abril
     *
     * @return integer
     */
    public function getAbril()
    {
        return $this->abril;
    }

    /**
     * Set mayo
     *
     * @param integer $mayo
     *
     * @return Planificaciondeleche
     */
    public function setMayo($mayo)
    {
        $this->mayo = $mayo;
    
        return $this;
    }

    /**
     * Get mayo
     *
     * @return integer
     */
    public function getMayo()
    {
        return $this->mayo;
    }

    /**
     * Set junio
     *
     * @param integer $junio
     *
     * @return Planificaciondeleche
     */
    public function setJunio($junio)
    {
        $this->junio = $junio;
    
        return $this;
    }

    /**
     * Get junio
     *
     * @return integer
     */
    public function getJunio()
    {
        return $this->junio;
    }

    /**
     * Set julio
     *
     * @param integer $julio
     *
     * @return Planificaciondeleche
     */
    public function setJulio($julio)
    {
        $this->julio = $julio;
    
        return $this;
    }

    /**
     * Get julio
     *
     * @return integer
     */
    public function getJulio()
    {
        return $this->julio;
    }

    /**
     * Set agosto
     *
     * @param integer $agosto
     *
     * @return Planificaciondeleche
     */
    public function setAgosto($agosto)
    {
        $this->agosto = $agosto;
    
        return $this;
    }

    /**
     * Get agosto
     *
     * @return integer
     */
    public function getAgosto()
    {
        return $this->agosto;
    }

    /**
     * Set septiembre
     *
     * @param integer $septiembre
     *
     * @return Planificaciondeleche
     */
    public function setSeptiembre($septiembre)
    {
        $this->septiembre = $septiembre;
    
        return $this;
    }

    /**
     * Get septiembre
     *
     * @return integer
     */
    public function getSeptiembre()
    {
        return $this->septiembre;
    }

    /**
     * Set octubre
     *
     * @param integer $octubre
     *
     * @return Planificaciondeleche
     */
    public function setOctubre($octubre)
    {
        $this->octubre = $octubre;
    
        return $this;
    }

    /**
     * Get octubre
     *
     * @return integer
     */
    public function getOctubre()
    {
        return $this->octubre;
    }

    /**
     * Set noviembre
     *
     * @param integer $noviembre
     *
     * @return Planificaciondeleche
     */
    public function setNoviembre($noviembre)
    {
        $this->noviembre = $noviembre;
    
        return $this;
    }

    /**
     * Get noviembre
     *
     * @return integer
     */
    public function getNoviembre()
    {
        return $this->noviembre;
    }

    /**
     * Set diciembre
     *
     * @param integer $diciembre
     *
     * @return Planificaciondeleche
     */
    public function setDiciembre($diciembre)
    {
        $this->diciembre = $diciembre;
    
        return $this;
    }

    /**
     * Get diciembre
     *
     * @return integer
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
     * @return Planificaciondeleche
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
     * Set fkTermo
     *
     * @param \Jc\ObdulioBundle\Entity\Termo $fkTermo
     *
     * @return Planificaciondeleche
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

