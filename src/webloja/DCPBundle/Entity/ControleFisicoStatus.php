<?php

namespace webloja\DCPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ControleFisicoStatus
 *
 * @ORM\Table("controle_fisico_status")
 * @ORM\Entity(repositoryClass="webloja\DCPBundle\Repository\ControleFisicoStatusRepository")
 */
class ControleFisicoStatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_controle_fisico_status", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_sap", type="string", length=12)
     */
    private $codSap;

    /**
     * @var string
     *
     * @ORM\Column(name="msg_erro", type="string", length=255)
     */
    private $msgErro;

    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string", length=4)
     */
    private $loja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt", type="datetime")
     */
    private $dt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_envio", type="integer")
     */
    private $idEnvio;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd", type="integer")
     */
    private $qtd;

    /**
     * @var integer
     *
     * @ORM\Column(name="prontuario", type="integer")
     */
    private $prontuario;


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
     * Set codSap
     *
     * @param string $codSap
     * @return ControleFisicoStatus
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
     * Set msgErro
     *
     * @param string $msgErro
     * @return ControleFisicoStatus
     */
    public function setMsgErro($msgErro)
    {
        $this->msgErro = $msgErro;
    
        return $this;
    }

    /**
     * Get msgErro
     *
     * @return string 
     */
    public function getMsgErro()
    {
        return $this->msgErro;
    }

    /**
     * Set loja
     *
     * @param string $loja
     * @return ControleFisicoStatus
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
     * Set dt
     *
     * @param \DateTime $dt
     * @return ControleFisicoStatus
     */
    public function setDt($dt)
    {
        $this->dt = $dt;
    
        return $this;
    }

    /**
     * Get dt
     *
     * @return \DateTime 
     */
    public function getDt()
    {
        return $this->dt;
    }

    /**
     * Set idEnvio
     *
     * @param integer $idEnvio
     * @return ControleFisicoStatus
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
     * Set qtd
     *
     * @param integer $qtd
     * @return ControleFisicoStatus
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
     * Set prontuario
     *
     * @param integer $prontuario
     * @return ControleFisicoStatus
     */
    public function setProntuario($prontuario)
    {
        $this->prontuario = $prontuario;
    
        return $this;
    }

    /**
     * Get prontuario
     *
     * @return integer 
     */
    public function getProntuario()
    {
        return $this->prontuario;
    }
}
