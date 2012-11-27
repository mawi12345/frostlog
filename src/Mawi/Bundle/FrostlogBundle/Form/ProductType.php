<?php

namespace Mawi\Bundle\FrostlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mawi\Bundle\FrostlogBundle\Entity\Product'
        ));
    }

    public function getName()
    {
        return 'mawi_bundle_frostlogbundle_producttype';
    }
}
