<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Usuario
 *
 * @ORM\Table("lasasap.usuarios")
 * @ORM\Entity(repositoryClass="webloja\WeblojaBundle\Repository\UsuarioRepository")
 */
class Usuario{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=15)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "3",
     *      minMessage = "O campo Login tem que ter no mínimo  {{ limit }} caracters")
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=45)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "3",
     *      minMessage = "O campo Senha tem que ter no mínimo  {{ limit }} caracters")
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="local", type="string", length=5)
     */
    private $local;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_perfil", type="integer")
     */
    private $idPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_criacao", type="date")
     */
    private $dataCriacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ativo", type="integer")
     */
    private $ativo;


    /**
     * Get id
     *
     * @return integer 
     */
     public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Usuario
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set senha
     *
     * @param string $senha
     * @return Usuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    
        return $this;
    }

    /**
     * Get senha
     *
     * @return string 
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set local
     *
     * @param string $local
     * @return Usuario
     */
    public function setLocal($local)
    {
        $this->local = $local;
    
        return $this;
    }

    /**
     * Get local
     *
     * @return string 
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     * @return Usuario
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
    
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dataCriacao
     *
     * @param \DateTime $dataCriacao
     * @return Usuario
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->dataCriacao = $dataCriacao;
    
        return $this;
    }

    /**
     * Get dataCriacao
     *
     * @return \DateTime 
     */
    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    /**
     * Set ativo
     *
     * @param integer $ativo
     * @return Usuario
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    
        return $this;
    }

    /**
     * Get ativo
     *
     * @return integer 
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

}
