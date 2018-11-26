<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GaleriaVideos
 *
 * @ORM\Table(name="galeria_videos")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\GaleriaVideosRepository")
 */
class GaleriaVideos
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
     * @ORM\Column(name="linkVideo", type="string", length=255)
     */
    private $linkVideo;


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
     * Set linkVideo
     *
     * @param string $linkVideo
     *
     * @return GaleriaVideos
     */
    public function setLinkVideo($linkVideo)
    {
        $this->linkVideo = $linkVideo;

        return $this;
    }

    /**
     * Get linkVideo
     *
     * @return string
     */
    public function getLinkVideo()
    {
        return $this->linkVideo;
    }
}

