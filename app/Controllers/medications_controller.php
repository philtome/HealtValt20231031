<?php

namespace App\Controllers;

use App\Models\Medications;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class medications_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave,$userId, $em) {

        $dataToSave->setId(1);
        if (isset($_POST['datestarted'])) {
            $dateValue = $_POST['datestarted'];
            $date = \DateTime::createFromFormat('Y-m-d', $dateValue);
            if ($date !== false) {
                $dataToSave->setDateStarted($date);
            } else {
                // Handle invalid datetime input
            }
        }
        if (isset($_POST['datestopped'])) {
            $dateValue = $_POST['datestopped'];
            $date = \DateTime::createFromFormat('Y-m-d', $dateValue);
            if ($date !== false) {
                $dataToSave->setDateStopped($date);
            } else {
                $dataToSave->setDateStopped("");
                // Handle invalid datetime input
            }
        }

        $dataToSave->setMedicationName(isset($_POST['medicationname']) ? filter_var($_POST['medicationname'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setStrength(isset($_POST['strength']) ? filter_var($_POST['strength'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setDose(isset($_POST['dose']) ? filter_var($_POST['dose'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setHowTaken(isset($_POST['howtaken']) ? filter_var($_POST['howtaken'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setHowOften(isset($_POST['howoften']) ? filter_var($_POST['howoften'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setReason(isset($_POST['reason']) ? filter_var($_POST['reason'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setInactive(isset($_POST['medicationinactive']) ? filter_var($_POST['medicationinactive'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setNotes(isset($_POST['medicationnotes']) ? filter_var($_POST['medicationnotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);
//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}