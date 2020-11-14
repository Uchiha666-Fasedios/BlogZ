<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;//me permite acceder al encoder q creamos en config/packages/security.yaml

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;//mi entidad de User 
use App\Entity\Following;//mi entidad de Following 
use App\Form\RegisterType;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;//para usar sesiones
use Symfony\Component\HttpFoundation\Response; //para hacer una resppuesta
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;//las utilidades de autenticacion



// Include paginator interface
use Knp\Component\Pager\PaginatorInterface; 



class FollowingController extends AbstractController
{

    

private $session;
    public function __construct(){
        
        $this->session = new Session();//creo el objet de sision q se importo en los use de arriba
        
    }


    public function follow(Request $request){

        
$user = $this->getUser();//obtenemos al usuario logeado
$followed_id= $request->get('followed');//el id q me llega 

$em = $this->getDoctrine()->getManager();

$user_repo = $em->getRepository("App:User");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
$followed=$user_repo->find($followed_id);//saco la fila de tal usuario q tiene este id

$following=new Following();//tengo el objeto 
$following->setUser($user);
$following->setFollowed($followed);

$em->persist($following);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
$flush=$em->flush();//flush guarda en la base de datos

if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso

    //$notification = $this->get('app.notification_service');//llamo al servicio global q cree en services.yml
    //$notification->set($followed, 'follow', $user->getId());//llamo al metodo del servicio q lleva 3 parametros
    //el primer parametro saco el usuario de la publicaion q se le dio like el 2 le meto el string de like el 3 el id del usuario logeado q le dio like y el 4 me guarda el id del usuario de la notificacion q se le dio like


    $status="Ahora estas siguiendo a este usuario!!";
}else{
    $status='No se ha podido seguir a este usuario!!';
}
return new Response($status);


    }

    public function unfollow(Request $request){
        $user = $this->getUser();//obtenemos al usuario logeado
        $followed_id= $request->get('followed');//el id q me llega 
        
        $em = $this->getDoctrine()->getManager();
        
        $following_repo = $em->getRepository("App:Following");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $followed=$following_repo->findOneBy(array(
            'user' => $user,
            'followed' => $followed_id
        ));
        
       
        
        $em->remove($followed);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
        $flush=$em->flush();//flush guarda en la base de datos
        
        if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso
            $status="Has dejado de seguir a este usuario!!";
        }else{
            $status='No se ha podido dejar de seguir a este usuario!!';
        }
        return new Response($status);
        
        
            }
    


            public function following(Request $request, $nickname = null ,PaginatorInterface $paginator){
                 
                
                $em = $this->getDoctrine()->getManager();

                if ($nickname != null) {//si no viene vacio entro
                
                    $user_repo = $em->getRepository("App:User");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
                        
                $user = $user_repo->findOneBy(array('nick' => $nickname)); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion
                    
                    
                
                }else{
                $user = $this->getUser();//el q esta logeado la linea entera
                
                }
                
                if (empty($user) || !is_object($user)) {
                    return $this->redirect($this->generateUrl('home_publications'));
                }
                
                
                $user_id=$user->getId();
                //al comparar con user de la entidad Following la OMR hace la magia en la vista following.html.twig con la variable pagination
                $dql= "SELECT f FROM App:Following f WHERE f.user = $user_id ORDER BY f.id DESC"; //para q me tome $user_id ay q poner comillas dobles ""
                    $query= $em->createQuery($dql);
                   //$paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
                   $pagination=$paginator->paginate(
                    $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1.. 5 son los registros q se van a mostrar por pagina
                    ); 
                
                    
                
                   
                    return $this->render('Following/following.html.twig', [
                        'type' => 'following',
                        'profile_user' => $user,
                        "pagination" => $pagination
                    ]);
                
                
                }


                public function followed(Request $request, $nickname = null, PaginatorInterface $paginator){
                 
                
                    $em = $this->getDoctrine()->getManager();
    
                    if ($nickname != null) {//si no viene vacio entro
                    
                        $user_repo = $em->getRepository("App:User");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
                            
                    $user = $user_repo->findOneBy(array('nick' => $nickname)); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion
                        
                        
                    
                    }else{
                    $user = $this->getUser();//el q esta logeado la linea entera
                    
                    }
                    
                    if (empty($user) || !is_object($user)) {
                        return $this->redirect($this->generateUrl('home_publications'));
                    }
                    
                    
                    $user_id=$user->getId();
                    //al comparar con user de la entidad Following la OMR hace la magia en la vista following.html.twig con la variable pagination
                    $dql= "SELECT f FROM App:Following f WHERE f.followed = $user_id ORDER BY f.id DESC"; //para q me tome $user_id ay q poner comillas dobles ""
                        $query= $em->createQuery($dql);
                      //$paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
                       $pagination=$paginator->paginate(
                        $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1.. 5 son los registros q se van a mostrar por pagina
                        ); 
                    
                        
                    
                       
                        return $this->render('Following/following.html.twig',[
                            'type' => 'followed',
                            'profile_user' => $user,
                            "pagination" => $pagination
                        ]);
                    
                    
                    }




}
