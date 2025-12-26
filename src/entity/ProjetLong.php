<?php
namespace src\entity;

require_once 'Projet.php';

class ProjetLong extends Projet {
    public function getType(): string {
        return "long";
    }
}
