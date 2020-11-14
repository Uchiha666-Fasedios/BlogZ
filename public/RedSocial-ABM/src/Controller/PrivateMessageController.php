<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RegisterType;
use App\Form\PrivateMessageType;
use Symfony\Component\HttpFoundation\Session\Session;//para usar sesiones
use Symfony\Component\HttpFoundation\Response; //para hacer una resppuesta


use App\Entity\User;//mi entidad de User 
use App\Entity\PrivateMessage;//mi entidad de User 


// Include paginator interface
use Knp\Component\Pager\PaginatorInterface;

class PrivateMessageController extends AbstractController
{

    

    private $session; 
    private $paginator;

    public function __construct(PaginatorInterface $paginator){
        
        $this->paginator = $paginator;//creo el objet de sision q se importo en los use de arriba
        $this->session = new Session();//creo el objet de sision q se importo en los use de arriba
        
    }
    


    public function index(Request $request,PaginatorInterface $paginator)
    {

        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        $user =  $this->getUser();//getUser() me trae el usuario logeado
        
        $private_message = new PrivateMessage();//instancio la entidad
        $form = $this->createForm(PrivateMessageType::class, $private_message, array(
            'empty_data' => $user
        ));//llamo a createForm para crear el formulario pero (TaskType::class, $task) refiriendoce a mi clase de formulario creada
        // Rellenar el objeto con los datos del form
		$form->handleRequest($request);//handleRequest este metodo recoge los datos del formulario y los adjunta al objeto form 
            // Comprobar si el form se ha enviado

            if ($form->isSubmitted()) {
                if ($form->isValid()) {
 //UPLOAD IMAGE
 $file = $form["image"]->getData();

 if (!empty($file) && $file != null) {
     $ext=$file->guessExtension();
     if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
         $file_name = $user->getId(). time() . "." . $ext;
         $file->move("uploads/message/images",$file_name);
         $private_message->setImage($file_name);
     }else{
         $private_message->setImage(null);
     }


 }else{
$private_message->setImage(null);
}


//upload document




$doc = $form["file"]->getData();

if (!empty($doc) && $doc != null) {
 $ext=$doc->guessExtension();
 if ($ext == 'pdf' || $ext == 'docx') {
     $file_name = $user->getId(). time() . "." . $ext;
     $doc->move("uploads/message/documents",$file_name);
     $private_message->setFile($file_name);
 }else{
     $private_message->setFile(null);
 }


}else{
$private_message->setFile(null);
}

$private_message->setEmitter($user);
$private_message->setCreatedAt(new \Datetime('now'));//le seteo la fecha de hoy
$private_message->setReaded(0);

$em->persist($private_message);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
            $flush=$em->flush();//flush guarda en la base de datos
    
            if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso
                $status='El mensaje privado se ha enviado correctamente !!';
            }else{
                $status='El mensaje privado no se ha enviado!!';
            }


                }else{
                    $status='El mensaje privado no se ha enviado';
                }


                $this->session->getFlashBag()->add('status', $status);// add('message', 'Animal creado') le estoy agregando el mensaje 
                return $this->redirectToRoute('private_message');

            }

           
            $private_message=$this->getPrivateMessages($request,$type =null, $paginator);


            $this->setReaded($em ,$user);//esta funcion cambia el estado de los mensages

           

        return $this->render('PrivateMessage/index.html.twig', [ //me voy a esta vista llevandome la variable para mostrarla ahi
            'form' => $form->createView(),//pasandole el formulario .. createView me genera el html para imprimir el formulario
       'pagination' => $private_message
        ]);  
    }

    public function sended(Request $request,PaginatorInterface $paginator)
    {
$private_message=$this->getPrivateMessages($request, 'sended', $paginator);

return $this->render('PrivateMessage/sended.html.twig', [
    "pagination" => $private_message
]);

    }

    public function getPrivateMessages($request, $type =null,PaginatorInterface $paginator)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $user_id=$user->getId();

if ($type == "sended") {
    $dql= "SELECT p FROM App:PrivateMessage p WHERE"
    ." p.emitter = $user_id ORDER BY p.id DESC";
     
    
}else{
    $dql= "SELECT p FROM App:PrivateMessage p WHERE"
    ." p.receiver = $user_id ORDER BY p.id DESC";
}

$query= $em->createQuery($dql);


//$paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
$pagination=$paginator->paginate(
 $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1.. 5 son los registros q se van a mostrar por pagina
 ); 

 


 return $pagination;

    }


    public function notReaded()
    {

       /* $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $private_message_repo = $em->getRepository("BackendBundle:PrivateMessage");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
$count_not_readed_msg = count($private_message_repo->findBy(array(//agarra de private_messages todos los q tengan el campo receiver(q es un id) con id del usuario logeado y readed 0 Y CON count CONTAMOS LOS Q AY

'receiver' => $user,
'readed' => 0

)));

return new Response($count_not_readed_msg);*/




$user =  $this->getUser();//getUser() me trae el usuario logeado
$em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
    
$private_message_repo = $em->getRepository("App:PrivateMessage");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
$private_message = $private_message_repo->findBy(array(//la condicion readed q este en 0 porqe si esta en 1 ya se leyeron las notificaciones
    'receiver' => $this->getUser(),
    'readed' => 0


)); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion





    return new Response(count($private_message));

 

    }


    public function setReaded($em , $user)
    {

        $private_message_repo = $em->getRepository("App:PrivateMessage");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $private_message = $private_message_repo->findBy(array(//la condicion readed q este en 0 porqe si esta en 1 ya se leyeron las notificaciones
            'receiver' => $this->getUser(),
            'readed' => 0
        
        
        )); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion

        
        foreach ($private_message as $msg) {
            $msg->setReaded(1);
            $em->persist($msg);
        }

       $flush = $em->flush();
    
       if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso
        $result=true;
    }else{
        $result=false;
    }

    return $result;
    }


}


