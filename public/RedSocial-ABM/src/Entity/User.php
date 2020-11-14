<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;//para usar la pasword cifrada el encoder q se creo en config/packages/security.yaml tambien para lo q es la autonticacion
use Symfony\Component\Validator\Constraints as Assert;//para activar lo de las validaciones


use Doctrine\ORM\Mapping as ORM;



/**
 * User
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="users_uniques_fields", columns={"email", "nick"})})
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */

 
class User implements UserInterface,\Serializable // implementamos esta interface q fue importada y acordate poo las interfaces tienen metodos tipo firmas q son obligatorios declararlos en esta clase hija
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    //NotBlank me dice q el campo sea obligatoorio
      /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=25, nullable=true)
	 * @Assert\NotBlank
	 * 
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
	 * @Assert\NotBlank
	 * @Assert\Email(
	 *		message = "El email {{ value }} no es valido",
	 *		
	 * )
     */
    private $email;

    //NotBlank me dice q el campo sea obligatoorio
      /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
	 * @Assert\NotBlank(
     * message="no puede estar vacio"
     * )
	  * @Assert\Regex(
	 *    pattern="/[a-zA-Z]+/",
	 *	  message="El nombre no es valido"
	 * )
     * 
     *      
     * 
     * 
     */
    private $name;

    //NotBlank me dice q el campo sea obligatoorio
      /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
	 * @Assert\NotBlank(
     * message="no puede estar vacio"
     * )
	 * @Assert\Regex(
	 *    pattern="/[a-zA-Z]+/",
	 *	  message="El apellido no es valido"
	 * )
     * 
     * 
     * 
     */
    private $surname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nick", type="string", length=50, nullable=true)
     */
    private $nick;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bio", type="string", length=255, nullable=true)
     */
    private $bio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="active", type="string", length=2, nullable=true)
     */
    private $active;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(?string $nick): self
    {
        $this->nick = $nick;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getActive(): ?string
    {
        return $this->active;
    }

    public function setActive(?string $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }


 //metodos obligados para la autenticacion y seguridad
 public function getUsername(){
    return $this->email;
}

public function getSalt(){//esto es de la contraseña
    return null;
}

/*public function getRoles(){
    return $this->getRole();//en este caso le damos un rol fijo
}*/

public function getRoles(){
    return array('ROLE_USER','ROLE_ADMIN');//en este caso le damos un rol fijo
}

public function eraseCredentials(){}//tambien es necesario para la autenticacion


//esta no es exencial para la autenticacion
public function __toString(){
    return $this->name;
}

//metodos q exige Serializable para q no de errores en las subidas de imagenes
public function serialize(){

return serialize(array(
    $this->id,
    $this->email,
    $this->password
));
}

public function unserialize($serialized){
    
    list(
        $this->id,
        $this->email,
        $this->password,
    ) = unserialize($serialized);
    }

    public function getFollowingUsers($user){
        $em = $this->getEntityManager();// dentro de un repositorio el entyty manager se saca asi
        $following_repo = $em->getRepository("App:Following");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
            $following=$following_repo->findBy(array('user' => $user));//agarro los q estoy siguiendo porqe estoy buscando en following(siguiendo) los q tengan el id user del logeado 
    
            $following_array=array();
            foreach ($following as $follow) {
                $following_array[]=$follow->getFollowed();//los metemos en el vector getFollowed el id del q estoy siguiendo
            }
            $user_repo = $em->getRepository("App:User");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $users=$user_repo->createQueryBuilder('u')//el alias u e los usuarios
        ->where("u.id != :user AND u.id IN (:following)")//:user :followin lo especifico en los setParameter..->where y cuando el id sea diferente a el id del logeado y cuando el id coincida con  following(es un array)  q son los id de los q estoy siguiendo
        ->setParameter('user', $user->getId())
        ->setParameter('following', $following_array)
        ->orderBy('u.id', 'DESC');
    
        return $users;
    }



}
