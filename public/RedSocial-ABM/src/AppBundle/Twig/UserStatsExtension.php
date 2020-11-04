<?php

namespace AppBundle\Twig;
use Symfony\Bridge\Doctrine\RegistryInterface;



class UserStatsExtension extends \Twig_Extension {//extends \Twig_Etension para q ande lo de filtro

protected $doctrine;

public function __construct(RegistryInterface $doctrine){//RegistryIntrface para q ande lo de doctrine .. con este parametro le inyectamos este servicio 
        
    $this->doctrine = $doctrine;//le cargo el servicio
    
}

    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('user_stats', array($this, 'userStatsFilter'))//user_stats es como se va a llamar este filtro , le pasamos esta funcion userStatsFilter
        );
    }


    public function userStatsFilter($user){
$following_repo = $this->doctrine->getRepository('BackendBundle:Following');
$publication_repo = $this->doctrine->getRepository('BackendBundle:Publication');
$like_repo = $this->doctrine->getRepository('BackendBundle:Like');


$user_following=$following_repo->findBy(array("user" => $user));
$user_followers=$following_repo->findBy(array("followed" => $user));
//findBy me saca todo las publicaciones cuya propiedad user q es un id sea el id $user q me llega
$user_publications=$publication_repo->findBy(array("user" => $user));
$user_likes = $like_repo->findBy(array("user" => $user));



$result = array(
    'following' => count($user_following),
    "followers" => count($user_followers),
    "publications" => count($user_publications),
    "likes" => count($user_likes)
);
    

return $result;

    }


public function getName()
{
   return 'user_stats_extension';
}


}


