<?php

namespace SudJuvenilesBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\PersonaRepository")
 */
class Persona
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
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumn(name="pais_origen_id", referencedColumnName="id")
     */
    private $paisOrigenId;

    /**
     * @ORM\ManyToOne(targetEntity="TipoDocumento")
     * @ORM\JoinColumn(name="tipo_documento", referencedColumnName="id")
     */
    private $tipoDocumento;

    /**
     * @ORM\ManyToOne(targetEntity="Sexo")
     * @ORM\JoinColumn(name="sexo_id", referencedColumnName="id")
     */
    private $sexoId;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento", type="string", length=50)
     */
    private $numeroDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=120)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=100)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_materno", type="string", length=120)
     */
    private $apellidoMaterno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=150)
     */
    private $correo;

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
     * Set numeroDocumento
     *
     * @param string $numeroDocumento
     *
     * @return Persona
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return string
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Persona
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
     * Set apellidoPaterno
     *
     * @param string $apellidoPaterno
     *
     * @return Persona
     */
    public function setApellidoPaterno($apellidoPaterno)
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    /**
     * Get apellidoPaterno
     *
     * @return string
     */
    public function getApellidoPaterno()
    {
        return $this->apellidoPaterno;
    }

    /**
     * Set apellidoMaterno
     *
     * @param string $apellidoMaterno
     *
     * @return Persona
     */
    public function setApellidoMaterno($apellidoMaterno)
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    /**
     * Get apellidoMaterno
     *
     * @return string
     */
    public function getApellidoMaterno()
    {
        return $this->apellidoMaterno;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Persona
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set tipoDocumento
     *
     * @param \SudJuvenilesBundle\Entity\TipoDocumento $tipoDocumento
     *
     * @return Persona
     */
    public function setTipoDocumento(\SudJuvenilesBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \SudJuvenilesBundle\Entity\TipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set paisOrigen
     *
     * @param \SudJuvenilesBundle\Entity\Pais $paisOrigen
     *
     * @return Persona
     */
    public function setPaisOrigen(\SudJuvenilesBundle\Entity\Pais $paisOrigen = null)
    {
        $this->paisOrigen = $paisOrigen;

        return $this;
    }

    /**
     * Get paisOrigen
     *
     * @return \SudJuvenilesBundle\Entity\Pais
     */
    public function getPaisOrigen()
    {
        return $this->paisOrigen;
    }

    /**
     * Set paisOrigenId
     *
     * @param \SudJuvenilesBundle\Entity\Pais $paisOrigenId
     *
     * @return Persona
     */
    public function setPaisOrigenId(\SudJuvenilesBundle\Entity\Pais $paisOrigenId = null)
    {
        $this->paisOrigenId = $paisOrigenId;

        return $this;
    }

    /**
     * Get paisOrigenId
     *
     * @return \SudJuvenilesBundle\Entity\Pais
     */
    public function getPaisOrigenId()
    {
        return $this->paisOrigenId;
    }

    /**
     * Set sexoId
     *
     * @param \SudJuvenilesBundle\Entity\Sexo $sexoId
     *
     * @return Persona
     */
    public function setSexoId(\SudJuvenilesBundle\Entity\Sexo $sexoId = null)
    {
        $this->sexoId = $sexoId;

        return $this;
    }

    /**
     * Get sexoId
     *
     * @return \SudJuvenilesBundle\Entity\Sexo
     */
    public function getSexoId()
    {
        return $this->sexoId;
    }
}
