<?php


namespace view;
use lib, Routing;

class QuizTableView extends AbstractView
{

    public function __construct(private array $q)
    {
    }

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();
        $center = new lib\HTMLAttribute("style", "text-align:center;");
        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;"));

        $h1 = new lib\HTMLTableHeadElement();
        $h1 -> add_child(new lib\HTMLTextNode("QUIZ NAME"));
        $h2 = new lib\HTMLTableHeadElement();
        $h2 -> add_child(new lib\HTMLTextNode("DESCRIPTION"));
        $h3 = new lib\HTMLTableHeadElement();
        $h3 -> add_child(new lib\HTMLTextNode("SOLVE"));

        $table -> add_row(new lib\HTMLRowElement([$h1, $h2, $h3]));

        foreach ($this->q as $quiz){
            $t1 = new lib\HTMLCellElement();
            $t1 -> add_child(new lib\HTMLTextNode($quiz["name"]));
            $t1 -> add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t2 = new lib\HTMLCellElement();
            $t2 -> add_child(new lib\HTMLTextNode($quiz["description"]));
            $t2 -> add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $a1 = new lib\HTMLAElement(Routing\Route::get("solve")->generate(["quiz_id" => $quiz["id"]]), "[solve]");
            $t3 = new lib\HTMLCellElement();
            $t3 -> add_child($a1);
            $t3 -> add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $table -> add_row(new lib\HTMLRowElement([$t1, $t2, $t3]));
        }

        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body -> add_child($table);

        echo $body;
    }
}