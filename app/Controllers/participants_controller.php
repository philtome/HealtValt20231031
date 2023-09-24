<?php

namespace App\Controllers;

use App\Models\Participants;
use App\Models\Participants_Model;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;


class participants_controller extends abstract_controller
{

    protected ObjectManager $em;

    public function __construct($em) {
        $this->em=$em;

    }

//    public function mainDisplay($controller)
//    {
//        $namespace = $this->namespace;
//        $model = $namespace.'\\'.ucfirst($controller);
//        $dataToDisplay = $this->em->getRepository($model)->findAll();
//        $templateToDisplay = $controller.'\\'.$controller.'_main.twig';
//
//
//        $key = $controller; // You can set this key dynamically
//        $templateData = [$key => $dataToDisplay];
//        return renderTemplate($templateToDisplay, $templateData);
//
//        //return renderTemplate($templateToDisplay,['participants' => $dataToDisplay]);
//    }


//    public function manageItem($id,$controller)
//    {
//        $namespace = $this->namespace;
//        $model = $namespace.'\\'.ucfirst($controller);
//        $dataToDisplay = $this->em->getRepository($model)->find($id);
//        $key = $controller; // You can set this key dynamically
//        $templateData = [$key => $dataToDisplay];
//        $templateToDisplay = $controller.'\\'.$controller.'Details.twig';
//        return renderTemplate($templateToDisplay, $templateData);
//    }

    public function saveParticipant($em,$controllerClassName, $id = null)  //save new and existing
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

    public function createParticipant()
    {
        $contacts = new Participants();
        return renderTemplate('participants\participantsDetails.twig');
    }

//    public function copyParticipant($em,$controller,$id)
//    {
//        $namespace = $this->namespace;
//        $entityClassName = $namespace.'\\'.$controller;
//        $dataSaver = new DataSaver($em);
//        $CopyFromParticipant = $this->em->find($entityClassName,$id);
//        $dataSaver->saveData($entityClassName,$CopyFromParticipant);
//    }

    public function deleteParticipant($em,$controller,$id)
    {
        $namespace = $this->namespace;
        $entityClassName = $namespace.'\\'.$controller;
        $dataSaver = new DataSaver($em);
        $participants = new Participants();
        $dataSaver->deleteData($entityClassName,$id);
        $templateToDisplay = $controller.'\\'.$controller.'_main.twig';
        //return renderTemplate($templateToDisplay, ['participantsController' => $participants->getParticipantsList()]);
    }


    Public function getDropDowns()
    {
        $contactsModelClassName = $this->namespace . '\\' . ucfirst('contacts');
        $contactRepository = $this->em->getRepository($contactsModelClassName);
        $contacts = $contactRepository->findAll();
        //return $contacts;
        return ['contactList' => $contacts];
    }


    public function movePostDataToFields($dataToSave,$em)
    {

        $dataToSave->setId(1);
        $dataToSave->setlastName(isset($_POST['participantLastName']) ? filter_var($_POST['participantLastName'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->SetFirstName(isset($_POST['participantFirstName']) ? filter_var($_POST['participantFirstName'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setstreetAddress1(isset($_POST['participantAddress']) ? filter_var($_POST['participantAddress'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setstreetAddress2(isset($_POST['participantAddress2']) ? filter_var($_POST['participantAddress2'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setcity(isset($_POST['participantCity']) ? filter_var($_POST['participantCity'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setstate(isset($_POST['participantState']) ? filter_var($_POST['participantState'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setzip(isset($_POST['participantZip']) ? filter_var($_POST['participantZip'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setphone(isset($_POST['participantPhone']) ? filter_var($_POST['participantPhone'], FILTER_SANITIZE_NUMBER_INT) : null);
        $dataToSave->setnotes(null);

        $participantResponParty = isset($_POST['responsibleParty']) ? filter_var($_POST['responsibleParty'], FILTER_SANITIZE_NUMBER_INT) : null;
        $modelClassName = $this->namespace.'\\Contacts';
        $contactRepository = $em->getRepository($modelClassName); // Replace with your Contact entity class
        $dataToSave->setresponsibleParty($contactRepository->find($participantResponParty));

        Return $dataToSave;

    }
}