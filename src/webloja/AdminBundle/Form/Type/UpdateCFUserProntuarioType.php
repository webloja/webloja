<?php

namespace webloja\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateCFUserProntuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('prontuario', 'integer');
        $builder->add('senha', 'password');
        $builder->add('senhaNova', 'password',array('mapped' => false));
        $builder->add('confirmeSenha', 'password',array('mapped' => false));
    }

    public function getName() {
        return 'updateCFUserProntuario';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\AdminBundle\Entity\CFUsuario'
        ));
    }

}

?>
