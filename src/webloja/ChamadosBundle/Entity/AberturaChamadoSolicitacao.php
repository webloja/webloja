<?php

namespace webloja\ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AberturaChamadoSolicitacao
 *
 * @ORM\Table("lasasap.abertura_chamado_solicitacoes")
 * @ORM\Entity
 */
class AberturaChamadoSolicitacao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_solicitacao", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_subprocesso", type="integer")
     */
    private $idSubprocesso;

    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string", length=4)
     */
    private $loja;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
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
     * @ORM\Column(name="status", type="string", length=50)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date")
     */
    private $data;


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
     * Set idSubprocesso
     *
     * @param integer $idSubprocesso
     * @return AberturaChamadoSolicitacao
     */
    public function setIdSubprocesso($idSubprocesso)
    {
        $this->idSubprocesso = $idSubprocesso;
    
        return $this;
    }

    /**
     * Get idSubprocesso
     *
     * @return integer 
     */
    public function getIdSubprocesso()
    {
        return $this->idSubprocesso;
    }

    /**
     * Set loja
     *
     * @param string $loja
     * @return AberturaChamadoSolicitacao
     */
    public function setLoja($loja)
    {
        $this->loja = $loja;
    
        return $this;
    }

    /**
     * Get loja
     *
     * @return string 
     */
    public function getLoja()
    {
        return $this->loja;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return AberturaChamadoSolicitacao
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
     * @return AberturaChamadoSolicitacao
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
     * Set status
     *
     * @param string $status
     * @return AberturaChamadoSolicitacao
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
     * Set data
     *
     * @param \DateTime $data
     * @return AberturaChamadoSolicitacao
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }
}
