<?php
 namespace webloja\WeblojaBundle\Repository;
 
use Doctrine\ORM\EntityRepository;
 
class UsuarioRepository extends EntityRepository {
    
    public function getUsuarioSenha($login,$senha){
        $ativo = 1;
        $query = $this->getEntityManager()
                ->createQuery('SELECT u FROM WeblojaBundle:Usuario u WHERE u.login = :login and u.senha = :senha and u.ativo = :ativo')
                ->setParameter('login',$login)
                ->setParameter('senha',$senha)
                ->setParameter('ativo',$ativo);

        return $query->getSingleResult();
      
    }
    
}

