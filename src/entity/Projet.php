<?php
namespace src\entity;

abstract class Projet {

    protected ?int $id = null;
    protected int $member_id;
    protected string $titre;
    protected ?\DateTime $date_debut;
    protected ?\DateTime $date_fin;
    protected ?\DateTimeImmutable $createdAt = null;

    public function __construct(
        int $member_id,
        string $titre,
        string $date_debut,
        string $date_fin
    ) {
        $this->member_id = $member_id;
        $this->titre = $titre;
        $this->date_debut = new \DateTime($date_debut);
        $this->date_fin   = new \DateTime($date_fin);
    }

    public function getMemberId() {
        return $this->member_id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDateDebut(){
        return $this->date_debut;
    }

    public function getDateFin(){
        return $this->date_fin;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt) {
        $this->createdAt = $createdAt;
    }

    abstract public function getType(): string;
}
