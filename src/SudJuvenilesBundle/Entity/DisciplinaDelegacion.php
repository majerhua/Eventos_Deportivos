<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisciplinaDelegacion
 *
 * @ORM\Table(name="disciplina_delegacion")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\DisciplinaDelegacionRepository")
 */
class DisciplinaDelegacion
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
     * @ORM\ManyToOne(targetEntity="Disciplina")
     * @ORM\JoinColumn(name="disciplina_id", referencedColumnName="id")
     */
    private $disciplinaId;

    /**
     * @ORM\ManyToOne(targetEntity="Delegacion")
     * @ORM\JoinColumn(name="delegacion_id", referencedColumnName="id")
     */
    private $delegacionId;

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
     * @return DisciplinaDelegacion
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
     * Set disciplinaId
     *
     * @param \SudJuvenilesBundle\Entity\Disciplina $disciplinaId
     *
     * @return DisciplinaDelegacion
     */
    public function setDisciplinaId(\SudJuvenilesBundle\Entity\Disciplina $disciplinaId = null)
    {
        $this->disciplinaId = $disciplinaId;

        return $this;
    }

    /**
     * Get disciplinaId
     *
     * @return \SudJuvenilesBundle\Entity\Disciplina
     */
    public function getDisciplinaId()
    {
        return $this->disciplinaId;
    }

    /**
     * Set delegacionId
     *
     * @param \SudJuvenilesBundle\Entity\Delegacion $delegacionId
     *
     * @return DisciplinaDelegacion
     */
    public function setDelegacionId(\SudJuvenilesBundle\Entity\Delegacion $delegacionId = null)
    {
        $this->delegacionId = $delegacionId;

        return $this;
    }

    /**
     * Get delegacionId
     *
     * @return \SudJuvenilesBundle\Entity\Delegacion
     */
    public function getDelegacionId()
    {
        return $this->delegacionId;
    }
}
