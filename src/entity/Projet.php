<?php
namespace src\entity\Projet;


    abstract class Projet {
    protected ?int $id = null;
    protected int $member_id;
    protected string $titre;
    protected string $type;
    protected ?\DateTime $date_debut;
    protected ?\DateTime $date_fin;
    protected ?\DateTimeImmutable $createdAt ;


    // Methodes
    public function __construct(int $member_id, string $titre, string $type , string $date_debut ,string $date_fin) {
        $this-> member_id = $member_id;
        $this-> titre = $titre;
        $this-> type = $type ;
        $this-> date_debut = new \Datetime($date_debut) ;
        $this-> date_fin = new \Datetime($date_fin) ;

    }
    public function setId(int $id) {
        $this -> id = $id ;
    }
    public function getMemberId() { 
        return $this-> member_id ;
    }
    public function setMemberId(int $member_id) { 
        $this -> member_id = $member_id;
    }
    public function getTitre() { 
        return $this->titre;
    }
    public function setTitre(string $titre) { 
        $this -> titre = $titre ;
    }
    public function getType() { 
        return $this->type;
    }
    public function setType(string $type) { 
        $this -> type = $type ;
    }
    public function getDateDebut() { 
        return $this->date_debut;
    }
    public function setDateDebut(\DateTime $date_debut) { 
        $this -> date_debut = $date_debut ;
    }
    public function getDateFin() { 
        return $this->date_fin;
    }
    public function setDateFin(\DateTime $date_fin) { 
        $this -> date_fin = $date_fin ;
    }
    public function setCreatAt(\DateTimeImmutable $createdAt){
        $this -> createdAt = $createdAt ;
    }
    
    }





?>