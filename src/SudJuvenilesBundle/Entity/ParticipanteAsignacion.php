<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipanteAsignacion
 *
 * @ORM\Table(name="participante_asignacion")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\ParticipanteAsignacionRepository")
 */
class ParticipanteAsignacion
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
     * @ORM\ManyToOne(targetEntity="Participante")
     * @ORM\JoinColumn(name="participante_id", referencedColumnName="id")
     */
    private $participanteId;

    /**
     * @ORM\ManyToOne(targetEntity="Asignacion")
     * @ORM\JoinColumn(name="asignacion_id", referencedColumnName="id")
     */
    private $asignacionId;

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
     * @return ParticipanteAsignacion
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
     * Set participanteId
     *
     * @param \SudJuvenilesBundle\Entity\Participante $participanteId
     *
     * @return ParticipanteAsignacion
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

    /**
     * Set asignacionId
     *
     * @param \SudJuvenilesBundle\Entity\Asignacion $asignacionId
     *
     * @return ParticipanteAsignacion
     */
    public function setAsignacionId(\SudJuvenilesBundle\Entity\Asignacion $asignacionId = null)
    {
        $this->asignacionId = $asignacionId;

        return $this;
    }

    /**
     * Get asignacionId
     *
     * @return \SudJuvenilesBundle\Entity\Asignacion
     */
    public function getAsignacionId()
    {
        return $this->asignacionId;
    }
}
