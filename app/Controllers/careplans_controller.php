<?php

namespace App\Controllers;

use App\Models\Careplans;
use App\Models\Careplans_model;
use App\Utils\DataSaver;
use Doctrine\Persistence\ObjectManager;


class careplans_controller extends abstract_controller
{
    protected ObjectManager $em;

    public function __construct($em) {
        $this->em=$em;
    }
    public function action1($param1, $param2, $param3)
    {
        // Your controller logic here using $param1, $param2, $param3
        return renderTemplate('template2.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
    }

}