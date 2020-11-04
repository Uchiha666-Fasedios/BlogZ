<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;//mi entidad de User
use App\Form\RegisterType;//me traigo el formulario vreado
use Symfony\Component\HttpFoundation\Request;//para poder resibir datos por post
use Symfony\Component\HttpFoundation\Response;//para hacer una resppuesta
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;//me permite acceder al encoder q creamos en config/packages/security.yaml
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;//las utilidades de autenticacion

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)//le paso de parametro el encoder creado en config/packages/security.yaml
    {
		// Crear formulario
		$user = new User();
		$form = $this->createForm(RegisterType::class, $user);//llamo a createForm para crear el formulario pero (RegisterType::class, $user) refiriendoce a mi clase de formulario creada
		
		// Rellenar el objeto con los datos del form
		$form->handleRequest($request);//handleRequest este metodo recoge los datos del formulario y los adjunta al objeto form
		
		// Comprobar si el form se ha enviado
		if($form->isSubmitted() && $form->isValid()){//si se toco el boton del formlario creado.. isValid es propio de symfony significa q cuando el formulario es valido va a hacer todo lo q sigue
			// Modificando el objeto para guardarlo
			$user->setRole('ROLE_USER');//le seteo el campo role poniendole ROLE_USER por defecto
			$user->setCreatedAt(new \Datetime('now'));//le seteo la fecha de hoy
			
			// Cifrar contraseña
			$encoded = $encoder->encodePassword($user, $user->getPassword());//encodePassword metodo para usar el encoder.. user le estoy diciendo sobre q objeto quiero actuar q es donde esta la password
            //getPassword me genera la contraseña
            $user->setPassword($encoded);//le meto la contraseña cifrada la seteo al modelo
			
			// Guardar usuario
			$em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
			$em->persist($user);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
			$em->flush();//flush guarda en la base de datos
			
			return $this->redirectToRoute('tasks');
		}
		
        return $this->render('user/register.html.twig', [
			'form' => $form->createView()//pasandole el formulario .. createView me genera el html para imprimir el formulario
        ]);
    }

	public function login(AuthenticationUtils $autenticationUtils){//autenticationUtils la libreria de symfony
		$error = $autenticationUtils->getLastAuthenticationError();//getLastAuthenticationError me saca el error 
		
		$lastUsername = $autenticationUtils->getLastUsername();
		
		return $this->render('user/login.html.twig', array(
			'error' => $error,
			'last_username' => $lastUsername
		));
	}
}
