<?php

namespace webloja\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateLojaProntuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('prontuario', 'integer');

    }

    public function getName() {
        return 'updateLojaProntuario';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'webloja\AdminBundle\Entity\CFUsuario'
        ));
    }

}

?>
