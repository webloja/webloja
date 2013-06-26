<?php
namespace webloja\WeblojaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class MenuInternoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
         $builder->add('titulo')
                 ->add('menu', 'entity', array('class' => 'WeblojaBundle:Menu',
                                                    'property' => 'menu',
                                                    'required' => true,
                                                    'empty_value' => 'Selecione o menu...',
                                                    'query_builder' => function(EntityRepository $er) {
                                                        return $er->createQueryBuilder('m')->orderBy('m.menu', 'ASC');
                                                    }))
                 ->add('link')
                 ->add('rota')
                 ->add('ordem', 'integer')
                 ->add('ativo')
                 ->add('permissao', 'choice', array('choices' => array(0 => '0', 1 => '1', 2 => '2')))
                 ->add('pai', 'entity', array('class' => 'WeblojaBundle:MenuInterno',
                                                    'property' => 'titulo',
                                                    'required' => true,
                                                    'group_by' => 'Menu.menu',
                                                    'empty_value' => 'Selecione o menu pai...',
                                                    'query_builder' => function(EntityRepository $er) {
                                                        return $er->createQueryBuilder('m')->orderBy('m.titulo', 'ASC');
                                                    }));
         
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) 
    {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\WeblojaBundle\Entity\MenuInterno'
        ));
    }
    
    public function getName() 
    {
        return 'frmMenuInterno';
    }
}