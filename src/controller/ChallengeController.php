<?php


namespace controller;
use db, view;

class ChallengeController extends AbstractController
{
    public function doAction(): void
    {
        $a = new db\DBDriver();
        $quizzes = $a -> get_quizzes();

        $user = $a -> get_user_by_id($_SESSION["id"]);
        $e = $user["name"] . " " . $user["surname"];

        $h1 = new view\HeaderView($e);
        $h1 -> generateHTML();

        $h2 = new view\QuizTableView($quizzes);
        $h2 -> generateHTML();
    }
}