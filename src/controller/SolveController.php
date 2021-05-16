<?php


namespace controller;
use db, view, Dispatch, lib;

class SolveController extends AbstractController
{
    public function doAction() : void
    {
        $id = Dispatch\Dispatcher::getInstance()->getRoute()->getParam('quiz_id');
        $a = new db\DBDriver();
        $x = $a -> get_quiz_by_id($id);

        if (!isset($_SESSION["id"]) and !$x["is_public"]) {
            $h = new view\AccessView();
            $h -> generateHTML();
            die();
        }

        $file = $x["qref_file"];
        $pitanja = lib\get_questions($file);

        $h = new view\SolveView($id, $pitanja);
        $h -> generateHTML();
    }
}