<?php

namespace App\Controllers;

use App\Models\Users;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class users_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

//    public function getList()
//    {
//        $contacts = new Contacts_Model();
//        $listItems = $contacts->getContactsList();
//        return renderTemplate('contacts\contacts_main.twig', ['param1' => $listItems]);
//    }
    public function saveUser($em,$controllerClassName, $id = null)  //save new and existing
    {
        $modelClassName = $this->namespace.'\\'.$controllerClassName;

        $dataSaver = new DataSaver($em);
        $dataToSave = $this->movePostDataToFields($_POST);
        $templateToDisplay = $controllerClassName.'\\'.$controllerClassName.'_main.twig';
        if ($id !== null & $id !== "") {
            $dataSaver->updateData($modelClassName,$dataToSave, $id);
        }
        else {
            $dataSaver->saveData($modelClassName,$dataToSave);
        }
        //return renderTemplate($templateToDisplay, ['participantsController' => $participants->getParticipantsList()]);
        //return renderTemplate('contacts\contactsDetails.twig', ['contact' => $contactDetails]);
    }

    public function createUser()
    {
        $contacts = new Users();
        return renderTemplate('users\usersDetailsCreate.twig');
    }

    public function deleteUser($em,$controller,$id)
    {
        $namespace = $this->namespace;
        $entityClassName = $namespace.'\\'.$controller;
        $dataSaver = new DataSaver($em);
        $participants = new Users();
        $dataSaver->deleteData($entityClassName,$id);
        $templateToDisplay = $controller.'\\'.$controller.'_main.twig';
        //return renderTemplate($templateToDisplay, ['participantsController' => $participants->getParticipantsList()]);
    }

    public function userLogin($em,$controller,$username, $password) {
        $userExists = $this->usernameExists($em, $controller, $username, $password);
        //$passwordExists = $users->passwordExists($entityManager, 'users', $_POST['pwsd']);
        if ($userExists) {
            $_SESSION["userId"] = "temp";
            $response = ['redirect' => 'index.php']; // Modify 'index.php' to your desired URL
            echo json_encode($response);
        } else {
            $errorMessage = "Invalid username or password.";
            header('Content-Type: application/json');
            //http_response_code(401); // Use 401 Unauthorized
            echo json_encode(['error' => $errorMessage]);
        }
    }

    public function usernameExists($em,$controller,$username,$password) {
        $namespace = $this->namespace;
        $entityClassName = $namespace.'\\'.$controller;
        if ($username !== null) {
            $user = $this->em->getRepository($entityClassName)->findOneBy(['uid' => $username]);
        }
        if ($user !== null) {
            if (password_verify($password, $user->getPwd())) {
                return true;
            }
            else {
                return false;
            }
            return true;
        }
        else { return false;
        }

    }
    public function isPasswordValid(User $user, string $enteredPassword): bool {
        return password_verify($enteredPassword, $user->getPassword());
    }

    public function movePostDataToFields($dataToSave, $em = null) {
        $dataToSave->setId(1);
        $dataToSave->setUid(isset($_POST['useruid']) ? filter_var($_POST['useruid'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
             //below - do not hash the password right off the form, it gets hashed in the DataSaver, 'hashIt' = false
        if (isset($_POST['userpwd'])) {
            $dataToSave->setPwd(filter_var($_POST['userpwd'], FILTER_SANITIZE_SPECIAL_CHARS),false);
        }
        //$dataToSave->setPwd(isset($_POST['userpwd']) ? filter_var($_POST['userpwd'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setEmail(isset($_POST['useremail']) ? filter_var($_POST['useremail'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setFirstName(isset($_POST['userfirstname']) ? filter_var($_POST['userfirstname'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLastName(isset($_POST['userlastname']) ? filter_var($_POST['userlastname'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setPwdHint(isset($_POST['userpwdhint']) ? filter_var($_POST['userpwdhint'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setAdmin(isset($_POST['useradmin']) && $_POST['useradmin'] === 'on' ? 1 : 0);
        $dataToSave->setActive(isset($_POST['useractive']) &&$_POST['useractive'] === 'on' ? 1 : 0);
        $dataToSave->setLastSignon(isset($_POST['userlastSignon']) ? filter_var($_POST['userlastSignon'], FILTER_SANITIZE_SPECIAL_CHARS) : null);

        Return $dataToSave;
    }
}