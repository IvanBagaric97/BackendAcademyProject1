<?php


namespace controller;
use lib, Dispatch, db, view;

class EvaluateController extends AbstractController
{
    public function doAction() : void
    {
        $id = Dispatch\Dispatcher::getInstance()->getRoute()->getParam('quiz_id');
        $a = new db\DBDriver();
        $x = $a -> get_quiz_by_id($id);
        $enable_comments = $a -> get_quiz_by_id($id)["enable_comments"];

        if (!isset($_SESSION["id"])) {
            if($x["is_public"]){
                $h = new view\NonRegView();
            }else{
                $h = new view\AccessView();
            }
            $h ->generateHTML();
            die();
        }

        $all_comments = $a -> get_comments_by_id($id);
        $comments = [];
        foreach($all_comments as $com){
            array_push($comments, [$a -> get_user_by_id($com["user_id"])["name"], $com["content"]]);
        }

        $file = $x["qref_file"];
        $pitanja = lib\get_questions($file);

        $tocno = 0;
        $ukupno = 0;

        $save = "";

        for($i = 1; $i <= count($pitanja); $i++){
            $odg = lib\post("pitanje" . strval($i));

            if(is_null($odg)){
                $save .= "Pitanje " . strval($i) . ": " . $pitanja[$i-1][1] . "<br>";
                $save .= "Odgovoreno: <br>" . "Tocno: " . $pitanja[$i-1][3] . "<br>" . "<br>";
                $ukupno += 1;
                continue;
            }

            if(count($odg) === 1) $odg = $odg[0];

            $save .= "Pitanje " . strval($i) . ": " . $pitanja[$i-1][1] . "<br>";

            if($pitanja[$i-1][0] === "1" | $pitanja[$i-1][0] === "3" | !is_array($odg)){
                if(strtoupper($odg) === strtoupper($pitanja[$i-1][3])) $tocno += 1;

                $save .= "Odgovoreno: " . htmlentities($odg) . "<br>" . "Tocno: " . $pitanja[$i-1][3] . "<br>" . "<br>";

            }else{
                $correct = str_replace(' ', '', $pitanja[$i-1][3]);
                $ans = implode(",", $odg);
                if($correct === $ans) $tocno += 1;

                $save .= "Odgovoreno: " . htmlentities($ans) . "<br>" . "Tocno: " . $correct . "<br>" . "<br>";
            }
            $ukupno += 1;
        }

        $postotak = ($tocno / $ukupno) * 100;

        $save .= "Postotak:" . strval($postotak) . "% <br><br>";

        $a -> set_new_quiz_answers($id, $_SESSION["id"], $postotak, lib\to_qref($save));

        $h1 = new view\EvaluateView($save);
        $h1 -> generateHTML();
        $h2 = new view\CommentsView($id, $comments, $enable_comments);
        $h2 -> generateHTML();
    }
}