<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delegacion
 *
 * @ORM\Table(name="delegacion")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\DelegacionRepository")
 */
class Delegacion
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
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     */
    private $paisId;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;


    /**
     * @var int
     *
     * @ORM\Column(name="periodo_id", type="integer")
     */
    private $periodoId;

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
     * Set periodoId
     *
     * @param integer $periodoId
     *
     * @return Delegacion
     */
    public function setPeriodoId($periodoId)
    {
        $this->periodoId = $periodoId;

        return $this;
    }

    /**
     * Get periodoId
     *
     * @return int
     */
    public function getPeriodoId()
    {
        return $this->periodoId;
    }


    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Delegacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return int
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set paisId
     *
     * @param \SudJuvenilesBundle\Entity\Pais $paisId
     *
     * @return Delegacion
     */
    public function setPaisId(\SudJuvenilesBundle\Entity\Pais $paisId = null)
    {
        $this->paisId = $paisId;

        return $this;
    }

    /**
     * Get paisId
     *
     * @return \SudJuvenilesBundle\Entity\Pais
     */
    public function getPaisId()
    {
        return $this->paisId;
    }
}
