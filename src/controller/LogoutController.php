<?php


namespace controller;


use JetBrains\PhpStorm\NoReturn;

class LogoutController extends AbstractController
{
    #[NoReturn] public function doAction() : void
    {
        session_unset();
        session_destroy();

        header("Location: /");
        die();
    }
}