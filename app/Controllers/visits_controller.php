<?php

namespace App\Controllers;

use App\Models\Visits;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class visits_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave,$userId, $em) {

        $dataToSave->setId(1);
        if (isset($_POST['visitdate'])) {
            $datetimeValue = $_POST['visitdate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }
        $dataToSave->setTypeVisit(isset($_POST['visittype']) ? filter_var($_POST['visittype'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setWithWho(isset($_POST['visitwith']) ? filter_var($_POST['visitwith'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setNotes(isset($_POST['visitnotes']) ? filter_var($_POST['visitnotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);
//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }
}