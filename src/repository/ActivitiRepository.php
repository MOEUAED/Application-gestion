<?php

namespace src\Repository;

use PDO;
use src\entity\Activities;

class ActiviteRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* CREATE */
    public function create(Activities $activite): bool
    {
        $sql = "INSERT INTO activities (projet_id, description, statut)
                VALUES (:projet_id, :description, :statut)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':projet_id'  => $activite->getProjetId(),
            ':description'=> $activite->getDescription(),
            ':statut'     => $activite->getStatus() ?? 'en_cours'
        ]);
    }

    /* READ */

    public function findByProjet(int $projetId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM activities WHERE projet_id = :id ORDER BY created_at DESC"
        );
        $stmt->execute([':id' => $projetId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function historyByProjet(int $projetId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM activities 
             WHERE projet_id = :id AND statut = 'terminee'
             ORDER BY created_at DESC"
        );
        $stmt->execute([':id' => $projetId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* UPDATE*/
    public function update(int $id, string $description, string $statut): bool
    {
        $sql = "UPDATE activities 
                SET description = :description, statut = :statut
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':description' => $description,
            ':statut'      => $statut,
            ':id'          => $id
        ]);
    }

    /* DELETE (transaction) */
    public function delete(int $id): bool
    {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare(
                "DELETE FROM activities WHERE id = :id"
            );
            $stmt->execute([':id' => $id]);

            $this->pdo->commit();
            return true;

        } catch (\Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
