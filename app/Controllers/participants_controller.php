<?php

namespace App\Controllers;

use App\Models\Participants;
use App\Models\Participants_Model;
use App\Models\DataSaver;
use Doctrine\Persistence\ObjectManager;

class participants_controller extends abstract_controller
{
    private ObjectManager $em;

    public function __construct($em) {
        $this->em=$em;
    }

    public function mainDisplay()
    {
        $participants = $this->em->getRepository(Participants::class)->findAll();

        return renderTemplate('participants\participants_main.twig',['participants' => $participants]);    }


    public function manageParticipant($id)
    {
        $participant = $this->em->getRepository(Participants::class)->find($id);
        return renderTemplate('participants\participantDetails.twig', ['participant' => $participant]);
    }

    public function saveParticipant($em,$id = null)  //save new and existing
    {
        $dataSaver = new DataSaver($em);
        $participants = new Participants();
        $dataToSave = $this->movePostDataToFields($_POST);
        if ($id !== null & $id !== "") {
            $dataSaver->updateData('App\Models\Participants',$dataToSave, $id);
        }
        else {
            $dataSaver->saveData('App\Models\Participants',$dataToSave);
        }
        return renderTemplate('participants\participants_main.twig', ['participantsController' => $participants->getParticipantsList()]);
        //return renderTemplate('contacts\contactDetails.twig', ['contact' => $contactDetails]);
    }

    public function createParticipant()
    {
        $contacts = new Participants();
        return renderTemplate('participants\participantDetails.twig');
    }

    public function copyParticipant($em,$id)
    {
        $dataSaver = new DataSaver($em);
        $CopyFromParticipant = $this->em->find('App\Models\Participants',$id);
        $dataSaver->saveData('App\Models\Participants',$CopyFromParticipant);
        return renderTemplate('participants\participants_main.twig', ['participant' => $participants->getParticipantsList()]);
    }

    public function deleteParticipant($em,$id)
    {
        $dataSaver = new DataSaver($em);
        $participants = new Participants();
        $dataSaver->deleteData('App\Models\Participants',$id);
        return renderTemplate('participants\participants_main.twig', ['participantsController' => $participants->getParticipantsList()]);
    }

    public function getList() {
        $participants = new Participants_Model();
        $listItems = $participants->getParticipantsList();
        return renderTemplate('participants\participants_main.twig', ['param1' => $listItems]);
    }
    public function movePostDataToFields($participantDetails)
    {

        $participantLastN = isset($_POST['participantLastName']) ? filter_var($_POST['participantLastName'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $participantFirstN = isset($_POST['participantFirstName']) ? filter_var($_POST['participantFirstName'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $participantAddress = isset($_POST['participantAddress']) ? filter_var($_POST['participantAddress'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $participantAddress2 = isset($_POST['participantAddress2']) ? filter_var($_POST['participantAddress2'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $participantCity = isset($_POST['participantCity']) ? filter_var($_POST['participantCity'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $participantState = isset($_POST['participantState']) ? filter_var($_POST['participantState'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $participantZip= isset($_POST['participantZip']) ? filter_var($_POST['participantZip'], FILTER_SANITIZE_SPECIAL_CHARS) : null;
        $participantResponParty = isset($_POST['participantResponParty']) ? filter_var($_POST['participantResponParty'], FILTER_SANITIZE_SPECIAL_CHARS) : null;


        //$participantEmail = isset($_POST['participantemail']) ? filter_var($_POST['participantemail'], FILTER_VALIDATE_EMAIL) : null;
        //  CHECK OUT PHONE FIELD HERE COMPARED TO PARTICIPANT DETAILS TWIG
        $participantPhone = isset($_POST['participantPhone']) ? filter_var($_POST['participantPhone'], FILTER_SANITIZE_NUMBER_INT) : null;
        // Add more fields as needed

        // Check if data is valid
        if ($participantLastN !== null && $participantPhone !== null) {
            // Data is valid, proceed to update the database
            Return $dataToReturn = [
                'firstName' => $participantFirstN,
                'lastName' => $participantLastN,
                'streetAddress1' => $participantAddress,
                'streetAddress2' => $participantAddress2,
                'city' => $participantCity,
                'state' => $participantState,
                'zip' => $participantZip,
                'responsibleParty' => $participantResponParty,
                'phone' => $participantPhone,

                // Add more fields as needed
            ];
        }
    }
}