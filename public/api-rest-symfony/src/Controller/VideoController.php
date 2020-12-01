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
use Knp\Component\Pager\PaginatorInterface;




class VideoController extends AbstractController
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
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/VideoController.php',
        ]);
    }


public function create(Request $request,JwtAuth $jwt_auth, $id=null){

    $data =[
        'status' => 'error',
        'code' => 400,
        'message' => 'El video no ha podido crearce.'
    ];

    $token=$request->headers->get('Authorization');

    $authCheck=$jwt_auth->checkToken($token);

if ($authCheck) {
    $json= $request->get('json',null);
    $params=json_decode($json);

    $identity=$jwt_auth->checkToken($token,true);

if (!empty($json)) {
   
$user_id = ($identity->sub != null) ? $identity->sub : null;
$title = (!empty($params->title)) ? $params->title : null;
$description = (!empty($params->description)) ? $params->description : null;
$url= (!empty($params->url)) ? $params->url : null;


if (!empty($user_id) && !empty($title)) {
    $em =  $this->getDoctrine()->getManager();
    $user= $this->getDoctrine()->getRepository(User::Class)->findOneBy(array(
        'id' => $user_id
    
    ));


if ($id == null) {

    $video=new Video();
    $video->setUser($user);
    $video->setDescription($description);
    $video->setTitle($title);
    $video->setUrl($url);
    $video->setStatus('normal');

    $createdAt = new \Datetime('now');
    $updatedAt = new \Datetime('now');

    $video->setCreatedAt($createdAt);
    $video->setUpdatedAt($updatedAt);

    $em->persist($video);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
    $em->flush();//flush guarda en la base de datos

$data =[
'status' => 'success',
'code' => 200,
'message' => 'Usuario video se ha guardado.',
'video' => $video
];
    
}else{
    $video = $this->getDoctrine()->getRepository(Video::Class)->findOneBy([
       
        'id' => $id,
        'user' => $identity->sub

    ]);
      
    if ($video && is_object($video)) {
        $video->setDescription($description);
        $video->setTitle($title);
        $video->setUrl($url);
        
        $updatedAt = new \Datetime('now');
        $video->setUpdatedAt($updatedAt);

        $em->persist($video);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
        $em->flush();//flush guarda en la base de datos

        $data =[
            'status' => 'success',
            'code' => 200,
            'message' => 'Usuario video se ha actualizado.',
            'video' => $video
            ];
    }
    
}

}

}

}
   



    return  $this->resjson($data);
}

public function videos(Request $request, JwtAuth $jwt_auth,PaginatorInterface $paginator){


    $token=$request->headers->get('Authorization');

    //comprobar el token
    $authCheck=$jwt_auth->checkToken($token);

if($authCheck) {

    $identity=$jwt_auth->checkToken($token,true);

    $em = $this->getDoctrine()->getManager();

    $dql= "SELECT v FROM App:Video v WHERE v.user = {$identity->sub} ORDER BY v.id DESC";
    $query= $em->createQuery($dql);
   
    //recoge el parametro page de la url
   $page=$request->query->getInt('page',1);
   $item_por_page=5;
   
   $pagination=$paginator->paginate($query,$page,$item_por_page); 
$total=$pagination->getTotalItemCount();
    

    $data =array(
        'status' => 'success',
        'code' => 200,
        'total_items_count' => $total,
        'page_actual' => $page,
        'item_por_page' => $item_por_page,
        'total_page' => ceil($total / $item_por_page),
        'videos' => $pagination,
        'user_id' => $identity->sub
    );

}else{

    $data =[
        'status' => 'error',
        'code' => 404,
        'message' => 'No se pueden listar los videos en este momento'
        
        ];
}


        return  $this->resjson($data);

}


public function video(Request $request, JwtAuth $jwt_auth, $id = null) {


    $token=$request->headers->get('Authorization');

    //comprobar el token
    $authCheck=$jwt_auth->checkToken($token, true);


    $data =[
        'status' => 'error',
        'code' => 404,
        'message' => 'Video no encontrado'
        
        
        ];



    if($authCheck) {

        $identity=$jwt_auth->checkToken($token,true);
    
        $video= $this->getDoctrine()->getRepository(Video::Class)->findOneBy(array(
            'id' => $id
            //'user' => $identity->sub
        
        ));

if ($video && is_object($video) && $identity->sub == $video->getUser()->getId()) {

    $data =[
        'status' => 'success',
        'code' => 200,
        'video' => $video
        ];
}



    }

       

        return  $this->resjson($data);

}



public function remove(Request $request, JwtAuth $jwt_auth, $id = null) {


    $token=$request->headers->get('Authorization');

    //comprobar el token
    $authCheck=$jwt_auth->checkToken($token, true);


    $data =[
        'status' => 'error',
        'code' => 404,
        'message' => 'Video no encontrado'
        
        
        ];

    if($authCheck) {

        $identity=$jwt_auth->checkToken($token,true);
        $doctrine= $this->getDoctrine();
        $em= $doctrine->getManager();

        $video= $doctrine->getRepository(Video::Class)->findOneBy(array(
            'id' => $id
        ));


        if ($video && is_object($video) && $identity->sub == $video->getUser()->getId()) {

            $em->remove($video);
            $em->flush();


            $data =[
                'status' => 'success',
                'code' => 200,
                'video' => $video
                ];


        }




    }


    


        return  $this->resjson($data);

}


}
