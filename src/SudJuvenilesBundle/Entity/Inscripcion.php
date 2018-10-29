<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscripcion
 *
 * @ORM\Table(name="inscripcion")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\InscripcionRepository")
 */
class Inscripcion
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
     * @ORM\ManyToOne(targetEntity="DisciplinaDelegacion")
     * @ORM\JoinColumn(name="disciplina_delegacion_id", referencedColumnName="id")
     */
    private $disciplinaDelegacionId;

    /**
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumn(name="participante_id", referencedColumnName="id")
     */
    private $participanteId;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;


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
     * Set estado
     *
     * @param integer $estado
     *
     * @return Inscripcion
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
     * Set disciplinaDelegacionId
     *
     * @param \SudJuvenilesBundle\Entity\DisciplinaDelegacion $disciplinaDelegacionId
     *
     * @return Inscripcion
     */
    public function setDisciplinaDelegacionId(\SudJuvenilesBundle\Entity\DisciplinaDelegacion $disciplinaDelegacionId = null)
    {
        $this->disciplinaDelegacionId = $disciplinaDelegacionId;

        return $this;
    }

    /**
     * Get disciplinaDelegacionId
     *
     * @return \SudJuvenilesBundle\Entity\DisciplinaDelegacion
     */
    public function getDisciplinaDelegacionId()
    {
        return $this->disciplinaDelegacionId;
    }

    /**
     * Set participanteId
     *
     * @param \SudJuvenilesBundle\Entity\Participante $participanteId
     *
     * @return Inscripcion
     */
    public function setParticipanteId(\SudJuvenilesBundle\Entity\Participante $participanteId = null)
    {
        $this->participanteId = $participanteId;

        return $this;
    }

    /**
     * Get participanteId
     *
     * @return \SudJuvenilesBundle\Entity\Participante
     */
    public function getParticipanteId()
    {
        return $this->participanteId;
    }
}
