<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\DebugExtension;


$loader = new FilesystemLoader(__DIR__ . '/Views');
$twig = new Environment($loader, ['debug' => true, 'cache' => __DIR__ . '/twig_cache',]);

$twig->addExtension(new DebugExtension());
$fred = 'ok';