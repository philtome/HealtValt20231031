<?php

namespace App\Controllers;

use App\Models\Careplans_model;

class careplans
{
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
        $careplans = new Careplans_Model();
        return renderTemplate('careplans_main.twig',['careplans' => $careplans->getCareplanList()]);
    }
    public function getList() {
        $careplans = new Careplans_Model();
        $listItems = $careplans->getCareplanList();
        return renderTemplate('template2.twig', ['param1' => $listItems]);
    }

}