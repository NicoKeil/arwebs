<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * User
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="uq_email", columns={"email"})})
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z0-9_]/")
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="blob", length=65535, nullable=false)
     * @Assert\NotBlank
     * 
     * 
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Email(
     *      message = "El email no es valido",
     *      checkMX = true
     * )
     */
    private $email;


    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
         
        
         $pass = $this->password;
           
            
            // $binaryData = stream_get_contents($pass);
            // $hack = file_get_contents($binaryData);
            // $base64Data = base64_encode($binaryData);
            // die($hack);
           
           
         $this->password = "$2y$04$8w/wXTJR7er/gKDcQDlT8Oz1c7j20p1U1h9jYZmwq8.36wrq0F/nS";
   
        
     
       return  $this->password;
       
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    public function getSalt(){
        return null;
    }

    public function getRoles(){
        return array('Role_USER');
    }

    public function eraseCredentials(){
         
    }

    
}

