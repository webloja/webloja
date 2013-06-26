<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentralRegionalLoja
 *
 * @ORM\Table("lasasap.centrais_regionais_lojas")
 * @ORM\Entity(repositoryClass="webloja\WeblojaBundle\Repository\CentralRegionalLojaRepository")
 */
class CentralRegionalLoja
{
    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
//    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string", length=4)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $loja;

    /**
     * @var string
     *
     * @ORM\Column(name="central", type="string", length=45)
     */
    private $central;


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
     * @return CentralRegionalLoja
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
     * Set central
     *
     * @param string $central
     * @return CentralRegionalLoja
     */
    public function setCentral($central)
    {
        $this->central = $central;
    
        return $this;
    }

    /**
     * Get central
     *
     * @return string 
     */
    public function getCentral()
    {
        return $this->central;
    }
}
