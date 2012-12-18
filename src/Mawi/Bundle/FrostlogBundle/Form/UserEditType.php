<?php

namespace Mawi\Bundle\FrostlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password1', 'password', array(
                'property_path' => false,
            ))
            ->add('password2', 'password', array(
                'property_path' => false,
            ))
            ->add('email')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mawi\Bundle\FrostlogBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'mawi_bundle_frostlogbundle_useredittype';
    }
}
