<?php

namespace webloja\ChamadosBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddLinkOcorrenciaType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add("descricao",'entity',array('class'=>'ChamadosBundle:AberturaChamadoProcesso',
            'property'=>'descricao',
            'empty_value'=>'Selecione',
            'required'=>false,
            'query_builder'=>function(EntityRepository $p){
                    return $p->createQueryBuilder("p")->orderBy("p.descricao","ASC");
                    
            }))
            ->add('modulo','choice',array('empty_value'=>'Selecione',
                'required'=>false))
            ->add('link','choice',array('empty_value'=>'Selecione',
                'required'=>false));
    }
    
    public function getName() {
        return 'addLinkOcorrencia';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\ChamadosBundle\Entity\AberturaChamadoProcesso'
        ));
    }
}

?>
