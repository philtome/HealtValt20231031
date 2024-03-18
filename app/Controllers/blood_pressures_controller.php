<?php

namespace App\Controllers;

use App\Models\Blood_pressures;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class blood_pressures_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave, $userId, $em)
    {

        $dataToSave->setId(1);
        if (isset($_POST['bloodpressuredate'])) {
            $datetimeValue = $_POST['bloodpressuredate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setBloodPressureDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }

        $dataToSave->setSystolicPressure(isset($_POST['systolicpressure']) ? filter_var($_POST['systolicpressure'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setDiastolicPressure(isset($_POST['diastolicpressure']) ? filter_var($_POST['diastolicpressure'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setPosition(isset($_POST['position']) ? filter_var($_POST['position'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setArmUsed(isset($_POST['armused']) ? filter_var($_POST['armused'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setDeviceUsed(isset($_POST['deviceused']) ? filter_var($_POST['deviceused'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        //$dataToSave->setReason(isset($_POST['reason']) ? filter_var($_POST['reason'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setBloodPressureNotes(isset($_POST['bloodpressurenotes']) ? filter_var($_POST['bloodpressurenotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);

//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}