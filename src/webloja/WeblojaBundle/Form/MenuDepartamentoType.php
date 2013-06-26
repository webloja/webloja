<?php

namespace webloja\WeblojaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class MenuDepartamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
         $builder->add('departamento')
                 ->add('ordem')
                 ->add('ativo','checkbox', array('label' => 'Ativo', 'required'  => false));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\WeblojaBundle\Entity\MenuDepartamento'
        ));
    }
    
    public function getName() 
    {
        return 'frmMenuDepartamento';
    }
}