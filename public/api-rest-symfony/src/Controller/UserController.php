<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Entity\Video;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; //para hacer una resppuesta
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Email;
use App\Services\JwtAuth;

class UserController extends AbstractController
{


    private function resjson($data){
        /*serializar datos con servicio serializer */
$json=$this->get('serializer')->serialize($data, 'json');

        /*response con httpfundations */
$response=new Response();


//asignar contenido a la respuesta
$response->setContent($json);
//indicar formato de respuesta
$response->headers->set('Content-Type', 'application/json');
//devolver la respuesta
return $response;
    }
    
    public function index()
    {

        $user_repo = $this->getDoctrine()->getRepository(User::Class);
        $video_repo = $this->getDoctrine()->getRepository(Video::Class);

        	$users = $user_repo->findAll();
            $user = $user_repo->find(1);
            $videos = $video_repo->findAll();
        	

/*foreach ($users as $user) {
   echo "<h1>{$user->getName()} {$user->getSurname()}</h1>";
}

foreach ($user->getVideos() as $video) {
  echo  "<h1>{$video->getTitle()}</h1> - {$video->getUser()->getEmail()}";
}*/


return $this->resjson($videos);

die();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

    public function create(Request $request)
    {
//recoge los datos por post
$json =$request->get('json', null);
//decodificar el json
$params= json_decode($json); 
//respuesta por defecto
$data =[
    'status' => 'error',
    'code' => 200,
    'message' => 'El usuario no se ha creado.'
];



//comprobar y validar datos
if ($json != null) {
    $name =(!empty($params->name)) ? $params->name : null;
    $surname =(!empty($params->surname)) ? $params->surname : null;
    $email =(!empty($params->email)) ? $params->email : null;
    $password= (!empty($params->password)) ? $params->password : null;

    $validator = Validation::createValidator();
    $validate_email = $validator->validate($email, [
new Email()
    ]);


    if (!empty($email) && count($validate_email) == 0 && !empty($password) && !empty($name) && !empty($surname)) {
        $data =[
            'status' => 'success',
            'code' => 200,
            'message' => 'Validacion correcta.'
        ];

        //si la validacion es correcta, crear el objeto del usuario
$user = new User();
$user->setName($name);
$user->setSurname($surname);
$user->setEmail($email);
$user->setRole('ROLE_USER');
$user->setCreatedAt(new \Datetime('now'));

//cifrar contraseña
$pwd=hash('sha256', $password);
$user->setPassword($pwd);

$data = $user;
//comprobar si hay usuario dupicado
$doctrine = $this->getDoctrine();
$em =  $doctrine->getManager();

$user_repo = $doctrine->getRepository(User::Class);

$isset_user =  $user_repo->findBy(array(
    'email' => $email

));

if (count($isset_user) == 0) {

    // Guardar usuario
			
			$em->persist($user);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
			$em->flush();//flush guarda en la base de datos

    $data =[
        'status' => 'success',
        'code' => 200,
        'message' => 'Usuario creado correctamente.',
        'user' => $user
    ];
}else{
    $data =[
        'status' => 'error',
        'code' => 400,
        'message' => 'El usuario ya existe.'
    ];
}

//si no existe lo guardo
    }
}
    




//hacer respuesta en json
//return new JsonResponse($data); asi tambien funciona
return  $this->resjson($data);
    }


    public function login(Request $request, JwtAuth $jwt_auth){

//recoge los datos por post
$json =$request->get('json', null);
//decodificar el json
$params= json_decode($json);

        $data =[
            'status' => 'error',
            'code' => 200,
            'message' => 'El usuario no se ha podido identificar.'
        ];


if ($json != null) {
    $email =(!empty($params->email)) ? $params->email : null;

    $gettoken =(!empty($params->gettoken)) ? $params->gettoken : null;
    $password= (!empty($params->password)) ? $params->password : null;

    $validator = Validation::createValidator();
    $validate_email = $validator->validate($email, [
new Email()
    ]);

    if (!empty($email) && count($validate_email) == 0 && !empty($password)) {

//cifrar contraseña
$pwd=hash('sha256', $password);


if ($gettoken) {
    $signup = $jwt_auth->signup($email,$pwd,$gettoken);
}else {
    $signup = $jwt_auth->signup($email,$pwd);
}
return new JsonResponse($signup);

       
}


}



        return  $this->resjson($data);


    }



public function edit(Request $request ,JwtAuth $jwt_auth){


$token=$request->headers->get('Authorization');

$authCheck=$jwt_auth->checkToken($token);


$data =[
    'status' => 'error',
    'code' => 400,
    'message' => 'Usuario no actualizado'
    
];



if ($authCheck) {
    
    $em =  $this->getDoctrine()->getManager();



   $identity=$jwt_auth->checkToken($token,true);

   $user_repo = $this->getDoctrine()->getRepository(User::Class);


   $user = $user_repo->findOneBy([
       'id' => $identity->sub
   ]);


   $json = $request->get('json', null);
   $params= json_decode($json);

if (!empty($json)) {

//comprobar y validar datos

    $name =(!empty($params->name)) ? $params->name : null;
    $surname =(!empty($params->surname)) ? $params->surname : null;
    $email =(!empty($params->email)) ? $params->email : null;
    

    $validator = Validation::createValidator();
    $validate_email = $validator->validate($email, [
new Email()
    ]);


    if (!empty($email) && count($validate_email) == 0 && !empty($name) && !empty($surname)) {
        $user->setName($name);
        $user->setSurname($surname);
        $user->setEmail($email);
        $isset_user =  $user_repo->findBy(array(
            'email' => $email
        
        ));


if (count($isset_user) == 0 || $identity->email == $email) {
    $em->persist($user);
    $em->flush();

    $data =[
        'status' => 'success',
        'code' => 200,
        'message' => 'Usuario actualizado',
        'user' => $user
        
    ];


}else{
    $data =[
        'status' => 'success',
        'code' => 200,
        'message' => 'No puedes usar ese email'
        
        
    ];
}




}


    
}



//var_dump($identity);
//die();

}




   



    return  $this->resjson($data);
}



}
