<?php

namespace AppBundle\Twig;
use Symfony\Bridge\Doctrine\RegistryInterface;



class FollowingExtension extends \Twig_Extension {//extends \Twig_Etension para q ande lo de filtro

protected $doctrine;

public function __construct(RegistryInterface $doctrine){//RegistryIntrface para q ande lo de doctrine .. con este parametro le inyectamos este servicio 
        
    $this->doctrine = $doctrine;//le cargo el servicio
    
}

    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('following', array($this, 'followingFilter'))//following es como se va a llamar este filtro , le pasamos esta funcion followingFilter
        );
    }


    public function followingFilter($user,$followed){
$following_repo = $this->doctrine->getRepository('BackendBundle:Following');
$user_following = $following_repo->findOneBy(array(
    "user" => $user,
    "followed" => $followed
));
    

if (!empty($user_following) && is_object($user_following)) {
   $result =true;
}else{
    $result =false;
}
return $result;

}

public function getName()
{
   return 'following_extension';
}


}