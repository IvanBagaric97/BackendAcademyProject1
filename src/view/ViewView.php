<?php


namespace view;
use lib, Routing;

class ViewView extends AbstractView
{
    public function __construct(private array $q, private array $solve)
    {
    }

    public function generateHTML()
    {
        $body = new lib\HTMLBodyElement();
        $table = new lib\HTMLTableElement();
        $table2 = new lib\HTMLTableElement();
        $center = new lib\HTMLAttribute("style", "text-align:center;");
        $table -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;"));
        $table2 -> add_attribute(new lib\HTMLAttribute("style", "width:100%; table-layout:fixed;border-collapse:separate;border: 2px solid black;"));

        $h1 = new lib\HTMLTableHeadElement();
        $h1 -> add_child(new lib\HTMLTextNode("QUIZ NAME"));
        $h2 = new lib\HTMLTableHeadElement();
        $h2 -> add_child(new lib\HTMLTextNode("TOOK THE QUIZ"));
        $h3 = new lib\HTMLTableHeadElement();
        $h3 -> add_child(new lib\HTMLTextNode("COMMENTS"));

        $table -> add_row(new lib\HTMLRowElement([$h1, $h2, $h3]));
        $table2 -> add_row(new lib\HTMLRowElement([$h1, $h2, $h3]));

        foreach ($this->q as $quiz){
            $t1 = new lib\HTMLCellElement();
            $t1->add_child(new lib\HTMLTextNode($quiz["name"]));
            $t1->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));

            $t2 = new lib\HTMLCellElement();
            if(isset($this->solve[$quiz["id"]])){
                $t2->add_child(new lib\HTMLTextNode("yes"));
                $l = new lib\HTMLAElement(Routing\Route::get("comments")->generate(["quiz_id" => $quiz["id"]]), "[comment]");
            }else{
                $t2->add_child(new lib\HTMLTextNode("no"));
                $l = new lib\HTMLTextNode("[comment]");
            }
            $t2->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));


            $t3 = new lib\HTMLCellElement();
            $t3->add_child(new lib\HTMLTextNode($l));
            $t3->add_attribute(new lib\HTMLAttribute("style", "height:50px; text-align:center; border:2px solid black;"));
            if($quiz["created_user_id"] == $_SESSION["id"]) {
                $table -> add_row(new lib\HTMLRowElement([$t1, $t2, $t3]));
            }else{
                $table2 -> add_row(new lib\HTMLRowElement([$t1, $t2, $t3]));
            }

        }

        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLH3Element("OWNED BY ME:"));
        $body -> add_child($table);
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLTextNode("<br>"));
        $body-> add_child(new lib\HTMLH3Element("OWNED BY OTHER:"));
        $body -> add_child($table2);

        echo $body;

    }
}