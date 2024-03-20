<?php

namespace App\Controllers;

use App\Models\Creatinines;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class creatinines_controller extends abstract_controller

{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave, $userId, $em)
    {

        $dataToSave->setId(1);
        if (isset($_POST['creatininedate'])) {
            $datetimeValue = $_POST['creatininedate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setCreatinineDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }

        $dataToSave->setCreatinineValue(isset($_POST['creatininevalue']) ? filter_var($_POST['creatininevalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setCreatinineNotes(isset($_POST['creatininenotes']) ? filter_var($_POST['creatininenotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);

//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}