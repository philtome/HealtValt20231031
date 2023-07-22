<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Include the Composer autoloader

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

function renderTemplate(string $templateName, array $contextData = []): void
{
    $loader = new FilesystemLoader(__DIR__ . '/Views');
    $twig = new Environment($loader);

    echo $twig->render($templateName, $contextData);
}