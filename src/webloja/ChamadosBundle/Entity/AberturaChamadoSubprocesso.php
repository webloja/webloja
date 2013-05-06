<?php

namespace webloja\ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AberturaChamadoSubprocesso
 *
 * @ORM\Table("lasasap.abertura_chamado_subprocesso")
 * @ORM\Entity
 */
class AberturaChamadoSubprocesso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_subprocesso", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_processo", type="integer")
     */
    private $idProcesso;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=50)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="assunto", type="string", length=50)
     */
    private $assunto;

    /**
     * @var string
     *
     * @ORM\Column(name="processo", type="string", length=50)
     */
    private $processo;

    /**
     * @var string
     *
     * @ORM\Column(name="modulo", type="string", length=50)
     */
    private $modulo;

    /**
     * @var string
     *
     * @ORM\Column(name="caminho", type="string", length=50)
     */
    private $caminho;

    /**
     * @var string
     *
     * @ORM\Column(name="natureza", type="string", length=50)
     */
    private $natureza;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=50)
     */
    private $titulo;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idProcesso
     *
     * @param integer $idProcesso
     * @return AberturaChamadoSubprocesso
     */
    public function setIdProcesso($idProcesso)
    {
        $this->idProcesso = $idProcesso;
    
        return $this;
    }

    /**
     * Get idProcesso
     *
     * @return integer 
     */
    public function getIdProcesso()
    {
        return $this->idProcesso;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return AberturaChamadoSubprocesso
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    
        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return AberturaChamadoSubprocesso
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set assunto
     *
     * @param string $assunto
     * @return AberturaChamadoSubprocesso
     */
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
    
        return $this;
    }

    /**
     * Get assunto
     *
     * @return string 
     */
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * Set processo
     *
     * @param string $processo
     * @return AberturaChamadoSubprocesso
     */
    public function setProcesso($processo)
    {
        $this->processo = $processo;
    
        return $this;
    }

    /**
     * Get processo
     *
     * @return string 
     */
    public function getProcesso()
    {
        return $this->processo;
    }

    /**
     * Set modulo
     *
     * @param string $modulo
     * @return AberturaChamadoSubprocesso
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;
    
        return $this;
    }

    /**
     * Get modulo
     *
     * @return string 
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Set caminho
     *
     * @param string $caminho
     * @return AberturaChamadoSubprocesso
     */
    public function setCaminho($caminho)
    {
        $this->caminho = $caminho;
    
        return $this;
    }

    /**
     * Get caminho
     *
     * @return string 
     */
    public function getCaminho()
    {
        return $this->caminho;
    }

    /**
     * Set natureza
     *
     * @param string $natureza
     * @return AberturaChamadoSubprocesso
     */
    public function setNatureza($natureza)
    {
        $this->natureza = $natureza;
    
        return $this;
    }

    /**
     * Get natureza
     *
     * @return string 
     */
    public function getNatureza()
    {
        return $this->natureza;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return AberturaChamadoSubprocesso
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }
}
