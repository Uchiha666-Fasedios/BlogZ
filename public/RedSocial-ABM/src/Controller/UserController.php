<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;//me permite acceder al encoder q creamos en config/packages/security.yaml

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;//mi entidad de User
use App\Form\RegisterType;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;//para usar sesiones
use Symfony\Component\HttpFoundation\Response; //para hacer una resppuesta
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;//las utilidades de autenticacion


//use App\Entity\Appointments;

// Include paginator interface
use Knp\Component\Pager\PaginatorInterface;

class UserController extends AbstractController
{

    private $session;
    public function __construct(){

        $this->session = new Session();//creo el objet de sision q se importo en los use de arriba

    }


    /*public function login()
    {
        return $this->render('User/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }*/


    public function login(AuthenticationUtils $autenticationUtils)
    {

if (is_object($this->getUser())) {//getUser si este metodo q esta en el controlador base nos devuelve un objeto (significa q el usuario esta logeado)
    return $this->redirect('home');
}

        //$authenticationUtils=$this->get('security.authentication_utils');//llamamos al servicio de autenticacion metodo echo por symfony


        $error = $autenticationUtils->getLastAuthenticationError();//getLastAuthenticationError me saca el error

		$lastUsername = $autenticationUtils->getLastUsername();


        return $this->render('User/login.html.twig', Array( //me voy a esta vista llevandome la variable para mostrarla ahi
            'error' => $error,
			'last_username' => $lastUsername
        ));




    }


    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {

        /*if (is_object($this->getUser())) {//getUser si este metodo q esta en el controlador base nos devuelve un objeto (significa q el usuario esta logeado)
            return $this->redirect('home');
        }*/



        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);//llamo a createForm para crear el formulario pero (TaskType::class, $task) refiriendoce a mi clase de formulario creada
        // Rellenar el objeto con los datos del form
		$form->handleRequest($request);//handleRequest este metodo recoge los datos del formulario y los adjunta al objeto form
            // Comprobar si el form se ha enviado

		if($form->isSubmitted()){//si se toco el boton del formlario creado.. isValid es propio de symfony significa q cuando el formulario es valido va a hacer todo lo q sigue
            $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
            $query= $em->createQuery('SELECT u FROM App:User u WHERE u.email = :email OR u.nick = :nick')
               ->setParameter('email', $form->get("email")->getData())//$form->get("email") concigo del formulario el email getData no concige en limpio el dato q nos va llegando
               ->setParameter('nick', $form->get("nick")->getData());
$user_isset=$query->getResult();

if (count($user_isset) == 0) {

			// Cifrar contraseña
			$encoded = $encoder->encodePassword($user, $user->getPassword());//encodePassword metodo para usar el encoder.. user le estoy diciendo sobre q objeto quiero actuar q es donde esta la password
            //getPassword me genera la contraseña
            $user->setPassword($encoded);//le meto la contraseña cifrada la seteo al modelo

            // Cifrar contraseña

			//$factory = $this->get('security.encoder_factory');//security.encoder_factory es un servicio q tiene symfony
           // $encoder=$factory->getEncoder($user);

           //$password=$encoder->encodePassword($form->get("password")->getData(), $user->getSalt()); //$user->getSalt() este me retorna un null
           $user->setRole('ROLE_USER');//le seteo el campo role poniendole ROLE_USER por defecto
           //$user->setCreatedAt(new \Datetime('now'));//le seteo la fecha de hoy
           //$user->setPassword($password);//le meto la contraseña cifrada la seteo al modelo
           $user->setImage(null);

             // Guardar usuario

			$em->persist($user);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
			$em->flush();//flush guarda en la base de datos


            $status='Te has registrado correctamente';


			$this->session->getFlashBag()->add('status', $status);// add('message', 'Animal creado') le estoy agregando el mensaje

			return $this->redirectToRoute('login');

        }else{

$status='El usuario ya existe';
//$this->session->getFlashBag()->add('status', $status);// add('message', 'Animal creado') le estoy agregando el mensaje

}

}else{
    $status="";

}

if ($status) {
    $this->session->getFlashBag()->add('status', $status);// add('message', 'Animal creado') le estoy agregando el mensaje

}








        return $this->render('User/register.html.twig', Array( //me voy a esta vista llevandome la variable para mostrarla ahi
            'form' => $form->createView()//pasandole el formulario .. createView me genera el html para imprimir el formulario
        ));


    }







    public function nickTest(Request $request)
    {

$nick=$request->get("nick");
$em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
$user_repo = $em->getRepository("App:User");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio

$user_isset = $user_repo->findOneBy(array('nick' => $nick)); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion




$result="used";
if (!empty($user_isset) && is_object($user_isset)) {//COUNT()SE REMPLAZO POR EMPTY() Advertencia de PHP 7.2: count (): El parámetro debe ser una matriz o un objeto que implemente Countable
    $result="used";
}else{
    $result="unused";
}

return new Response($result);


    }



    public function editUser(Request $request){

        $user =  $this->getUser();//getUser() me trae el usuario logeado
        $file_user =  $user->getImage();
        $form = $this->createForm(UserType::class, $user);//llamo a createForm para crear el formulario pero (TaskType::class, $task) refiriendoce a mi clase de formulario creada
        // Rellenar el objeto con los datos del form
		$form->handleRequest($request);//handleRequest este metodo recoge los datos del formulario y los adjunta al objeto form
            // Comprobar si el form se ha enviado
            if($form->isSubmitted() && $form->isValid()){//si se toco el boton del formlario creado.. isValid es propio de symfony significa q cuando el formulario es valido va a hacer todo lo q sigue
                $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
                $query= $em->createQuery('SELECT u FROM App:User u WHERE u.email = :email OR u.nick = :nick')
                   ->setParameter('email', $form->get("email")->getData())//$form->get("email") concigo del formulario el email getData no concige en limpio el dato q nos va llegando
                   ->setParameter('nick', $form->get("nick")->getData());
    $user_isset=$query->getResult();
    //[0] le tengo q poner eso porqe parece q lo toma como array dice victor
    //count($user_isset) == 0 ..si es igual a 0 es porqe no ay un email de la base de datos q no sea igual al q llega o un nicke
        if (count($user_isset) == 0 || ($user->getEmail() == $user_isset[0]->getEmail() && $user->getNick() == $user_isset[0]->getNick())){



               $file = $form["image"]->getData();



               if (!empty($file) && $file != null) {
   $ext=$file->guessExtension();

if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
    $file_name = $user->getId(). time() . "." . $ext;

$file->move("uploads/users",$file_name);
$user->setImage($file_name);

}


                }else {
  $user->setImage($file_user);
                  }


               //$user->setImage(null);

                 // Guardar usuario

                $em->persist($user);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
                $em->flush();//flush guarda en la base de datos


                $status='has modificado tus datos correctamente';


            }else{

    $status='El usuario ya existe';
    //$this->session->getFlashBag()->add('status', $status);// add('message', 'Animal creado') le estoy agregando el mensaje

    }

    }else{
        $status="";

    }

    if ($status) {
        $this->session->getFlashBag()->add('status', $status);// add('message', 'Animal creado') le estoy agregando el mensaje
        return $this->redirect('my-data');
    }



        return $this->render('User/edit_user.html.twig', Array( //me voy a esta vista llevandome la variable para mostrarla ahi
            'form' => $form->createView()//pasandole el formulario .. createView me genera el html para imprimir el formulario
        ));
    }


    //ACCION PARA LA PAGINACION
public function users(Request $request, PaginatorInterface $paginator){
    $em = $this->getDoctrine()->getManager();
    $dql= 'SELECT u FROM App:User u ORDER BY u.id ASC';
    $query= $em->createQuery($dql);
   //$paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
   $pagination=$paginator->paginate(
    $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1.. 5 son los registros q se van a mostrar por pagina
    );




    return $this->render('User/users.html.twig', array(
        "pagination" => $pagination
));




}



public function search(Request $request, PaginatorInterface $paginator){
    $em = $this->getDoctrine()->getManager();

$search=trim($request->query->get("search",null));//se recoge lo q llega trim(): Elimina los espacios en blanco u otros caracteres al inicio y final de una cadena.

if($search == null){
    return $this->redirect($this->generateURL('home_publications'));
}

//funcion explode() para cortar string
$searched = explode(" ", $search);
//consulta para nombre y apellido ejmplo.. adrian lisciotti
if (count($searched) >1) { //es q puso dos palabras
   //cambiamos los parametros para la consulta $dql
   $parametros = (array(
    'search' => "%$searched[0]%", //para buscar nombre
    'searchap' => "%$searched[1]%", //para buscar apellido
   ));

   $dql= "SELECT u FROM App:User u "
    . " WHERE u.name LIKE :search AND u.surname LIKE :searchap "
    . " ORDER BY u.id ASC";
    $query= $em->createQuery($dql)->setParameters($parametros);
}

//CONSULTA PARA BUSQEDA YA SEA PARA NOMBRE APELLIDO O NICK
if (count($searched) ==1) {//es q puso una palabra
    //cambiamos los parametros para la consulta $dql
    $parametros = (array(
        'search' => "%$searched[0]%"
    ));

    $dql= "SELECT u FROM App:User u "
    . " WHERE u.name LIKE :search OR u.surname LIKE :search "
    . " OR u.nick LIKE :search ORDER BY u.id ASC";
    $query= $em->createQuery($dql)->setParameters($parametros);//dentro de este parametro search vas a buscar lo q tenga la variable search por delante y por detras
    //$query= $em->createQuery($dql)->setParameter('search',"%$search%");//dentro de este parametro search vas a buscar lo q tenga la variable search por delante y por detras
}


   //$paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
   $pagination=$paginator->paginate(
    $query,$request->query->getInt('page',1),5  //5 son los registros q se van a mostrar por pagina
    );

if ($pagination) {
    return $this->render('User/users.html.twig', array(
        "pagination" => $pagination
));
}else{
    return $this->redirect($this->generateURL('home_publications'));

}







}



public function profile( Request $request, $nickname=null,PaginatorInterface $paginator){

    $em = $this->getDoctrine()->getManager();

    if ($nickname != null) {

        $user_repo = $em->getRepository(User::Class);//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio

    $user = $user_repo->findOneBy(array('nick' => $nickname)); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion



    }else{
    $user = $this->getUser();

    }

    if (empty($user) || !is_object($user)) {
        return $this->redirect($this->generateUrl('home_publications'));
    }


    $user_id=$user->getId();

    $dql= "SELECT p FROM App:Publication p WHERE p.user = $user_id ORDER BY p.id DESC"; //para q me tome $user_id ay q poner comillas dobles ""
        $query= $em->createQuery($dql);
       //$paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
       $pagination=$paginator->paginate(
        $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1.. 5 son los registros q se van a mostrar por pagina
        );




        return $this->render('User/profile.html.twig', [
            'user' => $user,
            "pagination" => $pagination
        ]);


    }


}
