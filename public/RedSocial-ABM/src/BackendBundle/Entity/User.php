<?php

namespace BackendBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;//para usar la pasword cifrada el encoder q se creo en config/packages/security.yaml tambien para lo q es la autonticacion
/**
 * User
 */
class User implements UserInterface,\Serializable // implementamos esta interface q fue importada y acordate poo las interfaces tienen metodos tipo firmas q son obligatorios declararlos en esta clase hija.. \Serializable esta se coloca para evitar errores con la imagen y nos exige dos metodos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $role;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $nick;

    /**
     * @var string
     */
    private $bio;

    /**
     * @var string
     */
    private $active;

    /**
     * @var string
     */
    private $image;


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


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nick
     *
     * @param string $nick
     *
     * @return User
     */
    public function setNick($nick)
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * Get nick
     *
     * @return string
     */
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set active
     *
     * @param string $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}

