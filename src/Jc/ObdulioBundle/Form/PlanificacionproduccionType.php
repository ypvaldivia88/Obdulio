<?php

namespace Jc\ObdulioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanificacionproduccionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('enero')->add('febrero')->add('marzo')->add('abril')->add('mayo')->add('junio')->add('julio')->add('agosto')->add('septiembre')->add('octubre')->add('noviembre')->add('diciembre')->add('año')->add('fkProducto')->add('fkUnidad');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\ObdulioBundle\Entity\Planificacionproduccion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jc_obduliobundle_planificacionproduccion';
    }


}
