<?php

namespace Jc\ObdulioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class ProduccionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fecha')
            ->add('valor')
            ->add('factura')
            ->add('fkDestino', 'entity', array(
                'class' => 'Jc\ObdulioBundle\Entity\Destino',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.nombre','ASC');
                },
                'choice_label' => 'getNombre','empty_value'=>"Seleccione un Destino"
            ))
            ->add('fkProducto', 'entity', array(
                'class' => 'Jc\ObdulioBundle\Entity\Producto',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.nombre','ASC');
                },
                'choice_label' => 'getNombre','empty_value'=>"Seleccione un Producto"
            ))
            ->add('fkUnidad', 'entity', array(
                'class' => 'Jc\ObdulioBundle\Entity\Unidad',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.nombre','ASC');
                },
                'choice_label' => 'getNombre','empty_value'=>"Seleccione una Unidad"
            ))
            ->add('save', 'submit', array('label' => ''));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\ObdulioBundle\Entity\Produccion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jc_obduliobundle_produccion';
    }


}
