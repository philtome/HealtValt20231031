<?php

// File: config.php
function get_connection() {
    $config = require 'dbdets.php';

    $pdo = new PDO(
        $config['database_dsn'],
        $config['database_user'],
        $config['database_pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

//    $config = require 'config.php';
//    $pdo = new PDO(
//        $config['database_dsn'],
//        $config['database_user'],
//        $config['database_pass']
//    );
//    try {
//        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    die("Connection failed: ". $e->getMessage());
//}
