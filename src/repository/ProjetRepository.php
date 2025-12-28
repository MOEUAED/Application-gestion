<?php

namespace src\Repository;

use PDO;
use src\entity\Projet;
use src\entity\ProjetCourt;
use src\entity\ProjetLong;

class ProjetRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* CREATE*/
    public function create(Projet $projet): bool
    {
        $sql = "INSERT INTO projets 
                (membre_id, titre, type, date_debut, date_fin)
                VALUES (:membre_id, :titre, :type, :date_debut, :date_fin)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':membre_id' => $projet->getMemberId(),
            ':titre'     => $projet->getTitre(),
            ':type'      => $projet->getType(),
            ':date_debut'=> $projet->getDateDebut()->format('Y-m-d'),
            ':date_fin'  => $projet->getDateFin()->format('Y-m-d')
        ]);
    }

    /* READ  */
    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM projets");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByMember(int $memberId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM projets WHERE membre_id = :id"
        );
        $stmt->execute([':id' => $memberId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* DELETE */
    public function delete(int $id): bool
    {
        $check = $this->pdo->prepare(
            "SELECT COUNT(*) FROM activities 
             WHERE projet_id = :id AND statut = 'en_cours'"
        );
        $check->execute([':id' => $id]);

        if ($check->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->pdo->prepare("DELETE FROM projets WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
