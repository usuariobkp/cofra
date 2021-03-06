<?php
namespace Framework\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Framework\GeneralBundle\Form\Type\ComboPartidoType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DireccionIndustrialType extends AbstractType {

	public function buildForm(FormBuilder $builder, array $options) {
		
						$builder
						    ->add('ruta',null,array( 'required'    => false))
							->add('km',null,array( 'required'    => false))
							//->add('calleinterna')
							->add('parcela',null,array( 'required'    => false))
							->add('lote',null,array( 'required'    => false))
	;
				
	}
		public function getName()
	{
		return 'dirIndustrial';
	}
	public function setDefaultOptions(OptionsResolverInterface $options)
    {
        return array(
            'data_class' => 'Framework\GeneralBundle\Entity\Direccion\DireccionIndustrial',
        );
    }
}
?>
