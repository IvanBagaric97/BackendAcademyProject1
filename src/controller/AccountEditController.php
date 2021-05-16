<?php


namespace controller;
use db, view, lib;


class AccountEditController extends AbstractController
{
    public function doAction() : void
    {
        lib\check_access();

        $a = new db\DBDriver();
        $user = $a -> get_user_by_id($_SESSION["id"]);

        $h1 = new view\HeaderView($user["name"] . " " . $user["surname"]);
        $h1 -> generateHTML();

        $h2 = new view\AccountEditView();
        $h2 -> generateHTML();
    }
}