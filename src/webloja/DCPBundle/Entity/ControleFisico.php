<?php

namespace webloja\DCPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControleFisico
 *
 * @ORM\Table("controle_fisico")
 * @ORM\Entity(repositoryClass="webloja\DCPBundle\Repository\ControleFisicoRepository")
 */
class ControleFisico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_controle", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_sap_inicio", type="string", length=12)
     */
    private $codSapInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_sap_fim", type="string", length=12)
     */
    private $codSapFim;

    /**
     * @var integer
     *
     * @ORM\Column(name="depto", type="integer")
     */
    private $depto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_envio", type="datetime")
     */
    private $dtEnvio;

    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string", length=4)
     */
    private $loja;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd", type="integer")
     */
    private $qtd;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_envio", type="integer")
     */
    private $idEnvio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer")
     */
    private $idUser;


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
     * Set codSapInicio
     *
     * @param string $codSapInicio
     * @return ControleFisico
     */
    public function setCodSapInicio($codSapInicio)
    {
        $this->codSapInicio = $codSapInicio;
    
        return $this;
    }

    /**
     * Get codSapInicio
     *
     * @return string 
     */
    public function getCodSapInicio()
    {
        return $this->codSapInicio;
    }

    /**
     * Set codSapFim
     *
     * @param string $codSapFim
     * @return ControleFisico
     */
    public function setCodSapFim($codSapFim)
    {
        $this->codSapFim = $codSapFim;
    
        return $this;
    }

    /**
     * Get codSapFim
     *
     * @return string 
     */
    public function getCodSapFim()
    {
        return $this->codSapFim;
    }

    /**
     * Set depto
     *
     * @param integer $depto
     * @return ControleFisico
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
     * Set dtEnvio
     *
     * @param \DateTime $dtEnvio
     * @return ControleFisico
     */
    public function setDtEnvio($dtEnvio)
    {
        $this->dtEnvio = $dtEnvio;
    
        return $this;
    }

    /**
     * Get dtEnvio
     *
     * @return \DateTime 
     */
    public function getDtEnvio()
    {
        return $this->dtEnvio;
    }

    /**
     * Set loja
     *
     * @param string $loja
     * @return ControleFisico
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
     * Set qtd
     *
     * @param integer $qtd
     * @return ControleFisico
     */
    public function setQtd($qtd)
    {
        $this->qtd = $qtd;
    
        return $this;
    }

    /**
     * Get qtd
     *
     * @return integer 
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * Set idEnvio
     *
     * @param integer $idEnvio
     * @return ControleFisico
     */
    public function setIdEnvio($idEnvio)
    {
        $this->idEnvio = $idEnvio;
    
        return $this;
    }

    /**
     * Get idEnvio
     *
     * @return integer 
     */
    public function getIdEnvio()
    {
        return $this->idEnvio;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     * @return ControleFisico
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    
        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
