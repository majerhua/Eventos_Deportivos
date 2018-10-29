<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participante
 *
 * @ORM\Table(name="participante")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\ParticipanteRepository")
 */
class Participante
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
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    private $personaId;

    /**
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumn(name="pais_representa_id", referencedColumnName="id")
     */
    private $paisRepresentaId;

    /**
     * @ORM\ManyToOne(targetEntity="TipoGrupo")
     * @ORM\JoinColumn(name="tipo_grupo_id", referencedColumnName="id")
     */
    private $tipoGrupoId;

    /**
     * @ORM\ManyToOne(targetEntity="TipoParticipante")
     * @ORM\JoinColumn(name="tipo_participante_id", referencedColumnName="id")
     */
    private $tipoParticipanteId;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_doc_identidad", type="string", length=255)
     */
    private $rutaDocIdentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_const_estudio", type="string", length=255)
     */
    private $rutaConstEstudio;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_ficha_medica_vigente", type="string", length=255)
     */
    private $rutaFichaMedicaVigente;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_formulario_inscripcion", type="string", length=255)
     */
    private $rutaFormularioInscripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_poliza_seguro", type="string", length=255)
     */
    private $rutaPolizaSeguro;

    /**
     * @var int
     *
     * @ORM\Column(name="estado_dis", type="integer")
     */
    private $estadoDis;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_certificado_dis", type="string", length=255, nullable=true)
     */
    private $rutaCertificadoDis;


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
     * Set rutaDocIdentidad
     *
     * @param string $rutaDocIdentidad
     *
     * @return Participante
     */
    public function setRutaDocIdentidad($rutaDocIdentidad)
    {
        $this->rutaDocIdentidad = $rutaDocIdentidad;

        return $this;
    }

    /**
     * Get rutaDocIdentidad
     *
     * @return string
     */
    public function getRutaDocIdentidad()
    {
        return $this->rutaDocIdentidad;
    }

    /**
     * Set rutaConstEstudio
     *
     * @param string $rutaConstEstudio
     *
     * @return Participante
     */
    public function setRutaConstEstudio($rutaConstEstudio)
    {
        $this->rutaConstEstudio = $rutaConstEstudio;

        return $this;
    }

    /**
     * Get rutaConstEstudio
     *
     * @return string
     */
    public function getRutaConstEstudio()
    {
        return $this->rutaConstEstudio;
    }

    /**
     * Set rutaFichaMedicaVigente
     *
     * @param string $rutaFichaMedicaVigente
     *
     * @return Participante
     */
    public function setRutaFichaMedicaVigente($rutaFichaMedicaVigente)
    {
        $this->rutaFichaMedicaVigente = $rutaFichaMedicaVigente;

        return $this;
    }

    /**
     * Get rutaFichaMedicaVigente
     *
     * @return string
     */
    public function getRutaFichaMedicaVigente()
    {
        return $this->rutaFichaMedicaVigente;
    }

    /**
     * Set rutaFormularioInscripcion
     *
     * @param string $rutaFormularioInscripcion
     *
     * @return Participante
     */
    public function setRutaFormularioInscripcion($rutaFormularioInscripcion)
    {
        $this->rutaFormularioInscripcion = $rutaFormularioInscripcion;

        return $this;
    }

    /**
     * Get rutaFormularioInscripcion
     *
     * @return string
     */
    public function getRutaFormularioInscripcion()
    {
        return $this->rutaFormularioInscripcion;
    }

    /**
     * Set rutaPolizaSeguro
     *
     * @param string $rutaPolizaSeguro
     *
     * @return Participante
     */
    public function setRutaPolizaSeguro($rutaPolizaSeguro)
    {
        $this->rutaPolizaSeguro = $rutaPolizaSeguro;

        return $this;
    }

    /**
     * Get rutaPolizaSeguro
     *
     * @return string
     */
    public function getRutaPolizaSeguro()
    {
        return $this->rutaPolizaSeguro;
    }

    /**
     * Set estadoDis
     *
     * @param integer $estadoDis
     *
     * @return Participante
     */
    public function setEstadoDis($estadoDis)
    {
        $this->estadoDis = $estadoDis;

        return $this;
    }

    /**
     * Get estadoDis
     *
     * @return int
     */
    public function getEstadoDis()
    {
        return $this->estadoDis;
    }

    /**
     * Set rutaCertificadoDis
     *
     * @param string $rutaCertificadoDis
     *
     * @return Participante
     */
    public function setRutaCertificadoDis($rutaCertificadoDis)
    {
        $this->rutaCertificadoDis = $rutaCertificadoDis;

        return $this;
    }

    /**
     * Get rutaCertificadoDis
     *
     * @return string
     */
    public function getRutaCertificadoDis()
    {
        return $this->rutaCertificadoDis;
    }

    /**
     * Set personaId
     *
     * @param \SudJuvenilesBundle\Entity\Persona $personaId
     *
     * @return Participante
     */
    public function setPersonaId(\SudJuvenilesBundle\Entity\Persona $personaId = null)
    {
        $this->personaId = $personaId;

        return $this;
    }

    /**
     * Get personaId
     *
     * @return \SudJuvenilesBundle\Entity\Persona
     */
    public function getPersonaId()
    {
        return $this->personaId;
    }

    /**
     * Set paisRepresentaId
     *
     * @param \SudJuvenilesBundle\Entity\Pais $paisRepresentaId
     *
     * @return Participante
     */
    public function setPaisRepresentaId(\SudJuvenilesBundle\Entity\Pais $paisRepresentaId = null)
    {
        $this->paisRepresentaId = $paisRepresentaId;

        return $this;
    }

    /**
     * Get paisRepresentaId
     *
     * @return \SudJuvenilesBundle\Entity\Pais
     */
    public function getPaisRepresentaId()
    {
        return $this->paisRepresentaId;
    }

    /**
     * Set tipoGrupoId
     *
     * @param \SudJuvenilesBundle\Entity\TipoGrupo $tipoGrupoId
     *
     * @return Participante
     */
    public function setTipoGrupoId(\SudJuvenilesBundle\Entity\TipoGrupo $tipoGrupoId = null)
    {
        $this->tipoGrupoId = $tipoGrupoId;

        return $this;
    }

    /**
     * Get tipoGrupoId
     *
     * @return \SudJuvenilesBundle\Entity\TipoGrupo
     */
    public function getTipoGrupoId()
    {
        return $this->tipoGrupoId;
    }

    /**
     * Set tipoParticipanteId
     *
     * @param \SudJuvenilesBundle\Entity\TipoParticipante $tipoParticipanteId
     *
     * @return Participante
     */
    public function setTipoParticipanteId(\SudJuvenilesBundle\Entity\TipoParticipante $tipoParticipanteId = null)
    {
        $this->tipoParticipanteId = $tipoParticipanteId;

        return $this;
    }

    /**
     * Get tipoParticipanteId
     *
     * @return \SudJuvenilesBundle\Entity\TipoParticipante
     */
    public function getTipoParticipanteId()
    {
        return $this->tipoParticipanteId;
    }
}
