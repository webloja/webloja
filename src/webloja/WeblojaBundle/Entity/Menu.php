<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use webloja\WeblojaBundle\Entity\MenuInterno;
use webloja\WeblojaBundle\Entity\MenuDepartamento;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Menu
 *
 * @ORM\Entity(repositoryClass="webloja\WeblojaBundle\Repository\MenuRepository")
 * @ORM\Table(name="menu")
 */
class Menu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_menu", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @var string
     *
     * @ORM\Column(name="menu", type="string", length=45, nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $menu;
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="MenuDepartamento", inversedBy="menus")
     * @ORM\JoinColumn(name="id_departamento", referencedColumnName="id_departamento", nullable=false)
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
     * @ORM\OneToMany(targetEntity="MenuInterno", mappedBy="menu")
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    protected $menusInternos;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menusInternos = new ArrayCollection();
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
     * Set menu
     *
     * @param string $menu
     * @return Menu
     */
    public function setMenu($menu)
    {
        $this->menu = $menu;
    
        return $this;
    }

    /**
     * Get menu
     *
     * @return string 
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set ordem
     *
     * @param integer $ordem
     * @return Menu
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
     * Set ativo
     *
     * @param boolean $ativo
     * @return Menu
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

    /**
     * Set departamento
     *
     * @param \webloja\WeblojaBundle\Entity\MenuDepartamento $departamento
     * @return Menu
     */
    public function setDepartamento(MenuDepartamento $departamento)
    {
        $this->departamento = $departamento;
    
        return $this;
    }

    /**
     * Get departamento
     *
     * @return \webloja\WeblojaBundle\Entity\MenuDepartamento 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Add menusInternos
     *
     * @param \webloja\WeblojaBundle\Entity\MenuInterno $menusInternos
     * @return Menu
     */
    public function addMenusInterno(MenuInterno $menusInternos)
    {
        $this->menusInternos[] = $menusInternos;
    
        return $this;
    }

    /**
     * Remove menusInternos
     *
     * @param \webloja\WeblojaBundle\Entity\MenuInterno $menusInternos
     */
    public function removeMenusInterno(MenuInterno $menusInternos)
    {
        $this->menusInternos->removeElement($menusInternos);
    }

    /**
     * Get menusInternos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMenusInternos()
    {
        return $this->menusInternos;
    }
}