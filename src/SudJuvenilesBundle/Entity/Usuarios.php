<?php

namespace SudJuvenilesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="SudJuvenilesBundle\Repository\UsuariosRepository")
 */
class Usuarios implements AdvancedUserInterface
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
     * @ORM\ManyToOne(targetEntity="TipoUsuario")
     * @ORM\JoinColumn(name="tipo_usuario_id", referencedColumnName="id")
     */
    private $tipoUsuarioId;

    /**
     * @ORM\ManyToOne(targetEntity="TipoGrupo")
     * @ORM\JoinColumn(name="tipo_grupo_id", referencedColumnName="id")
     */
    private $tipoGrupoId;

    /**
     * @ORM\ManyToOne(targetEntity="Delegacion")
     * @ORM\JoinColumn(name="delegacion_id", referencedColumnName="id")
     */
    private $delegacionId;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="json_array")
     */
    private $roles = array();

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
     * Set username
     *
     * @param string $username
     *
     * @return Usuarios
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Usuarios
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

    public function getSalt(){
        return null;
    }

    public function eraseCredentials(){
        
    }


    public function getRoles(){
        return $this->roles;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return Usuarios
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Set tipoUsuarioId
     *
     * @param \SudJuvenilesBundle\Entity\TipoUsuario $tipoUsuarioId
     *
     * @return Usuarios
     */
    public function setTipoUsuarioId(\SudJuvenilesBundle\Entity\TipoUsuario $tipoUsuarioId = null)
    {
        $this->tipoUsuarioId = $tipoUsuarioId;

        return $this;
    }

    /**
     * Get tipoUsuarioId
     *
     * @return \SudJuvenilesBundle\Entity\TipoUsuario
     */
    public function getTipoUsuarioId()
    {
        return $this->tipoUsuarioId;
    }

    /**
     * Set tipoGrupoId
     *
     * @param \SudJuvenilesBundle\Entity\TipoGrupo $tipoGrupoId
     *
     * @return Usuarios
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
     * Set delegacionId
     *
     * @param \SudJuvenilesBundle\Entity\Delegacion $delegacionId
     *
     * @return Usuarios
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

    public function isAccountNonExpired() {
       return true;
   }

   public function isAccountNonLocked() {
       return true;
   }

   public function isCredentialsNonExpired() {
       return true;
   }

   public function isEnabled(){
       return $this->estado;
   }

}
