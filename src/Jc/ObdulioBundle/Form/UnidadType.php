<?php

namespace Jc\ObdulioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnidadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
            ->add('fkTipodeunidad', 'entity', array(
                'class' => 'Jc\ObdulioBundle\Entity\Tipodeunidad',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.nombre','ASC');
                },
                'choice_label' => 'getNombre','empty_value'=>"Seleccione un Tipo de unidad"
            ))
            ->add('save', 'submit', array('label' => ''));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\ObdulioBundle\Entity\Unidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jc_obduliobundle_unidad';
    }


}
