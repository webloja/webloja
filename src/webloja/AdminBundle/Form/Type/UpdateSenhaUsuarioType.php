<?php
namespace webloja\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateSenhaUsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('login','hidden');
        $builder->add('senhaNova','password',array('mapped'=>false));
        $builder->add('senha','password');
        $builder->add('confirmeSenha','password',array('mapped'=>false));

    }

    public function getName() {
        return 'updateSenhaUser';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\WeblojaBundle\Entity\Usuario'
        ));
    }
}

?>
