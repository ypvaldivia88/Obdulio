<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Destino
 *
 * @ORM\Table(name="destino")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\DestinoRepository")
 */
class Destino
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
     * @ORM\OneToMany(targetEntity="Produccion", mappedBy="fkDestino")
     */
    protected $produccion;


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
     * @return Destino
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
     * @return Destino
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
}

