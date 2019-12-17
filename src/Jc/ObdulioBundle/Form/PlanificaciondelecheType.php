<?php

namespace Jc\ObdulioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class PlanificaciondelecheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('enero')
            ->add('febrero')
            ->add('marzo')
            ->add('abril')
            ->add('mayo')
            ->add('junio')
            ->add('julio')
            ->add('agosto')
            ->add('septiembre')
            ->add('octubre')
            ->add('noviembre')
            ->add('diciembre')
            ->add('anno')
            ->add('fkTermo', 'entity', array(
                'class' => 'Jc\ObdulioBundle\Entity\Termo',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.nombre','ASC');
                },
                'choice_label' => 'getNombre','empty_value'=>"Seleccione un Termo"
            ))
            ->add('save', 'submit', array('label' => ''));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\ObdulioBundle\Entity\Planificaciondeleche'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jc_obduliobundle_planificaciondeleche';
    }


}
