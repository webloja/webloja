<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itens
 *
 * @ORM\Table("lasamat.itens")
 * @ORM\Entity
 */
class Itens
{
    /**
     * @var string
     *
     * @ORM\Column(name="ean", type="string", length=13)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="ean", type="string", length=13)
//     */
//    private $ean;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_sap", type="string", length=12)
     */
    private $codSap;

    /**
     * @var integer
     *
     * @ORM\Column(name="depto", type="integer")
     */
    private $depto;

    /**
     * @var string
     *
     * @ORM\Column(name="linha", type="string", length=20)
     */
    private $linha;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=40)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="ean12", type="string", length=12)
     */
    private $ean12;

    /**
     * @var integer
     *
     * @ORM\Column(name="bo_basico", type="integer")
     */
    private $boBasico;

    /**
     * @var string
     *
     * @ORM\Column(name="vch_atrib_cor", type="string", length=20)
     */
    private $vchAtribCor;

    /**
     * @var integer
     *
     * @ORM\Column(name="conjunto", type="integer")
     */
    private $conjunto;

    /**
     * @var integer
     *
     * @ORM\Column(name="und", type="integer")
     */
    private $und;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag_novo", type="integer")
     */
    private $flagNovo;


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
     * Set ean
     *
     * @param string $ean
     * @return Itens
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Get ean
     *
     * @return string 
     */
   // public function getEan()
    //{
    //    return $this->ean;
   // }

    /**
     * Set codSap
     *
     * @param string $codSap
     * @return Itens
     */
    public function setCodSap($codSap)
    {
        $this->codSap = $codSap;
    
        return $this;
    }

    /**
     * Get codSap
     *
     * @return string 
     */
    public function getCodSap()
    {
        return $this->codSap;
    }

    /**
     * Set depto
     *
     * @param integer $depto
     * @return Itens
     */
    public function setDepto($depto)
    {
        $this->depto = $depto;
    
        return $this;
    }

    /**
     * Get depto
     *
     * @return integer 
     */
    public function getDepto()
    {
        return $this->depto;
    }

    /**
     * Set linha
     *
     * @param string $linha
     * @return Itens
     */
    public function setLinha($linha)
    {
        $this->linha = $linha;
    
        return $this;
    }

    /**
     * Get linha
     *
     * @return string 
     */
    public function getLinha()
    {
        return $this->linha;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Itens
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
     * Set ean12
     *
     * @param string $ean12
     * @return Itens
     */
    public function setEan12($ean12)
    {
        $this->ean12 = $ean12;
    
        return $this;
    }

    /**
     * Get ean12
     *
     * @return string 
     */
    public function getEan12()
    {
        return $this->ean12;
    }

    /**
     * Set boBasico
     *
     * @param integer $boBasico
     * @return Itens
     */
    public function setBoBasico($boBasico)
    {
        $this->boBasico = $boBasico;
    
        return $this;
    }

    /**
     * Get boBasico
     *
     * @return integer 
     */
    public function getBoBasico()
    {
        return $this->boBasico;
    }

    /**
     * Set vchAtribCor
     *
     * @param string $vchAtribCor
     * @return Itens
     */
    public function setVchAtribCor($vchAtribCor)
    {
        $this->vchAtribCor = $vchAtribCor;
    
        return $this;
    }

    /**
     * Get vchAtribCor
     *
     * @return string 
     */
    public function getVchAtribCor()
    {
        return $this->vchAtribCor;
    }

    /**
     * Set conjunto
     *
     * @param integer $conjunto
     * @return Itens
     */
    public function setConjunto($conjunto)
    {
        $this->conjunto = $conjunto;
    
        return $this;
    }

    /**
     * Get conjunto
     *
     * @return integer 
     */
    public function getConjunto()
    {
        return $this->conjunto;
    }

    /**
     * Set und
     *
     * @param integer $und
     * @return Itens
     */
    public function setUnd($und)
    {
        $this->und = $und;
    
        return $this;
    }

    /**
     * Get und
     *
     * @return integer 
     */
    public function getUnd()
    {
        return $this->und;
    }

    /**
     * Set flagNovo
     *
     * @param integer $flagNovo
     * @return Itens
     */
    public function setFlagNovo($flagNovo)
    {
        $this->flagNovo = $flagNovo;
    
        return $this;
    }

    /**
     * Get flagNovo
     *
     * @return integer 
     */
    public function getFlagNovo()
    {
        return $this->flagNovo;
    }
}
