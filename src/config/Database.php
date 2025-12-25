<?php

namespace src\config\DATABASE;

use PDO;
use PDOException;

class Database
{
    private string $host = "localhost";
    private string $user = "root";
    private string $password = "";
    private string $database = "metis_db";
    private ?PDO $connect = null;

    public function getConnect(): PDO
    {
        if ($this->connect === null) {
            try {
                $this->connect = new PDO(
                    "mysql:host={$this->host};dbname={$this->database};charset=utf8",
                    $this->user,
                    $this->password
                );
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return $this->connect;
    }
}
