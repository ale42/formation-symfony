<?php

namespace ParkBundle\Form;

use Doctrine\ORM\EntityRepository;
use ParkBundle\Entity\IpRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComputerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('ip', 'entity', array(
                'class' => 'ParkBundle\Entity\Ip',
                'choice_label' => 'ip',
                'query_builder' => function(IpRepository $repo){
                    return $repo->getUnaffectedIps();
                }
            ))
            ->add('enabled', 'checkbox',array(
                    'required'=>false
            ))
            ->add('person', 'entity', array(
                'class' => 'ParkBundle\Entity\Person',
                'choice_label' => 'firstname',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ParkBundle\Entity\Computer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parkbundle_computer';
    }
}
