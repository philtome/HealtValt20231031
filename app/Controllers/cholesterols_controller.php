<?php

namespace App\Controllers;

use App\Models\Cholesterols;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class cholesterols_controller extends abstract_controller

{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave, $userId, $em)
    {

        $dataToSave->setId(1);
        if (isset($_POST['cholesteroldate'])) {
            $datetimeValue = $_POST['cholesteroldate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setCholesterolDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }

        $dataToSave->setCholesterolTotalValue(isset($_POST['cholesteroltotalvalue']) ? filter_var($_POST['cholesteroltotalvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setCholesterolLdlValue(isset($_POST['cholesterolldlvalue']) ? filter_var($_POST['cholesterolldlvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setCholesterolHdlValue(isset($_POST['cholesterolhdlvalue']) ? filter_var($_POST['cholesterolhdlvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setTriglyceridesTotalValue(isset($_POST['triglyceridestotalvalue']) ? filter_var($_POST['triglyceridestotalvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setCholesterolNotes(isset($_POST['cholesterolnotes']) ? filter_var($_POST['cholesterolnotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);

//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}