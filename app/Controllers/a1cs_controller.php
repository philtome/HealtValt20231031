<?php

namespace App\Controllers;

use App\Models\A1cs;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class a1cs_controller extends abstract_controller

{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave, $userId, $em)
    {

        $dataToSave->setId(1);
        if (isset($_POST['a1cdate'])) {
            $datetimeValue = $_POST['a1cdate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setA1cDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }

        $dataToSave->setA1cValue(isset($_POST['a1cvalue']) ? filter_var($_POST['a1cvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setA1cNotes(isset($_POST['a1cnotes']) ? filter_var($_POST['a1cnotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);

//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}