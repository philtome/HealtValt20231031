<?php

namespace App\Controllers;

use App\Models\Users;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;

class users_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em)
    {
        $this->em = $em;
    }
    public function movePostDataToFields($dataToSave, $em = null) {
        $dataToSave->setId(1);
        $dataToSave->setUid(isset($_POST['uid']) ? filter_var($_POST['uid'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setPwd(isset($_POST['pwd']) ? filter_var($_POST['pwd'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setEmail(isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setAdmin(isset($_POST['admin']) ? filter_var($_POST['admin'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setActdive(isset($_POST['active']) ? filter_var($_POST['active'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
        $dataToSave->setLastSignon(isset($_POST['lastSignon']) ? filter_var($_POST['lastSignon'], FILTER_SANITIZE_SPECIAL_CHARS) : null);
}
}