<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PublicationType;
use App\Entity\Publication;//mi entidad de User
use Symfony\Component\HttpFoundation\Session\Session;//para usar sesiones
use Symfony\Component\HttpFoundation\Response; //para hacer una resppuesta


// Include paginator interface
use Knp\Component\Pager\PaginatorInterface; 


class PublicationController extends AbstractController
{


    private $session; 
    private $paginator;

    public function __construct(PaginatorInterface $paginator){
        
        $this->paginator = $paginator;//creo el objet de sision q se importo en los use de arriba
        $this->session = new Session();//creo el objet de sision q se importo en los use de arriba
        
    }
    
    public function index(Request $request,PaginatorInterface $paginator)
    {
        #return $this->render('Publication/home.html.twig', [
           # 'controller_name' => 'PublicationController',
        #]);

        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        $user =  $this->getUser();//getUser() me trae el usuario logeado
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);//llamo a createForm para crear el formulario pero (TaskType::class, $task) refiriendoce a mi clase de formulario creada
        // Rellenar el objeto con los datos del form
		$form->handleRequest($request);//handleRequest este metodo recoge los datos del formulario y los adjunta al objeto form 
            // Comprobar si el form se ha enviado
            if($form->isSubmitted()){
                if($form->isValid()){

                    //UPLOAD IMAGE
                    $file = $form["image"]->getData();

                    if (!empty($file) && $file != null) {
                        $ext=$file->guessExtension();
                        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                            $file_name = $user->getId(). time() . "." . $ext;
                            $file->move("uploads/publications/images",$file_name);
                            $publication->setImage($file_name);
                        }else{
                            $publication->setImage(null);
                        }


                    }else{
$publication->setImage(null);
                }


                //upload document




                $doc = $form["document"]->getData();
        
                if (!empty($doc) && $doc != null) {
                    $ext=$doc->guessExtension();
                    if ($ext == 'pdf' || $ext == 'docx') {
                        $file_name = $user->getId(). time() . "." . $ext;
                        $doc->move("uploads/publications/documents",$file_name);
                        $publication->setDocument($file_name);
                    }else{
                        $publication->setDocument(null);
                    }


                }else{
$publication->setDocument(null);
            }

            $publication->setUser($user);
            $publication->setCreatedAt(new \Datetime('now'));//le seteo la fecha de hoy
    
            $em->persist($publication);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
            $flush=$em->flush();//flush guarda en la base de datos
    
            if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso
                $status='La pubicacion se ha creado correctamente !!';
            }else{
                $status='Error al añadir la publicacion !!';
            }



                
               
                }else{
                    $status='La pubicacion no se ha creado porque el formulario no es valido !!';
                }

                $this->session->getFlashBag()->add('status', $status);// add('message', 'Animal creado') le estoy agregando el mensaje 
                return $this->redirectToRoute('home_publications');


            }

$publications= $this->getPublications($request, $paginator);

$re=$publications->getTotalItemCount();//getTotalItemCount() me saca la cantidad  

            return $this->render('Publication/home.html.twig', Array( //me voy a esta vista llevandome la variable para mostrarla ahi
                'form' => $form->createView(),//pasandole el formulario .. createView me genera el html para imprimir el formulario
                 'pagination' => $publications,
                 're' => $re
            )); 
    }


    public function getPublications($request,PaginatorInterface $paginator){
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        $user =  $this->getUser();//getUser() me trae el usuario logeado
        $publications_repo = $em->getRepository("App:Publication");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $following_repo = $em->getRepository("App:Following");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
    /*SELECT text FROM publications WHERE user_id = 6
    OR user_id IN (SELECT followed FROM following WHERE user = 6);*/
    
    $following =$following_repo->findBY(array('user' => $user));//me saca todos dependiendo de la condicion de que el user se = a $user (agarro todos los id de los usuarios q estoy siguiendo)
    
    $following_array =array();//creo un array
    
    foreach ($following as $follow) {//$following esta viene con los metodos del modelo 
        $following_array[]=$follow->getFollowed();//getFollowed() metodo q esta en el modelo(los id de los q estoy siguiendo los pongo en este array)
    }
    $query=$publications_repo->createQueryBuilder('p')//acordate q following_repo tiene todos los metodos entonces con createQueryBuilder creo el query builder como p (es como q p toma los metodos y todo de $following_repo)
    ->where('p.user = (:user_id) OR p.user IN (:following)')//llamo a la propiedad user y digo q es igual a (:user_id) el id del logeado o q sea igual a following q es el id de los que sigo 
    ->setParameter('user_id', $user->getId())//se va a llamar user_id y va valer $user->getId() el id del usuario logeado
    ->setParameter('following', $following_array)//se va a llamar following y va a valer $following_array el id de los q estoy siguiendo
    ->orderBy('p.id', 'DESC')
    ->getQuery();
    
    
     
    
    $pagination=$paginator->paginate(
        $query,$request->query->getInt('page',1),5  //va a cargar el parametro page y si no tiene nada page carga el 1 ..5 son los registros q se van a mostrar por pagina
        );
    
        return $pagination;
    
    }


    public function remove(Request $request, $id = null){
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        $publication_repo = $em->getRepository("App:Publication");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
    $publication=$publication_repo->find($id);
    $user =  $this->getUser();//getUser() me trae el usuario logeado
    
    if($user->getId() == $publication->getUser()->getId()){
    $em->remove($publication);
                $flush=$em->flush();
                if ($flush == null) {//si es igual a null o sea si no devuelve un error y nada de eso
                    $status='La pubicacion se ha borrado correctamente !!';
                }else{
                    $status='Error no se ha borrado la publicacion !!';
                }
            }else{
                $status='Error no se ha borrado la publicacion !!';
            }
    
                return new Response($status);
    
    
    // replace this example code with whatever you need
     
    
    }
}
