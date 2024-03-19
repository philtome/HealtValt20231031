<?php

namespace App\Controllers;

use App\Models\Procedures;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class procedures_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave,$userId, $em) {

        $dataToSave->setId(1);
        if (isset($_POST['proceduredate'])) {
            $dateValue = $_POST['proceduredate'];
            $date = \DateTime::createFromFormat('Y-m-d', $dateValue);
            if ($date !== false) {
                $dataToSave->setProcedureDate($date);
            } else {
                // Handle invalid datetime input
            }
        }


        $dataToSave->setProcedureType(isset($_POST['proceduretype']) ? filter_var($_POST['proceduretype'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setProcedurePhysician(isset($_POST['procedurephysician']) ? filter_var($_POST['procedurephysician'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setProcedureFacility(isset($_POST['procedurefacility']) ? filter_var($_POST['procedurefacility'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setProcedureDescription(isset($_POST['proceduredescription']) ? filter_var($_POST['proceduredescription'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setProcedureResults(isset($_POST['procedureresults']) ? filter_var($_POST['procedureresults'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setProcedureInstructions(isset($_POST['procedureinstructions']) ? filter_var($_POST['procedureinstructions'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setProcedureMode(isset($_POST['procedureMode']) ? filter_var($_POST['procedureMode'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setNotes(isset($_POST['procedurenotes']) ? filter_var($_POST['procedurenotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);
//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}