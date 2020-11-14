<?php
namespace App\Twig;
use Doctrine\Common\Persistence\ManagerRegistry;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;



class GetUserExtension extends AbstractExtension {

    public $manager;

    public function __construct($manager){
        $this->manager = $manager;
    }
 

    

    public function getFilters() {
       
        return [
            
            new TwigFilter('get_user', [$this, 'getUserFilter']),
        ];
    }


    public function getUserFilter($user_id){
$user_repo = $this->manager->getRepository('App:User');
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




}