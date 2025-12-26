<?php
namespace src\entity;

require_once 'Projet.php';

class ProjetCourt extends Projet {
    public function getType(): string {
        return "court";
    }
}
