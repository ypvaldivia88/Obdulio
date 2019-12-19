<?php

namespace Jc\ObdulioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReporteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reporte', 'choice', array(
                'choices' => array(
                    'general'               => 'General',
                    'operativo'             => 'Operativo',
                    'consejo_popular'       => 'Consejo Popular',
                    'acumulado'             => 'Acumulado',
                    'prod_cultivo'          => 'Prod x Cultivo',
                    'huevo'                 => 'Huevo',
                    'ventas_viandas'        => 'Ventas Viandas',
                    'ventas_hortalizas'     => 'Ventas Hortalizas',
                    'ventas_granos'         => 'Ventas Granos',
                    'ventas_frutas'         => 'Ventas Frutas',
                    'ventas_totales'        => 'Ventas Totales',
                    'ventas_tot_est'        => 'Ventas Totales al Estado',
                    'ventas_tot_est_dia'    => 'Ventas Totales al Estado Diario',
                    'prod_dec_sem5'         => 'Producción Decenal - Semana 5',
                    'prod_dec_sem4'         => 'Producción Decenal - Semana 4',
                    'prod_dec_sem3'         => 'Producción Decenal - Semana 3',
                    'prod_dec_sem2'         => 'Producción Decenal - Semana 2',
                    'prod_dec_sem1'         => 'Producción Decenal - Semana 1',
                    'sust_imp_anual'        => 'Sustitución Importaciones Anual',
                    'sust_imp_mensual'      => 'Sustitución Importaciones Mensual',
                    'ventas_est_plan_real'  => 'Ventas al Estado - Plan Real',
                    'ventas_est_prod_total' => 'Ventas al Estado - Producción Total',
                    'ratificado_mes'        => 'Ratificado Mes',
                    'ratificado_acumulado'  => 'Ratificado Acumulado',
                    'turismo'               => 'Turismo',

                ),
                'required'    => true,
                'empty_value' => 'Filtrar por Reporte',
                'empty_data'  => null
            ))
            ->add('rangofechas', 'text')
            ->add('tipoproducto', 'entity', array(
                'class' => 'JcObdulioBundle:Tipoproducto',
                'property' => 'nombre',
                'required'    => false,
                'empty_value' => 'Filtrar por Tipo de Producto',
                'empty_data'  => null
            ))
            ->add('unidad', 'entity', array(
                'class' => 'JcObdulioBundle:Unidad',
                'property' => 'nombre',
                'required'    => false,
                'empty_value' => 'Filtrar por Unidad',
                'empty_data'  => null
            ))
            ->add('tipounidad', 'entity', array(
                'class' => 'JcObdulioBundle:Tipodeunidad',
                'property' => 'nombre',
                'required'    => false,
                'empty_value' => 'Filtrar por Tipo de Unidad',
                'empty_data'  => null
            ))
            ->add('destino', 'entity', array(
                'class' => 'JcObdulioBundle:Destino',
                'property' => 'nombre',
                'required'    => false,
                'empty_value' => 'Filtrar por Destino',
                'empty_data'  => null
            ));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'message' => 'Formulario Filtro Reportes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jc_obduliobundle_reporte';
    }
}
