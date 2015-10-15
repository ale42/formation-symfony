<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('plainPassword')
            ->add('name')
            ->add('firstname')
            ->add('roles', 'choice', array(
                    'choices' => array(
                        'ROLE_USER' => 'user',
                        'ROLE_ADMIN' => 'admin',
                        'ROLE_MODERATOR' => 'modo',
                        'ROLE_SUPER_ADMIN' => 'superadmin'
                    ),
                    'required' => true,
                    'multiple' => true,
                    'expanded' =>false
                )
            )
            ->add('enabled', 'checkbox',array(
                'required'=>false
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_user';
    }
}
