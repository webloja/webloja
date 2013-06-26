<?php

namespace webloja\AdminBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NovaLojaProntuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('prontuario', 'integer',array('read_only'=>true));
        $builder->add('loja', 'text',array('read_only'=>true));
        $builder->add('lojaDestino', 'entity',array('mapped'=>false,'class'=>'WeblojaBundle:Lojas',
            'property'=>'id',
            'empty_value'=>'Selecione',
            'required'=>false,
            'query_builder'=>function(EntityRepository $l){
                    return $l->createQueryBuilder("l")->orderBy("l.id","ASC");
                    
            }));

    }

    public function getName() {
        return 'novaLojaProntuario';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\AdminBundle\Entity\CFUsuario'
        ));
    }

}

?>
