<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Produto
 *
 * @ORM\Entity(repositoryClass="webloja\WeblojaBundle\Repository\MenuRepository")
 * @ORM\Table(name="menu_interno")
 */
class MenuInterno
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_interno", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

   /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="menusInternos")
     * @ORM\JoinColumn(name="id_menu", referencedColumnName="id_menu", nullable=false)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    protected $menu;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $titulo;
    
     /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=45, nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $link;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordem", type="integer", nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     * @Assert\Range(invalidMessage="Campo não é número", max="999", maxMessage="O valor deve ser menor que 1000", min="0", minMessage="O valor mínimo é 0")
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
     * @var integer
     *
     * @ORM\Column(name="permissao", type="smallint")
     * @Assert\NotBlank(message="Campo obrigatório")
     * @Assert\choice(choices = {"0", "1", "2"}, message = "Esse campo só admite os valores 0, 1 e 2")
     */
    private $permissao;
    
     /**
     * @var string
     *
     * @ORM\Column(name="rota", type="string", length=50, nullable=true)
     * @Assert\Length(min=4, max=50, minMessage="A rota deve possuir {{ limit }} caracteres no mínimo", maxMessage="A rota deve possuir {{ limit }} caracteres no máximo")
     */
    private $rota;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="pai", type="integer", nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $pai;

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
     * Set titulo
     *
     * @param string $titulo
     * @return MenuInterno
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return MenuInterno
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

    /**
     * Set ordem
     *
     * @param integer $ordem
     * @return MenuInterno
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
     * @return MenuInterno
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
     * Set permissao
     *
     * @param integer $permissao
     * @return MenuInterno
     */
    public function setPermissao($permissao)
    {
        $this->permissao = $permissao;
    
        return $this;
    }

    /**
     * Get permissao
     *
     * @return integer 
     */
    public function getPermissao()
    {
        return $this->permissao;
    }

    /**
     * Set rota
     *
     * @param string $rota
     * @return MenuInterno
     */
    public function setRota($rota)
    {
        $this->rota = $rota;
    
        return $this;
    }

    /**
     * Get rota
     *
     * @return string 
     */
    public function getRota()
    {
        return $this->rota;
    }

    /**
     * Set pai
     *
     * @param integer $pai
     * @return MenuInterno
     */
    public function setPai($pai)
    {
        $this->pai = $pai;
    
        return $this;
    }

    /**
     * Get pai
     *
     * @return integer 
     */
    public function getPai()
    {
        return $this->pai;
    }

    /**
     * Set menu
     *
     * @param \webloja\WeblojaBundle\Entity\Menu $menu
     * @return MenuInterno
     */
    public function setMenu(\webloja\WeblojaBundle\Entity\Menu $menu)
    {
        $this->menu = $menu;
    
        return $this;
    }

    /**
     * Get menu
     *
     * @return \webloja\WeblojaBundle\Entity\Menu 
     */
    public function getMenu()
    {
        return $this->menu;
    }
}