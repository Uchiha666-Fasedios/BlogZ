<?php

namespace AppBundle\Twig;
use Symfony\Bridge\Doctrine\RegistryInterface;



class GetUserExtension extends \Twig_Extension {//extends \Twig_Etension para q ande lo de filtro

protected $doctrine;

public function __construct(RegistryInterface $doctrine){//RegistryIntrface para q ande lo de doctrine .. con este parametro le inyectamos este servicio 
        
    $this->doctrine = $doctrine;//le cargo el servicio
    
}

    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('get_user', array($this, 'getUserFilter'))//get_user es como se va a llamar este filtro , le pasamos esta funcion likedFilter
        );
    }


    public function getUserFilter($user_id){
$user_repo = $this->doctrine->getRepository('BackendBundle:User');
$user = $user_repo->findOneBy(array(
    "id" => $user_id
    
));
    

if (!empty($user) && is_object($user)) {
   $result =$user;
}else{
    $result =false;
}
return $result;

}

public function getName()
{
   return 'get_user_extension';
}


}