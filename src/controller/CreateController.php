<?php


namespace controller;
use view, db, lib;

class CreateController extends AbstractController
{
    public function doAction() : void
    {
        lib\check_access();

        $a = new db\DBDriver();
        $user = $a -> get_user_by_id($_SESSION["id"]);
        $e = $user["name"] . " " . $user["surname"];

        $h1 = new view\HeaderView($e);
        $h1 -> generateHTML();

        $h2 = new view\CreateView();
        $h2 -> generateHTML();
    }
}