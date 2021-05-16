<?php


namespace controller;
use db, view, lib;

class StatsController extends AbstractController
{
    public function doAction(): void
    {
        $a = new db\DBDriver();

        $user = $a -> get_user_by_id($_SESSION["id"]);
        $e = $user["name"] . " " . $user["surname"];

        $answers = $a -> get_answers();
        $quizzes = [];
        $owned_by = [];
        $visited = [];
        foreach ($answers as $ans1){
            $quiz_id = $ans1["quiz_id"];
            $points = [];
            foreach ($answers as $ans2){
                if($ans2["quiz_id"] == $quiz_id and !in_array($ans2["quiz_id"], $visited)){
                    array_push($points, $ans2["points"]);
                }
            }
            if(!in_array($quiz_id, $visited)) {
                array_push($visited, $quiz_id);
                $quizzes[$quiz_id] = $points;
                $owned_by[$quiz_id] = $a->get_quiz_by_id($quiz_id)["created_user_id"];
            }
        }

        $ret = [];
        foreach ($quizzes as $key => $value){
            $ret[$key] = [min($value), max($value), lib\calculate_average($value),
                    lib\stand_deviation($value), lib\calculate_median($value)];
        }

        $h1 = new view\HeaderView($e);
        $h1 -> generateHTML();
        $h2 = new view\StatsView($ret, $owned_by);
        $h2 -> generateHTML();
    }
}