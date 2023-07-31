<?php

require_once __DIR__ . '/../app/twig.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. '/../app/render.php';
//require_once __DIR__. '/../config/config.php';

use App\Controllers\Controller1; // Add the correct namespace for Controller1
use App\Controllers\careplans; // Add the correct namespace for Controller2
use App\Controllers\participants;
use App\Controllers\contacts;


// Define your routes and include the necessary controllers


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

        $param1 = $uriParts[2];
        $param2 = $uriParts[3];
        $param3 = $uriParts[4];
    }
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

    case 'careplans_manageB': //****TESTING EXAMPLES - 'fetchbutton'
                              // button on home: etchButton event - replace entire screen
        renderTemplate('/bogustesting/careplanDetailsB.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
        break;

    case 'careplansB': // ****TESTING
        renderTemplate('/bogustesting/careplans_mainB.twig', [
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

    case 'template1':  //this will be changed to 'contacts'
        $contacts = new Controller1();
        renderTemplate('template1.twig', [
                'param1' => $param1,
                'param2' => $param2,
                'param3' => $param3
        ]);
        break;
    case 'careplans':
        $careplans = new careplans();
        $dude = new careplans();
        if (is_null($param1)) {
            $result = $careplans->mainDisplay();
        }
        elseif ($param1='display') {
        $result = $careplans->mainDisplay();
        }
        else {
            $result = $careplans->action1($param1, $param2, $param3);
        }
        break;

    case 'participants':
        $participants = new participants();
        if (is_null($param1)) {
            $result = $participants->mainDisplay();
        }
        elseif ($param1 === 'display') {
            $result = $participants->mainDisplay();
        }
        else {
            $result = $participants->action1($param1, $param2, $param3);
        }
        break;

    case 'participant_manage':
        renderTemplate('participantDetails.twig');
        break;

    case 'contacts':
        $contacts = new contacts();
        if (is_null($param1)) {
            $result = $contacts->mainDisplay();
        }
        elseif ($param1 === 'display') {
            $result = $contacts->mainDisplay();
        }
        elseif ($param1 === 'manage') {
            $result = $contacts->manageContact($param2);
        }
        else {
            $result = $contacts->action1($param1, $param2, $param3);
        }
        break;

    case 'contact_manage':
        renderTemplate('contactDetails.twig');
        break;

    default:
        $errorMsg = '404 - Not Found';
        renderTemplate('errorMessage.twig', [
            'param1' => $errorMsg,
        ]);
        break;

}
