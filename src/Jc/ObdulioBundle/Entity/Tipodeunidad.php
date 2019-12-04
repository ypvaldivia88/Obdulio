<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tipodeunidad
 *
 * @ORM\Table(name="tipodeunidad")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\TipodeunidadRepository")
 */
class Tipodeunidad
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
     * @ORM\OneToMany(targetEntity="Unidad", mappedBy="fkTipodeunidad")
     */
    protected $unidad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, unique=true)
     */
    private $nombre;


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
     * @return Tipodeunidad
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
     * Set unidad
     *
     * @param \Jc\ObdulioBundle\Entity\Unidad $unidad
     *
     * @return Tipodeunidad
     */
    public function setUnidad(\Jc\ObdulioBundle\Entity\Unidad $unidad = null)
    {
        $this->unidad = $unidad;

        return $this;
    }

    /**
     * Get unidad
     *
     * @return \Jc\ObdulioBundle\Entity\Unidad
     */
    public function getUnidad()
    {
        return $this->unidad;
    }
    public function __toString()
    {
        return $this->getNombre();
    }
}

