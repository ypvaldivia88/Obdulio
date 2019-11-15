<?php

namespace Jc\ObdulioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tipoproducto
 *
 * @ORM\Table(name="tipoproducto")
 * @ORM\Entity(repositoryClass="Jc\ObdulioBundle\Repository\TipoproductoRepository")
 */
class Tipoproducto
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
     * @ORM\OneToMany(targetEntity="Producto", mappedBy="fkTipoproducto")
     */
    protected $producto;


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
     * @return Tipoproducto
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
     * @return Tipoproducto
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

