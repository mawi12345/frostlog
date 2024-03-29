<?php

namespace Mawi\Bundle\FrostlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StorageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mawi\Bundle\FrostlogBundle\Entity\Storage'
        ));
    }

    public function getName()
    {
        return 'mawi_bundle_frostlogbundle_storagetype';
    }
}
