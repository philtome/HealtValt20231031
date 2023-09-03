<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Include the Composer autoloader

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

function renderTemplate(string $templateName, array $contextData = []): void
{


    $loader = new FilesystemLoader(__DIR__ . '/Views');
    $twig = new Environment($loader, ['debug' => true, 'cache' => __DIR__ . '/twig_cache',]);

    $twig->addExtension(new DebugExtension());


    echo $twig->render($templateName, $contextData);
}