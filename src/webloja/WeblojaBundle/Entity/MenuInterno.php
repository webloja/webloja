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
    private $id_interno;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_menu", type="integer", nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $id_menu;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length="45", nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $titulo;
    
     /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length="45", nullable=true)
     * @Assert\NotBlank(message="Campo obrigatório")
     */
    private $link;

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
     * @Assert\NotBlank(message="Campo obrigatório")
     * @Assert\Range(invalidMessage="Campo não é número", max="1", maxMessage="O campo deve ser 0 ou 1", min="0", minMessage="O campo deve ser 0 ou 1")
     */
    private $ativo;

     /**
     * @var integer
     *
     * @ORM\Column(name="permissao", type="smallint")
     * @Assert\NotBlank(message="Campo obrigatório")
     * @Assert\Range(invalidMessage="Campo não é número", max="100", maxMessage="O campo deve ser menor que 100", min="1", minMessage="O campo maior que 0")
     */
    private $permissao;
    
     /**
     * @var string
     *
     * @ORM\Column(name="rota", type="string", length="50", nullable=true)
     * @Assert\Range(invalidMessage="Campo não é número", max="100", maxMessage="O campo deve ser menor que 100", min="1", minMessage="O campo maior que 0")
     * @Assert\Length(min=4, max=45, minMessage="A rota deve possuir {{ limit }} caracteres no mínimo", maxMessage="A rota deve possuir {{ limit }} caracteres no máximo")
     */
    private $rota;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_menu_interno_pai", type="int", nullable=true)
     * @Assert\Range(invalidMessage="Campo não é um número inteiro positivo")
     */
    private $id_menu_interno_pai;
}