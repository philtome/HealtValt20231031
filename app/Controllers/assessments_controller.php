<?php

namespace App\Controllers;

use App\Models\Assessments;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class assessments_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
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

    public function getList()
    {
        $contacts = new Contacts_Model();
        $listItems = $contacts->getContactsList();
        return renderTemplate('contacts\contacts_main.twig', ['param1' => $listItems]);
    }
    public function createAssessment()
    {
        $assessments = new Assessments();
        //$contactDetails = $contacts->get_contact();
        return renderTemplate('assessments\assessmentsDetails.twig');
    }

    Public function getDropDowns()
    {
        $participantsModelClassName = $this->namespace . '\\' . ucfirst('participants');
        $participantRepository = $this->em->getRepository($participantsModelClassName);
        $participants = $participantRepository->findAll();
        //return $$participants;
        return ['participantList' => $participants];
    }

    public function movePostDataToFields($dataToSave,$em)
    {

        $dataToSave->setId(1);
        if (isset($_POST['assessmentDate'])) {
            $datetimeValue = $_POST['assessmentDate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }
        $dataToSave->setSeniorAdult(isset($_POST['assessmentSeniorAdult']) ? filter_var($_POST['assessmentSeniorAdult'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setAbsent(isset($_POST['assessmentAbsent']) ? filter_var($_POST['assessmentAbsent'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setOuting(isset($_POST['assessmentOuting']) ? filter_var($_POST['assessmentOuting'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setInHouseAct(isset($_POST['assessmentInHouseAct']) ? filter_var($_POST['assessmentInHouseAct'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setIndyskilsdev(isset($_POST['assessmentIndySkilsDev']) ? filter_var($_POST['assessmentIndySkilsDev'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setVolunteer(isset($_POST['assessmentVolunteer']) ? filter_var($_POST['assessmentVolunteer'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setReading(isset($_POST['assessmentReading']) ? filter_var($_POST['assessmentReading'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setWriting(isset($_POST['assessmentWriting']) ? filter_var($_POST['assessmentWriting'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setEddevelopment(isset($_POST['assessmentEddevelopment']) ? filter_var($_POST['assessmentEddevelopment'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setArt(isset($_POST['assessmentArt']) ? filter_var($_POST['assessmentArt'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setCrafts(isset($_POST['assessmentCrafts']) ? filter_var($_POST['assessmentCrafts'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setSocializing(isset($_POST['assessmentSocializing']) ? filter_var($_POST['assessmentSocializing'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setCurrentEvents(isset($_POST['assessmentCurrentEvents']) ? filter_var($_POST['assessmentCurrentEvents'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLunch(isset($_POST['assessmentLunch']) ? filter_var($_POST['assessmentLunch'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setSnack(isset($_POST['assessmentSnack']) ? filter_var($_POST['assessmentSnack'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setToilet(isset($_POST['assessmentToilet']) ? filter_var($_POST['assessmentToilet'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setGrooming(isset($_POST['assessmentGrooming']) ? filter_var($_POST['assessmentGrooming'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setDance(isset($_POST['assessmentDance']) ? filter_var($_POST['assessmentDance'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setMusic(isset($_POST['assessmentMusic']) ? filter_var($_POST['assessmentMusic'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setExercise(isset($_POST['assessmentExercise']) ? filter_var($_POST['assessmentExercise'], FILTER_SANITIZE_SPECIAL_CHARS) : null);        //    art*
        $dataToSave->setNotes(isset($_POST['assessmentNotes']) ? filter_var($_POST['assessmentNotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);

        $assessmentParticipant = isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_NUMBER_INT) : null;
        $modelClassName = $this->namespace.'\\Participants';
        $participantRepository = $em->getRepository($modelClassName); // Replace with your Contact entity class
        $dataToSave->setParticipant($participantRepository->find($assessmentParticipant));

        return $dataToSave;
    }
}