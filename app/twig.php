<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/Views');
$twig = new Environment($loader, ['debug' => true,]);

$twig->addExtension(new \Twig\Extension\DebugExtension());