<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GaleriaResultados
 *
 * @ORM\Table(name="galeria_resultados")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\GaleriaResultadosRepository")
 */
class GaleriaResultados
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

