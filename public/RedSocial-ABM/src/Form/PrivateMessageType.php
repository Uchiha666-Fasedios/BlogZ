<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//user necesarios para definir mi formulario en una clase

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;//este es typo select del formulario para seleccionar cosas


class PrivateMessageType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
$user=$options['empty_data'];//lo recibe del controlador q es el objeto user

        $builder
        ->add('receiver', EntityType::class, array( //este input es de typo select 
            'class' => 'App:User', //aca pongo de donde voy a seleccionar en estecaso porqe voy a usar una query para sacar los usuarios  .. si no le pongo lo q yo quiera.. 
            'query_builder' => function($er) use($user){//vamos a hacer na queryBuilder.. va recibir el repositorio y el usuario
             return $er->getFollowingUsers($user);//llamo al repository q cree 
            },
            'choice_label' => function($user){//va ser de typo choice y va recibir un objeto user
            return $user->getName()." ".$user->getSurname()." - ".$user->getNick();// y se va mostrar de esta forma
            },
            'label' => 'Para:',
            'attr' => array('class' => 'form-control')//y va tener esta clase el input
        ))
        ->add('message', TextareaType::class, array(
            'label' => 'Mensaje', //PUEDO PERSONALIZAR LOS CAMPOS
            'required' => 'required',
            'attr' => array(
                'class' => 'form-control' //le agrego clases al boton btn y btn-success ay q poner attr para q ande
            )
        ))

        ->add('image', FileType::class, array(
            'label' => 'Imagen',
            'required' => false,
            'data_class' => null,
            'attr' => array(
                'class' => 'form-control'
                )
        ))
       
        ->add('file', FileType::class, array(
            'label' => 'Archivo',
            'required' => false,
            'data_class' => null,
            'attr' => array(
                'class' => 'form-control'
                )
        ))

        ->add('Enviar', SubmitType::class, array(
            'attr' => array(
                'class' => 'btn btn-success' //le agrego clases al boton btn y btn-success ay q poner attr para q ande
            ) 
        ));

  
    }
    
    
    
   

    
    

    
	
        
    
}
