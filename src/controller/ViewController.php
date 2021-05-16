<?php


namespace controller;
use db, view, lib;


class ViewController extends AbstractController
{
    public function doAction(): void
    {
        lib\check_access();

        $a = new db\DBDriver();
        $user = $a -> get_user_by_id($_SESSION["id"]);
        $e = $user["name"] . " " . $user["surname"];

        $h1 = new view\HeaderView($e);
        $h1 -> generateHTML();

        $quizzes = $a -> get_quizzes();
        $solved = $a -> get_quiz_answ_by_user_id($_SESSION["id"]);
        $solve = [];
        foreach ($solved as $s){
            $solve[$s["quiz_id"]] = $s["user_id"] == $_SESSION["id"] ? "yes" : "no";
        }
        $h2 = new view\ViewView($quizzes, $solve);
        $h2 -> generateHTML();
    }
}