<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Termo
 *
 * @ORM\Table(name="termo")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\TermoRepository")
 */
class Termo
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
     * @ORM\OneToMany(targetEntity="Produccionleche", mappedBy="fkTermo")
     */
    protected $produccionleche;

    /**
     * @ORM\OneToMany(targetEntity="Planificaciondeleche", mappedBy="fkTermo")
     */
    protected $planificaciondeleche;

    public function __toString()
    {
        return $this->getNombre();
    }


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Termo
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

    /**
     * Set planificaciondeleche
     *
     * @param \Jc\ObdulioBundle\Entity\Planificaciondeleche $planificaciondeleche
     *
     * @return Termo
     */
    public function setPlanificaciondeleche(\Jc\ObdulioBundle\Entity\Planificaciondeleche $planificaciondeleche = null)
    {
        $this->planificaciondeleche = $planificaciondeleche;

        return $this;
    }

    /**
     * Get planificaciondeleche
     *
     * @return \Jc\ObdulioBundle\Entity\Planificaciondeleche
     */
    public function getPlanificaciondeleche()
    {
        return $this->planificaciondeleche;
    }

    /**
     * Set produccionleche
     *
     * @param \Jc\ObdulioBundle\Entity\Produccionleche $produccionleche
     *
     * @return Termo
     */
    public function setProduccionleche(\Jc\ObdulioBundle\Entity\Produccionleche $produccionleche = null)
    {
        $this->produccionleche = $produccionleche;

        return $this;
    }

    /**
     * Get produccionleche
     *
     * @return \Jc\ObdulioBundle\Entity\Produccionleche
     */
    public function getProduccionleche()
    {
        return $this->produccionleche;
    }
}

