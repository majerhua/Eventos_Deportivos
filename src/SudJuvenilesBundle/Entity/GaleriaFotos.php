<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GaleriaFotos
 *
 * @ORM\Table(name="galeria_fotos")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\GaleriaFotosRepository")
 */
class GaleriaFotos
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;


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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return GaleriaFotos
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
}

