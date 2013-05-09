<?php

namespace webloja\AdminBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddNewUserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('nome', 'text');
        $builder->add('login','text');
        $builder->add('senha','password');
        $builder->add('confirmeSenha','password');
        $builder->add("idPerfil",'entity',array('class'=>'WeblojaBundle:Perfil',
            'property'=>'perfil',
            'empty_value'=>'Selecione',
            'required'=>false,
            'query_builder'=>function(EntityRepository $p){
                    return $p->createQueryBuilder("p")->orderBy("p.perfil","ASC");         
            }));
    }

    public function getName() {
        return 'addNewUser';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\WeblojaBundle\Entity\Usuario'
        ));
    }

}