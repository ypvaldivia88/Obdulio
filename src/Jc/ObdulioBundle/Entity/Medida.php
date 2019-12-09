<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Medida
 *
 * @ORM\Table(name="medida")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\MedidaRepository")
 */
class Medida
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
     * @ORM\Column(name="nombre", type="string", length=30, unique=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Producto", mappedBy="fkMedida")
     */
    protected $producto;


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
     * @return Medida
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
     * Set producto
     *
     * @param \Jc\ObdulioBundle\Entity\Producto $producto
     *
     * @return Medida
     */
    public function setProducto(\Jc\ObdulioBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \Jc\ObdulioBundle\Entity\Producto
     */
    public function getProducto()
    {
        return $this->producto;
    }
    public function __toString()
    {
        return $this->getNombre();
    }
}

