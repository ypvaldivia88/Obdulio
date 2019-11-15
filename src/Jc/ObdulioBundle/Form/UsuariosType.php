<?php

namespace Jc\ObdulioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class UsuariosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
       $builder
            ->add('username')
            ->add('password', 'password')
            ->add('role', 'choice', array('choices'=>array(
                'ROLE_ADMINISTRADOR'=>'Administrador', 
                'ROLE_OPERADOR'=>'Operador',
                'ROLE_CONSULTANTE'=>'Consultante'))) 

            ->add('isActive', 'checkbox')
            ->add('nombreCompleto')
            /*->add('old_nombre', 'hidden', array(
               'mapped' => false,
               'attr' => array('class' => 'form-control'),
               'data' => 0, 
            ))*/
            ->add('avatar', 'file', array(
                "data_class" => null
            ))
            /*->add('old_avatar', 'hidden', array(
               'mapped' => false,
               'attr' => array('class' => 'form-control'),
               'data' => 0, 
            ))*/
            ->add('save', 'submit', array('label' => ''))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\ObdulioBundle\Entity\Usuarios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}
