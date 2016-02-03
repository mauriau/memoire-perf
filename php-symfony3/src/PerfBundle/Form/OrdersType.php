<?php

namespace PerfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderdate', 'date')
            ->add('requireddate', 'date')
            ->add('shippeddate', 'date')
            ->add('status')
            ->add('comments')
            ->add('customernumber')
            ->add('productcode')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PerfBundle\Entity\Orders'
        ));
    }
}
