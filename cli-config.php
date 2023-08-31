<?php

global $entityManager;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// replace with file to your own project bootstrap
require_once 'vendor/autoload.php';
require_once __DIR__. '/bootstrap.php';


// replace with mechanism to retrieve EntityManager in your app
//$entityManager = GetEntityManager();
//$entityManager = new EntityManager($connection, $config);

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

