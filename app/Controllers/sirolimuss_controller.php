<?php

namespace App\Controllers;
 use App\Models\Sirolimuss;
 use App\Utils\DataSaver;
 use Doctrine\Persistence\ObjectManager;

class sirolimuss_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave, $userId, $em)
    {

        $dataToSave->setId(1);
        if (isset($_POST['sirolimusdate'])) {
            $datetimeValue = $_POST['sirolimusdate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setSirolimusDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }

        $dataToSave->setSirolimusValue(isset($_POST['sirolimusvalue']) ? filter_var($_POST['sirolimusvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setSirolimusNotes(isset($_POST['sirolimusnotes']) ? filter_var($_POST['sirolimusnotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);

//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}