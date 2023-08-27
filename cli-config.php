<?php

global $entityManager;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

// replace with file to your own project bootstrap
//require_once 'bootstrap.php';
require_once 'bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
//$entityManager = GetEntityManager();
//$entityManager = new EntityManager($connection, $config);

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

