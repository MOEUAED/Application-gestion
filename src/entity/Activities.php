<?php
namespace src\entity\activities;

class Activities {

    // Attributs
    private ?int $id = null ;
    private int $projet_id ;
    private string $description ;
    private string $statut = 'en_cours';
    private ?\DateTimeImmutable $createdAt = null;

    // Methodes
    public function __construct(int $projet_id, string $description, string $statut = 'en_cours')
    {
        $this->setProjetId($projet_id);
        $this->setDescription($description);
        $this->setStatus($statut);
    }


    public function setId(?int $id){
        $this -> id = $id ;
    }
    public function setProjetId(int $projet_id){
        $this -> projet_id = $projet_id ;
    }
    public function getProjetId(){
        return $this -> projet_id ;
    }
    public function setDescription(string $description){
        $this -> description = $description ;
    }
    public function getDescription(){
        return $this -> description ;
    }
    public function setStatus(string $statut){
        $this -> statut = $statut ;
    }
    public function getStatus(){
        return $this -> statut ;
    }
    public function setCreatedAt(?\DateTimeImmutable $createdAt){
        $this -> createdAt = $createdAt ;
    }
}

?>