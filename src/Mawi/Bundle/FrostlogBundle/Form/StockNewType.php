<?php

namespace Mawi\Bundle\FrostlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StockNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('product', null, array(
        		'required' => true,
        	))
            ->add('arrival', 'date', array(
			    'widget' => 'single_text',
			))
            ->add('quantity')
            ->add('storage')
            ->add('count', 'integer', array(
                'property_path' => false,
                'data' => 1,
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mawi\Bundle\FrostlogBundle\Entity\Stock'
        ));
    }

    public function getName()
    {
        return 'mawi_bundle_frostlogbundle_stocknewtype';
    }
}
