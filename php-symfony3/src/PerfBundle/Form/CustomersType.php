<?php

namespace PerfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customername')
            ->add('contactlastname')
            ->add('contactfirstname')
            ->add('phone')
            ->add('addressline1')
            ->add('addressline2')
            ->add('city')
            ->add('state')
            ->add('postalcode')
            ->add('country')
            ->add('creditlimit')
            ->add('salesrepemployeenumber')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PerfBundle\Entity\Customers'
        ));
    }
}
