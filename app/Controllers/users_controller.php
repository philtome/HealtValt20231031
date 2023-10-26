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

    public function usernameExists($em,$controller,$username,$password) {
        $namespace = $this->namespace;
        $entityClassName = $namespace.'\\'.$controller;
        if ($username !== null) {
            $user = $this->em->getRepository($entityClassName)->findOneBy(['uid' => $username]);
        }
        if ($user !== null) {
            $tryPass = $user->getPwd();
            $testPassword = $user->getEmail();
            $anothertest = password_verify($testPassword,$tryPass);
            // this is ignored for now...
            //$hashedEntered = password_hash($password, PASSWORD_DEFAULT);
            //$tryPass = password_hash($hash, PASSWORD_DEFAULT);
            $whatisit = (password_verify($password, $tryPass));
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
             //below - do not has the password right off the form, it gets hashed in the DataSaver, 'hashIt' = false
        $dataToSave->setPwd(isset($_POST['userpwd']) ? filter_var($_POST['userpwd'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setEmail(isset($_POST['useremail']) ? filter_var($_POST['useremail'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setAdmin(isset($_POST['useradmin']) && $_POST['useradmin'] === 'on' ? 1 : 0);
        $dataToSave->setActive(isset($_POST['useractive']) &&$_POST['useractive'] === 'on' ? 1 : 0);
        $dataToSave->setLastSignon(isset($_POST['userlastSignon']) ? filter_var($_POST['userlastSignon'], FILTER_SANITIZE_SPECIAL_CHARS) : null);

        Return $dataToSave;
    }
}