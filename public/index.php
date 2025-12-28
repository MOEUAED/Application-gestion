<?php

require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/Console/Application.php';

use src\config\DATABASE\Database;
use src\Console\Application;

$database = new Database();
$pdo = $database->getConnect();

$app = new Application($pdo);
$app->run();
