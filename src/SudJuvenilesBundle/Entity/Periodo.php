<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periodo
 *
 * @ORM\Table(name="periodo")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\PeriodoRepository")
 */
class Periodo
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

