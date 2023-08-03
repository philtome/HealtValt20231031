<?php

namespace App\Controllers;

use App\Models\Participants_Model;

class participants
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
        $participants = new Participants_Model();
        return renderTemplate('participants_main.twig',['participants' => $participants->getParticipantsList()]);
    }
    public function getList() {
        $participants = new Participants_Model();
        $listItems = $participants->getParticipantsList();
        return renderTemplate('participants_main.twig', ['param1' => $listItems]);
    }

}