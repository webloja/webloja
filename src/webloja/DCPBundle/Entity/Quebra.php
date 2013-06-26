<?php

namespace webloja\DCPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quebra
 *
 * @ORM\Table(name="comercial_rf.quebra")
 * @ORM\Entity
 */
class Quebra
{
//    /**
//     * @var integer
//     *
//     * @ORM\Column(name="loja", type="string")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="NONE")
//     */
//    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_id", type="integer")
     */
    private $numId;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_tratando", type="string", length=8)
     */
    private $usuarioTratando;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date")
     */
    private $data;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time")
     */
    private $hora;


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
     * Set loja
     *
     * @param string $loja
     * @return Quebra
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
     * Set numId
     *
     * @param integer $numId
     * @return Quebra
     */
    public function setNumId($numId)
    {
        $this->numId = $numId;
    
        return $this;
    }

    /**
     * Get numId
     *
     * @return integer 
     */
    public function getNumId()
    {
        return $this->numId;
    }

    /**
     * Set usuarioTratando
     *
     * @param string $usuarioTratando
     * @return Quebra
     */
    public function setUsuarioTratando($usuarioTratando)
    {
        $this->usuarioTratando = $usuarioTratando;
    
        return $this;
    }

    /**
     * Get usuarioTratando
     *
     * @return string 
     */
    public function getUsuarioTratando()
    {
        return $this->usuarioTratando;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Quebra
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Quebra
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

    /**
     * Set hora
     *
     * @param \DateTime $hora
     * @return Quebra
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    
        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime 
     */
    public function getHora()
    {
        return $this->hora;
    }
}
