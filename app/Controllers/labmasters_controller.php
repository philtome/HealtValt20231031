<?php

namespace App\Controllers;

use App\Nodels\Labmasters;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class labmasters_controller extends abstract_controller
{

    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }
    public function movePostDataToFields($dataToSave, $userId, $em)
    {

        $dataToSave->setId(1);
        if (isset($_POST['labmasterdate'])) {
            $datetimeValue = $_POST['labmasterdate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setLabsDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }
        // Use current datetime regardless of POST input
        $currentDatetime = new \DateTime();
        $dataToSave->setLabsDate($currentDatetime);

        // look at fixing these later, when updates work
        $dataToSave->setLabsCreateDate($currentDatetime);
        $dataToSave->setLabsModifiedDate($currentDatetime);

        $dataToSave->setUserID($userId);
        $dataToSave->setLabsName(isset($_POST['labmasterlabsname']) ? filter_var($_POST['labmasterlabsname'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsSubtype(isset($_POST['labmasterlabstype']) ? filter_var($_POST['labmasterlabstype'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsValueType(isset($_POST['labsvaluetype']) ? filter_var($_POST['labsvaluetype'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsUnits(isset($_POST['labsunits']) ? filter_var($_POST['labsunits'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsLowValue(isset($_POST['labslowvalue']) ? filter_var($_POST['labslowvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsHighValue(isset($_POST['labshighvalue']) ? filter_var($_POST['labshighvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsValue2Type(isset($_POST['labsvalue2type']) ? filter_var($_POST['labsvalue2type'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsUnits2(isset($_POST['labsunits2']) ? filter_var($_POST['labsunits2'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsLowValue2(isset($_POST['labslowvalue2']) ? filter_var($_POST['labslowvalue2'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsHighValue2(isset($_POST['labshighvalue2']) ? filter_var($_POST['labshighvalue2'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLabsNotes(isset($_POST['labsnotes']) ? filter_var($_POST['labsnotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
//        $dataToSave->SetParticipant(isset($_POST['assessmentParticipant']) ? filter_var($_POST['assessmentParticipant'], FILTER_SANITIZE_SPECIAL_CHARS)
        return $dataToSave;
    }

}