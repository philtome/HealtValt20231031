<?php

namespace App\Controllers;

use App\Models\Careplan;
use App\Models\Careplans_model;
use Doctrine\Persistence\ObjectManager;


class careplan_controller
{
    private ObjectManager $em;

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

    public function mainDisplay()
    {
        $carePlans = $this->em->getRepository(Careplan::class)->findAll();

        return renderTemplate('careplans_main.twig',['careplans' => $carePlans]);
    }
    public function getList() {
        $careplans = new Careplans_Model();
        $listItems = $careplans->getCareplanList();
        return renderTemplate('template2.twig', ['param1' => $listItems]);
    }

}