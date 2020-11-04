<?php

namespace App\Entity;
//estas las cargo para conseguir un array de colecciones
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
///////////////////////////////////////////////

use Symfony\Component\Security\Core\User\UserInterface;//para usar la pasword cifrada el encoder q se creo en config/packages/security.yaml tambien para lo q es la autonticacion
use Symfony\Component\Validator\Constraints as Assert;//para activar lo de las validaciones

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements UserInterface // implementamos esta interface q fue importada y acordate poo las interfaces tienen metodos tipo firmas q son obligatorios declararlos en esta clase hija
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

     /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=true)
     */
    private $role;
//NotBlank me dice q el campo sea obligatoorio
      /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
	 * @Assert\NotBlank
	 * @Assert\Regex("/[a-zA-Z ]+/")
     */

    private $name;

      /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=100, nullable=true)
	 * @Assert\NotBlank
	 * @Assert\Regex("/[a-zA-Z]+/")
     */
    private $surname;

     /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
	 * @Assert\NotBlank
	 * @Assert\Email(
	 *		message = "El email '{{ value }}' no es valido",
	 *		
	 * )
     */
    private $email;

     /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
	 * @Assert\NotBlank
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


    //ACA LE STOY CREANDO UNA RELACION DE UNO A MUCHOS (un solo usuario tiene muchas tareas)
    //targetEntity="App\Entity\Task" ..la entidad la cual me voy a relacionar)
    //, mappedBy="user" .. con q esta mapeando esto en este caso user es la propiedad q esta en la clase Tack

    /**
	 * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="user")
	 */

    private $tasks; //creo esta propiedad
	
    public function __construct(){ //el sentido q tiene este constructor es 
        //q esta propiedad $tasks .. va tener una coleccion o un array lleno de colecciones de objetos de doctrine
		$this->tasks = new ArrayCollection();
	}



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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
  //  se le agrego esto q es un metodo tipo coleccion le estoy diciendo q va a devolver el task tipo colleccion..
/**
	 * @return Collection|Task[]
	 */
	public function getTasks(): Collection
	{
		return $this->tasks;
    }


    //metodos obligados para la autenticacion y seguridad
    public function getUsername(){
		return $this->email;
	}
	
	public function getSalt(){//esto es de la contraseña
		return null;
	}
	
	public function getRoles(){
		return array('ROLE_USER');//en este caso le damos un rol fijo
	}
	
	public function eraseCredentials(){}//tambien es necesario para la autenticacion

}
