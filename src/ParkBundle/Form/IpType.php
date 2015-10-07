<?php

namespace ParkBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IpType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ip')
            ->add('description')
            ->add('updatedAt')
            ->add('computer', 'entity', array(
                'class' => 'ParkBundle\Entity\Computer',
                'choice_label' => 'name',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ParkBundle\Entity\Ip'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parkbundle_ip';
    }
}
