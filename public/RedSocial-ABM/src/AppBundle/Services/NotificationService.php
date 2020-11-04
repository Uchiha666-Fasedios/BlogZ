<?php

namespace AppBundle\Services;
use BackendBundle\Entity\Notification;//mi entidad de User 

class NotificationService
{


    public $manager;//este servicio ya viene con el manager desde services.yml
    public function __construct($manager){
        
        $this->manager = $manager;
        
    }


    public function set($user,$type, $typeId, $extra = null )
    {
        $em = $this->manager;


$notification = new Notification();
$notification->setUser($user);
$notification->setType($type);
$notification->setTypeId($typeId);
$notification->setReaded(0);
$notification->setCreatedAt (new \DateTime("now"));
$notification->setExtra($extra);

$em->persist($notification);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
$flush=$em->flush();//flush guarda en la base de datos

if ($flush == null) {
    $status=true;
}else{
    $status=false;
}
return $status;


    }

    public function read($user)
    { 
        $em = $this->manager;
        $notification_repo = $em->getRepository('BackendBundle:Notification');

        $notifications = $notification_repo->findBy(array(
            "user" => $user
            
        ));


        foreach ($notifications as $notification) {
            $notification->setReaded(1);//le cambia el estado de la notificacion y las deja como leidas
            $em->persist($notification);
        }

        
        $flush=$em->flush();//flush guarda en la base de datos
        
        if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso
            return true;
        }else{
            return false;
        }

        return true;

    }



   



}
