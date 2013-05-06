<?php

namespace webloja\ChamadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AberturaChamadoProcesso
 *
 * @ORM\Table("lasasap.abertura_chamado_processo")
 * @ORM\Entity
 */
class AberturaChamadoProcesso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_processo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=20)
     */
    private $descricao;


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
     * Set descricao
     *
     * @param string $descricao
     * @return AberturaChamadoProcesso
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
}
