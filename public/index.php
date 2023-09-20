<?php

global $entityManager;
//require_once __DIR__ . '/../app/twig.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/render.php';
require_once '../bootstrap.php';

//require_once __DIR__. '/../config/config.php';

use App\Controllers\Controller1;

// Add the correct namespace for Controller1
use App\Controllers\careplans_controller;

// Add the correct namespace for Controller2
use App\Controllers\participants_controller;
use App\Controllers\contacts_controller;

// Define your routes and include the necessary controllers

$controller = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //check if this is change on a page, if not then else does full url
    if (isset($_GET['controller'])) {
        $controller = $_GET['controller'];
        if (isset($_GET['function'])) {
            $function = $_GET['function'];
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $param1 = $function;
        $param2 = $id;
        $param3 = '3';
    } else {
        //the else here is for full url
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $_SERVER['REQUEST_URI']);

        $controller = $uriParts[1];

//        $param1 = $uriParts[2];
//        $param2 = $uriParts[3];
//        $param3 = $uriParts[4];

        $paramCount = 3; // Number of parameters you want to extract
        $params = array();

        for ($i = 2; $i <= $paramCount + 1; $i++) {
            if (isset($uriParts[$i])) {
                $params[] = $uriParts[$i];
            } else {
                $params[] = ''; // or handle the default value in some other way
            }
        }

        list($param1, $param2, $param3) = $params;



    }
    // I need to finish this else for the posting of data from contacts screen, my forst post of project
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //check if this is change on a page, if not then else does full url
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $_SERVER['REQUEST_URI']);

    $controller = $uriParts[1];

    $param1 = $uriParts[2];
    $param2 = $uriParts[3];
    $param3 = $uriParts[4];
}
//$entityNameSpace = 'App\models\\';
switch ($controller) {


    case '':
        //$controller = new Controller1();
        renderTemplate('homePage.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
        break;

    case 'about': //****TESTING EXAMPLES - 'fetchbutton'
        // button on home: etchButton event - replace entire screen
        renderTemplate('/gridtest_main.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
        break;

    case 'careplans_manage':
        renderTemplate('careplanDetails.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
        break;

    case 'careplans':
        $careplans = new careplans_controller($entityManager);
        //$dude = new careplans();
        if (is_null($param1)) {
            $result = $careplans->mainDisplay($controller);
        } elseif ($param1 = 'display') {
            $result = $careplans->mainDisplay($controller);
        } else {
            $result = $careplans->action1($param1, $param2, $param3);
        }
        break;

    case 'participants':
        $participants = new participants_controller($entityManager);
        //$entityClassName = 'App\Models\Participants';
        if (is_null($param1)) {
            $result = $participants->mainDisplay($controller);
        } elseif ($param1==='') {
            $result = $participants->mainDisplay($controller);
        } elseif ($param2 === 'update') {
            $result = $participants->saveItem($entityManager,$controller,$param3);
        } elseif ($param1 === 'delete') {
            $result = $participants->deleteParticipant($entityManager,$controller,$param2);
        } elseif ($param1 === 'display') {
            $result = $participants->mainDisplay();
        } elseif ($param1 === 'manage') {
            $result = $participants->manageItem($entityManager,$param2,$controller);
        } elseif ($param1 === 'create') {
            $result = $participants->createParticipant();
        } elseif ($param1 === 'copy') {
            $result = $participants->copyItem($entityManager,$controller,$param2);
        } else {
            $result = $participants->action1($param1, $param2, $param3);
        }
        break;

    case 'contacts':
        $contacts = new contacts_controller($entityManager);
        if (is_null($param1)) {
            $result = $contacts->mainDisplay($controller);
        } elseif ($param1==='') {
            $result = $contacts->mainDisplay($controller);
        } elseif ($param2 === 'update') {
            $result = $contacts->saveItem($entityManager,$controller,$param3);
        } elseif ($param1 === 'delete') {
            $result = $contacts->deleteItem($entityManager, $controller, $param2);
        } elseif ($param1 === 'display') {
            $result = $contacts->mainDisplay($controller);
        } elseif ($param1 === 'manage') {
            $result = $contacts->manageItem($entityManager,$param2,$controller);
        } elseif ($param1 === 'create') {
            $result = $contacts->createContact();
        } elseif ($param1 === 'copy') {
            $result = $contacts->copyItem($entityManager, $controller,$param2);
        } else {
            $result = $contacts->action1($param1, $param2, $param3);
        }
        break;

    default:
        $errorMsg = '404 - Not Found';
        renderTemplate('errorMessage.twig', [
            'param1' => $errorMsg,
        ]);
        break;

}
