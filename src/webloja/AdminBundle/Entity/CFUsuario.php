<?php

namespace webloja\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CFUsuario
 *
 * @ORM\Table("lasasap.cf_usuarios")
 * @ORM\Entity
 */
class CFUsuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cfusuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="loja", type="string", length=4)
     */
    private $loja;

    /**
     * @var integer
     *
     * @ORM\Column(name="prontuario", type="integer")
     */
    private $prontuario;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=20)
     */
    private $senha;
    
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
     * @return CFUsuario
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
     * Set prontuario
     *
     * @param integer $prontuario
     * @return CFUsuario
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

    /**
     * Set senha
     *
     * @param string $senha
     * @return CFUsuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    
        return $this;
    }

    /**
     * Get senha
     *
     * @return string 
     */
    public function getSenha()
    {
        return $this->senha;
    }
}
