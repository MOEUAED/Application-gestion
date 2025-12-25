<?php
namespace src\entity\member;

class Member {

    // Attributs
    private ?int $id = null ;
    private string $name ;
    private string $email ;
    private ?\DateTimeImmutable $createdAt = null;

    // Methodes
    public function __construct(string $name , string $email)
    {
        $this -> setName($name) ;
        $this -> setEmail($email );
    }

    public function setId(?int $id){
        $this -> id = $id ;
    }
    public function setName(string $name){
        if (!empty($name)){
            $this -> name = $name ;
        }else{
            echo "Name Is Empty !!";
        }
    }
    public function getName(){
        return $this -> name ;
    }
    public function setEmail(string $email){
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this -> email = $email ;
        }else{
            echo"Invalid Email !!" ;
        }
    }
    public function getEmail(){
        return $this -> email ;
    }
    public function setCreatedAt(?\DateTimeImmutable $createdAt){
        $this -> createdAt = $createdAt ;
    }
}

?>