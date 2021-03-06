<?php

namespace Magyp\RendicionDeCajaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FondoRotatorioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('expediente')
            ->add('nota')
            ->add('beneficiario')
            ->add('motivo','textarea')
            ->add('area',null,array('query_builder' => function(\Doctrine\ORM\EntityRepository $er) { return $er->qb_destino();}))
            ->add('programa')
            ->add('actividad')
            ->add('fuentefinanciamiento')
            ->add('ug')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Magyp\RendicionDeCajaBundle\Entity\FondoRotatorio'
        ));
    }

    public function getName()
    {
        return 'magyp_rendiciondecajabundle_fondorotatoriotype';
    }
}
