<<<<<<< HEAD
<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perfil
 *
 * @ORM\Table("lasasap.perfil")
 * @ORM\Entity(repositoryClass="webloja\WeblojaBundle\Repository\UsuarioRepository")

 */
class Perfil
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_perfil", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="perfil", type="string", length=45)
     */
    private $perfil;


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
     * Set perfil
     *
     * @param string $perfil
     * @return Perfil
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    
        return $this;
    }

    /**
     * Get perfil
     *
     * @return string 
     */
    public function getPerfil()
    {
        return $this->perfil;
    }
    
=======
<?php

namespace webloja\WeblojaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perfil
 *
 * @ORM\Table("lasasap.perfil")
 * @ORM\Entity(repositoryClass="webloja\WeblojaBundle\Repository\UsuarioRepository")

 */
class Perfil
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_perfil", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="perfil", type="string", length=45)
     */
    private $perfil;


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
     * Set perfil
     *
     * @param string $perfil
     * @return Perfil
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    
        return $this;
    }

    /**
     * Get perfil
     *
     * @return string 
     */
    public function getPerfil()
    {
        return $this->perfil;
    }
    
>>>>>>> 937b52f6b832f19aba09fde6e02f412238dfdf30
}