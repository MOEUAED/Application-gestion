<?php

use src\config\DATABASE\Database;
use src\Console\Application;

require_once __DIR__ . '/../src/config/Database.php';
require_once __DIR__ . '/../src/Console/Application.php';
require_once __DIR__ . '/../src/repository/MembreRepository.php';
require_once __DIR__ . '/../src/repository/ActivitiRepository.php';
require_once __DIR__ . '/../src/repository/ProjetRepository.php';

$database = new Database();

try {
    $pdo = $database->getConnect();
} catch (\Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$app = new Application($pdo);
$app->run();
