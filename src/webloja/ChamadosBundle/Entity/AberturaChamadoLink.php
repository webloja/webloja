<?php

namespace webloja\ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AberturaChamadoLink
 *
 * @ORM\Table("lasasap.abertura_chamado_link")
 * @ORM\Entity
 */
class AberturaChamadoLink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_link", type="integer")
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
     * @ORM\Column(name="caminho", type="string", length=128)
     */
    private $caminho;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=128)
     */
    private $link;


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
     * @return AberturaChamadoLink
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
     * Set caminho
     *
     * @param string $caminho
     * @return AberturaChamadoLink
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
     * Set link
     *
     * @param string $link
     * @return AberturaChamadoLink
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }
}
