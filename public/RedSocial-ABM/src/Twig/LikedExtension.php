<?php

namespace App\Twig;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;



class LikedExtension extends AbstractExtension {

    public $manager;

    public function __construct($manager){
        $this->manager = $manager;
    }

   

    public function getFilters() {
       
        return [
            
            new TwigFilter('liked', [$this, 'likedFilter']),
        ];
    }




    public function likedFilter($user,$publication){
$like_repo = $this->manager->getRepository('App:Like');
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




}