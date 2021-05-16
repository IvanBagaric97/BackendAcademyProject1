<?php

namespace controller;

use JetBrains\PhpStorm\Pure;
use view, db, Dispatch;


class IndexController extends AbstractController
{

    public function doAction() : void
    {
        if (isset($_SESSION["id"])) {
            header("Location: /home");
            die();
        }

        $h = new view\IndexView();
        $h -> generateHTML();
    }
}