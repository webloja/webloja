<?php

namespace webloja\WeblojaBundle\Repository;
use Doctrine\ORM\EntityRepository;

class CentralRegionalLojaRepository extends EntityRepository{
    
    public function getCentralRegionalLoja($central){
        
        $centralRegionalLoja = "Central_".preg_replace("/[^0-9]/","", $central);
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT crl FROM WeblojaBundle:CentralRegionalLoja crl 
                    WHERE crl.central like :central")
                ->setParameter('central', $centralRegionalLoja);
        
        return $query->getResult();
    } 
    
}

?>
