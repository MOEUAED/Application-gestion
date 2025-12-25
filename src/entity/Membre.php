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
        $this -> name = $name ;
    }
    public function getName(){
        return $this -> name ;
    }
    public function setEmail(string $email){
        $this -> email = $email ;
    }
    public function getEmail(){
        return $this -> email ;
    }
    public function setCreatedAt(?\DateTimeImmutable $createdAt){
        $this -> createdAt = $createdAt ;
    }
}

?>