<?php
namespace App\Form;//le indico donde esta en app/Form

//user necesarios para definir mi formulario en una clase
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterType extends AbstractType{
	
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('name', TextType::class, array(
			'label' => 'Nombre' //PUEDO PERSONALIZAR LOS CAMPOS
		))
		->add('surname', TextType::class, array(
			'label' => 'Apellidos'
		))
		->add('email', EmailType::class, array(
			'label' => 'Correo electrónico'
		))
		->add('password', PasswordType::class, array(
			'label' => 'Constraseña'
		))
		->add('submit', SubmitType::class, array(
			'label' => 'Registrarse'   //PUEDO PERSONALIZAR LOS CAMPOS ACA PERSONALIZO EL BOTTON .. //le pongo de nombre esto al boton es la parte del value
		));
	}
	
}