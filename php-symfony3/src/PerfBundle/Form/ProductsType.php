<?php

namespace PerfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productname')
            ->add('productscale')
            ->add('productvendor')
            ->add('productdescription')
            ->add('quantityinstock')
            ->add('buyprice')
            ->add('msrp')
            ->add('productline')
            ->add('ordernumber')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PerfBundle\Entity\Products'
        ));
    }
}
