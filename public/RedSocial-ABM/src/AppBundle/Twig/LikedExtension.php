<?php

namespace AppBundle\Twig;
use Symfony\Bridge\Doctrine\RegistryInterface;



class LikedExtension extends \Twig_Extension {//extends \Twig_Etension para q ande lo de filtro

protected $doctrine;

public function __construct(RegistryInterface $doctrine){//RegistryIntrface para q ande lo de doctrine .. con este parametro le inyectamos este servicio 
        
    $this->doctrine = $doctrine;//le cargo el servicio
    
}

    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('liked', array($this, 'likedFilter'))//liked es como se va a llamar este filtro , le pasamos esta funcion likedFilter
        );
    }


    public function likedFilter($user,$publication){
$like_repo = $this->doctrine->getRepository('BackendBundle:Like');
$publication_liked = $like_repo->findOneBy(array(
    "user" => $user,
    "publication" => $publication
));
    

if (!empty($publication_liked) && is_object($publication_liked)) {
   $result =true;
}else{
    $result =false;
}
return $result;

}

public function getName()
{
   return 'liked_extension';
}


}