#!/usr/bin/env php
<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once "vendor/autoload.php";

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
    'dbname' => 'health_history',
    'user' => 'root',
    'password' => 'root',
    // for hostgator 20240319
    //        'host' => 'localhost:3306',
    //        'dbname' => 'tomefily_health_history',
    //        'user' => 'tomefily_healthvault',
    //        'password' => 'U59P1Oiq6a2C',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
