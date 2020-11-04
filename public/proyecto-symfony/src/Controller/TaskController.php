<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Request;//para poder resibir dtos por post
use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;//llamo a la clase q cree del formulario
use Doctrine\Persistence\ManagerRegistry;//permite relacionar el repositorio con la entidad
use Symfony\Component\Security\Core\User\UserInterface;//me permite tomar al usuario autenticado

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="task")
     */
    public function index()
    {

// PRUEBAS OMR
//doctrine es una memoria temporal q tiene symfony donde se acumulan los objetos q qiero para luego meterlos en la base de datos
/*$em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
$task_repo = $this->getDoctrine()->getRepository(Task::class);//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio

$tasks = $task_repo->findAll();//findAll me saca todos 

foreach($tasks as $task){
    echo $task->getUser()->getEmail().' :'. $task->getTitle()."<br/>";//aca hago la prueba de orm llamo a task q es la clase Task 
    //y el metodo getUser q llama a la propiedad user q esta propiedad esta configurada con la relacion omr 
}*/

//OTRO EJEMPLO DEL PODER DE OMR
/*$user_repo = $this->getDoctrine()->getRepository(User::class);
$users = $user_repo->findAll();

foreach($users as $user){
    echo "<h1>{$user->getName()} {$user->getSurname()}</h1>";//saco los nomres y apellidos
    
    foreach($user->getTasks() as $task){
        echo $task->getTitle()."<br/>";
    }
}

return $this->render('task/index.html.twig', [
    'controller_name' => 'TaskController',
]); */




    // Prueba de entidades y relaciones
    $em = $this->getDoctrine()->getManager();
    $task_repo = $this->getDoctrine()->getRepository(Task::class);
    $tasks = $task_repo->findBy([], ['id' => 'DESC']);
    

    
    return $this->render('task/index.html.twig', [
        'tasks' => $tasks
    ]);
}


public function detail(Task $task){//AL PONER DE PARAMETRO Task $task NO HACE FALTA PNER $id ESTO DE LA CONSULTA YA SYMFONY LO SACA SOLO A la tarea
    if(!$task){
        return $this->redirectToRout('tasks');
    }
    
    return $this->render('task/detail.html.twig',[
        'task' => $task
    ]);
}



public function creation(Request $request, UserInterface $user){
    
    $task = new Task();
    $form = $this->createForm(TaskType::class, $task);//llamo a createForm para crear el formulario pero (TaskType::class, $task) refiriendoce a mi clase de formulario creada
    
    $form->handleRequest($request);//handleRequest este metodo recoge los datos del formulario y los adjunta al objeto form

    
    if($form->isSubmitted() && $form->isValid()){//si se toco el boton del formlario creado.. isValid es propio de symfony significa q cuando el formulario es valido va a hacer todo lo q sigue
        $task->setCreatedAt(new \Datetime('now'));//setea la fecha actual
        $task->setUser($user);//seteo al id del usuario autenticado le user_id de Task
        
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        $em->persist($task);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
        $em->flush();//flush guarda en la base de datos
        
        return $this->redirect($this->generateUrl('task_detail', ['id' => $task->getId()]));//me redirige a la trea q acabo de crear
    }
    
    return $this->render('task/creation.html.twig',[//y voy a la vista 
        'form' => $form->createView()//pasandole el formulario .. createView me genera el html para imprimir el formulario
    ]);
}

public function myTasks(UserInterface $user){//con este parametro ya tengo al usuario autenticado
    $tasks = $user->getTasks();//me trae las tareas del usuario autenticado
            
    return $this->render('task/my-tasks.html.twig',[
        'tasks' => $tasks 
    ]);	
}


public function edit(Request $request, UserInterface $user, Task $task){//esto me saca el autenticado y al pasar esto Task $task tambien la magia de symfony rellena los input
    if(!$user || $user->getId() != $task->getUser()->getId()){//si no existe autenticado o si el id del autenticado es distinto al id del objeto tarea usuario id 
        return $this->redirectToRoute('tasks');//lo redirecciono 
    }
    
    $form = $this->createForm(TaskType::class, $task);//llamo a createForm para crear el formulario pero (TaskType::class, $task) refiriendoce a mi clase de formulario creada
    
    $form->handleRequest($request);//handleRequest este metodo recoge los datos del formulario y los adjunta al objeto form

    
    if($form->isSubmitted() && $form->isValid()){//si se toco el boton del formlario creado.. isValid es propio de symfony significa q cuando el formulario es valido va a hacer todo lo q sigue
        //$task->setCreatedAt(new \Datetime('now'));
        //$task->setUser($user);
        
        $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
        $em->persist($task);// persist Guardar objeto en doctrine q doctrine es una memoria temporal
        $em->flush();//flush guarda en la base de datos
        
        return $this->redirect($this->generateUrl('task_detail', ['id' => $task->getId()]));//me redirige a la trea q acabo de crear
    }
    
    return $this->render('task/creation.html.twig',[//me lleva a una vista llevando estas variables
        'edit' => true,
        'form' => $form->createView()//pasandole el formulario .. createView me genera el html para imprimir el formulario
    ]);
}

public function delete(UserInterface $user, Task $task){
    if(!$user || $user->getId() != $task->getUser()->getId()){//si no existe autenticado o si el id del autenticado es distinto al id del objeto tarea usuario id 
        return $this->redirectToRoute('tasks');
    }
    
    if(!$task){//si no me llega tarea
        return $this->redirectToRout('tasks');
    }
    
    $em = $this->getDoctrine()->getManager();// esto me va permitir trabajar con las entidades y guardar en la base de datos
    $em->remove($task);//lo borro de doctrain
    $em->flush();//lo borro de la base de datos
    
    return $this->redirectToRoute('tasks');
}



    }


