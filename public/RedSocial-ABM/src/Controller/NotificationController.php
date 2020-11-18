<?php

namespace App\Controller;
use App\Services\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Container\ContainerInterface;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; //para hacer una resppuesta

// Include paginator interface
use Knp\Component\Pager\PaginatorInterface;


class NotificationController extends AbstractController
{
    
    public function index(Request $request,PaginatorInterface $paginator,ContainerInterface $container)
    {
        $user =  $this->getUser();//getUser() me trae el usuario logeado
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        

    
        $user_id=$user->getId();// tengo q poner el id del logeado para llevarlo a la query porqe si pongo el objeto entero da error es porqe la entydad tiene el metodo
        //get_string q me devuelve un string cuando llamo al objeto logeado no hay q darle mucha vuelta ponedlo asi

        $dql= "SELECT n FROM App:Notification n WHERE n.user = $user_id ORDER BY n.id DESC"; //para q me tome $user_id ay q poner comillas dobles ""
        $query= $em->createQuery($dql);
      // $paginator=$this->get('knp_paginator');//$this->get('knp_paginator') llamo al servicio de paginacion
       $pagination=$paginator->paginate(
        $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1.. 5 son los registros q se van a mostrar por pagina
        ); 

        $notification = $container->get('app.notification_service');//llamo al servicio global q cree en services.yml
        $notification->read($user);//llamo al metodo del servicio q lleva 1 parametro
        
        
    
        return $this->render('Notification/notification.html.twig', [
                
            'user' => $user,
            "pagination" => $pagination
        ]);

    }


    public function countNotifications()
    {
        //$user =  $this->getUser();//getUser() me trae el usuario logeado
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
    
        $notification_repo = $em->getRepository("App:Notification");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $notifications = $notification_repo->findBy(array(//la condicion readed q este en 0 porqe si esta en 1 ya se leyeron las notificaciones
            'user' => $this->getUser(),
            'readed' => 0
        
        
        )); ////condicion q el nick sea = a $nick q me llega findOneBy me saca uno dependiendo de una condicion
            
         return new Response(count($notifications));
    
    }


}
