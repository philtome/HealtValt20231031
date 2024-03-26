<?php

namespace App\Controllers;

use App\Models\Weights;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class weights_controller extends abstract_controller

{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function movePostDataToFields($dataToSave, $userId, $em)
    {
        $dataToSave->setId(1);
        if (isset($_POST['weightdate'])) {
            $dateValue = $_POST['weightdate'];
            $date = \DateTime::createFromFormat('Y-m-d', $dateValue);
            if ($date !== false) {
                $dataToSave->setWeightDate($date);
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }
        $dataToSave->setWeightValue(isset($_POST['weightvalue']) ? filter_var($_POST['weightvalue'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setWeightNotes(isset($_POST['weightnotes']) ? filter_var($_POST['weightnotes'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setUserID($userId);
        return $dataToSave;
    }
}