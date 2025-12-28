<?php

namespace src\Repository;

use PDO;
use src\config\DATABASE\Database;
use src\entity\member\Member;

class MemberRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnect();
    }

    /* CREATE */
    public function create(Member $member)
    {
        if ($this->emailExists($member->getEmail())) {
            throw new \Exception("Email already exists.");
        }

        $sql = "INSERT INTO membres (nom, email) VALUES (:nom, :email)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom'   => $member->getName(),
            ':email' => $member->getEmail()
        ]);
    }

    /* READ ALL */
    public function findAll()
    {
        $sql = "SELECT * FROM membres ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* READ BY ID */
    public function findById(int $id)
    {
        $sql = "SELECT * FROM membres WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    /* UPDATE */
    public function update(int $id, string $name, string $email)
    {
        $sql = "UPDATE membres SET nom = :nom, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom'   => $name,
            ':email' => $email,
            ':id'    => $id
        ]);
    }

    /*  DELETE (condition) */

    public function delete(int $id): bool
    {
        if ($this->hasProjects($id)) {
            throw new \Exception("Cannot delete member: projects exist.");
        }

        $sql = "DELETE FROM membres WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $id]);
    }

    /* BUSINESS RULES */
    private function emailExists(string $email): bool
    {
        $sql = "SELECT COUNT(*) FROM membres WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetchColumn() > 0;
    }

    private function hasProjects(int $memberId): bool
    {
        $sql = "SELECT COUNT(*) FROM projets WHERE membre_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $memberId]);

        return $stmt->fetchColumn() > 0;
    }
}
