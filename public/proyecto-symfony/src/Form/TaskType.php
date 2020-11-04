<?php
namespace App\Form;//le indico donde esta en app/Form
//user necesarios para definir mi formulario en esta clase
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType{
	
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('title', TextType::class, array(
			'label' => 'Titulo' //PUEDO PERSONALIZAR LOS CAMPOS ACA PERSONALIZO title
		))
		->add('content', TextareaType::class, array(//TextareaType porqe es un textarea
			'label' => 'Contenido'
		))
		->add('priority', ChoiceType::class, array(
			'label' => 'Prioridad',
			'choices' => array(
				'Alta' => 'high',
				'Media' => 'medium',
				'Baja' => 'low'
			)
		))
		->add('hours', TextType::class, array(
			'label' => 'Horas presupuestadas'
		))
		->add('submit', SubmitType::class, array(
			'label' => 'Guardar'
		));
	}
	
}