<?php
namespace webloja\WeblojaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
         $builder->add('menu')
                 ->add('departamento', 'entity', array('class' => 'WeblojaBundle:MenuDepartamento',
                                                    'property' => 'departamento',
                                                    'required' => true,
                                                    'empty_value' => 'Selecione o departamento...',
                                                    'query_builder' => function(EntityRepository $er) {
                                                        return $er->createQueryBuilder('d')->orderBy('d.departamento', 'ASC');
                                                    }))
                 ->add('ordem')
                 ->add('ativo','checkbox', array('label' => 'Ativo', 'required'  => false));
         
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\WeblojaBundle\Entity\Menu'
        ));
    }
    
    public function getName() 
    {
        return 'frmMenu';
    }
}