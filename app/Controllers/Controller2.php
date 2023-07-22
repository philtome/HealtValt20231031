<?php

namespace App\Controllers;
class Controller2
{
    public function action1($param1, $param2, $param3)
    {
        // Your controller logic here using $param1, $param2, $param3
        return $twig->render('template2.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
    }
}