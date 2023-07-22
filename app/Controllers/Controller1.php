<?php

namespace App\Controllers;
class Controller1
{
    public function action1($param1, $param2, $param3)
    {
        // Your controller logic here
        return $twig->render('template1.twig', [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3
        ]);
    }
}