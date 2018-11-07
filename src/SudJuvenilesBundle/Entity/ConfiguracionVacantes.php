<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfiguracionVacantes
 *
 * @ORM\Table(name="configuracion_vacantes")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\ConfiguracionVacantesRepository")
 */
class ConfiguracionVacantes
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
     * @var int
     *
     * @ORM\Column(name="tipo_participante_id", type="integer")
     */
    private $tipoParticipanteId;

    /**
     * @var int
     *
     * @ORM\Column(name="disciplina_id", type="integer")
     */
    private $disciplinaId;

    /**
     * @var int
     *
     * @ORM\Column(name="sexo_id", type="integer")
     */
    private $sexoId;

    /**
     * @var int
     *
     * @ORM\Column(name="num_vacantes", type="integer")
     */
    private $numVacantes;


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
     * Set numVacantes
     *
     * @param integer $numVacantes
     *
     * @return ConfiguracionVacantes
     */
    public function setNumVacantes($numVacantes)
    {
        $this->numVacantes = $numVacantes;

        return $this;
    }

    /**
     * Get numVacantes
     *
     * @return int
     */
    public function getNumVacantes()
    {
        return $this->numVacantes;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return ConfiguracionVacantes
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
     * Set tipoParticipanteId
     *
     * @param integer $tipoParticipanteId
     *
     * @return ConfiguracionVacantes
     */
    public function setTipoParticipanteId($tipoParticipanteId)
    {
        $this->tipoParticipanteId = $tipoParticipanteId;

        return $this;
    }

    /**
     * Get tipoParticipanteId
     *
     * @return integer
     */
    public function getTipoParticipanteId()
    {
        return $this->tipoParticipanteId;
    }

    /**
     * Set disciplinaId
     *
     * @param integer $disciplinaId
     *
     * @return ConfiguracionVacantes
     */
    public function setDisciplinaId($disciplinaId)
    {
        $this->disciplinaId = $disciplinaId;

        return $this;
    }

    /**
     * Get disciplinaId
     *
     * @return integer
     */
    public function getDisciplinaId()
    {
        return $this->disciplinaId;
    }

    /**
     * Set sexoId
     *
     * @param integer $sexoId
     *
     * @return ConfiguracionVacantes
     */
    public function setSexoId($sexoId)
    {
        $this->sexoId = $sexoId;

        return $this;
    }

    /**
     * Get sexoId
     *
     * @return integer
     */
    public function getSexoId()
    {
        return $this->sexoId;
    }
}
