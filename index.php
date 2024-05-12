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
use App\Controllers\medications_controller;
use App\Controllers\participants_controller;
use App\Controllers\contacts_controller;
use App\Controllers\assessments_controller;
use App\Controllers\users_controller;
use App\Controllers\visits_controller;
use App\Controllers\blood_pressures_controller;
use App\Controllers\procedures_controller;
use App\Controllers\creatinines_controller;
use App\Controllers\a1cs_controller;
use App\Controllers\cholesterols_controller;
use App\Controllers\weights_controller;


// Define your routes and include the necessary controllers
//ini_set('session.gc_maxlifetime', 60);
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

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        $userController = new users_controller($entityManager);

        $initials = $userController->getFirstInitialsByUserUid($userId);
        $_SESSION["initials"] = $initials;
       // You can now use the $userId variable for further processing
        }

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

        case 'visits':
            $visits = new visits_controller($entityManager);
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $visits->mainDisplay($controller, $userId, null, null, 'date', 'desc');
            } elseif ($param1 === '') {
                $result = $visits->mainDisplay($controller, $userId, null, null, 'date', 'desc');
            } elseif ($param2 === 'update') {
                $result = $visits->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $visits->deleteItem($entityManager, $controller, $param2);
            } elseif ($param1 === 'display') {
                $result = $visits->mainDisplay();
            } elseif ($param1 === 'manage') {
                $result = $visits->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'print') {
                $result = $visits->manageItem($entityManager, $param2, $controller, 'PDF');
            } elseif ($param1 === 'create') {
                $result = $visits->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'copy') {
                $result = $visits->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $visits->action1($param1, $param2, $param3);
            }
            break;

        case 'medications':
            $medications = new medications_controller($entityManager);
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $medications->mainDisplay($controller, $userId, null, null, 'medicationName', 'asc');
            } elseif ($param1 === '') {
                $result = $medications->mainDisplay($controller, $userId, null, null, 'medicationName', 'asc');
            } elseif ($param1 === 'display') {
                $result = $medications->mainDisplay($controller, $userId, null, null, 'medicationName', 'asc', null, null, $param3);
            } elseif ($param1 === 'printlist') {
                $result = $medications->mainDisplay($controller, $userId, null, null, 'medicationName', 'asc', 'PDF', null, $param3);
            } elseif ($param2 === 'update') {
                $result = $medications->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $medications->deleteItem($entityManager, $controller, $param2);

            } elseif ($param1 === 'manage') {
                $result = $medications->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'print') {
                $result = $medications->manageItem($entityManager, $param2, $controller, 'PDF');
            } elseif ($param1 === 'create') {
                $result = $medications->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'copy') {
                $result = $medications->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $medications->action1($param1, $param2, $param3);
            }
            break;

        case 'blood_pressures':
            $blood_pressures = new blood_pressures_controller($entityManager);
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $blood_pressures->mainDisplay($controller, $userId, null, null, 'bloodPressureDate', 'desc');
            } elseif ($param1 === '') {
                $result = $blood_pressures->mainDisplay($controller, $userId, null, null, 'bloodPressureDate', 'desc');
            } elseif ($param2 === 'update') {
                $result = $blood_pressures->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $blood_pressures->deleteItem($entityManager, $controller, $param2);
            } elseif ($param1 === 'display') {
                $result = $blood_pressures->mainDisplay();
            } elseif ($param1 === 'manage') {
                $result = $blood_pressures->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'print') {
                $result = $blood_pressures->manageItem($entityManager, $param2, $controller, 'PDF');
            } elseif ($param1 === 'create') {
                $result = $blood_pressures->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'copy') {
                $result = $blood_pressures->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $blood_pressures->action1($param1, $param2, $param3);
            }
            break;

        case 'weights':
            $weights = new weights_controller($entityManager);
            $templateDir = 'vitals';
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $weights->mainDisplay($controller, $userId, null, null, 'weightDate', 'desc', null, $templateDir);
            } elseif ($param1 === '') {
                $result = $weights->mainDisplay($controller, $userId, null, null, 'weightDate', 'desc', null, $templateDir);
            } elseif ($param2 === 'update') {
                $result = $weights->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $weights->deleteItem($entityManager, $controller, $param2, $templateDir);
            } elseif ($param1 === 'display') {
                $result = $weights->mainDisplay();
            } elseif ($param1 === 'manage') {
                $result = $weights->manageItem($entityManager, $param2, $controller, null, $templateDir);
            } elseif ($param1 === 'print') {
                $result = $weights->manageItem($entityManager, $param2, $controller, 'PDF', $templateDir);
            } elseif ($param1 === 'create') {
                $result = $weights->manageItem($entityManager, $param2, $controller, null, $templateDir);
            } elseif ($param1 === 'copy') {
                $result = $weights->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $weights->action1($param1, $param2, $param3);
            }
            break;

        case 'creatinines':
            $creatinines = new creatinines_controller($entityManager);
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $creatinines->mainDisplay($controller, $userId, null, null, 'creatinineDate', 'desc');
            } elseif ($param1 === '') {
                $result = $creatinines->mainDisplay($controller, $userId, null, null, 'creatinineDate', 'desc');
            } elseif ($param2 === 'update') {
                $result = $creatinines->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $creatinines->deleteItem($entityManager, $controller, $param2);
            } elseif ($param1 === 'display') {
                $result = $creatinines->mainDisplay();
            } elseif ($param1 === 'manage') {
                $result = $creatinines->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'print') {
                $result = $creatinines->manageItem($entityManager, $param2, $controller, 'PDF');
            } elseif ($param1 === 'create') {
                $result = $creatinines->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'copy') {
                $result = $creatinines->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $creatinines->action1($param1, $param2, $param3);
            }
            break;

        case 'a1cs':
            $a1cs = new a1cs_controller($entityManager);
            $templateDir = 'labs';
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $a1cs->mainDisplay($controller, $userId, null, null, 'a1cDate', 'desc', $templateDir);
            } elseif ($param1 === '') {
                $result = $a1cs->mainDisplay($controller, $userId, null, null, 'a1cDate', 'desc', $templateDir);
            } elseif ($param2 === 'update') {
                $result = $a1cs->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $a1cs->deleteItem($entityManager, $controller, $param2, $templateDir);
            } elseif ($param1 === 'display') {
                $result = $a1cs->mainDisplay();
            } elseif ($param1 === 'manage') {
                $result = $a1cs->manageItem($entityManager, $param2, $controller, null, $templateDir);
            } elseif ($param1 === 'print') {
                $result = $a1cs->manageItem($entityManager, $param2, $controller, 'PDF', $templateDir);
            } elseif ($param1 === 'create') {
                $result = $a1cs->manageItem($entityManager, $param2, $controller, null, $templateDir);
            } elseif ($param1 === 'copy') {
                $result = $a1cs->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $a1cs->action1($param1, $param2, $param3);
            }
            break;

        case 'cholesterols':
            $cholesterols = new cholesterols_controller($entityManager);
            $templateDir = 'labs';
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $cholesterols->mainDisplay($controller, $userId, null, null, 'cholesterolDate', 'desc', $templateDir);
            } elseif ($param1 === '') {
                $result = $cholesterols->mainDisplay($controller, $userId, null, null, 'cholesterolDate', 'desc', $templateDir);
            } elseif ($param2 === 'update') {
                $result = $cholesterols->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $cholesterols->deleteItem($entityManager, $controller, $param2, $templateDir);
            } elseif ($param1 === 'display') {
                $result = $cholesterols->mainDisplay();
            } elseif ($param1 === 'manage') {
                $result = $cholesterols->manageItem($entityManager, $param2, $controller, null, $templateDir);
            } elseif ($param1 === 'print') {
                $result = $cholesterols->manageItem($entityManager, $param2, $controller, 'PDF', $templateDir);
            } elseif ($param1 === 'create') {
                $result = $cholesterols->manageItem($entityManager, $param2, $controller, null, $templateDir);
            } elseif ($param1 === 'copy') {
                $result = $cholesterols->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $cholesterols->action1($param1, $param2, $param3);
            }
            break;

        case 'procedures':
            $procedures = new procedures_controller($entityManager);
            //$entityClassName = 'App\Models\Participants';
            if (is_null($param1)) {
                $result = $procedures->mainDisplay($controller, $userId, null, null, 'procedureDate', 'desc');
            } elseif ($param1 === '') {
                $result = $procedures->mainDisplay($controller, $userId, null, null, 'procedureDate', 'desc');
            } elseif ($param2 === 'update') {
                $result = $procedures->saveItem($entityManager, $controller, $userId, $param3);
            } elseif ($param1 === 'delete') {
                $result = $procedures->deleteItem($entityManager, $controller, $param2);
            } elseif ($param1 === 'display') {
                $result = $procedures->mainDisplay();
            } elseif ($param1 === 'manage') {
                $result = $procedures->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'print') {
                $result = $procedures->manageItem($entityManager, $param2, $controller, 'PDF');
            } elseif ($param1 === 'create') {
                $result = $procedures->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'copy') {
                $result = $procedures->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $procedures->action1($param1, $param2, $param3);
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


        case 'users':
            $users = new users_controller($entityManager);
            if (is_null($param1)) {
                $result = $users->mainDisplay($controller, null);
            } elseif ($param1 === '') {
                $result = $users->mainDisplay($controller, null);
            } elseif ($param2 === 'update') {
                $result = $users->saveItem($entityManager, $controller, $param3);
            } elseif ($param1 === 'delete') {
                $result = $users->deleteItem($entityManager, $controller, $param2);
            } elseif ($param1 === 'display') {
                $result = $users->mainDisplay($controller, null);
            } elseif ($param1 === 'manage') {
                $result = $users->manageItem($entityManager, $param2, $controller);
            } elseif ($param1 === 'print') {
                $result = $users->manageItem($entityManager, $param2, $controller, 'PDF');
            } elseif ($param1 === 'create') {
                $result = $users->createUser();
            } elseif ($param1 === 'copy') {
                $result = $users->copyItem($entityManager, $controller, $param2);
            } else {
                $result = $users->action1($param1, $param2, $param3);
            }
            break;

        case 'sessions':
            $users = new users_controller($entityManager);
            if (is_null($param1)) {
                $errorMsg = '404 - Session Not Found';
                renderTemplate('errorMessage.twig', [
                    'param1' => $errorMsg,]);
            } elseif ($param1 === 'logout') {
                session_unset();
                session_destroy();
                //renderTemplate('session/login.twig');
            } elseif ($param1 === 'login') {    //shoudl this really be in the users block?
                $result = $users->userLogin($entityManager, 'Users', $_POST['username'],$_POST['pswd']);
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
