<?php


namespace controller;
use view, db, lib;


class AccountController extends AbstractController
{
    public function doAction() : void
    {
        lib\check_access();

        $a = new db\DBDriver();
        $user = $a -> get_user_by_id($_SESSION["id"]);
        $answ = $a -> get_quiz_answ_by_user_id($_SESSION["id"]);
        $send = [];

        foreach($answ as $ans){
            array_push($send, [$a -> get_quiz_by_id($ans["quiz_id"])["name"], $ans["points"]]);
        }

        $data = [];
        $visited = [];
        foreach ($send as $item1) {
            $attempts = 0;
            $scores = 0;
            $name = $item1[0];
            foreach ($send as $item2){
                if($item2[0] == $name and !in_array($name, $visited)){
                    $attempts += 1;
                    $scores += $item2[1];
                }
            }
            array_push($visited, $name);
            if($attempts != 0) array_push($data, [$name, $attempts, $scores/$attempts]);
        }

        $h1 = new view\HeaderView($user["name"] . " " . $user["surname"]);
        $h1 -> generateHTML();

        $h2 = new view\AccountView($user, $data);
        $h2 -> generateHTML();
    }
}