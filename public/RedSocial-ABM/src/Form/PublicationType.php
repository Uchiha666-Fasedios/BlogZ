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


class PublicationType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
        ->add('text', TextareaType::class, array(
            'label' => 'Mensaje', //PUEDO PERSONALIZAR LOS CAMPOS
            'required' => 'required',
            'attr' => array(
                'class' => 'form-control' //le agrego clases al boton btn y btn-success ay q poner attr para q ande
            )
        ))

        ->add('image', FileType::class, array(
            'label' => 'Foto',
            'required' => false,
            'data_class' => null,
            'attr' => array(
                'class' => 'form-control'
                )
        ))
       
        ->add('document', FileType::class, array(
            'label' => 'Document',
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
