<?php
require_once "../vendor/autoload.php";

use Doctrine\ORM\Tools\ORMSetup;
use Doctrine\ORM\EntityManager;

// Customize the paths to your entity classes
$entityPaths = [__DIR__."/../app/Entities"];

$config = Setup::createAnnotationMetadataConfiguration($entityPaths, true);

// Customize the database connection parameters
$conn = [
    'driver' => 'pdo_mysql',
    'user' => 'your_db_username',
    'password' => 'your_db_password',
    'dbname' => 'your_db_name',
    'host' => 'localhost',
];

$entityManager = EntityManager::create($conn, $config);
