<?php

namespace App\Controllers;

use App\Models\Settings;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class settings_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }


    public function movePostDataToFields($dataToSave,$em = null)
    {

        $dataToSave->setId(1);
        $dataToSave->setUid(isset($_POST['useruid']) ? filter_var($_POST['useruid'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setDoc1Desc(isset($_POST['doc1desc']) ? filter_var($_POST['doc1desc'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setDoc2Desc(isset($_POST['doc2desc']) ? filter_var($_POST['doc2desc'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setContactDesc(isset($_POST['contactdesc']) ? filter_var($_POST['contactdesc'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setParticipantDesc(isset($_POST['participantdesc']) ? filter_var($_POST['participantdesc'], FILTER_SANITIZE_SPECIAL_CHARS) : null);

        Return $dataToSave;
    }

}