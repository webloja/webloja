<?php

namespace webloja\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddCFUserProntuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('prontuario', 'integer');
        $builder->add('nome', 'text',array('mapped'=>false));
        $builder->add('loja', 'hidden');
        $builder->add('senha', 'password');
        $builder->add('confirmeSenha', 'password',array('mapped' => false));
    }

    public function getName() {
        return 'addCFUserProntuario';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\AdminBundle\Entity\CFUsuario'
        ));
    }

}

?>
