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

    public function movePostDataToFields($dataToSave,$em) {

        $dataToSave->setId(1);
        if (isset($_POST['visitDate'])) {
            $datetimeValue = $_POST['visitDate'];
            $datetime = \DateTime::createFromFormat('Y-m-d\TH:i', $datetimeValue);
            if ($datetime !== false) {
                $dataToSave->setDate($datetime); // Assuming 'setDatetime' is the method to set the datetime property
            } else {
                // Handle invalid datetime input
                // You can set a default datetime or generate an error message
                // For example, $dataToSave->setDatetime(null) or throw an exception
            }
        }
        return $dataToSave;
    }
}