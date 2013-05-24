<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lojas
 *
 * @ORM\Table("lasasap.lojas")
 * @ORM\Entity
 */
class Lojas
{
    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string", length=4)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=30)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="regiao", type="string", length=6)
     */
    private $regiao;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_estado", type="string", length=3)
     */
    private $codEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade", type="string", length=20)
     */
    private $cidade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_inauguracao", type="date")
     */
    private $dtInauguracao;

    /**
     * @var string
     *
     * @ORM\Column(name="distrito", type="string", length=4)
     */
    private $distrito;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=1)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;


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
     * Set nome
     *
     * @param string $nome
     * @return Lojas
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
     * Set regiao
     *
     * @param string $regiao
     * @return Lojas
     */
    public function setRegiao($regiao)
    {
        $this->regiao = $regiao;
    
        return $this;
    }

    /**
     * Get regiao
     *
     * @return string 
     */
    public function getRegiao()
    {
        return $this->regiao;
    }

    /**
     * Set codEstado
     *
     * @param string $codEstado
     * @return Lojas
     */
    public function setCodEstado($codEstado)
    {
        $this->codEstado = $codEstado;
    
        return $this;
    }

    /**
     * Get codEstado
     *
     * @return string 
     */
    public function getCodEstado()
    {
        return $this->codEstado;
    }

    /**
     * Set cidade
     *
     * @param string $cidade
     * @return Lojas
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    
        return $this;
    }

    /**
     * Get cidade
     *
     * @return string 
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Set dtInauguracao
     *
     * @param \DateTime $dtInauguracao
     * @return Lojas
     */
    public function setDtInauguracao($dtInauguracao)
    {
        $this->dtInauguracao = $dtInauguracao;
    
        return $this;
    }

    /**
     * Get dtInauguracao
     *
     * @return \DateTime 
     */
    public function getDtInauguracao()
    {
        return $this->dtInauguracao;
    }

    /**
     * Set distrito
     *
     * @param string $distrito
     * @return Lojas
     */
    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
    
        return $this;
    }

    /**
     * Get distrito
     *
     * @return string 
     */
    public function getDistrito()
    {
        return $this->distrito;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Lojas
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Lojas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
