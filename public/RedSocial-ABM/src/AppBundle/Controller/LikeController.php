<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;//para usar sesiones
use Symfony\Component\HttpFoundation\Response; //para hacer una resppuesta

use BackendBundle\Entity\Publication;//mi entidad de User
use BackendBundle\Entity\User;//mi entidad de User
use BackendBundle\Entity\Like;//mi entidad de User


class LikeController extends Controller
{

    public function likeAction($id = null){

        $user =  $this->getUser();//getUser() me trae el usuario logeado
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        
        $publication_repo = $em->getRepository("BackendBundle:Publication");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $publication=$publication_repo->find($id);

        $like = new Like();
        $like->setUser($user);
        $like->setPublication($publication);

        $em->persist($like);
            $flush=$em->flush();

            if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso

$notification = $this->get('app.notification_service');//llamo al servicio global q cree en services.yml
$notification->set($publication->getUser(), 'like', $user->getId(), $publication->getId());//llamo al metodo del servicio q lleva 3 parametros
//el primer parametro saco el usuario de la publicaion q se le dio like el 2 le meto el string de like el 3 el id del usuario logeado q le dio like y el 4 me guarda el id del usuario de la notificacion q se le dio like
                $status='Te gusta esta pubicacion !!';
            }else{
                $status='No se ha podido guardar el me gusta !!';
            }

            return new Response($status);

    }

    public function unlikeAction($id = null){

        $user =  $this->getUser();//getUser() me trae el usuario logeado
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        
        $like_repo = $em->getRepository("BackendBundle:Like");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $like=$like_repo->findOneBy(array(
            'user' => $user,
            'publication' => $id
        ));

       

        $em->remove($like);
            $flush=$em->flush();

            if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso
                $status='Ya no te gusta esta pubicacion !!';
            }else{
                $status='No se ha podido desmarcar el me gusta !!';
            }

            return new Response($status);

    }


    public function likesAction(Request $request, $nickname = null){
                 
                
        $em = $this->getDoctrine()->getManager();

        if ($nickname != null) {//si no viene vacio entro
        
            $user_repo = $em->getRepository("BackendBundle:User");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
                
        $user = $user_repo->findOneBy(array('nick' => $nickname)); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion
            
            
        
        }else{
        $user = $this->getUser();//el q esta logeado la linea entera
        
        }
        
        if (empty($user) || !is_object($user)) {
            return $this->redirect($this->generateUrl('home_publications'));
        }
        
        
        $user_id=$user->getId();
        //al comparar con user de la entidad Following la OMR hace la magia en la vista following.html.twig con la variable pagination
        $dql= "SELECT l FROM BackendBundle:Like l WHERE l.user = $user_id ORDER BY l.id DESC"; //para q me tome $user_id ay q poner comillas dobles ""
            $query= $em->createQuery($dql);
           $paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
           $pagination=$paginator->paginate(
            $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1.. 5 son los registros q se van a mostrar por pagina
            ); 
        
            
        
           
            return $this->render('AppBundle:Like:likes.html.twig', array(
                
                'user' => $user,
                "pagination" => $pagination
            ));
        
        
        }

}
