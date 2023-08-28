<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;

/**
 * @throws MissingMappingDriverImplementation
 * @throws \Doctrine\DBAL\Exception
 */

// Create a simple "default" Doctrine ORM configuration for Attributes
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: array(__DIR__ . "/app/Models"),
        isDevMode: true,
    );

// configuring the database connection
    $connection = DriverManager::getConnection([
        'driver' => 'pdo_mysql',
        //'path' => __DIR__ . '/db.sqlite',

        'host' => 'localhost:8889',
        'dbname' => 'skycliff',
        'user' => 'root',
        'password' => 'root',
    ], $config);

// obtaining the entity manager
    $entityManager = new EntityManager($connection, $config);

//ConsoleRunner::run(
//    new SingleManagerProvider($entityManager)
//);
