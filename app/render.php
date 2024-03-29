<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Include the Composer autoloader

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

function renderTemplate(string $templateName, array $contextData = [], string $outPutType = null): string
{

    if (isset($_SESSION['initials'])) {
        $contextData['initials'] = $_SESSION['initials'];
    }
    $loader = new FilesystemLoader(__DIR__ . '/Views');
    $twig = new Environment($loader, ['debug' => true, 'cache' => __DIR__ . '/twig_cache',]);

    $twig->addExtension(new DebugExtension());


    $twigData = $twig->render($templateName, $contextData);
    if ($outPutType === null) {
        echo $twigData;
    }
    return $twigData;
}