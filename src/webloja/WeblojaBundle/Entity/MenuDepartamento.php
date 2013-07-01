
<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use webloja\WeblojaBundle\Entity\Menu;


/**
 * Produto
 *
 * @ORM\Entity()
 * @ORM\Table(name="menu_departamentos")
 */
class MenuDepartamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_departamento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=45, nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $departamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordem", type="integer", nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     * @Assert\Range(invalidMessage="Campo não é número", max="999", maxMessage="O valor deve ser menor que 1000", min="1", minMessage="O valor mínimo é 1")
     */
    private $ordem;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="ativo", type="boolean")
     * @Assert\choice(choices = {"0", "1"}, message = "Esse campo só admite verdadeiro ou falso, 1 ou 0")
     */
    private $ativo;
    
    /**
     * @var collection
     *
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="departamento")
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $menus;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menus = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set departamento
     *
     * @param string $departamento
     * @return MenuDepartamento
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    
        return $this;
    }

    /**
     * Get departamento
     *
     * @return string 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set ordem
     *
     * @param integer $ordem
     * @return MenuDepartamento
     */
    public function setOrdem($ordem)
    {
        $this->ordem = $ordem;
    
        return $this;
    }

    /**
     * Get ordem
     *
     * @return integer 
     */
    public function getOrdem()
    {
        return $this->ordem;
    }

    /**
     * Add menus
     *
     * @param \webloja\WeblojaBundle\Entity\Menu $menus
     * @return MenuDepartamento
     */
    public function addMenu(\webloja\WeblojaBundle\Entity\Menu $menus)
    {
        $this->menus[] = $menus;
    
        return $this;
    }

    /**
     * Remove menus
     *
     * @param \webloja\WeblojaBundle\Entity\Menu $menus
     */
    public function removeMenu(\webloja\WeblojaBundle\Entity\Menu $menus)
    {
        $this->menus->removeElement($menus);
    }

    /**
     * Get menus
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMenus()
    {
        return $this->menus;
    }

    /**
     * Set ativo
     *
     * @param boolean $ativo
     * @return MenuDepartamento
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    
        return $this;
    }

    /**
     * Get ativo
     *
     * @return boolean 
     */
    public function getAtivo()
    {
        return $this->ativo;
    }
}
