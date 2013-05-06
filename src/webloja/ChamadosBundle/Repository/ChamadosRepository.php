<?php

namespace webloja\ChamadosBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ChamadosRepository extends EntityRepository {

    public function getAllProcessos(){
        
        return $this->createQueryBuilder("p")->orderBy("p.descricao","ASC");
    }
    
}