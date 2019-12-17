<?php

namespace Jc\ObdulioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class ProduccionlecheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fecha')
            ->add('valor')
            ->add('factura')
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
            'data_class' => 'Jc\ObdulioBundle\Entity\Produccionleche'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jc_obduliobundle_produccionleche';
    }


}
