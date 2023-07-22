<?php

require_once __DIR__ . '/../app/twig.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. '/../app/render.php';

use App\Controllers\Controller1; // Add the correct namespace for Controller1
use App\Controllers\Controller2; // Add the correct namespace for Controller2


// Define your routes and include the necessary controllers
$uri = $_SERVER['REQUEST_URI'];


$uriParts = explode('/',  $_SERVER['REQUEST_URI']);
$route = $uriParts[1];

$param1 = $uriParts[2];
$param2 = $uriParts[3];
$param3 = $uriParts[4];


switch ($route) {
    case '':
        //$controller = new Controller1();
        renderTemplate('homepage.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
        break;
    case 'template1':
        $controller = new Controller1();
        renderTemplate('template1.twig', [
                'param1' => $param1,
                'param2' => $param2,
                'param3' => $param3
        ]);
        break;
    case 'template2':
        $controller2 = new Controller2();
        $result = $controller2->action1($param1, $param2, $param3);
        break;
    default:
        $errorMsg = '404 - Not Found';
        renderTemplate('errorMessage.twig', [
            'param1' => $errorMsg,
        ]);
        break;
}
