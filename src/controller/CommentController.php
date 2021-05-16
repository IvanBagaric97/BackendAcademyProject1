<?php


namespace controller;
use db, Dispatch, lib;
use JetBrains\PhpStorm\NoReturn;

class CommentController extends AbstractController
{
    #[NoReturn] public function doAction(): void
    {
        lib\check_access();

        $id = Dispatch\Dispatcher::getInstance()->getRoute()->getParam('quiz_id');
        $a = new db\DBDriver();
        $a -> set_new_comment($_POST["comment"], $id, $_SESSION["id"]);

        header("Location: /home");
        die();
    }
}