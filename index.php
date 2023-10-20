<?php

global $entityManager;
//require_once __DIR__ . '/../app/twig.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/render.php';
require_once 'bootstrap.php';
//$vendorPath = __DIR__ . '/vendor/';

//require_once __DIR__. '/../config/config.php';

use App\Controllers\Controller1;

// Add the correct namespace for Controller1
use App\Controllers\careplans_controller;

// Add the correct namespace for Controller2
use App\Controllers\participants_controller;
use App\Controllers\contacts_controller;
use App\Controllers\assessments_controller;

// Define your routes and include the necessary controllers

session_start();

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
        $uriFull = $_SERVER['REQUEST_URI'];
        $uri = preg_replace("~^/index\.php~", "", $uriFull);

        $uriParts = explode('/', $uri);

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
    $uriParts = explode('/', $uri);

    $controller = $uriParts[1];

    $param1 = $uriParts[2];
    $param2 = $uriParts[3];
    if (isset($uriParts[4])) {
        $param3 = $uriParts[4];
    } else {
        $param3 = null;
    }
}

if (!isset($_SESSION["userId"]) && $controller !== "sessions") {
    renderTemplate('session/login.twig');
}

else {
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

    case 'login_process.php':
        $_SESSION["userId"] = "temp";
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
        } elseif ($param1 === '') {
            $result = $participants->mainDisplay($controller);
        } elseif ($param2 === 'update') {
            $result = $participants->saveItem($entityManager, $controller, $param3);
        } elseif ($param1 === 'delete') {
            $result = $participants->deleteParticipant($entityManager, $controller, $param2);
        } elseif ($param1 === 'display') {
            $result = $participants->mainDisplay();
        } elseif ($param1 === 'manage') {
            $result = $participants->manageItem($entityManager, $param2, $controller);
        } elseif ($param1 === 'print') {
            $result = $participants->manageItem($entityManager, $param2, $controller, 'PDF');
        } elseif ($param1 === 'create') {
            $result = $participants->manageItem($entityManager, $param2, $controller);
        } elseif ($param1 === 'copy') {
            $result = $participants->copyItem($entityManager, $controller, $param2);
        } else {
            $result = $participants->action1($param1, $param2, $param3);
        }
        break;

    case 'contacts':
        $contacts = new contacts_controller($entityManager);
        if (is_null($param1)) {
            $result = $contacts->mainDisplay($controller);
        } elseif ($param1 === '') {
            $result = $contacts->mainDisplay($controller);
        } elseif ($param2 === 'update') {
            $result = $contacts->saveItem($entityManager, $controller, $param3);
        } elseif ($param1 === 'delete') {
            $result = $contacts->deleteItem($entityManager, $controller, $param2);
        } elseif ($param1 === 'display') {
            $result = $contacts->mainDisplay($controller);
        } elseif ($param1 === 'manage') {
            $result = $contacts->manageItem($entityManager, $param2, $controller);
        } elseif ($param1 === 'print') {
            $result = $contacts->manageItem($entityManager, $param2, $controller, 'PDF');
        } elseif ($param1 === 'create') {
            $result = $contacts->createContact();
        } elseif ($param1 === 'copy') {
            $result = $contacts->copyItem($entityManager, $controller, $param2);
        } else {
            $result = $contacts->action1($param1, $param2, $param3);
        }
        break;

    case 'assessments':
        $assessments = new assessments_controller($entityManager);
        if (is_null($param1)) {
            $result = $assessments->mainDisplay($controller);
        } elseif ($param1 === '') {
            $result = $assessments->mainDisplay($controller);
        } elseif ($param2 === 'update') {
            $result = $assessments->saveItem($entityManager, $controller, $param3);
        } elseif ($param1 === 'delete') {
            $result = $assessments->deleteItem($entityManager, $controller, $param2);
        } elseif ($param1 === 'display') {
            $result = $assessments->mainDisplay($controller, $param2, $param3);  //parm2=participant   param3=6  example
        } elseif ($param1 === 'manage') {
            $result = $assessments->manageItem($entityManager, $param2, $controller);
        } elseif ($param1 === 'print') {
            $result = $assessments->manageItem($entityManager, $param2, $controller, 'PDF');
        } elseif ($param1 === 'create') {
            $result = $assessments->manageItem($entityManager, null, $controller);
        } elseif ($param1 === 'copy') {
            $result = $assessments->copyItem($entityManager, $controller, $param2);
        } else {
            $result = $assessments->action1($param1, $param2, $param3);
        }
        break;

    case 'sessions':
        if (is_null($param1)) {
            $errorMsg = '404 - Session Not Found';
            renderTemplate('errorMessage.twig', [
                'param1' => $errorMsg,]);
        } elseif ($param1 === 'logout') {
            session_unset();
            session_destroy();
            renderTemplate('session/login.twig');
        } elseif ($param1 === 'login') {
            $_SESSION["userId"] = "temp";
            renderTemplate('homePage.twig', [
                'param1' => $param1,
                'param2' => $param2,
                'param3' => $param3
            ]);
        } else {
            $errorMsg = '404 - Session OTHER error, Not Found';
        renderTemplate('errorMessage.twig', [
            'param1' => $errorMsg,]);
        }
        break;

    default:
        $errorMsg = '404 - Not Found';
        renderTemplate('errorMessage.twig', [
            'param1' => $errorMsg,
        ]);
        break;
}
}
